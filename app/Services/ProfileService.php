<?php


namespace App\Services;


use App\Http\Resources\ProfileResource;
use App\Repository\Interfaces\FileRepositoryInterface;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\ProfileServiceInterface;

class ProfileService implements ProfileServiceInterface
{
    protected $userRepository;
    protected $fileRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        FileRepositoryInterface $fileRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->fileRepository = $fileRepository;
    }

    public function findProfile(int $id)
    {
        $user = $this->userRepository->find($id);

        return isset($user) ? new ProfileResource($user) : null;
    }

    public function updateAvatarProfile($file)
    {
        $file = $this->fileRepository->create([
            'name' => $file['file']->store('avatars', 'public')
        ]);

        return $this->userRepository->updateWithoutLoading(auth()->user()->id, ['file_id' => $file->id]);
    }
}
