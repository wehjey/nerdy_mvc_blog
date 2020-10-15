<?php

class Users extends Controller
{
    // Users Controller

    public function __construct()
    {
        
    }

    /**
     * Register new user
     *
     * @return view
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form
        } else {
            // init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'password_err' => '',
                'email_err' => '',
                'confirm_password_err' => '',
            ];

            $this->view('users/register', $data);
        }
    }

    /**
     * Login user
     *
     * @return view
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form
        } else {
            // init data
            $data = [
                'email' => '',
                'password' => '',
                'password_err' => '',
                'email_err' => '',
            ];

            $this->view('users/login', $data);
        }
    }
}