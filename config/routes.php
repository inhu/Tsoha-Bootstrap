<?php

$routes->get('/', function() {
    JobController::index();
});

$routes->get('/login', function() {
    UserController::login();
});
$routes->post('/login', function() {
    UserController::handle_login();
});

$routes->post('/logout', function() {
    UserController::logout();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/job', function() {
    JobController::index();
});

$routes->post('/job', function() {
    JobController::store();
});

$routes->get('/job/new', function() {
    JobController::create();
});

$routes->get('/job/:id/edit', function($id) {
    JobController::edit($id);
});

$routes->post('/job/:id/edit', function($id) {
    JobController::update($id);
});

$routes->post('/job/:id/done', function($id) {
    JobController::done($id);
});

$routes->post('/job/:id/destroy', function($id) {
    JobController::destroy($id);
});

$routes->get('/job/:id', function($id) {
    JobController::show($id);
});

$routes->get('/category', function() {
    CategoryController::index();
});

$routes->get('/category/new', function() {
    CategoryController::create();
});

$routes->post('/category', function() {
    CategoryController::store();
});

$routes->post('/category/:id/destroy', function($id) {
    CategoryController::destroy($id);
});