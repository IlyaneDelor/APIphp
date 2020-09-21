<?php


class Intervention
{
    private Int $idIntervention;
    private String $title;
    private Int $idService;
    private String $addressIntervention;
    private String $postalCode;
    private String $city;
    private String $dateIntervention;
    private String $hourIntervention;
    private float $duration;
    private String $detail;
    private int $WORKER_idWORKER;
    private int $idCustomer;

    /**
     * Intervention constructor.
     * @param Int $idIntervention
     * @param String $title
     * @param Int $idService
     * @param String $addressIntervention
     * @param String $postalCode
     * @param String $city
     * @param String $dateIntervention
     * @param String $hourIntervention
     * @param float $duration
     * @param String $detail
     * @param int $WORKER_idWORKER
     * @param int $idCustomer
     */
    public function __construct(Int $idIntervention, String $title, Int $idService, String $addressIntervention, String $postalCode, String $city, String $dateIntervention, String $hourIntervention, float $duration, String $detail, int $WORKER_idWORKER, int $idCustomer)
    {
        $this->idIntervention = $idIntervention;
        $this->title = $title;
        $this->idService = $idService;
        $this->addressIntervention = $addressIntervention;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->dateIntervention = $dateIntervention;
        $this->hourIntervention = $hourIntervention;
        $this->duration = $duration;
        $this->detail = $detail;
        $this->WORKER_idWORKER = $WORKER_idWORKER;
        $this->idCustomer = $idCustomer;
    }

    public function __toString()
    {
        return json_encode(get_object_vars($this));

    }


}