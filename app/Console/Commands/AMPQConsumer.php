<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use LaravelCode\AMPQ\Consumer;
use PhpAmqpLib\Message\AMQPMessage;

class AMPQConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ampq:consumer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RabbitMQ Consumer';

    /**
     * @param AMQPMessage $message
     */
    public function message(AMQPMessage $message)
    {
        var_dump($message->body);
        $message->ack();
    }

    /**
     * Execute the console command.
     *
     * @param Consumer $consumer
     * @return void
     */
    public function handle(Consumer $consumer)
    {
        $consumer->declare(config('ampq.exchange'), config('ampq.queue'));
        $consumer->read(config('ampq.exchange'), config('ampq.queue'), [$this, 'message']);
    }
}
