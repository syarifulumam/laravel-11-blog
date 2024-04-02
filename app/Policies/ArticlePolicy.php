<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ArticlePolicy
{

    public function before(User $user, string $ability): bool|null
    {
        if (Auth::user()->role->value == 'admin') {
            return true;
        }
    
        return null;
    }
    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, Article $article): bool
    {
        return $user?->id === $article->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $article): bool
    {
        return $user?->id === $article->user_id;
    }
}
