<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use LaravelCode\AMPQ\Publisher;
use PhpAmqpLib\Exchange\AMQPExchangeType;

class AMPQPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ampq:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish to rabbitMQ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Publisher $publisher)
    {
        $publisher->declare(config('ampq.exchange'), AMQPExchangeType::FANOUT);
        $payload = [
            'event' => '\App\Project\ProjectWasCreated',
            'author' => null,
            'data' => [
                'name' => 'Project 1',
            ],
        ];

        $publisher->write(config('ampq.exchange'), $payload);
    }
}
