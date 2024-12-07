<?php

namespace Aurora\View;

use Aurora\View\Exceptions\TemplateNotFound;

class View
{
    protected string $template;
    protected array $data = [];
    protected ?string $extends = null;

    public function __construct(protected $namespaces = [])
    {
    }

    public function addNamespace(string $namespace, string $path): static
    {
        $this->namespaces[$namespace] = $path;
        return $this;
    }

    /**
     * @throws TemplateNotFound
     */
    public function render($template, $data = []): bool|string
    {
        $this->template = $this->resolveTemplate($template);
        $this->data = [...$data, ...$this->data];
        extract($this->data);
        ob_start();
        include $this->template;
        $content = ob_get_clean();

        if (isset($this->data['extends'])) {
            $layout = new View($this->namespaces);
            $layout->assign('content', $content);
            return $layout->render($this->data['extends'], $this->data);
        } else {
            return $content;
        }
    }

    public function assign($key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * @throws TemplateNotFound
     */
    private function resolveTemplate($template): string
    {
        $parts = explode('::', $template);
        if (count($parts) > 1) {
            $namespace = $parts[0];
            $templateName = $parts[1];
            if (isset($this->namespaces[$namespace])) {
                $file = $this->namespaces[$namespace] . '/' . $templateName . '.php';
                if (file_exists($file)) {
                    return $file;
                }
            }
        }
        return throw new TemplateNotFound('Template not found ' . $template);
    }

    public function extends(string $template): static
    {
        $this->extends = $template;
        return $this;
    }
}