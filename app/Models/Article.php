<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenG\Explorer\Application\Explored;
use Laravel\Scout\Searchable;

class Article extends Model implements Explored
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title', 'body'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function mappableAs(): array
    {
        return [
            'title' => 'keyword',
            'body' => 'text',
            'created_at' => 'date',
        ];
    }
}
