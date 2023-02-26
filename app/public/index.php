<?php

require_once "bootstrap.php";

$path = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$routes = [
    '/' => '/',
    '/excuteDb' => 'excuteDb',
    '/create' => 'create',
    '/edit/([a-z0-9-]+)' => 'show',
    '/delete/([a-z0-9-]+)' => 'delete',
    '/calendar' => 'calendar',
    '/api/getAllTodoList' => '/api/getAllTodoList'
];

foreach ($routes as $route => $file) {
    if (preg_match("#^$route$#", $path)) {
        switch ($file) {
            case '/':
                $controler->index();
                break;
            case 'create':
                if($method === 'GET'){
                    $controler->create();
                    break;
                }
                $controler->store();
                break;
            case 'show':
                if($method === 'GET'){
                    $controler->show();
                    break;
                }
                $controler->update();
                break;
            case 'delete':
                $controler->destroy();
                break;
            case 'excuteDb':
                $db->createTableTodoList();
                break;
            case 'calendar':
                $controler->calendar();
                break;
            case '/api/getAllTodoList':
                $controler->ApiGetAllTodoList();
                break;
            default:
                echo "";
                break;
        }
        exit();
    }
}

http_response_code(404);
echo '404 Not Found';
