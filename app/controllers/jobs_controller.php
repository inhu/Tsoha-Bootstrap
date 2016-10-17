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
        $attributes = array(
            'name' => $params['name'],
            'description' => $params['description'],
            'importance' => $params['importance']
        );
        $job = new Job($attributes);
        $errors = $job->errors();
        if (count($errors) == 0) {
            $job->save();
            Redirect::to('/job/' . $job->id, array('message' => 'Askare on lisätty listaasi.'));
        } else {
            View::make('job/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
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
        
        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'description' => $params['description'],
            'importance' => $params['importance']
        );
        $job = new Job($attributes);
        $errors = $job->errors();
        
        if(count($errors)>0){
            View::make('job/edit.html', array('errors' => $errors, 'attributes'=> $attributes));
        }else{
            $job->update();
            Redirect::to('/job/' . $job->id, array('message' => 'Askaretta on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        $job = new Job(array('id' => $id));
        $job->destroy();
        Redirect::to('/job', array('message' => 'Askare on poistettu onnistuneesti!'));
    }

    public static function done($id) {
        $job = new Job(array('id' => $id));
        $job->done();
        Redirect::to('/job/' . $job->id, array('message' => 'Askare on tehty.'));
    }

}
