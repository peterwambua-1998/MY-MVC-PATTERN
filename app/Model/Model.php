<?php

namespace App\Model;

use App\App;
use App\DB;

class Model {
    protected DB $db;

    public function __construct() {
        $this->db = App::$db;
    }
}