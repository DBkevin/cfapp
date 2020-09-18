<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Auth\AuthenticationException;
use App\Models\Image;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);
        return (new UserResource($user))->showSensitiveFields();
    }
    public function me(Request $request)
    {
        return (new UserResource($request->user()))->showSensitiveFields();
    }
    public function show(User $user, Request $request)
    {
        return new UserResource($user);
    }
    public function update(UserRequest $request)
    {
        $user = $request->user();
        $attributes = $request->only(['name', 'email', 'introduction']);
        if ($request->avarat_image_id) {
            $image = Image::find($request->avarat_image_id);
            $attributes['avatar'] = $image->path;
        }
        $user->update($attributes);
        return (new UserResource($user))->showSensitiveFields();
    }
}
