<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UploadAvatarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate(
            ['image' => 'required|image|mimes:jpeg,jpg,jfif,pjpeg,pjp,png,svg,webp,gif,avif,apng|max:50000']
        );
        $image = $data['image'];

        $service = new UploadAvatarService();
        $service->run($image);

        return response()->json(['message' => trans('user.icon_upload.success')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return $user;
    }
}
