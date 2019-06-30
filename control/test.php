<?php
require_once __DIR__ . '/../model/pdoModel.php';

class test {

    public function tester(){
        try {
            if($dbh = new pdoModel()){
                echo 'connection sucessful';
            }
            $sql = <<<SQL
            SELECT *
            FROM action
            SQL;
            return $dbh->exec($sql);

        } catch (Exception $e) {
            echo $e->getMessage();
        }        

    }

}
$n = new test();
echo $n->tester();
