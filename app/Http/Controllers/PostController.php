<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return Inertia::render('Dashboard', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try {
            $post = Post::create($request->validated());

            return redirect()->route('dashboard.create')->with('success', 'Postagem criada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.create')->with('error', 'Ocorreu um erro ao criar a postagem.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return Inertia::render('Edit', compact('post'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->update($request->validated());

            return redirect()->route('dashboard.edit')->with('success', 'Postagem editada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.edit')->with('error', 'Ocorreu um erro ao editar a postagem.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();

            return redirect()->route('dashboard')->with('success', 'Postagem excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Ocorreu um erro ao excluir a postagem.');
        }
    }
}
