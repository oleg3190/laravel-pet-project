<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface BooksRepository
{
    public function index(): Collection;

    public function getAuthors(): Collection;

    public function store(Request $request);

    public function edit($id): array;

    public function update($id, Request $request);

    public function destroy($id): void;
}
