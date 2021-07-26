<?php


namespace App\Repository;


use App\Models\Category;
use App\Repository\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    protected $class = Category::class;
}
