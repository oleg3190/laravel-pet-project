<?php

namespace App\Http\Controllers;

use App\Contracts\BooksRepository;
use App\Contracts\SearchBookRepository;
use Illuminate\Http\Request;

class SearchApiController extends Controller
{
    public function __construct(BooksRepository $repo, SearchBookRepository $service)
    {
        $this->repo = $repo;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->repo->index();

        return response()->json($books);
    }

    public function search(Request  $request)
    {
        $books = $this->service->search($request->q);

        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = $this->repo->getAuthors();

        return response()->json($authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->repo->store($request);
        } catch (\DomainException $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json([], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =  $this->repo->edit($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->repo->update($id, $request);
        } catch (\DomainException $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->repo->destroy($id);
        } catch (\DomainException $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json([], 200);
    }
}
