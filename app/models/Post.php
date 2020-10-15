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
}