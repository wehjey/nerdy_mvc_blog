<?php

/**
 * Base controller class
 * Loads the models and views
 */

class Controller
{
    /**
     * Load model
     */
    public function model($model)
    {
        // require model file
        require_once '../app/models/' . $model . '.php';

        // instantiate the model
        // eg return new Post()
        return new $model();
    }

    /**
     * Load view
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    public function view($view, $data = [])
    {
        // check for view file
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('Whoops! View "' . $view . '" does not exist.');
        }
    }
}