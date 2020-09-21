<?php

require_once "DataBaseManager.php";
require_once "Person.php";

class Customer extends Person
{
    private $manager;
    private $password;
    private $address;
    private $postalCode;
    private $error = [
        "password" => 0,
        "confirmPass" => 0,
        "address" => 0,
        "postalCode" => 0
    ];

    public function __construct($name, $firstName, $mail, $dateBorn, $tel, $password, $confirmPass, $address, $postalCode)
    {
        parent::__construct($name, $firstName, $mail, $tel, $dateBorn);

        $this->manager = new DatabaseManager();



        // if valid password
        if (preg_match('/\A(?=[\x20-\x7E]*?[A-Z])(?=[\x20-\x7E]*?[a-z])(?=[\x20-\x7E]*?[0-9])[\x20-\x7E]{6,}\z/', $password) == 1){
            if (strcasecmp($password, $confirmPass) !== 1){
                $this->password = $password;
            }
            else{
                $this->error["confirmPass"] = 1;
            }
        }
        else{
            $this->error["password"] = 1;
        }

        // if valid address
//        if ()
        $this->address = $address;

        //if valid postalCode
        if (strlen($postalCode) == 5 && ctype_digit($postalCode) == true)
            $this->postalCode = $postalCode;
        else
            $this->error["postalCode"] = 1;
    }

    public function __toString()
    {
        $result = parent::__toString();
        return  $result . json_encode(get_object_vars($this));
    }

    public function addInBdd(){

        if (parent::addInBdd()){
            $daraError = 0;
            foreach ( $this->error as $value ){
                if ($value == 1) $daraError = 1;
            }

            if ($daraError == 0) {
                $q = "INSERT INTO CUSTOMER(password, address, postalCode) values(:password, :address, :postalCode)";
                $req = $this->manager->getPdo()->prepare($q);
                $req->execute([
                    "password" => $this->password,
                    "address" => $this->address,
                    "postalCode" => $this->postalCode
                ]);
            }

            return 1;
        }
        return 0;
    }
}