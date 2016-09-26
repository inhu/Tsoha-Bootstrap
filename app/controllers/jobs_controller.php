<?php

class JobController extends BaseController{
    
    public static function index(){
        $jobs = Job::all();
        
        View::make('job/index.html', array('jobs'=> $jobs));
    }
    public static function show($id){
        $job = Job::find($id);
        
        View::make('job/show.html', array('job'=> $job));
    }
    public static function store(){
        $params = $_POST;
        $job = new Job(array(
            'name' => $params['name'],
            'description' => $params['description'],
            'importance' => $params['importance']
        ));
        $job->save();
        Redirect::to('/job/' . $job->id, array('message' => 'Askare on lisätty listaasi.'));
    }
    
    public static function create(){
        View::make('job/new.html');
    }
}

