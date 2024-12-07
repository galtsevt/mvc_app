<?php

use Aurora\Router\Exceptions\RouteNotFoundException;
use Aurora\Router\Route;
use Aurora\Router\RouteCollection;
use PHPUnit\Framework\TestCase;

class RouteCollectionTest extends TestCase
{
    public function testAddRoute()
    {
        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(['GET', 'POST'], '/test', TestController::class, 'test');
        $route = current($routeCollection->getCollection());
        $this->assertSame(['GET', 'POST'], $route->getMethods());
        $this->assertInstanceOf(Route::class, $route);
    }

    public function testUrlFromRoute()
    {
        $routeCollection = new RouteCollection();
        $routeCollection->addRoute(['GET', 'POST'], '/test/{test}/{test3::\d+}', TestController::class, 'test')
            ->setName('test');
        $url = $routeCollection->getUrlFromRouteName('test', ['test' => 'first', 'test3' => 'second']);
        $this->assertSame('/test/first/second', $url);
    }

    /**
     * @throws RouteNotFoundException
     */
    public function testNestedUrlFromRoute()
    {
        $routeCollection = new RouteCollection();
        $routeCollection->group(['prefix' => '/category'], function (RouteCollection $routeCollection) {
            $routeCollection->addRoute(
                ['GET', 'POST'], '/test/{test}', TestController::class, 'test'
            )->setName('test');
        });
        $url = $routeCollection->getUrlFromRouteName('test', 'first');
        $this->assertSame('/category/test/first', $url);
    }
}
