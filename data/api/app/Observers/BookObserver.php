<?php

namespace App\Observers;

use App\Models\Book;
use App\servises\KafkaProducer;
use Exception;
use Illuminate\Support\Facades\Log;

class BookObserver
{
    const KAFKA_TOPIC = 'books';

    const PUBLISH_ERROR_MESSAGE = 'Сообщение не было доставлено';

    protected $producerHandler;

    public function __construct(KafkaProducer $producerHandler)
    {
        $this->producerHandler = $producerHandler;
    }

    public function created(Book $book)
    {
        $this->pushToKafka($book);
    }

    public function updated(Book $book)
    {
        $this->pushToKafka($book);
    }


    public function deleted(Book $book)
    {
        $this->pushToKafka($book);
    }

    protected function pushToKafka(Book $book)
    {
        try {
            $this->producerHandler->setTopic(self::KAFKA_TOPIC)
                ->send($book->toJson(), $book->id);
        } catch (Exception $e) {
            dd($e->getMessage(), $e->getCode());
            Log::critical(self::PUBLISH_ERROR_MESSAGE, [
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
    }
}
