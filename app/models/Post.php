<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Get posts from db
     *
     * @return object
     */
    public function getPosts()
    {
        $this->db->query(
            'SELECT *,
            posts.id as postId,
            users.id as userId,
            posts.created_at as post_created_at
            FROM posts
            INNER JOIN users
            ON posts.user_id = users.id
            ORDER BY posts.created_at DESC'
        );
        $results = $this->db->resultSet();
        return $results;
    }

    /**
     * Add post to database
     *
     * @param array $data
     * @return void
     */
    public function addPost($data)
    {
        $this->db->query('INSERT INTO posts (title, body, user_id) VALUES (:title, :body, :user_id)');

        // bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':user_id', $data['user_id']);

        // execute statement
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }
}