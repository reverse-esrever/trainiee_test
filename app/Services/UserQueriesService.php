<?php

namespace App\Services;

use App\Models\UserQuery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserQueriesService
{
    public function getAllQueries(): Collection{
        return UserQuery::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->get();
    }
    
}
