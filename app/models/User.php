<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Check if email already exists
     *
     * @param string $email
     * @return boolean
     */
    public function findUserByEmail($email) 
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}