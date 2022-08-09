<?php

namespace http_part_2\Services;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\Psr6CacheStorage;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class HttpService
{
    const BASE_URI = 'https://api.thecatapi.com';

    const X_API_KEY = 'c307c66c-67fc-499a-b65b-d066e96eef1c';

    const BASE_LOCAL_URL = 'http://localhost/php-mentoring-program-intermidiate-2022/src/http_part_2/Views/breeds.php';

    private Client $client;

    public function __construct(bool $responseCaching = false)
    {
        $stack = HandlerStack::create();

        $cacheStorage = new Psr6CacheStorage(
            new FilesystemAdapter('', 10, __DIR__ . './../../../config/cache')
        );

        $stack->push(
            new CacheMiddleware(new GreedyCacheStrategy($cacheStorage, 10)),
            'cache'
        );

        $config = [
            'handler' => $stack,
            'base_uri' => self::BASE_URI,
            'headers' => [
                'x-api-key' => self::X_API_KEY,
            ],
        ];

        if (! $responseCaching) {
            unset($config['handler']);
        }

        $this->client = new Client($config);
    }

    public function setLogService(LogService $logService): void
    {
        $this->logService = $logService;
    }

    public function get(string $path, ?array $options = []): mixed
    {
        return $this->client->get('/v1' . $path, $options);
    }

    public function post(string $path, ?array $body = null, ?array $options = []): mixed
    {
        return $this->client->post(
            '/v1' . $path,
            array_merge($options, [
                'json' => $body,
                'headers' => [
                    'x-api-key' => self::X_API_KEY,
                    'Content-Type' => 'application/json',
                ],
            ]),
        );
    }

    public function delete(string $path, ?array $options = []): mixed
    {
        return $this->client->delete('/v1' . $path, $options);
    }
}