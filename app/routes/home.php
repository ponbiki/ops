<?php

use ns1\ops as ops;

new ops\Session();

$app->get('/', function () use ($app) {

    if (array_key_exists('loggedin', $_SESSION)) {
        $app->redirect('/menu');
    }

    $page = "Api Key Entry";
    $meta = "Login";
    $app->render('home.html.twig', [
        'page' => $page,
        'meta' => $meta,
        'error' => $_SESSION['error']
    ]);

    ops\Session::clear();

})->name('home');

$app->post('/', function () use ($app) {

    $check_key = \filter_var(($app->request()->post('key')), FILTER_SANITIZE_STRING);

    if ($check_key == "") {
        $_SESSION['error'][] = "Please enter your API key";
        $app->redirect('/');
    }

    $_SESSION['api'] = new ops\ApiCalls();
    $_SESSION['api']->keyValidate($check_key);

    if ($_SESSION['api']->valid_key === \FALSE) {
        $_SESSION['error'][] = "Key invalid. Please re-enter your API key";
        //$_SESSION['loggedin'] = \FALSE;
        unset($_SESSION['api']);
        $app->redirect('/');
    } else {
        ops\Session::clear();
        $_SESSION['loggedin'] = \TRUE;
        $app->redirect('/menu');
    }
});