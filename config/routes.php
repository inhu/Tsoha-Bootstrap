<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

   $routes->get('/job', function() {
    HelloWorldController::job_list();
  });
  
   $routes->get('/job/1', function() {
    HelloWorldController::job_show();
  });
  
   $routes->get('/job/1/edit', function() {
    HelloWorldController::job_edit();
  });
  
    $routes->get('/login', function() {
    HelloWorldController::login();
  });