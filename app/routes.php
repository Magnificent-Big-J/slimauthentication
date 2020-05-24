<?php

$app->get('/','HomeController:index')->setName('home');
$app->get('/auth/signup','AuthController:getSignUp')->setName('auth.sign');
$app->post('/auth/signup','AuthController:postSignUp');