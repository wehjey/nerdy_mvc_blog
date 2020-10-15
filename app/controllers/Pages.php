<?php

/**
 * Default controller for framework
 */

class Pages extends Controller
{

    public function __construct()
    {
        //
    }

    public function index() 
    {
        $data = [
            'title' => 'Share Posts',
            'description' => 'Simple social network built using Nerdy MVC PHP framework',
        ];
        $this->view('pages/index', $data);
    }

    public function about() 
    {
        $data = [
            'title' => 'About Us',
            'description' => 'App to share posts with other users',
        ];

        $this->view('pages/about', $data);
    }
}