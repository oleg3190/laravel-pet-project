<?php

namespace Tests\Unit;

use App\Contracts\BooksRepository;
use App\Models\Book;
use App\repo\BookRepository;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Response\Elasticsearch;
use GuzzleHttp\Handler\MockHandler;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\CreatesApplication;
use Tests\TestCase;
use Illuminate\Http\Response;

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
        /*$mock = new Client(); // This is the mock client
        $client = ClientBuilder::create()
        ->setHttpClient($mock)
        ->build();
        // This is a PSR-7 response
        $response = $this->createMock('Psr\Http\Message\ResponseInterface');
        $mock->addResponse($response);
        $result = $client->info(); // Just calling an Elasticsearch endpoint
        echo $result->asString(); // This is the body!
        */

        $handler = MockHandler::mockTemplate('index_document');

        $builder = ClientBuilder::create();
        $builder->setHandler($handler);
        $client = $builder->build();


        $elasticSearchEngine = new Elasticsearch($client);
        $document = [
            'author' => 'Albert Einstein',
            'quote' => 'I have no special talents. I am only passionately curious.',
        ];

        $response = $elasticSearchEngine->index('quotes_index', $document);

        $expectedResponse = $this->getTemplate('index_document');
        $this->assertEquals($expectedResponse, $response);

        /*$book = Book::factory()->create();
        $res = $this->json('get', 'api/books/search', [
        'q' => $book->title
        ]);
        $res->assertStatus(Response::HTTP_OK)
        ->assertExactJson(
        [
        'data' => [
        'id' => $book->id,
        'title' => $book->title,
        'author' => $book->author,
        ]
        ]
        );*/
    }
}
