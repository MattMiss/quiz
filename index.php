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

    // Render a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /survey', function($f3) {

    $destinations = getDestinations();
    $f3->set('destinations', $destinations);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (!empty($_POST['name'])){
            $f3->set('SESSION.name', $_POST['name']);
        }

        if (!empty($_POST['activities'])) {
            $activities = implode(', ', $_POST['activities']);
            $f3->set('SESSION.choices', $activities);
        }

        $f3->reroute('summary');
    }


    $view = new Template();
    echo $view->render('views/survey.html');
});

$f3->route('GET /summary', function($f3) {



    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run fat free
$f3->run();