<?php

namespace Tests\Unit;

use App\Models\Author;
use App\Models\Book;
use App\repo\BookRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use Tests\CreatesApplication;
use Tests\TestCase;

class BookTest extends TestCase
{
    use CreatesApplication, DatabaseMigrations;

    private $service;

    public function setUp(): void
    {
        parent::setUp();
    }

    private function createAuthor()
    {
        return  Author::create([
            'name' => 'first2'
        ]);
    }

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->service = resolve(BookRepository::class);
    }

    public function test_index()
    {
        $this->book = Book::factory()->create();
        $books = $this->service->index();
        $this->assertNotEmpty($books);
    }


    public function test_getAuthors()
    {
        $author = $this->createAuthor();
        $authors = $this->service->getAuthors();
        $this->assertNotEmpty($authors);
    }

    public function test_store()
    {
        $author = $this->createAuthor();
        $req = new Request([
            'title' => 'newTitle',
            'author' => $author->id
        ]);

        $book = $this->service->store($req);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author
        ]);
    }

    public function test_edit()
    {
        $this->book = Book::factory()->create();
        $data = $this->service->edit($this->book->id);
        $this->assertIsArray($data);
    }

    public function test_update()
    {
        $this->book = Book::factory()->create();
        $req = new Request([
            'title' => 'newTitle',
        ]);
        $book = $this->service->update($this->book->id, $req);
        $this->assertDatabaseHas('books', [
            'title' => $book->title,
        ]);
    }

    public function test_destroy()
    {
        $this->book = Book::factory()->create();
        $this->service->destroy($this->book->id);

        $this->assertDatabaseMissing('books', [
            'id' => $this->book->id
        ]);
    }
}
