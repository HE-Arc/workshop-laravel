<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // TODO-5-8 / TODO-8-6 : mass assignment
    protected $fillable = [
        'title', 'pages', 'quantity', 'author_id'
    ];

    // TODO-8-5
    function author() {
        return $this->belongsTo(Author::class);
    }
}
