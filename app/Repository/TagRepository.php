<?php


namespace App\Repository;


use App\Models\Tag;
use App\Repository\Interfaces\TagRepositoryInterface;

class TagRepository extends AbstractRepository implements TagRepositoryInterface
{
    protected $class = Tag::class;

    public function searchByTags(string $searchWord)
    {
        if ($this->model->where('name', $searchWord)->exists()) {
            return $this->model->where('name', $searchWord)->first()->posts;
        }

        return false;
    }
}
