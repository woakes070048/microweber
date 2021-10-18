<?php
namespace MicroweberPackages\Multilanguage\tests;

use Illuminate\Support\Facades\Auth;
use MicroweberPackages\Page\Models\Page;
use MicroweberPackages\User\Models\User;

class MultilanguageLiveEditTest extends MultilanguageTestBase
{
    public function testSaveContentOnPage()
    {
        $user = User::where('is_admin', '=', '1')->first();
        Auth::login($user);

        $newCleanMlPage = save_content([
           'subtype' => 'static',
           'content_type' => 'page',
           'layout_file' => 'clean.php',
           'title' => 'LiveEditMultilanguagePage',
           'url' => 'liveeditmultilanguagepage',
           'preview_layout_file' => 'clean.php',
           'is_active' => 1,
        ]);

        $fingPage = Page::whereId($newCleanMlPage)->first();
        $this->assertEquals($fingPage->id, $newCleanMlPage);

        $fieldsData = [
            'field_data_0'=>[
                'attributes'=>[
                    'class'=>'edit main-content',
                    'rel'=>'content',
                    'field'=>'new-world_content',
                ],
                'html'=>'Example content saved from live edit api'
            ]
        ];

        $encoded = base64_encode(json_encode($fieldsData));

        $_SERVER['HTTP_REFERER'] = content_link($fingPage->id);

        $response = $this->call(
            'POST',
            route('api.content.save_edit'),
            [
                'data_base64' => $encoded,
            ],
            [],//params
            $_COOKIE,//cookie
            [],//files
            $_SERVER //server
        );

        dd($response->getContent());

    }
}
