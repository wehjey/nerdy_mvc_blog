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
}