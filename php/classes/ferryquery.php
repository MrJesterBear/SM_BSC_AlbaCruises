<?php
// Sual Maylin 21005729
//  17/11/2025
// v1.1
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

    public function getDestinationID($DB)
    {
        $destination = null;
        $id = null;

        $idQuery = $DB->prepare("SELECT destinationID FROM AlbaDestinations WHERE destinationName = ?;");
        $idQuery->bind_param("s", $destination);
        $idQuery->bind_result($id);
        $idQuery->execute();
        $idQuery->store_result();
        if ($idQuery->fetch()) {
            $callingID = $id;
            echo '<script>console.log("Calling is id:' . $callingID . '");</script>';
        }
        $idQuery->close();
    }

    // Check if the route exists.
    public function routeExists($DB)
    {
        $routeID = null;
        $stmt = $DB->prepare('SELECT routeID FROM AlbaRoutes WHERE callingID = ? AND destinationID = ?;');
        $stmt->bind_param('ii', $this->callingID, $this->destinationID);
        $stmt->bind_result($routeID);
        $stmt->execute();
        if ($stmt->fetch()) {
            $stmt->close();
            return $routeID;
        } else {
            $stmt->close();
            return false;
        }
    }

    // Get timetable for the route supplied.
    public function getTimetable($DB, $route)
    {
        // clear variables for binding the result.
        $timetableID = null;
        $departureTime = null;
        $arivalTime = null;
        $seatOccupancy = null;

        // Requires the day of the week to filter sailings.
        $date = date_create($this->departureDate);
        $dayOfWeek = date_format($date, 'l');

        // query to get sailings for the route.
        $query = "SELECT timetableID, departureTime, arivalTime, seatOccupancy
                FROM AlbaTimetable
                WHERE routeID = ?
                AND ? between timetableStart and timetableEnd
                AND FIND_IN_SET(?, dayOfTravel)";

        // prepare and execute the statement.
        $stmt = $DB->prepare($query);
        $stmt->bind_param("iss", $route, $this->departureDate, $dayOfWeek);
        $stmt->bind_result($timetableID, $departureTime, $arivalTime, $seatOccupancy);

        if ($stmt->execute()) {
            $stmt->store_result();

            // Get the name of both the calling and destination ports.
            $callingName = null;
            $destinationName = null;

            // Destination
            $nameQuery = $DB->prepare("SELECT destinationName FROM AlbaDestinations WHERE destinationID = ?;");
            $nameQuery->bind_param("i", $this->destinationID);
            $nameQuery->bind_result($destinationName);
            $nameQuery->execute();
            $nameQuery->store_result();
            if ($nameQuery->fetch()) {
                $destination = $destinationName;
            } else {
                return false;
            }
            $nameQuery->close();

            // Calling
            $nameQuery = $DB->prepare("SELECT destinationName FROM AlbaDestinations WHERE destinationID = ?;");
            $nameQuery->bind_param("i", $this->callingID);
            $nameQuery->bind_result($callingName);
            $nameQuery->execute();
            $nameQuery->store_result();
            if ($nameQuery->fetch()) {
                $calling = $callingName;
            } else {
                return false;
            }
            $nameQuery->close();

            $ferryList = array();
            while ($stmt->fetch()) {
                $ferryList[] = new Ferries($timetableID, $calling, $destination, $this->departureDate, $departureTime, $arivalTime, $seatOccupancy);
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