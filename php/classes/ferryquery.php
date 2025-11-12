<?php
// Sual Maylin 21005729
//  10/11/2025
// v1
// Query class page.

class FerryQuery
{
    private $callingID;
    private $destinationID;
    private $departureDate;
    private $departureTime;

    public function __construct($callingID, $destinationID, $departureDate)
    {
        $this->callingID = $callingID;
        $this->destinationID = $destinationID;
        $this->departureDate = $departureDate;
    }


    public function getPortOfCall($DB)
    {
        // clear variables for binding the result.
        $destinationName = null;
        $departureDate = null;
        $departureTime = null;
        $arivalTime = null;
        $seatOccupancy = null;

        // query to get sailings from calling port.
        $query = "SELECT AlbaDestinations.destinationName,
                        AlbaDestinationTimetable.departureDate, 
                        AlbaDestinationTimetable.departureTime, 
                        AlbaDestinationTimetable.arivalTime, 
                        AlbaDestinationTimetable.seatOccupancy
                FROM AlbaDestinationTimetable
                JOIN AlbaDestinations
                ON AlbaDestinationTimetable.destinationID = AlbaDestinations.destinationID
                WHERE AlbaDestinationTimetable.callingID = ?
                AND AlbaDestinationTimetable.departureDate >= ?
                LIMIT 8;"; // Get next 8 sailings from calling port.

        // prepare and execute the statement.
        $stmt = $DB->prepare($query);
        $stmt->bind_param("is", $this->callingID, $this->departureDate);
        $stmt->bind_result($destinationName, $departureDate, $departureTime, $arivalTime, $seatOccupancy);

        if ($stmt->execute()) {
            $stmt->store_result();

            $ferryList = array();
            while ($stmt->fetch()) {
                $ferryList[] = new Ferries(null, $destinationName, $departureDate, $departureTime, $arivalTime, $seatOccupancy);
            }
            $stmt->close();

            // Return the list of ferries.
            if (empty($ferryList)) {
                return false;
            } else {
                // allocate the departure time variable.
                $this->departureTime = $ferryList[0]->getDepartureTime();
                return $ferryList;
            }
        }
    }

    // Get sailings to destination port.
    public function getDestination($DB)
    {
        // clear variables for binding the result.
        $destinationName = null;
        $departureDate = null;
        $departureTime = null;
        $arivalTime = null;
        $seatOccupancy = null;

        // query to get sailings to destination port.
        $query = "SELECT AlbaDestinations.destinationName,
                        AlbaDestinationTimetable.departureDate, 
                        AlbaDestinationTimetable.departureTime, 
                        AlbaDestinationTimetable.arivalTime, 
                        AlbaDestinationTimetable.seatOccupancy
                FROM AlbaDestinationTimetable
                JOIN AlbaDestinations
                ON AlbaDestinationTimetable.destinationID = AlbaDestinations.destinationID
                WHERE AlbaDestinationTimetable.destinationID = ?
                AND AlbaDestinationTimetable.departureDate >= ?
                AND AlbaDestinationTimetable.arivalTime > ?
                LIMIT 8;"; // Get next 8 sailings to destination port.

        // prepare and execute the statement.
        $stmt = $DB->prepare($query);
        $stmt->bind_param("iss", $this->destinationID, $this->departureDate, $this->departureTime);
        $stmt->bind_result($destinationName, $departureDate, $departureTime, $arivalTime, $seatOccupancy);

        if ($stmt->execute()) {
            $stmt->store_result();

            $ferryList = array();
            while ($stmt->fetch()) {
                $ferryList[] = new Ferries(null, $destinationName, $departureDate, $departureTime, $arivalTime, $seatOccupancy);
            }
            $stmt->close();
            // Return the list of ferries.
            if (empty($ferryList)) {
                return false;
            } else {
                return $ferryList;
            }
        }
    }
}

?>