<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->paginate(6);
        return view('category.index', compact('categories'));
    }
    public function store(Request $request){
        Category::create([
            'title' => $request->title
        ]);
        return redirect()->route('category.index')->with('message','berhasil menambah category');
    }
    public function edit($id){
        $category = Category::FindOrFail($id);
        return view('category.edit', compact('category'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|min:3|max:20'
        ]);
        $category = Category::findOrFail($id);
        $category->update([
            'title' => $request->title
        ]);
        return redirect()->route('category.index')->with('message','berhasil edit category');
    }
    public function destroy($id){
        $category = Category::FindOrFail($id);
        $category->delete();
        return redirect()->route('category.index')->with('message','berhasil hapus category');
    }
}
