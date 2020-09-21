<?php
require_once __DIR__.'/../DataBaseManager.php';
require_once __DIR__.'/../models/Intervention.php';


class InterventionManage
{
    private DataBaseManager $manager;

    /**
     * InterventionManage constructor.
     * @param DataBaseManager $manager
     */
    public function __construct(DataBaseManager $manager)
    {
        $this->manager = $manager;
    }

    public function addNewIntervention(String $title, int $idService, String $address, int $postalCode, String $city, String $serviceDate, String $serviceHour, float $duration, String $detail, int $idCustomer){
        $date = date_create($serviceDate);

        $affectedRows = $this->manager->exec("INSERT INTO intervention ( title, idService, addressIntervention, postalCode, city, dateIntervention, hourIntervention, duration, detail, etat, idCustomer) VALUES (?,?,?,?,?,?,?,?,?,?,?)", [$title, (int)$idService, $address, (String)$postalCode, $city, $serviceDate, $serviceHour, $duration, $detail, 0, $idCustomer]);

        if ($affectedRows === 0){
            return null;
        }

        return new Intervention($this->manager->getLastInsertId(), $title, $idService, $address, $postalCode, $city, $serviceDate, $serviceHour, $duration, $detail, 0, $idCustomer);
    }

    public function getAllIntervention(int $id){
        $found = $this->manager->getAll('SELECT intervention.*, service.jobs, person.name from intervention LEFT JOIN service ON intervention.idService = service.id LEFT JOIN person ON intervention.WORKER_idWORKER = person.id WHERE intervention.etat = 0 AND idCustomer = ?', [$id]);
        return $found;
    }
    
    public function find(int $id){
        $found = $this->manager->find('SELECT title, detail from intervention WHERE idIntervention = ?', [$id]);
        return $found;
    }

    public function acceptIntervention(int $id){
        $affectedRows = $this->manager->exec('UPDATE intervention SET etat = 1 WHERE idIntervention = ?', [$id]);
        if($affectedRows === 0){
            return null;
        }
    }
    public function refuseIntervention(int $id){
        $affectedRows = $this->manager->exec('UPDATE intervention SET etat = 2 WHERE idIntervention = ?', [$id]);
        if($affectedRows === 0){
            return null;
        }
    }

    public function getInterventionPay(){
        $found = $this->manager->find('SELECT intervention.*, service.jobs, service.price from intervention LEFT JOIN service ON intervention.idService = service.id  WHERE intervention.etat = 1');
        return $found;
    }


}