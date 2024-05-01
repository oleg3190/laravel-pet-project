<?php

namespace App\repo;

use App\Contracts\BooksRepository;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookRepository implements BooksRepository
{
    public function index(): Collection
    {
        return Book::take(3)->get();
    }

    public function getAuthors(): Collection
    {
        return Author::all();
    }

    public function store($request)
    {
        return Book::create($request->only([
            'title', 'author'
        ]));
    }

    public function edit($id): array
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();

        return compact('authors', 'book');
    }

    public function update($id, $request)
    {
        $book = Book::findOrFail($id);
        $book->update($request->only([
            'title', 'author'
        ]));

        return $book;
    }

    public function destroy($id): void
    {
        $book = Book::findOrFail($id);
        $book->delete();
    }
}
