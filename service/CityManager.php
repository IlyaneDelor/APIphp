<?php
require_once __DIR__ . '/../DataBaseManager.php';
require_once  __DIR__ . '/../models/Agency.php';

class CityManager
{
    private DataBaseManager  $manager;

    /**
     * CityManager constructor.
     * @param DataBaseManager $manager
     */
    public function __construct(DataBaseManager $manager)
    {
        $this->manager = $manager;
    }


    public function addNewCity(int $postalCode, string $city){
        if($this->exists($postalCode)){
            return null;
        }

        $affectedRows = $this->manager->exec('INSERT INTO city (cityCode,cityName) VALUES (?,?)', [
            $postalCode,
            $city
        ]);

        if ($affectedRows === 0){
            return null;
        }
        return new City($this->manager->getLastInsertId(), $postalCode, $city);

    }

    public function exists(int $postalCode):bool{
        $found = $this->manager->find('SELECT idCity FROM city WHERE cityCode = ? ', [
            $postalCode]);
        return $found !== null;
    }

    public function findIdWithPostalCode(int $postalCode){
        $found = $this->manager->find("SELECT * FROM city WHERE cityCode = ?", [$postalCode]);
        return new City($found['idCity'], $found['cityCode'], $found['cityName']);
    }
}