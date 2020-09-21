<?php

require_once 'City.php';


class Agency extends City
{
    private int $id;
    private string $address;



    /**
     * Agency constructor.
     * @param int $id
     * @param string $address
     * @param int $postalCode
     * @param string $city
     */
    public function __construct(int $id, string $address, int $idCity, int $postalCode, string $city)
    {
        parent::__construct($idCity, $postalCode, $city);
        $this->id = $id;
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }


    public function jsonSerialize() {
        return json_encode(get_object_vars($this));
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }





}