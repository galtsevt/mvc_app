<?php

use JetBrains\PhpStorm\NoReturn;

function settings($key)
{
    $settings = include __DIR__ . '/../../../config/main.php';
    if (isset($settings[$key])) {
        return $settings[$key];
    }
    return null;
}

function session(): ?\App\System\Session
{
    return \App\System\Session::getInstance();
}

#[NoReturn] function redirect($url): void
{
    header('Location: ' . $url);
    exit;
}

function auth(): \App\System\Facades\Auth
{
    return \App\System\Facades\Auth::getInstance();
}

function public_path($path): string
{
    return __DIR__ . '/../../../public/' . $path;
}

function vite(string $url): string
{
    return (new \App\System\View\ViteAsset())->viteAssets($url);
}
