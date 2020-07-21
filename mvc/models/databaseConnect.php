<?php

class databaseConnection
{

    public function __construct()
    {
        $host = "localhost";
        $user = "etpjiwmy_WP1GK";
        $pass = "Hostforme123.";
        $db_name = "etpjiwmy_WP1GK";

        $this->connection = new mysqli($host, $user, $pass, $db_name);
        if ($this->connection->connect_error) {
            die("Failed to connect to MySQL: " . $this->connection->connect_error);
        }
    }

    public function prepare($query) {
        return $this->connection->prepare($query);
    }
}
