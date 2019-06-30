<?php

class cModel {

    private $ch;

    public function __construct(){

        if($this->ch = curl_init()){
        }else $this->_exception();
    }

    public function setOpt($opt,$val){
        if(curl_setopt($this->ch,$opt,$val)){
            
        }else $this->_exception;
    }

    public function exec(){
        $this->setOpt(CURLOPT_RETURNTRANSFER, true);
        if($result = curl_exec($this->ch)){
            return $result;
        } else $this->_exception();
    }

    public function close(){
        curl_close($this->$ch);
    }

    private function _exception(){
        throw new Exception(curl_error($this->ch));
    }
}
