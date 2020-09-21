<?php


class City
{
    private int $id;
    private int $postalCode;
    private string $city;

    /**
     * City constructor.
     * @param int $id
     * @param string $address
     * @param int $postalCode
     * @param string $city
     */
    public function __construct(int $id, int $postalCode, string $city)
    {
        $this->id = $id;
        $this->postalCode = $postalCode;
        $this->city = $city;
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
     * @return int
     */
    public function getPostalCode(): int
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }




}