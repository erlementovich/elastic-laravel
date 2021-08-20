<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthorRepositoryInterface;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index()
    {
        return response()->json($this->authorRepository->all());
    }

    public function show($id)
    {
        return response()->json($this->authorRepository->find($id));
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $author = $this->authorRepository->create($data);

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $author = $this->authorRepository->update($id, $data);

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        $this->authorRepository->delete($id);
        return response('Deleted Successfully', 200);
    }
}
