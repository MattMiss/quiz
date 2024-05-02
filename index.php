<?php

// SDEV328/quiz/index.php
// This is my controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');

// Create an instance of the Base class
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function($f3) {

    $destinations = getDestinations();
    $f3->set('destinations', $destinations);

    // Render a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET /survey', function($f3) {

    $view = new Templace();
    echo $view->render('views/survey.html');
});

// Run fat free
$f3->run();