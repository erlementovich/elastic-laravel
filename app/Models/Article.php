<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['title', 'body'];
    protected $searchable_fields = ['title', 'body', 'updated_at', 'tags'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the index name for the model.
     */
    public function searchableAs()
    {
        return 'article_index';
    }

    public function toSearchableArray()
    {
        return $this->only($this->searchable_fields);
    }
}
