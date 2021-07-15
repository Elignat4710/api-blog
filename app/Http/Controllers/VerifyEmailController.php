<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    protected $userRep;

    public function __construct(UserRepositoryInterface $userRep)
    {
        $this->userRep = $userRep;
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Already verified']);
        }

        $request->user()->sendEmailVerificationNotification();

        if($request->wantsJson()) {
            return response()->json(['message' => 'Email send']);
        }

        return back()->with('resent', true);
    }

    public function verify(Request $request)
    {
        $user = $this->userRep->find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return response(['message' => 'Already verified']);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json(['message' => 'Successfully verified']);
    }
}
