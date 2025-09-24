<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    // Allow mass assignment for these fields
    protected $fillable = ['slug', 'title', 'content'];
}
