<?php
// Saul Maylin 21005729
//  18/11/2025
// v1
// Ticket class

class Tickets
{
    private $ticketID;
    private $bookingID;
    private $routeID;
    private $timetableID;
    private $bookingDate;
    private $routeNames;
    private $departTime;
    private $arrivalTime;

    public function __construct($ticketID, $bookingID, $routeID, $timetableID, $bookingDate, $routeNames, $departTime, $arrivalTime)
    {
        $this->ticketID = $ticketID;
        $this->bookingID = $bookingID;
        $this->routeID = $routeID;
        $this->timetableID = $timetableID;
        $this->bookingDate = $bookingDate;
        $this->routeNames = $routeNames;
        $this->departTime = $departTime;
        $this->arrivalTime = $arrivalTime;
    }

    public function getTicketID()
    {
        return $this->ticketID;
    }
    public function getBookingID()
    {
        return $this->bookingID;
    }
    public function getRouteID()
    {
        return $this->routeID;
    }

    public function getTimetableID()
    {
        return $this->timetableID;
    }

    public function getBookingDate()
    {
        return $this->bookingDate;
    }

    public function getRouteNames()
    {
        return $this->routeNames;
    }

    public function getDepartTime()
    {
        return $this->departTime;
    }

    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    public function setTicketID($ticketID)
    {
        $this->ticketID = $ticketID;
    }

    public function setBookingID($bookingID)
    {
        $this->bookingID = $bookingID;
    }

    public function setRouteID($routeID)
    {
        $this->routeID = $routeID;
    }

    public function setTimetableID($timetableID)
    {
        $this->timetableID = $timetableID;
    }
    public function setBookingDate($bookingDate)
    {
        $this->bookingDate = $bookingDate;
    }

    public function setRouteNames($routeNames)
    {
        $this->routeNames = $routeNames;
    }

    public function setDepartTime($departTime)
    {
        $this->departTime = $departTime;
    }

    public function setArrivalTime($arrivalTime)
    {
        $this->arrivalTime = $arrivalTime;
    }


}
?>