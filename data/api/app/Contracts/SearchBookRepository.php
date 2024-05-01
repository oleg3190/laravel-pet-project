<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface SearchBookRepository
{
    public function search(string $query = ''): Collection;
}
