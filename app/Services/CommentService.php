<?php


namespace App\Services;


use App\Repository\Interfaces\CommentRepositoryInterface;
use App\Services\Interfaces\CommentServiceInterface;

class CommentService implements CommentServiceInterface
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function createComment(array $options)
    {
        auth()->check() ? $options['user_id'] = auth()->user()->id : $options['user_id'] = 1;

        return $this->commentRepository->create($options);
    }
}
