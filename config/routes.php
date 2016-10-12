<?php

$routes->get('/', function() {
    JobController::index();
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

$routes->get('/job/1/edit', function() {
HelloWorldController::job_edit();
});

$routes->get('/login', function() {
HelloWorldController::login();
});
