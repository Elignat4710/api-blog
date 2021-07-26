<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Services\Interfaces\ProfileServiceInterface;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileServiceInterface $profileService)
    {
        $this->middleware('auth:api', ['except' => ['showAnyProfile']]);

        $this->profileService = $profileService;
    }

    public function myProfile()
    {
        $result = $this->profileService->findProfile(auth()->user()->id);

        return $result ?? response()->json(['message' => 'Not find profile with this id']);
    }


    public function updateAvatar(FileRequest $request)
    {
        $file = $request->validated();

        $result = $this->profileService->updateAvatarProfile($file);

        return response()->json(['message' => $result ? 'Success update avatar' : 'Oops']);
    }

    public function showAnyProfile($id)
    {
        $result = $this->profileService->findProfile($id);

        return $result ?? response()->json(['message' => 'Not find profile with this id']);
    }
}
