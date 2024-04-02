<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::latest()->paginate(6);
        return view('articles.index',compact('articles'));
    }
    public function create(){
        $categories = Category::all();
        return view('articles.create',compact('categories'));
    }
    public function show(Article $article){
        return view('articles.show', compact('article'));
    }
    public function store(ArticleRequest $request){
        $validated = $request->validated();
        $thumbnail = $request->file('thumbnail');
        $fileName = $thumbnail->getClientOriginalName();
        $nameThumbnail = time() . '_' . $fileName;
        $validated['thumbnail'] = $nameThumbnail;
        // $extension = $thumbnail->getClientOriginalExtension();
        Auth::user()->articles()->save(new Article($validated));
        // save image to folder public
        $thumbnail->move(public_path('images'), $nameThumbnail);
        return redirect()->route('article.index')->with('message','berhasil tambah artikel');
    }
    public function edit(Article $article){
        $categories = Category::all();
        return view('articles.edit',compact('categories','article'));
    }
    public function update(ArticleRequest $request, Article $article){
        if ($request->hasFile('thumbnail')) {
            $validated = $request->validated();
            //upload new image
            $thumbnail = $request->file('thumbnail');
            $fileName = $thumbnail->getClientOriginalName();
            $nameThumbnail = time() . '_' . $fileName;
            $thumbnail->move(public_path('images'), $nameThumbnail);
            $validated['thumbnail'] = $nameThumbnail;
            //delete old image
            unlink(public_path('images/').$article->thumbnail);
            //update product with new image
            $article->update($validated);
        }else{
            //update product without image
            $article->update($request->validated());
        }
        return redirect()->route('article.index')->with('message','berhasil update artikel');
    }
    public function destroy(Article $article) {
        Article::FindOrFail($article->id)->delete();
        return redirect()->route('article.index')->with('message','berhasil hapus artikel');
    }
}
