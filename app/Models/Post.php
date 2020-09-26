<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class Post extends Model
{
    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }
}
