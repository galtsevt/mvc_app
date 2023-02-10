<?php

namespace App\System;
use Exception;

class Render
{
    protected string $layout;

    /**
     * @throws Exception
     */
    public function render(string $template, array $data = []): bool|string
    {
        $template = $this->getTemplate($template);
        $layout = $this->getTemplate($this->layout);
        if (file_exists($template) and file_exists($layout)) {
            $mainContent = $this->getHtml($template, $data);
            $data['mainContent'] = $mainContent;
            return $this->getHtml($layout, $data);
        } else {
            throw new Exception('Template not found');
        }
    }

    public function layout($template): static
    {
        $this->layout = $template;
        return $this;
    }

    private function getHtml($template, $data): bool|string
    {
        extract($data);
        ob_start();
        include $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    private function getTemplate($template): string
    {
        return __DIR__ . '/../../templates/' . $template . '.php';
    }
}