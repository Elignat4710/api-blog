<?php


namespace App\Repository\Interfaces;


use App\Models\Post;

interface PostRepositoryInterface
{
    public function addOneViews(Post $post);

    public function myPost();

    public function postsWithoutComments();

    public function mostViewPost();

    public function atachTags(Post $post, array $tags);
}
