<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Article::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' =>'required|string|max:255',
            'body' => 'required|string',
        ]);
        return Article::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::find($id);

        if(!$article){
            return response()->json(['message' => 'article non trouvé'],404);
        }
        return $article;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::find($id);
        if(!$article){
            return response()->json(['message'=>'article non trouvé'],404);
        }
        $request->validate([
            'title'=>'required|string|max:255',
            'body'=>'required|string',
        ]);
        $article->update($request->all());
        return $article;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);
        if(!$article){
            return response()->json(['message'=>'article non trouvé'],404);
        }

        $article->delete();
        return response()->json(['message'=>'Article supprimé avec succés']);
    }
}
