<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    //
    public function index($user)
    {
        // die and dump?
        // $user is what we pass in (the param) -> the id of the user
        // dd($user);
        // dd(User::find($user));
        $user = User::findOrFail($user);

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        // dd($follows);
        // $postCount = $user->posts->count();
        // $followersCount = $user->profile->followers->count();
        // $followingCount = $user->following->count();

        // In here, we don't have access to $user so we have to use closer use ($user) to have access to it?
        $postCount = Cache::remember(
            'count.posts' . $user->id, 
            now()->addSeconds(30), 
            function () use ($user) {
                return $user->posts->count();
            }
        );

        $followersCount = Cache::remember(
            'count.followers' . $user->id, 
            now()->addSeconds(30), 
            function () use ($user) {
                return $user->profile->followers->count();
            }
        );
        
        $followingCount = Cache::remember(
            'count.following' . $user->id, 
            now()->addSeconds(30), 
            function () use ($user) {
                return $user->following->count();
            }
        );

        // 'user' is the variable name of what we pass in the view
        return view('profiles.index', [
            'user' => $user,
            'follows' => $follows,
            'postCount' => $postCount,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => 'image',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        // dd($data);
        // Empty array will not override anything
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? [],
        ));

        $user_id = auth()->user()->id;

        return redirect("/profile/{$user_id}");
    }
}
