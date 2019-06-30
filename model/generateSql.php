<?php

class generateSql {

    private $actionSql = 'INSERT IGNORE INTO action (id, description) VALUES (?,?)';

    public function insertActionSql(){
        return $this->actionSql;
    }
}