<?php


$url = $_SERVER['REQUEST_URI'];

$path = parse_url($url, PHP_URL_PATH);
$uri = explode('/',$path);
$route = $uri[array_key_last($uri)];

$routes = [
    'login' => 'login.php',
    'reset' => 'reset.php',
    'signup' => 'signup.php',
    'forget' => 'forget.php',
    'logout' => 'controller/auth-controller.php',
    'dashboard' => 'views/pages/dashboard.php',
    'account' => 'views/pages/account.php',
];


$authenticated_routes = ['dashboard', 'account',];
$normal_routes = ['login', 'reset', 'signup', 'forget',];

if (!isset($routes[$route])) {
    $route = 'login';
}


if (in_array($route, $authenticated_routes) && !isset($_SESSION['user'])) {
    // Redirect unauthenticated users to the login page
    header('Location: login');
    exit();
}

if (in_array($route, $normal_routes) && isset($_SESSION['user'])) {
    // Redirect unauthenticated users to the login page
    header('Location: dashboard');
    exit();
}


require($routes[$route]);

