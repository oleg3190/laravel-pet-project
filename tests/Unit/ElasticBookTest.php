<?php

namespace Tests\Unit;

use App\Contracts\BooksRepository;
use App\Models\Book;
use App\repo\BookRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\CreatesApplication;
use Tests\TestCase;

class ElasticBookTest extends TestCase
{
    use CreatesApplication, DatabaseMigrations;

    private $service;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function searchTest()
    {
        $this->json('get', '/api/book')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    '*' => [
                        'id',
                        'title',
                        'author',
                    ]
                ]
            );
    }
    /** @test */
    public function searchBooksTest()
    {
        $book = Book::factory()->create();

        $res = $this->json('get', 'api/books/search', [
            'q' => $book->title
        ]);
        $res->assertStatus(Response::HTTP_OK)

            ->assertExactJson(
                [
                    'data' => [
                        'id' =>  $book->id,
                        'title' =>  $book->title,
                        'author' =>  $book->author,
                    ]
                ]
            );
    }
}
