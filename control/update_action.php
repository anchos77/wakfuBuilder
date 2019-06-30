<?php
require_once(__DIR__ . '/common.php');

class action extends common{

    public function execute(){
        try{
            $getSql = new generateSql();
            $sql = $getSql->insertActionSql();
            $actionsData = $this->getJson('actions');
            $pdoHandle = $this->initialise();

            foreach($actionsData as $action){
                $id = $action->definition->id;
                $description = $action->description->en;
                $param = [$id, $description];
                if(!$this->insertIntoDb($pdoHandle,$sql,$param)){
                    echo 'failed updating actions table';
                }
            }

        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }



}
$obj = new action();
$obj->execute();

