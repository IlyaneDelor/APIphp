<?php




class Service
{
    private $id;
    private string $jobs;
    private int $price;


    public function __construct(int $id, string $jobs, int $price)
    {
        $this->id = $id;
        $this->jobs = $jobs;
        $this->price = $price;
        $this->price = $price;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    /**
     * @return string
     */
    public function getJobs(): string
    {
        return $this->jobs;
    }

    /**
     * @param string $jobs
     */
    public function setName(string $jobs): void
    {
        $this->jobs = $jobs;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }




}