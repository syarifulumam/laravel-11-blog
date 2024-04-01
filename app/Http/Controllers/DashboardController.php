<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $articles = Article::count();
        $categories = Category::count();
        $users = User::count();
        return view('dashboard', compact('articles','categories','users'));
    }
}
