<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

    session_start();
    require_once "vendor/autoload.php";

    require_once "base.php";

    use Phroute\Phroute\RouteCollector;

    $router = new RouteCollector();

    $router->get("/", function () {
        displayContent("home.pug");
    });

    $router->get("/login", function () {
        require_once "login.php";
    });

    $router->post("/login", function () {
        require_once "login.php";
    });

    $router->get("/signup", function () {
        require_once "signup.php";
    });
    
    $router->post("/signup", function () {
        require_once "signup.php";
    });

    $router->get("/dashboard", function () {
        require_once "dashboard.php";
    });

    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

    try {
        $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        echo $response;
    } catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $error) {
        echo "not found";
    } catch (Phroute\Phroute\Exception\HttpMethodNotAllowedException $error) {
        echo "not allowed method";
    }
?>