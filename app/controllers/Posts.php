<?php

class Posts extends Controller
{

    public function __construct()
    {
        if (!isLoggedIn()) {
            flash('redirect_user', 'Please log in to continue!', 'alert alert-warning');
            redirect('users/login');
        }
            
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        // get posts
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts,
        ];
        $this->view('posts/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            // validate fields
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter body of post';
            }

            if (empty($data['title_err']) && empty($data['body_err'])) {
                // validated

                if ($this->postModel->addPost($data)) {
                    flash('post_message', 'Post added!');
                    redirect('posts');
                } else {
                    die('Whoops! An error occured');
                }
            } else {
                // load view with errors
                $this->view('posts/add', $data);
            }

        } else {
            $data = [
                'title' => '',
                'body' => '',
            ];
            $this->view('posts/add', $data);
        }

    }
}