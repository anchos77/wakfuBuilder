<?php
require_once __DIR__ . '\config.php';
require_once __DIR__ . '\..\model\pdoModel.php';
require_once __DIR__ . '\..\model\generateSql.php';


class common {

    public function initialise(){
        $pdoHandle  = new PdoModel();
        $conf = new config();
        $username = $conf->getUsername();
        $password = $conf->getPassword();
        $dsn      = "mysql:host={$conf->getHost()};dbname={$conf->getDbName()};charset=utf8mb4";
        $pdoHandle->connect($dsn,$username,$password);
        return $pdoHandle;
    }

    public function insertIntoDb($pdoHandle,$sql,$parm){
        return $pdoHandle->insert($sql,$param);
    }

    public function getJson($name){
        try{
            $data = json_decode(file_get_contents(__DIR__ . "\..\JsonData\\{$name}.json"));
            return $data;
        } catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

}
