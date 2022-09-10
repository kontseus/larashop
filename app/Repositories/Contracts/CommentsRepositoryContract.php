<?php

namespace App\Repositories\Contracts;

use App\Models\Comment;

interface CommentsRepositoryContract
{
    public function create(Comment $comment, string $model, int $id): Comment|bool;
}
