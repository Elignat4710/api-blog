<?php


namespace App\Repository\Interfaces;


use App\Models\Post;

interface PostRepositoryInterface
{
    public function addOneViews(Post $post);
}
