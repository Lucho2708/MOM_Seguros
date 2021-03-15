<?php

namespace App\Http\Controllers;

use App\Repositories\Posts As PostsRepositories;
use App\Http\Requests\Post As PostRequests;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    protected $posts;

    public function __construct(PostsRepositories $posts)
    {
         $this->posts = $posts;
    }

    public function index()
    {
        $posts = $this->posts->all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequests $request)
    {

        $post = $this->posts->create($request);

        return view('posts.store', compact('post'));
    }

    public function show($id)
    {
        $post = $this->posts->find($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = $this->posts->find($id);
        return view('posts.edit', compact('post'));
    }

    public function update(PostRequests $request, $id)
    {
        $post=$this->posts->update($request, $id);

        return view('posts.update', compact('post'));
    }

    public function destroy($id)
    {
        $post = $this->posts->delete($id);

        return view('posts.delete', compact('post'));
    }
}
