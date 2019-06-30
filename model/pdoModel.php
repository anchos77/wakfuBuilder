<?php 
require_once __DIR__ . '/../control/config.php';

class pdoModel{

    private $dbh;

    /** 
    * DB自動接続クラス
    * @throws PDOEXception
    */
    public function __construct($dsn = ''){
        $option = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false    
        );
        
        $conf = config::getInstance();
        $dsn = $conf->getDsn();
        $username = $conf->getUsername();
        $password = $conf->getPassword();
        
        try {
            $this->dbh = new PDO($dsn, $username, $password, $option);
        } catch(PDOException $e){
            throw new PDOException($e->getMessage());
        }
    }

    /** 
    * INSERT,DELETE 等用のクエリを送る関数
    * @param 
    * @return boolean
    * @throws exception
    */
    public function insert($sql,$param){
        try {
            $prep = $this->dbh->prepare($sql);
            return $prep->execute($param);
        } catch(PDOEXception $e){
            throw new PDOEXception($e->getMessage());
        }
    }
    
    public function exec($sql){
        try {
            return $this->dbh->exec($sql);
        } catch(Excption $e) {
            throw new Exception($e->getMessage());
        }
    }

}
