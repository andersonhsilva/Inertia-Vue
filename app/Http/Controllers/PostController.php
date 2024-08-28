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
        $iObjects = Post::all();
        return Inertia::render('Dashboard', compact('iObjects'));
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
    public function store(Request $request) // StorePostRequest $request
    {
        $objResult = [];
        DB::beginTransaction();
        try {
            $object = Post::create($request->all());

            DB::commit();
            $objResult = ['type' => 'success', 'message' => 'Postagem criada com sucesso!', 'object' => $object];
        } catch (\Exception $e) {
            DB::rollBack();
            $objResult = ['type' => 'error', 'message' => $e->getMessage()];
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
        $eObject = Post::findOrFail($id);
        return Inertia::render('Edit', compact('eObject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) // StorePostRequest $request
    {
        $objResult = [];
        DB::beginTransaction();
        try {
            $post = Post::findOrFail($id);
            $post->update($request->all());

            DB::commit();
            $objResult = ['type' => 'success', 'message' => 'Postagem alterada com sucesso!', 'object' => $post];
        } catch (\Exception $e) {
            DB::rollBack();
            $objResult = ['type' => 'error', 'message' => $e->getMessage()];
        } finally {
            return redirect()->back()->with(['objResult' => $objResult]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $objResult = [];
        DB::beginTransaction();
        try {
            $post = Post::findOrFail($id);
            $post->delete();

            DB::commit();
            $objResult = ['type' => 'success', 'message' => 'Postagem excluída com sucesso!', 'object' => null];
        } catch (\Exception $e) {
            DB::rollBack();
            $objResult = ['type' => 'error', 'message' => $e->getMessage()];
        } finally {
            return redirect()->back()->with(['objResult' => $objResult]);
        }
    }
}
