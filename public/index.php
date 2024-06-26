<?php
require_once '../vendor/autoload.php';

ini_set('session.gc_maxlifetime', 604800);
ini_set('session.cookie_lifetime', 604800);

$application = new \Aurora\Framework\Core\Application([
    \Aurora\Modules\Auth\AuthModule::class,
]);
$application->run();