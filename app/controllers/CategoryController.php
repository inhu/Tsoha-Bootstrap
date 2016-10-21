<?php

class CategoryController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $categories = Category::all();

        View::make('category/index.html', array('categories' => $categories));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'name' => $params['name']
        );
        $category = new Category($attributes);
        $errors = $category->errors();
        if (count($errors) == 0) {
            $category->save();
            Redirect::to('/category', array('message' => 'Uusi luokka on lisätty'));
        } else {
            View::make('category/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function create() {
        self::check_logged_in();
        View::make('category/new.html');
    }

    public static function destroy($id) {
        self::check_logged_in();
        $category = new Category(array('id' => $id));
        $category->destroy();
        Redirect::to('/category', array('message' => 'Luokka on poistettu onnistuneesti!'));
    }

}