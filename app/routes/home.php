<?php

$app->get('/', function () use ($app) {
    $page = "Ops-API";
    $meta = "Main Menu";

    $app ->render('home.html.twig', [
        'page' => $page,
        'meta' => $meta
    ]);

})->name('home');