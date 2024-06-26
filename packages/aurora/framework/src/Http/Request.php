<?php

declare(strict_types=1);

namespace Aurora\Framework\Http;

class Request
{
    public function __construct(
        protected array $get,
        protected array $post,
        protected array $cookie,
        protected array $files,
        protected array $server,
    )
    {

    }

    public function query(): array
    {
        return $this->get;
    }

    public function request(): array
    {
        return $this->post;
    }

    public function cookie(): array
    {
        return $this->cookie;
    }

    public function files(): array
    {
        return $this->files;
    }

    public function server(): array
    {
        return $this->server;
    }

    public function get(string $key): mixed
    {
        return current($this->all([$key])) ?: null;
    }

    public function all($keys = []): array
    {
        return array_filter([...$this->get, ...$this->post], fn($key) => in_array($key, $keys),
            ARRAY_FILTER_USE_KEY);
    }

    public static function fromGlobals(): Request
    {
        return new self($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }
}