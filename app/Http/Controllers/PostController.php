<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function store(Request $request)
    {
        $objResult = [];
        DB::beginTransaction();
        try {
            $post = Post::create($request->all());

            DB::commit();
            $objResult = ['type' => 'success', 'message' => 'Postagem criada com sucesso!', 'object' => $post];
        } catch (\Exception $e) {
            DB::rollBack();
            $objResult = ['object' => null, 'type' => 'error', 'message' => $e->getMessage()];
        } finally {
            return redirect()->back()->with(['objResult' => $objResult]);
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

            return redirect()->back()->with('message', ['success' => 'Postagem editada com sucesso!']);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', ['error' => 'Ocorreu um erro ao editar a postagem.']);
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

            return redirect()->back()->with('message', ['success' => 'Postagem excluída com sucesso!']);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', ['error' => 'Ocorreu um erro ao excluir a postagem.']);
        }
    }
}
