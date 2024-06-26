<?php
declare(strict_types=1);

namespace Aurora\Framework\Http;

class Response
{
    public function __construct(
        protected mixed $content,
        protected int   $status = 200,
        protected array $headers = []
    )
    {

    }

    public function send(): void
    {
        $this->returnHeaders();
        echo $this->content;
    }

    public function setHeader(string $name, string $value): static
    {
        $this->headers[$name] = $value;
        return $this;
    }

    protected function returnHeaders(): void
    {
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
    }
}