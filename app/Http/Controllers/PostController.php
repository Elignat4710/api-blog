<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\Interfaces\PostServiceInterface;

class PostController extends Controller
{
    const PAGINATE_COUNT = 15;

    protected $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
        $this->middleware('auth:api', ['except' => [
            'allPost',
            'show',
            'postWithoutComments',
            'mostViewPosts'
        ]]);
    }

    public function allPost()
    {
        return $this->postService->getAllPosts(self::PAGINATE_COUNT);
    }

    public function myPost()
    {
        return $this->postService->myPost(self::PAGINATE_COUNT);
    }

    public function postWithoutComments()
    {
        return $this->postService->postsWithoutComments(self::PAGINATE_COUNT);
    }

    public function mostViewPosts()
    {
        return $this->postService->mostViewPosts(self::PAGINATE_COUNT);
    }

    public function store(PostRequest $request)
    {
        $validate = $request->validated();

        $this->postService->createPost($validate);

        return response()->json(['message' => 'Post was created successfully'], 201);
    }

    public function show($id)
    {
        return $this->postService->showPost($id) ?? response()->json(['message' => 'No such post exists']);
    }

    public function update(PostRequest $request, $id)
    {
        $updateData = $request->validated();

        $result = $this->postService->updatePost($updateData, $id);

        return $result ?
            response()->json(['message' => 'Post was successfully updated'], 201) :
            response()->json(['message' => 'You can only update the post you created'], 404);
    }
}
