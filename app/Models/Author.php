<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // TODO-8-8 : necessaire pour Author::create()
    protected $fillable = ['name'];

    // TODO-8-5
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
