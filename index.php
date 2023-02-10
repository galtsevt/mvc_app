<?php
require_once 'vendor/autoload.php';

try {
    echo (new \App\App())->run();
} catch (Exception $e) {
    echo $e;
}
