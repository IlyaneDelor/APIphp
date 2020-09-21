<?php
require_once __DIR__ . '/../DataBaseManager.php';
require_once  __DIR__ . '/../models/Agency.php';
require_once  __DIR__ . '/CityManager.php';

class AgencyManager
{
    private DataBaseManager  $manager;
    private CityManager $cityManager;


    /**
     * ServiceManger constructor.
     * @param DataBaseManager $manager
     */
    public function __construct( $manager)
    {
        $this->manager = $manager;
        $this->cityManager = new CityManager($manager);
    }

    public function addNewAgency(string $address, int $postalCode, string $city){
        if($this->exists($address, $postalCode)){
            return null;
        }

        if($this->cityManager->exists($postalCode)){
            $cityInfo = $this->cityManager->findIdWithPostalCode($postalCode);
            $affectedRows = $this->manager->exec('INSERT INTO agency (address, CITY_idCity, state) VALUES (?,?,1)', [
                $address,
                $cityInfo->getId()
            ]);


        }
        else{
            $cityInfo = $this->cityManager->addNewCity($postalCode, $city);
            $affectedRows = $this->manager->exec('INSERT INTO agency (address, CITY_idCity, state) VALUES (?,?,1)', [
                $address,
                $cityInfo->getId()
            ]);


        }



        if ($affectedRows === 0){
            return null;
        }
        return new Agency($this->manager->getLastInsertId(), $address, $cityInfo->getId(), $cityInfo->getPostalCode(), $cityInfo->getCity());

    }

    public function exists(string $address, int $postalCode):bool{
        $found = $this->manager->find('SELECT idAgency FROM agency WHERE address = ? AND CITY_idCity = (SELECT idCity FROM city where cityCode = ? ) ', [$address,
            $postalCode]);
        return $found !== null;
    }

    public function getAllAgency(){
        $found = $this->manager->getAll('SELECT agency.idAgency, agency.address, city.cityCode, city.cityName, agency.state from agency  INNER JOIN city ON agency.CITY_idCity = city.idCity');
        return $found;
    }

    public function find(int $id){
        $found = $this->manager->find('SELECT agency.idAgency, agency.address, city.cityCode, city.cityName, agency.state from agency  INNER JOIN city ON agency.CITY_idCity = city.idCity WHERE agency.idAgency = ?', [$id]);
        return $found;
    }

    public function delAgency(int $id){
        $affectedRows = $this->manager->exec('UPDATE agency SET state = 0 WHERE idAgency = ?', [$id]);
        if($affectedRows === 0){
            return null;
        }
    }

    public function activeAgency(int $id){
        $affectedRows = $this->manager->exec('UPDATE agency SET state = 1 WHERE idAgency = ?', [$id]);
        if($affectedRows === 0){
            return null;
        }
    }

    public function updateAddress(int $id, string $address, int $postalCode){
        if($this->exists($address, $postalCode)){
            return null;
        }

        $affectedRows = $this->manager->exec('UPDATE agency SET address = ? WHERE idAgency = ?', [$address,$id]);
        if ($affectedRows === 0){
            return null;
        }
        else{
            return true;
        }


    }
}