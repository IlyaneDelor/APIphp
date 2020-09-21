<?php

require_once __DIR__ . "/../DataBaseManager.php";
require_once __DIR__ . '/Person.php';

class Customer extends Person
{
    private DataBaseManager $manager;

    private string $address;
    private int $postalCode;
//    private $error = [
//        "password" => 0,
//        "confirmPass" => 0,
//        "address" => 0,
//        "postalCode" => 0
//    ];

    public function __construct($name, $firstName, $mail, $dateBorn, $tel,$token, $password, $confirmPass, $address, $postalCode)
    {
        parent::__construct($name, $firstName, $mail, $tel, $dateBorn,$password,$confirmPass,$token);

        $this->manager = new DatabaseManager();





//        // if valid address
////        if ()
//        $this->address = $address;
//
//        //if valid postalCode
//        if (strlen($postalCode) == 5 && ctype_digit($postalCode) == true)
//            $this->postalCode = $postalCode;
//        else
//            $this->error["postalCode"] = 1;
    }

    public function __toString()
    {
        $result = parent::__toString();
        return  $result . json_encode(get_object_vars($this));
    }

//    public function addInBdd(){
//
//        if (parent::addInBdd() != -1){
//            $daraError = 0;
//            foreach ( $this->error as $value ){
//                if ($value == 1) $daraError = 1;
//            }
//
//            if ($daraError == 0) {
//                $q = "INSERT INTO CUSTOMER(address, postalCode) values(:address, :postalCode)";
//                $req = $this->manager->getPdo()->prepare($q);
//                $req->execute([
//
//                    "address" => $this->address,
//                    "postalCode" => $this->postalCode
//                ]);
//            }
//
//
//            return 1;
//
//        }
//        return 0;
//
//   œœœœœœ}
}