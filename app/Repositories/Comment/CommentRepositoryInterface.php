<?php
namespace App\Repositories\Comment;

interface CommentRepositoryInterface
{
    public function getListComment($targetId, $commentType);

    public function updateComment($input);

    public function updateTargetComment($input);

    public function updateAfterDeleteComment($id);
}
