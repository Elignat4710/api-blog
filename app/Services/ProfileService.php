<?php


namespace App\Services;


use App\Http\Resources\ProfileResource;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\ProfileServiceInterface;

class ProfileService implements ProfileServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findProfile(int $id)
    {
        $profileResources = new ProfileResource($this->userRepository->find($id));

        return $profileResources ?? response()->json(['message' => 'Not find profile with this id'], 404);
    }

    public function updateAvatarProfile(array $options)
    {
        // TODO: Implement updateAvatarProfile() method.
    }
}
