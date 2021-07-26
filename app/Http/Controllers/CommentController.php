<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Services\Interfaces\CommentServiceInterface;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentServiceInterface $commentService)
    {
        $this->commentService = $commentService;
    }

    public function create(CommentRequest $request)
    {

        $validate = $request->validated();

        return $this->commentService->createComment($validate);
    }
}
