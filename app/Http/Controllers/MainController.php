<?php

namespace App\Http\Controllers;

use App\Interfaces\ArticleRepositoryInterface;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }


    public function main()
    {
        $articles = $this->articleRepository->all();
        return view('main', ['articles' => $articles]);
    }

    public function search(Request $request)
    {
        $query = $request->input('q') ?? '';
        $articles = $this->articleRepository->search($query);
        return view('main', ['articles' => $articles]);
    }
}
