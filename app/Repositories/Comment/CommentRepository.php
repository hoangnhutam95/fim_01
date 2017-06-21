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
}
