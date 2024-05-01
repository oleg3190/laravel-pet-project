<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'id',
        'title',
        'author'
    ];

    public function Author()
    {
        return $this->belongsTo(Author::class, 'author', 'id');
    }
    /*
    public static function bootProducerable()
    {
        static::observe(BookObserver::class);
    }*/
}
