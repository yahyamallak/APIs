<?php

namespace Api\Models;

use Api\Database\Database;

class Player extends Database {

    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }


    public function getPlayers() {
        $query = $this->db->prepare("SELECT * FROM players");
    }

}