<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }
    public static function job_list(){
        View::make('suunnitelmat/job_list.html');
    }
    public static function job_show(){
        View::make('suunnitelmat/job_show.html');
    }
    public static function job_edit(){
        View::make('suunnitelmat/job_edit.html');
    }
    public static function login(){
    View::make('suunnitelmat/login.html');
    }
  }
