<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get article
        $articles = Article::orderBy('created_at', 'desc')->paginate(5);

        //return collection of articles as a response
        return ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $article = $request->isMethod('put') ? Article::findOrFail($request->article_id) : new Article;

        $article = new Article;

        $article->id = $request->input('article_id');
        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if ($article->save()) {
            return new ArticleResource($article);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // a single article
        $article = Article::findOrFail($id);

        // return as resource
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if ($article->save()) {
            return new ArticleResource($article);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // a single article
        $article = Article::findOrFail($id);

        // return as resource
        if ($article->delete()) {
            return new ArticleResource($article);
        }
    }
}