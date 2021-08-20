<?php

namespace App\Interfaces;

interface ArticleRepositoryInterface
{
    public function all();

    public function find($id);

    public function search(string $query = '');
}
