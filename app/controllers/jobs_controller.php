<?php

class JobController extends BaseController {

    public static function index() {
        $jobs = Job::all();

        View::make('job/index.html', array('jobs' => $jobs));
    }

    public static function show($id) {
        $job = Job::find($id);

        View::make('job/show.html', array('job' => $job));
    }

    public static function store() {
        $params = $_POST;
        $job = new Job(array(
            'name' => $params['name'],
            'description' => $params['description'],
            'importance' => $params['importance']
        ));
        $job->save();
        Redirect::to('/job/' . $job->id, array('message' => 'Askare on lisätty listaasi.'));
    }

    public static function create() {
        View::make('job/new.html');
    }

    public static function edit($id) {
        $job = Job::find($id);
        View::make('job/edit.html', array('attributes' => $job));
    }

    //ei toimi oikein
    public static function update($id) {
        $params = $_POST;

        $job = new Job(array(
            'name' => $params['name'],
            'description' => $params['description'],
            'importance' => $params['importance']
        ));
        $job->update();
        Redirect::to('/job/' . $job->id, array('message' => 'Askaretta on muokattu onnistuneesti.'));
    }
    
    public static function destroy($id){
        $job = new Job(array('id'=> $id));
        $job->destroy();
        Redirect::to('/job', array('message'=>'Askare on poistettu onnistuneesti!'));
    }
    public static function done($id){
        $job = new Job(array('id'=> $id));
        $job->done();
        Redirect::to('/job/' . $job->id, array('message' => 'Askare on tehty.'));
    }
}
