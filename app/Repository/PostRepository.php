<?php


namespace App\Repository;


use App\Models\Post;
use App\Repository\Interfaces\PostRepositoryInterface;

class PostRepository extends AbstractRepository implements PostRepositoryInterface
{
    protected $class = Post::class;

    public function paginate(int $paginateCount)
    {
        return $this->model->orderBy('id', 'desc')->paginate($paginateCount);
    }

    public function addOneViews(Post $post)
    {
        $post->views += 1;
        $post->save();

        return $post;
    }
}
