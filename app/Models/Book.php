<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $with = ['author', 'publisher', 'category'];
    protected $fillable =[
        'title','npages','language','releaseYear','author_id','publisher_id','category_id'
    ];

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
