<?php

namespace App\Model;

use App\DB;

class Model {
    public function __construct(protected DB $db) {
    }
}