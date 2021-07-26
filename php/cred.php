<?php
    class SMTPcred{
        private $host;
        private $user;
        private $pass;
        private $sender;
        private $port;

        public function __construct($host,$user,$pass,$sender,$port){
            $this->host = $host;
            $this->user = $user;
            $this->pass=$pass;
            $this->sender=$sender;
            $this->port=$port;
        }
        function getHost(){
            return $this->host;
        }
        function getUser(){
            return $this->user;
        }
        function getPass(){
            return $this->pass;
        }
        function getSender(){
            return $this->sender;
        }
        function getPort(){
            return $this->port;
        }
    }
?>