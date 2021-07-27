<?php


namespace App\Services;

use App\Http\Resources\GetAllPostResource;
use App\Http\Resources\PostResource;
use App\Repository\Interfaces\CategoryRepositoryInterface;
use App\Repository\Interfaces\PostRepositoryInterface;
use App\Repository\Interfaces\TagRepositoryInterface;
use App\Services\Interfaces\PostServiceInterface;

class PostService implements PostServiceInterface
{
    protected $postRepository;
    protected $categoryRepository;
    protected $tagRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        CategoryRepositoryInterface $categoryRepository,
        TagRepositoryInterface $tagRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
    }

    public function getAllPosts(int $paginateCount)
    {
        return GetAllPostResource::collection($this->postRepository->paginate($paginateCount));
    }

    public function myPost(int $paginateCount)
    {
        return GetAllPostResource::collection(
            $this->postRepository->myPost()->paginate($paginateCount)
        );
    }

    public function postsWithoutComments(int $paginateCount)
    {
        return GetAllPostResource::collection(
            $this->postRepository->postsWithoutComments()->paginate($paginateCount)
        );
    }

    public function mostViewPosts(int $paginateCount)
    {
        return GetAllPostResource::collection(
            $this->postRepository->mostViewPost()->paginate($paginateCount)
        );
    }

    public function createPost(array $options)
    {
        $category_id = $this->categoryRepository->firstOrCreate(['name' => $options['category_name']])->id;
        $user_id = auth()->user()->id;

        $options = array_merge($options, [
            'category_id' => $category_id,
            'user_id' => $user_id
        ]);

        $post = $this->postRepository->create($options);

        $this->atachTags($options['tags'], $post);

        return true;
    }

    public function showPost(int $id)
    {
        $post = $this->postRepository->find($id);

        return $post ? new PostResource($this->postRepository->addOneViews($post)) : null;
    }

    public function updatePost(array $options, int $id)
    {
        $post = $this->postRepository->find($id);
        $postOwnerId = $post->user->id;

        if ($postOwnerId == auth()->user()->id) {
            $category_id = $this->categoryRepository->firstOrCreate(['name' => $options['category_name']])->id;
            $post->fill(array_merge($options, ['category_id' => $category_id]));

            $post = $this->postRepository->save($post);

            $this->atachTags($options['tags'], $post);

            return true;
        }

        return false;
    }

    private function atachTags(array $tags, $post)
    {
        $tagsArray = [];
        foreach ($tags as $tag) {
            $tagsArray[] = $this->tagRepository->firstOrCreate(['name' => $tag])->id;
        }

        $this->postRepository->atachTags($post, $tagsArray);
    }
}
