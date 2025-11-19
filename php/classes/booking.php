<?php
// Saul Maylin 21005729
//  19/11/2025
// v1
// Booking class

class bookingDisplay
{
    private $departTicketID;
    private $returnTicketID;
    private $bookingID;
    private $departRouteID;
    private $returnRouteID;
    private $departTimetableID;
    private $returnTimetableID;
    private $departDate;
    private $returnDate;
    private $routeNames;
    private $departureDepartTime;
    private $returnDepartTime;

    public function __construct($bookingID)
    {
        $this->bookingID = $bookingID;

    }

    public function renderBooking()
    {
        // Render booking details here
        $departDate = date_create($this->departDate);
        if (!empty($this->returnDate)) {
            $returnDate = date_create($this->returnDate);
        }

        echo
            '<div class = "text-white main-background" id = "bookingDetails' . $this->bookingID . '" hidden>',
            '<h3> Your Trip </h3>',
            '<p> Date: ' . date_format($departDate, 'l - jS F Y') . '</p>';
        // Figure out if return trip exists.
        if (!isset($returnDate)) {
            echo
                '<p> Route: ' . $this->routeNames . '</p>',
                '<p> Return: No Return Trip </p>',
                '<p> Departure Time: ' . $this->departureDepartTime . '</p>';
        } else {
            // get both routes from substring.
            // format ("Mallaig - Eigg,Eigg - Mallaig")
            $delimPos = strpos($this->routeNames, ",");
            $departRoute = substr($this->routeNames, 0, $delimPos);
            $returnRoute = substr($this->routeNames, $delimPos + 1);

            // Echo it out.
            echo
                '<p> Route: ' . $departRoute . '</p>',
                '<p> Return: ' . $returnRoute . ' on ' . date_format($returnDate, 'l - jS F Y') . '</p>',
                '<p> Departure Time: ' . $this->departureDepartTime . '</p>',
                '<p> Return Departure Time: ' . $this->returnDepartTime . '</p>';
        }

        echo '</div>';
    }

    public function getDepartTicketID()
    {
        return $this->departTicketID;
    }
    public function getReturnTicketID()
    {
        return $this->returnTicketID;
    }
    public function getBookingID()
    {
        return $this->bookingID;
    }

    public function getDepartRouteID()
    {
        return $this->departRouteID;
    }

    public function getReturnRouteID()
    {
        return $this->returnRouteID;
    }

    public function getDepartTimetableID()
    {
        return $this->departTimetableID;
    }

    public function getReturnTimetableID()
    {
        return $this->returnTimetableID;
    }

    public function getDepartDate()
    {
        return $this->departDate;
    }
    public function getReturnDate()
    {
        return $this->returnDate;
    }
    public function getRouteNames()
    {
        return $this->routeNames;
    }
    public function getDepartureDepartTime()
    {
        return $this->departureDepartTime;
    }
    public function getReturnDepartTime()
    {
        return $this->returnDepartTime;
    }

    public function setDepartTicketID($departTicketID)
    {
        $this->departTicketID = $departTicketID;
    }

    public function setReturnTicketID($returnTicketID)
    {
        $this->returnTicketID = $returnTicketID;
    }

    public function setBookingID($bookingID)
    {
        $this->bookingID = $bookingID;
    }

    public function setDepartRouteID($departRouteID)
    {
        $this->departRouteID = $departRouteID;
    }

    public function setReturnRouteID($returnRouteID)
    {
        $this->returnRouteID = $returnRouteID;
    }

    public function setDepartTimetableID($departTimetableID)
    {
        $this->departTimetableID = $departTimetableID;
    }
    public function setReturnTimetableID($returnTimetableID)
    {
        $this->returnTimetableID = $returnTimetableID;
    }
    public function setDepartDate($departDate)
    {
        $this->departDate = $departDate;
    }

    public function setReturnDate($returnDate)
    {
        $this->returnDate = $returnDate;
    }

    public function setRouteNames($routeNames)
    {
        $this->routeNames = $routeNames;
    }
    public function setDepartureDepartTime($departureDepartTime)
    {
        $this->departureDepartTime = $departureDepartTime;
    }

    public function setReturnDepartTime($returnDepartTime)
    {
        $this->returnDepartTime = $returnDepartTime;
    }

}
?>