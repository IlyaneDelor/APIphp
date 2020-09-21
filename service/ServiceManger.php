<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once  __DIR__ . '/../models/Service.php';

class ServiceManger
{
    private DataBaseManager  $manager;

    /**
     * ServiceManger constructor.
     * @param DataBaseManager $manager
     */
    public function __construct( $manager)
    {
        $this->manager = $manager;
    }

    public function addNewService(string $name, string $price){
        if($this->exists($name)){
            return null;
        }

        $affectedRows = $this->manager->exec('INSERT INTO service (jobs,price,etat) VALUES (?,?,1)', [
            $name,
            (float)$price
        ]);

        if ($affectedRows === 0){
            return null;
        }
        return new Service($this->manager->getLastInsertId(), $name, $price);

    }

    public function exists(string $name):bool{
        $found = $this->manager->find('SELECT id FROM service WHERE jobs = ?', [$name]);
        return $found !== null;
    }

    public function getAllService(){
        $found = $this->manager->getAll('SELECT * from service');
        return $found;
    }

    public function getAllServiceValide(){
        $found = $this->manager->getAll('SELECT * from service WHERE etat = 1');
        return $found;
    }

    public function find(int $id){
        $found = $this->manager->find('SELECT * from service WHERE id = ?', [$id]);
        return $found;
    }

    public function delService(int $id){
        $affectedRows = $this->manager->exec('UPDATE service SET etat = 0 WHERE id = ?', [$id]);
        if($affectedRows === 0){
            return null;
        }
    }

    public function activeService(int $id){
        $affectedRows = $this->manager->exec('UPDATE service SET etat = 1 WHERE id = ?', [$id]);
        if($affectedRows === 0){
            return null;
        }
    }

    public function updateName(int $id, string $name){
        if($this->exists($name)){
            return null;
        }

        $affectedRows = $this->manager->exec('UPDATE service SET jobs = ? WHERE id = ?', [$name,$id]);
        if ($affectedRows === 0){
            return null;
        }
        else{
            return true;
        }


    }

    public function updatePrice(int $id, string $price){

        $affectedRows = $this->manager->exec('UPDATE service SET price = ? WHERE id = ?', [(float)$price,$id]);
        if ($affectedRows === 0){
            return null;
        }
        else{
            return true;
        }


    }




}