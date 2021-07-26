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
        return $this->commentRepository->create($options);
    }
}
