<?php
// Sual Maylin 21005729
//  10/11/2025
// v1
// Ferry class

class Ferries
{
    private $sailingID;
    private $destinationName;
    private $departureDate;
    private $departureTime;
    private $arivalTime;
    private $occupancy;

    public function __construct($sailingID, $destinationName, $departureDate, $departureTime, $arivalTime, $occupancy)
    {
        $this->sailingID = $sailingID;
        $this->destinationName = $destinationName;
        $this->departureDate = $departureDate;
        $this->departureTime = $departureTime;
        $this->arivalTime = $arivalTime;
        $this->occupancy = $occupancy;
    }

    public function getSailingID()
    {
        return $this->sailingID;
    }
    public function getDestinationName()
    {
        return $this->destinationName;
    }

    public function getDepartureDate()
    {
        return $this->departureDate;
    }

    public function getDepartureTime()
    {
        return $this->departureTime;
    }
    public function getArivalTime()
    {
        return $this->arivalTime;
    }
    public function getOccupancy()
    {
        return $this->occupancy;
    }

    public function setSailingID($sailingID)
    {
        $this->sailingID = $sailingID;
    }

    public function setDestinationName($destinationName)
    {
        $this->destinationName = $destinationName;
    }

    public function setDepartureDate($departureDate)
    {
        $this->departureDate = $departureDate;
    }

    public function setDepartureTime($departureTime)
    {
        $this->departureTime = $departureTime;
    }

    public function setArivalTime($arivalTime)
    {
        $this->arivalTime = $arivalTime;
    }

    public function setOccupancy($occupancy)
    {
        $this->occupancy = $occupancy;
    }
}

?>