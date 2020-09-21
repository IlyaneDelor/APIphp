<?php
require_once __DIR__ . '/../DataBaseManager.php';
require_once  __DIR__ . '/../models/Customer.php';

class AcountManager
{
    private DataBaseManager  $manager;


    public function __construct( $manager)
    {
        $this->manager = $manager;
    }

    public function log($mail, $password){
        $passSha = hash("sha256", $password);
        $result = $this->manager->find("SELECT id, type FROM person WHERE mail = ? AND password = ?", [$mail, $passSha]);
        echo "id : " . $result['id'] . "   okkk";

        if ($result['id'] ){
            $token = bin2hex(random_bytes(32));
            $affectedRows = $this->manager->exec('UPDATE person SET token = ? WHERE id = ?', [
                $token,
                $result['id']
            ]);

            return $token;
        }

        else{
            return 0;
        }

    }

    public function verifAdmin($token){
        $result = $this->manager->find("SELECT type FROM person where token = ?", [$token]);
        if($result['type'] == 1){
            return 1;
        }
        else{
            return 0;
        }
    }

    function getVerifMail($token){
        $result = $this->manager->find("SELECT verifMail FROM person WHERE token = ?", [$token]);
        if ($result){
            return $result;
        }
        else{
            return nop;
        }

    }

    function isCo($token){
        $result = $this->manager->find("SELECT id FROM person WHERE token = ?", [$token]);
        if ($result){
            return 1;
        }
        else{
            return 0;
        }
    }

    function getIdFromToken($token){
         return $this->manager->find("SELECT id FROM person WHERE token = ?", [$token])['id'];
    }
}