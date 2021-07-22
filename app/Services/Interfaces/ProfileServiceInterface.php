<?php


namespace App\Services\Interfaces;


interface ProfileServiceInterface
{
    public function findProfile(int $id);

    public function updateAvatarProfile($file);
}
