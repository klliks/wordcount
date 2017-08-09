<?php

namespace app\models;

use vendor\Connection;

class Model extends Connection {

    public function getAll() {
        $stmt = $this->bdh->prepare("SELECT special_interest FROM watchlist ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}