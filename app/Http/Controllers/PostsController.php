<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    // Makes all the method require authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get all users we are following
        // The user_id is in the profiles table?
        $users = auth()->user()->following()->pluck('profiles.user_id');

        // $posts = Post::whereIn('user_id', $users)->orderBy('created_id', 'DESC')->get();
        // with is about the relationship => fix N + 1 problem
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        // dd($posts);

        return view('posts.index', compact('posts'));
    }

    //
    public function create()
    {
        // In this case / and . are the same
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required' , 'image'],
        ]);

        // image is an instance of a class: UploadedFile
        // It will move to storage -> app -> public -> uploads
        // This store method: first param is the name of the directory,
        // Second param is where the file will be uploaded - it could be localStorage (in our case)
        // Or something like s3 - amazon,...
        // One more thing that though this case we store it in the local, but we cannot access it yet
        // We will have to run the php command: php artisan storage:link
        $imagePath = request('image')->store('uploads', 'public');
        // dd(request('image'));

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        // This won't work because we don't have the user id
        // Post::create($data);
        // dd(request()->all());
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post)
    {
        // Route model binding?
        // dd($post);
        return view('posts.show', compact('post'));
    }
}
