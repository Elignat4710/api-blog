<?php


namespace App\Repository;


use App\Models\Comment;
use App\Repository\Interfaces\CommentRepositoryInterface;

class CommentRepository extends AbstractRepository implements CommentRepositoryInterface
{
    protected $class = Comment::class;
}
