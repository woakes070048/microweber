<?php
namespace MicroweberPackages\Backup\tests;

use MicroweberPackages\Backup\GenerateBackup;
use MicroweberPackages\Content\Models\Content;
use MicroweberPackages\Core\tests\TestCase;
use MicroweberPackages\Export\SessionStepper;
use MicroweberPackages\Multilanguage\tests\MultilanguageTest;
use MicroweberPackages\Post\Models\Post;


/**
 * Run test
 * @author bobi@microweber.com
 * @command php artisan test --filter GenerateBackupTest
 */



class GenerateBackupTest extends TestCase
{
    public function testSingleModuleBackup() {

        \Config::set('microweber.allow_php_files_upload', true);

        $sessionId = SessionStepper::generateSessionId(20);

        for ($i = 0; $i <= 20; $i++) {
            $backup = new GenerateBackup();
            $backup->setSessionId($sessionId);
            $backup->setExportModules([
                'categories/category_images',
                'content',
                'menu',
            ]);
            $status = $backup->start();
            if (isset($status['success'])) {
                break;
            }
        }

        $this->assertTrue(is_file($status['data']['filepath']), 'File not found');

        $zip = new \ZipArchive();
        $zip->open($status['data']['filepath']);

        $moduleInZip = $zip->getFromName('modules/categories/category_images/index.php');
        $moduleInZip2 = $zip->getFromName('modules/content/index.php');
        $moduleInZip3= $zip->getFromName('modules/menu/index.php');

        $zip->close();

        $this->assertNotEmpty($moduleInZip);
        $this->assertNotEmpty($moduleInZip2);
        $this->assertNotEmpty($moduleInZip3);
    }

    public function testSingleTableBackup() {

        $getAllContent = Content::all();
        $getAllContent->each(function ($content) {
            $content->delete();
        });

        $post = new Post();
        $post->url = 'test-post';
        $post->title = 'Test post';
        $post->save();

        $sessionId = SessionStepper::generateSessionId(1);

        $backup = new GenerateBackup();
        $backup->setSessionId($sessionId);
        $backup->setAllowSkipTables(false);
        $backup->setExportTables(['content']);
        $backup->setExportMedia(false);
        $backup->setExportModules([]);
        $backup->setExportTemplates([]);

        $status = $backup->start();

        $content = file_get_contents($status['data']['filepath']);
        $content = json_decode($content, true);

        $this->assertNotEmpty($content['content'][0]['url']);
        $this->assertNotEmpty($content['__table_structures']['content']['url']);

        $this->assertSame($content['content'][0]['url'], 'test-post');
        $this->assertSame($content['content'][0]['title'], 'Test post');


    }
}
