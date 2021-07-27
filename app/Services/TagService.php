<?php


namespace App\Services;


use App\Http\Resources\GetAllPostResource;
use App\Repository\Interfaces\TagRepositoryInterface;
use App\Services\Interfaces\TagServiceInterface;

class TagService implements TagServiceInterface
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function search(string $searchWord)
    {
        $posts = $this->tagRepository->searchByTags($searchWord);

        return $posts ? GetAllPostResource::collection($posts) : false;
    }
}
