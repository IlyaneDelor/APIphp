<?php
require_once __DIR__ . '/../DataBaseManager.php';
require_once  __DIR__ . '/../models/Customer.php';

class RegisterCustomerManager{
    private DataBaseManager  $manager;


    public function __construct( $manager)
    {
        $this->manager = $manager;
    }

    public function ifExsit(string $mail){
        $found = $this->manager->find('SELECT id FROM person WHERE mail = ?', [$mail]);
        return $found !== null;
    }

    public function timestampToDate($mon_timestamp) {
        return date('Ymd', $mon_timestamp);
    }

    public function getNewDate($ma_date, $decalage) {
        return  $ma_date + ($decalage * 3600 * 24);
    }

    public function register($name, $firstName, $mail, $dateBorn, $tel, $address, $postalCode, $password, $confirmPass){
        $error = new ArrayObject();
        if ($this->ifExsit($mail)){
            $error->append("mailExist");
        }

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $error->append("mailError");
        }


        if (!ctype_alpha($name)){
            $error->append("nameError");
        }
        if (!ctype_alpha($firstName)){
            $error->append("firstNameError");
        }
        if (!ctype_digit($tel) && strlen($tel) != 10){
            $error->append("telError");
        }

        $date = date_create($dateBorn);
        if (checkdate($date->format('m'), $date->format('d'), $date->format('Y'))){
            $dateMin = date_create("01-01-1920");
            if($dateMin > $date){
                $error->append("dateError");
            }

            $dateMin  = $this->timestampToDate($this->getNewDate(time(), - (10 * 365) ));
            $dateMin = date_create($dateMin);
            if($dateMin < $date){
                $error->append("tooYoung");
            }

        }
        else{
            $error->append("dateFormat");
        }

        if (preg_match('/\A(?=[\x20-\x7E]*?[A-Z])(?=[\x20-\x7E]*?[a-z])(?=[\x20-\x7E]*?[0-9])[\x20-\x7E]{6,}\z/', $password) != 1){
            $error->append("passwordError");
        }

        if (strcmp($password, $confirmPass) !== 0){
            $error->append("confirmPassError");
        }

//        $error->append($postalCode);
        if (strlen($postalCode) != 5){
            $error->append("postalCodeError");
        }

        if(strlen($address) < 3){
            $error->append("addressError");
        }

        if (count($error) == 0) {
            $passwordSha = hash('sha256', $password);
//            $verifMail = $this->getRandomStr(6);

            $error->append($name);
            $error->append($firstName);
            $error->append($mail);
            $error->append($tel);
            $error->append($dateBorn);
            $error->append($password);
//            $error->append($verifMail);


            $this->manager->exec('INSERT INTO person (name, firstName, mail, tel, dateBorn,password) VALUES (?,?,?,?,?,?)', [
                (string)$name,
                (string)$firstName,
                (string)$mail,
                (string)$tel,
                (string)$dateBorn,
                (string)$passwordSha
            ]);

            $newId = $this->manager->getLastInsertId();

            $this->manager->exec('INSERT INTO customer (address, postalCode, id_person) VALUES (?,?,?)', [$address, $postalCode, $newId]);



            return "ok";
        }else{
            return $error;
        }

    }

    public function getRandomStr($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }


}

