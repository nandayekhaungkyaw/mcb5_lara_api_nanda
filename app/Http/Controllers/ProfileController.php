<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Resources\ProfileResource;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller // ✅ Must extend Controller
{
    // 🔹 Constructor for middleware
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum'); // works here
    // }

    // GET /api/profile
    public function show(Request $request)
    {
        return new ProfileResource($request->user());
    }

    // PUT /api/profile
    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $user->update($request->validated());

        return new ProfileResource($user->fresh());
    }


        public function updateName(Request $request)
    {
        $user = $request->user();
        $user->update(['name' => $request->name]);

        return new ProfileResource($user->fresh());
    }

    public function updateEmail(Request $request)
    {
        $user = $request->user();
        $user->update(['email' => $request->email]);

        return new ProfileResource($user->fresh());
    }

    public function updatePassword(Request $request)
{
    // 1️⃣ Validate input
    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:6|confirmed',
    ]);

    // 2️⃣ Get authenticated user
    $user = $request->user();

    // 3️⃣ Check old password
    if (! Hash::check($request->current_password, $user->password)) {
        throw ValidationException::withMessages([
            'current_password' => ['Current password is incorrect.'],
        ]);
    }

    // 4️⃣ Update password
    $user->update([
        'password' => Hash::make($request->new_password),
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Password updated successfully',
    ]);
}
}
