<?php


namespace App\Repository;


use App\Models\File;
use App\Repository\Interfaces\FileRepositoryInterface;

class FileRepository extends AbstractRepository implements FileRepositoryInterface
{
    protected $class = File::class;

    public function updateImage()
    {
    }
}
