<?php

namespace App\Repositories;

use App\Interfaces\AuthorRepositoryInterface;
use App\Models\Author;

class AuthorRepository implements AuthorRepositoryInterface
{
    protected $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function all()
    {
        return $this->author->paginate(10);
    }

    public function articles()
    {
        return $this->author->articles()->paginate(10);
    }

    public function find($id)
    {
        return $this->author->findOrFail($id);
    }

    public function create($data)
    {
        return $this->author->create($data);
    }

    public function update($id, $data)
    {
        $author = $this->find($id);
        $author->update($data);
        return $author;
    }

    public function delete($id)
    {
        $author = $this->find($id);
        return $author->delete();
    }
}
