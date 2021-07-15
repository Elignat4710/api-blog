<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->middleware('auth:api');

        $this->profileService = $profileService;
    }

    public function myProfile()
    {
        return $this->profileService->findProfile(auth()->user()->id);
    }


    public function updateAvatar(FileRequest $request)
    {
        $file = $request->validated();
    }
}
