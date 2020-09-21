<?php

require_once "DataBaseManager.php";

class Person{
    private $manager;
    private $name;
    private $firstName;
    private $mail;
    private $tel;
    private $dateBorn;

    private $error = [
        "name" => 0,
        "firstName" => 0,
        "mail" => 0,
        "tel" => 0,
        "dateBorn" => 0
        ];
    /**
     * Person constructor.
     * @param $name
     * @param $firstName
     * @param $mail
     * @param $tel
     * @param $dateBorn
     */
    public function __construct($name, $firstName, $mail, $tel, $dateBorn)
    {
        $this->manager = new DatabaseManager();

        if (ctype_alpha($name)){
            $this->name = $name;
        }
        else{
            $this->error["name"] = 1;
        }

        if (ctype_alpha($firstName)){
            $this->firstName = $firstName;
        }
        else{
            $this->error["firstName"] = 1;
        }


        if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $q = 'SELECT mail FROM PERSON';
            $req = $this->manager->getPdo()->prepare($q);
            $req->execute();
            $result = $req->fetchAll();
            //echo var_dump($result);

            $ifExist = 0;
            foreach ($result as $value){
                $ifExist = strcasecmp($value['mail'], $mail) !== 0?0:1;
            }
            if ($ifExist == 0){
                $this->mail = $mail;
            }
            else{
                $this->error["mail"] = 1;
            }
        }
        else{
            $this->error["mail"] = 1;
        }

        //verify valid tel
        if (ctype_digit($tel) && strlen($tel) == 10){
            $this->tel = $tel;
        }
        else{
            $this->error["tel"] = 1;
        }

        if (ctype_digit($tel) && strlen($tel) == 10){
            $this->tel = $tel;
        }
        else{
            $this->error["tel"] = 1;
        }


        $date = date_create($dateBorn);
//        $this->dateBorn = $dateBorn;
        if (checkdate($date->format('m'), $date->format('d'), $date->format('Y'))){
            $this->dateBorn = $dateBorn;
        }
        else{
            $this->error["dateBorn"] = 1;
        }
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

    public function addInBdd(){
        $dataError = 0;
        foreach ( $this->error as $value ){
            if ($value == 1) $dataError = 1;
        }

        if ($dataError == 0) {
            $q = "INSERT INTO PERSON(name, firstName, mail, tel, dateBorn) values(:name, :firstName, :mail, :tel, :dateBorn)";
            $req = $this->manager->getPdo()->prepare($q);
            $req->execute([
                'name' => htmlspecialchars($this->name),
                'firstName' => htmlspecialchars($this->firstName),
                'mail' => htmlspecialchars($this->mail),
                'tel' => htmlspecialchars($this->tel),
                'dateBorn' => htmlspecialchars($this->dateBorn)
            ]);
            return 1;
        }
        else{
            return 0;
        }
    }


}

 ?>
