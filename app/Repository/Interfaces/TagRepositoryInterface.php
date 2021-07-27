<?php


namespace App\Repository\Interfaces;


interface TagRepositoryInterface
{
    public function searchByTags(string $searchWord);
}
