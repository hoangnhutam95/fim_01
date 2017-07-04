<?php

namespace App\Repositories\Comment;

use Auth;
use App\Models\Comment;
use App\Models\Song;
use App\Models\Album;
use App\Repositories\BaseRepository;
use Exception;
use File;
use DB;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    protected $songModel;
    protected $albumModel;

    public function __construct(Comment $comment, Song $song, Album $album)
    {
        $this->model = $comment;
        $this->songModel = $song;
        $this->albumModel = $album;
    }

    public function getListComment($targetId, $commentType)
    {
        return $this->model
            ->where('type', $commentType)
            ->where('target_id', $targetId)
            ->orderBy('created_at', 'desc')
            ->paginate(config('settings.list_per_page'));
    }

    public function updateComment($input)
    {
        return $this->model->find($input['id'])->update(['content' => $input['content']]);
    }

    public function updateTargetComment($input)
    {
        $comment = $this->model
            ->where('type', $input['type'])
            ->where('target_id', $input['target_id'])
            ->get();
        if ($input['type'] == config('settings.comment.song')) {
            return $this->songModel->find($input['target_id'])->update(['comment_number' => $comment->count()]);
        }
        if ($input['type'] == config('settings.comment.album')) {
            return $this->albumModel->find($input['target_id'])->update(['comment_number' => $comment->count()]);
        }

        return false;
    }

    public function updateAfterDeleteComment($id)
    {
        $comment = $this->model->find($id);
        if ($comment['type'] == config('settings.comment.song')) {
            return $this->songModel->find($comment['target_id'])->update(['comment_number' => $comment->count()]);
        }
        if ($comment['type'] == config('settings.comment.album')) {
            return $this->albumModel->find($comment['target_id'])->update(['comment_number' => $comment->count()]);
        }

        return false;
    }
}
