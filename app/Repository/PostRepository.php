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

    public function myPost()
    {
        $this->model = Post::where('user_id', auth()->user()->id);

        return $this;
    }

    public function postsWithoutComments()
    {
        $this->model = Post::doesntHave('comments');

        return $this;
    }

    public function mostViewPost()
    {
        $this->model = Post::orderBy('views', 'desc');

        return $this;
    }

    public function atachTags(Post $post, array $tags)
    {
        return $post->tags()->sync($tags);
    }
}
