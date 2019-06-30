<?php
require_once __DIR__ . '/../model/simpleCurlModel.php';

class loader {

    const BASE_DIR = __DIR__.'\\..\\JsonData\\';
    const BASE_URL = 'https://s.ankama.com/games/wakfu/gamedata/';
    const GAME_VERSION = 'config.json';
    const TYPES = ['actions','equipmentItemTypes','itemProperties','items','states'];

    /** 
     * 
     * @return 1 if new version was loaded, 0 if current version was already the latest
     */
    public function loadVersion(){
        try {
            $ch = new cModel();
            $ch->setOpt(CURLOPT_URL,self::BASE_URL.self::GAME_VERSION);
            $result = json_decode($ch->exec());
    
            $currentVersion = $this->getVersion();
            if($result->version == $currentVersion){
                return false;
            }else {
				$this->exportJson(json_encode($result),'version');
                return true;
            }
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function getURL($type){
        $version = $this->getVersion();
        return self::BASE_URL . $version . '/' .$type . '.json';
    }

    public function exportJson($data,$filename){
        $fp = fopen(self::BASE_DIR.$filename.'.json','w');
        fwrite($fp,$data);
        fclose($fp);
    }

    public function getVersion(){
        if(file_exists(self::BASE_DIR.'version.json')){
			return json_decode(file_get_contents(self::BASE_DIR.'version.json'))->version;
        } else return 0;       
    }

    public function execute(){
        foreach(self::TYPES as $type){
            if(!file_exists(self::BASE_DIR . $type . '.json')){
                $ch = new cModel();
                $ch->setOpt(CURLOPT_URL,$this->getURL($type));
                $result = $ch->exec();
                $this->exportJson($result,$type);
            }
        }
	}
	
	public function download($type){
		$ch = new cModel();
        $ch->setOpt(CURLOPT_URL,$this->getURL($type));
		$result = $ch->exec();
		$this->exportJson($result,$type);
	}

}
$obj = new loader();
//echo $obj->loadVersion() ? "true\n" : "false\n";
$obj->loadVersion();
//$obj->execute();
$obj->download('equipmentItemTypes');
