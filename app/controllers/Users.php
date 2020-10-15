<?php

class Users extends Controller
{
    public function __construct()
    {
        // instantiate user model
        $this->userModel = $this->model('User');
    }

    /**
     * Register new user
     *
     * @return view
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'password_err' => '',
                'email_err' => '',
                'confirm_password_err' => '',
            ];

            // validate logic
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email!';
            } else {
                // check if email already exists
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'This email is already taken!';
                }
            }


            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name!';
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password!';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be atleast 6 characters';
            }

            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password!';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match!';
                }
            }

            // make sure errors are empty
            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                
                // hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if ($this->userModel->register($data)) {
                    flash('register_success', 'Account has been created. Please log in!');
                    redirect('users/login');
                } else {
                    die('Whoops! An error occured.');
                }
            } else {
                // load views with errors
                $this->view('users/register', $data);
            }

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
            // sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'password_err' => '',
                'email_err' => '',
            ];

            // validate logic
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email!';
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password!';
            }

            // make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                die('success');
            } else {
                // load views with errors
                $this->view('users/login', $data);
            }

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