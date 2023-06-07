<?php
namespace MicroweberPackages\Modules\Comments\Http\Livewire\Admin;

use Livewire\WithPagination;
use MicroweberPackages\Modules\Comments\Models\Comment;

class AdminCommentsListComponent extends \MicroweberPackages\Admin\Http\Livewire\AdminComponent
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $filter = [
        "keyword" => "",
        "orderField" => "id",
        "orderType" => "desc",
        "status"=>'all'
    ];

    public $queryString = [
        'filter',
        'itemsPerPage',
        'page'
    ];

    public $itemsPerPage = 10;

    public function preview()
    {

    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
    }

    public function markAsModerated($id)
    {
        $comment = Comment::find($id);
        $comment->is_new = 0;
        $comment->is_moderated = 1;
        $comment->save();
    }

    public function markAsUnmoderated($id)
    {
        $comment = Comment::find($id);
        $comment->is_new = 1;
        $comment->is_moderated = 0;
        $comment->save();
    }

    public function markAsSpam($id)
    {
        $comment = Comment::find($id);
        $comment->is_spam = 1;
        $comment->is_moderated = 0;
        $comment->save();
    }

    public function markAsNotSpam($id)
    {
        $comment = Comment::find($id);
        $comment->is_spam = 0;
        $comment->is_moderated = 1;
        $comment->save();
    }

    public function markAsTrash($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
    }

    public function markAsNotTrash($id)
    {
        $comment = Comment::withTrashed()->find($id);
        $comment->restore();
    }

    public function render()
    {

        $countAll = Comment::count();
        $countMine = Comment::where('created_by', user_id())->count();
        $countPending = Comment::where('is_new', 1)->count();
        $countApproved = Comment::where('is_new', 0)->where('is_spam', 0)->count();
        $countSpam = Comment::where('is_spam', 1)->count();
        $countTrashed = Comment::onlyTrashed()->count();

        $getCommentsQuery = Comment::query();
        if (isset($this->filter['keyword'])) {
            $keyword = trim($this->filter['keyword']);
            $getCommentsQuery->where('comment_body', 'like', '%' . $keyword . '%');
        }
        if (isset($this->filter['status'])) {
            if ($this->filter['status'] == 'pending') {
                $getCommentsQuery->where('is_new', 1);
            } elseif ($this->filter['status'] == 'approved') {
                $getCommentsQuery->where('is_new', 0)->where('is_spam', 0);
            } elseif ($this->filter['status'] == 'spam') {
                $getCommentsQuery->where('is_spam', 1);
            } elseif ($this->filter['status'] == 'trash') {
                $getCommentsQuery->onlyTrashed();
            } else {
                $getCommentsQuery->where('is_spam', 0);
            }
        }

        $getComments = $getCommentsQuery->paginate($this->itemsPerPage);

        return view('comments::admin.livewire.comments-list', [
            'comments' => $getComments,
            'countAll' => $countAll,
            'countMine' => $countMine,
            'countPending' => $countPending,
            'countApproved' => $countApproved,
            'countSpam' => $countSpam,
            'countTrashed' => $countTrashed,
        ]);
    }
}
