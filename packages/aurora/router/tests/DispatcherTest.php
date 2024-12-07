<?php

use Aurora\Router\Dispatcher;
use Aurora\Router\Exceptions\NotFoundException;
use Aurora\Router\RouteCollection;

class DispatcherTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws NotFoundException
     */
    public function testDispatch()
    {
        $routeCollection = new RouteCollection();

        $routeCollection->patch('/category', TestController::class, 'test');
        $postRoute = $routeCollection->post('/test', TestController::class, 'test');
        $getRoute = $routeCollection->get('/test', TestController::class, 'test');
        $routeCollection->patch('/test', TestController::class, 'test');
        // POST
        $dispatcher = new Dispatcher($routeCollection, '/test', 'POST');
        $route = $dispatcher->dispatch();
        $this->assertSame($postRoute, $route);
        $this->assertNotSame($getRoute, $route);
        // GET
        $dispatcher = new Dispatcher($routeCollection, '/test', 'GET');
        $route = $dispatcher->dispatch();
        $this->assertSame($getRoute, $route);
    }

    public function testDispatchNotFound() {
        $this->expectException(NotFoundException::class);
        $routeCollection = new RouteCollection();
        $routeCollection->post('/test', TestController::class, 'test');
        $dispatcher = new Dispatcher($routeCollection, '/notFoundException', 'POST');
        $dispatcher->dispatch();
    }
}