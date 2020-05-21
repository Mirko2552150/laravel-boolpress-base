<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // lo colleghi con con PHP artisan MAKE:MODEL nome singolare della TABLE
    // in ITA protected $table = 'nome table in ITA';
    protected $fillable = [ // controlla la funzione fill in CREATE, e la incrocia con i nomi delle colonne
        'title',
        'body',
        'slug',
        'author',
        'published',
        'src'
    ];

}
