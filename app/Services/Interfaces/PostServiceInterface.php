<?php


namespace App\Services\Interfaces;


interface PostServiceInterface
{
    public function getAllPosts(int $paginateCount);

    public function createPost(array $options);

    public function showPost(int $id);

    public function updatePost(array $options, int $id);

    public function myPost(int $paginateCount);

    public function postsWithoutComments(int $paginateCount);

    public function mostViewPosts(int $paginateCount);
}
