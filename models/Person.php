<?php

require_once __DIR__ . "/../DataBaseManager.php";

class Person{
    private $manager;
    private $name;
    private $firstName;
    private $mail;
    private $tel;
    private $dateBorn;
    private $password;
    private $confirmPass;

    private $error = [
        "name" => 0,
        "firstName" => 0,
        "mail" => 0,
        "tel" => 0,
        "dateBorn" => 0,
        "password" => 0,
        "confirmPass" =>0,
        "token" => 0
        ];
    /**
     * Person constructor.
     * @param $name
     * @param $firstName
     * @param $mail
     * @param $tel
     * @param $dateBorn
     * @param $password
     */
    public function __construct($name, $firstName, $mail, $tel, $dateBorn,$password,$confirmPass,$token)
    {
        $this->manager = new DatabaseManager();


            $this->name = $name;

            $this->firstName = $firstName;

            $this->mail = $mail;

            $this->tel = $tel;

            $this->tel = $tel;

            $this->dateBorn = $dateBorn;

            $this->password = $password;

            $this->confirmPass = $confirmPass;

            $this->token = $token;

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

        /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $firstName
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getDateBorn()
    {
        return $this->dateBorn;
    }

    /**
     * @param mixed $dateBorn
     */
    public function setDateBorn($dateBorn)
    {
        $this->dateBorn = $dateBorn;
    }

    public function __toString()
    {
        return json_encode(get_object_vars($this));
    }

//    public function addInBdd(){
//        $dataError = 0;
//        foreach ( $this->error as $value ){
//            if ($value == 1) $dataError = 1;
//        }
//
//        if ($dataError == 0) {
//            $q = "INSERT INTO PERSON(name, firstName, mail, tel, dateBorn,password,token) values(:name, :firstName, :mail, :tel, :dateBorn,:password,:token)";
//            $req = $this->manager->getPdo()->prepare($q);
//            $req->execute([
//                'name' => htmlspecialchars($this->name),
//                'firstName' => htmlspecialchars($this->firstName),
//                'mail' => htmlspecialchars($this->mail),
//                'tel' => htmlspecialchars($this->tel),
//                'dateBorn' => htmlspecialchars($this->dateBorn),
//                'password' => htmlspecialchars($this->password),
//
//                'token' => htmlspecialchars($this->token)
//            ]);
//            return ;
//        }
//        else{
//            return 0;
//        }
//    }


}


