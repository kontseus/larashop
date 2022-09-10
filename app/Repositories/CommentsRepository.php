<?php
namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Contracts\CommentsRepositoryContract;

class CommentsRepository implements CommentsRepositoryContract
{

    public function create(Comment $comment, string $model, int $id): Comment|bool
    {
        if (!class_exists($model)) {
            throw new \Exception("{$model} does not exists");
        }
        $model = app()->make($model)->find($id);

        return $model->comments()->save($comment);
    }
}
