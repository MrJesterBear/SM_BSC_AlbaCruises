<?php
// Sual Maylin 21005729
//  17/11/2025
// v1.1
// Ferry class

class Ferries
{
    private $timetableID;
    private $callingName;
    private $destinationName;
    private $departureDate;
    private $departureTime;
    private $arivalTime;
    private $occupancy;

    public function __construct($timetableID, $callingName, $destinationName, $departureDate, $departureTime, $arivalTime, $occupancy)
    {
        $this->timetableID = $timetableID;
        $this->callingName = $callingName;
        $this->destinationName = $destinationName;
        $this->departureDate = $departureDate;
        $this->departureTime = $departureTime;
        $this->arivalTime = $arivalTime;
        $this->occupancy = $occupancy;
    }

    public function getTimetableID()
    {
        return $this->timetableID;
    }

    public function getCallingName()
    {
        return $this->callingName;
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

    public function setTimetableID($timetableID)
    {
        $this->timetableID = $timetableID;
    }

    public function setCallingName($callingName)
    {
        $this->callingName = $callingName;
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