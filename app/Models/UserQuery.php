<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuery extends Model
{
    protected $table = 'users_queries';

    protected $fillable = ['text', 'user_id', 'updated_at'];
}
