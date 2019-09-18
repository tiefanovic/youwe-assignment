<?php
/**
 * Created by PhpStorm.
 * User: Tiefanovic
 * Date: 9/17/2019
 * Time: 9:39 PM
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('BP', __DIR__);

require BP . DS . 'vendor/autoload.php';

$router = new \Buki\Router([
    'paths' => [
        'controllers' => 'app/Controller',
    ],
    'namespaces' => [
        'controllers' => 'App\Controller',
    ],
]);
// Poker Game Routes
$router->get('/', 'HomeController@index');
$router->post('/poker/select-card', 'HomeController@selectCard');
$router->get('/poker/index', 'PokerController@index');
$router->post('/poker/draw', 'PokerController@draw');
$router->get('/poker/success', 'PokerController@success');
$router->post('/poker/new-game', 'PokerController@clearSessionData');
// Word Analyzer Routes
$router->get('/words', 'WordController@index');
$router->post('/words/analyze', 'WordController@analyze');
$router->run();