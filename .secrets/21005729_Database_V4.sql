-- Saul Maylin
-- Alba Cruises
-- V4
-- 17/11/2025
 
CREATE DATABASE IF NOT EXISTS 21005729_AlbaCruises;

USE 21005729_AlbaCruises;

DROP TABLE IF EXISTS AlbaFares;
DROP TABLE IF EXISTS AlbaTickets;
DROP TABLE IF EXISTS AlbaBookings;
DROP TABLE IF EXISTS AlbaCustomers;
DROP TABLE IF EXISTS AlbaStaff;
DROP TABLE IF EXISTS AlbaTimetable;
DROP TABLE IF EXISTS AlbaRoutes;
DROP TABLE IF EXISTS AlbaDestinations;

-- Create Statements 
CREATE TABLE AlbaCustomers (
	customerID INT(8) PRIMARY KEY AUTO_INCREMENT,
	firstName VARCHAR(150) NOT NULL,
    lastName VARCHAR (150) NOT NULL,
    email VARCHAR (300) NOT NULL,
    frequentCustomer BOOLEAN NOT NULL DEFAULT FALSE,
    password VARCHAR (255) NOT NULL,
    onMailingList BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE AlbaStaff (
	StaffID INT(4) PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(150) NOT NULL,
    lastName VARCHAR (150) NOT NULL,
    email VARCHAR (300) NOT NULL,
    password VARCHAR (255) NOT NULL,
    role ENUM("Staff", "Manager") NOT NULL DEFAULT "Staff"
);

CREATE TABLE AlbaDestinations(
	destinationID INT(3) PRIMARY KEY AUTO_INCREMENT,
    destinationName VARCHAR(150) NOT NULL,
    destinationDescription VARCHAR(200) NOT NULL
);

CREATE TABLE AlbaFares(
	fareID INT(3) PRIMARY KEY AUTO_INCREMENT,
    callingID INT (3) NOT NULL,
    destinationID INT (3) NOT NULL,
    category ENUM("Adult","Teen", "Child", "Infant") NOT NULL,
    fare DECIMAL(4,2) NOT NULL,
    FOREIGN KEY (destinationID) REFERENCES AlbaDestinations(destinationID),
    FOREIGN KEY (callingID) REFERENCES AlbaDestinations(destinationID)
);

CREATE TABLE AlbaRoutes(
	routeID INT (3),
    callingID INT (3),
    destinationID INT (3),
    routeDesc VARCHAR (50) NOT NULL,
    PRIMARY KEY (routeID, callingID, destinationID),
    FOREIGN KEY (destinationID) REFERENCES AlbaDestinations(destinationID),
    FOREIGN KEY (callingID) REFERENCES AlbaDestinations(destinationID)
);

CREATE TABLE AlbaTimetable(
    timetableID INT (3) PRIMARY KEY AUTO_INCREMENT,
    routeID INT(3) NOT NULL,
	timetableStart DATE NOT NULL,
	timetableEnd DATE NOT NULL,
    departureTime TIME NOT NULL,
    arivalTime TIME NOT NULL,
	seatOccupancy INT(3) NOT NULL,
    dayOfTravel SET("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday") NOT NULL,
	FOREIGN KEY (routeID) REFERENCES AlbaRoutes(routeID)
);

CREATE TABLE AlbaBookings(
	bookingID INT(10) PRIMARY KEY AUTO_INCREMENT,
    customerID INT(8) NOT NULL,
    FOREIGN KEY (customerID) REFERENCES AlbaCustomers(customerID)
);

CREATE TABLE AlbaTickets(
	ticketID INT(10) PRIMARY KEY AUTO_INCREMENT,
    bookingID INT(10) NOT NULL,
    routeID INT(3) NOT NULL,
    timetableID INT (3) NOT NULL,
    bookingDate DATE NOT NULL,
    occupants INT (3) NOT NULL,
	feeApplicable BOOLEAN NOT NULL DEFAULT false,
    FOREIGN KEY (bookingID) REFERENCES AlbaBookings(bookingID),
	FOREIGN KEY (routeID) REFERENCES AlbaRoutes(routeID),
    FOREIGN KEY (timetableID) REFERENCES AlbaTimetable(timetableID)
);

-- Insert Statements

-- Test Data 
INSERT INTO AlbaDestinations (destinationName, destinationDescription)
VALUES 
("Mallaig", "Mallaig is a port in Morar, on the west coast of the Highlands of Scotland. It faces Skye from across the Sound of Sleat."),
("Eigg", "The Isle of Eigg is one of the four Small Isles. Five miles long by three miles wide, Eigg lies 12 miles off Mallaig on Scotland’s west coast, just south of the Isle of Skye."),
("Rum", "The Isle of Rum is the real jewel of Scotland's Inner Hebrides, diamond in shape and diamond by nature."),
("Muck", "Muck is the smallest of four main islands in the Small Isles, part of the Inner Hebrides of Scotland.");
-- Mallaig = 1, Eigg = 2, Rum = 3, Muck = 4 

INSERT INTO AlbaFares (callingID, destinationID, category, fare)
VALUES 
-- Mallaig to anywhere but Mallaig
		-- Eigg
(1, 2, 'Adult', 18.00), -- Adult
(1, 2, 'Teen', 10.00), -- Teen
(1, 2, 'Child', 7.00), -- Child
(1, 2, 'Infant', 0.00), -- Infant

		-- Rum
(1, 3, 'Adult', 16.00), -- Adult
(1, 3, 'Teen', 10.00), -- Teen
(1, 3, 'Child', 7.00), -- Child
(1, 3, 'Infant', 0.00), -- Infant

		-- Nuck
(1, 4, 'Adult', 19.00), -- Adult
(1, 4, 'Teen', 10.00), -- Teen
(1, 4, 'Child', 7.00), -- Child
(1, 4, 'Infant', 0.00), -- Infant

-- Eigg to anywhere but Eigg
	-- Mallaig
(2, 1, 'Adult', 18.00), -- Adult
(2, 1, 'Teen', 10.00), -- Teen
(2, 1, 'Child', 7.00), -- Child
(2, 1, 'Infant', 0.00), -- Infant

	-- Rum
(2, 3, 'Adult', 16.00), -- Adult
(2, 3, 'Teen', 10.00), -- Teen
(2, 3, 'Child', 7.00), -- Child
(2, 3, 'Infant', 0.00), -- Infant

	-- Muck
(2, 4, 'Adult', 10.00), -- Adult
(2, 4, 'Teen', 10.00), -- Teen
(2, 4, 'Child', 7.00), -- Child
(2, 4, 'Infant', 0.00), -- Infant

-- Rum to anywhere but Rum
	-- Mallaig
(3, 1, 'Adult', 24.00), -- Adult
(3, 1, 'Teen', 10.00), -- Teen
(3, 1, 'Child', 7.00), -- Child
(3, 1, 'Infant', 0.00), -- Infant

	-- Eigg
(3, 2, 'Adult', 16.00), -- Adult
(3, 2, 'Teen', 10.00), -- Teen
(3, 2, 'Child', 7.00), -- Child
(3, 2, 'Infant', 0.00), -- Infant

	-- Muck
(3, 4, 'Adult', 10.00), -- Adult
(3, 4, 'Teen', 10.00), -- Teen
(3, 4, 'Child', 7.00), -- Child
(3, 4, 'Infant', 0.00), -- Infant

-- Muck to anywhere but Muck
	-- Mallaig
(4, 1, 'Adult', 19.00), -- Adult
(4, 1, 'Teen', 10.00), -- Teen
(4, 1, 'Child', 7.00), -- Child
(4, 1, 'Infant', 0.00), -- Infant

	-- Eigg
(4, 2, 'Adult', 10.00), -- Adult
(4, 2, 'Teen', 10.00), -- Teen
(4, 2, 'Child', 7.00), -- Child
(4, 2, 'Infant', 0.00), -- Infant

	-- Rum
(4, 3, 'Adult', 16.00), -- Adult
(4, 3, 'Teen', 10.00), -- Teen
(4, 3, 'Child', 7.00), -- Child
(4, 3, 'Infant', 0.00); -- Infant

-- Routes
INSERT INTO AlbaRoutes -- RouteID, callingID, destinationID, routeDesc
VALUES
-- Similar to the fares table, you can go anywhere from anywhere.
(1, 1, 2, "Mallaig - Eigg"),
(2, 1, 4, "Mallaig - Muck"),
(3, 1, 3, "Mallaig - Rum"),
(4, 3, 1, "Rum - Mallaig"),
(5, 2, 4, "Eigg - Muck"),
(6, 2, 3, "Eigg - Rum"),
(7, 2, 1, "Eigg - Mallaig"),
(8, 4, 2, "Muck - Eigg"),
(9, 3, 2, "Rum - Eigg");

-- Timetable days
INSERT INTO AlbaTimetable (routeID, timetableStart, timetableEnd, departureTime, arivalTime, seatOccupancy, dayOfTravel)
VALUES -- Mallaig = 1, Eigg = 2, Rum = 3, Muck = 4 
-- Monday, wednesday and friday are the same as each other. Sunday is the same, but different dates.
(1, "2024-05-13", "2024-10-18", "11:00:00", "12:00:00", 30, "Monday,Wednesday,Friday"),
(5, "2024-05-13", "2024-10-18", "12:30:00", "13:30:00", 30, "Monday,Wednesday,Friday"),
(8, "2024-05-13", "2024-10-18", "15:30:00", "16:00:00", 30, "Monday,Wednesday,Friday"),
(7, "2024-05-13", "2024-10-18", "16:30:00", "17:30:00", 30, "Monday,Wednesday,Friday"),

-- Sundays 
(1, "2024-06-01", "2024-08-31", "11:00:00", "12:00:00", 30, "Sunday"),
(5, "2024-06-01", "2024-08-31", "12:30:00", "13:30:00", 30, "Sunday"),
(8, "2024-06-01", "2024-08-31", "15:30:00", "16:00:00", 30, "Sunday"),
(7, "2024-06-01", "2024-08-31", "16:30:00", "17:30:00", 30, "Sunday"),

-- Tuesday and Saturday is the same, but saturday is different dates.
(1, "2024-05-13", "2024-10-18", "11:00:00", "12:00:00", 30, "Tuesday"),
(6, "2024-05-13", "2024-10-18", "12:30:00", "13:30:00", 30, "Tuesday"),
(9, "2024-05-13", "2024-10-18", "15:30:00", "16:00:00", 30, "Tuesday"),
(7, "2024-05-13", "2024-10-18", "16:30:00", "17:30:00", 30, "Tuesday"),

-- Saturdays
(1, "2024-06-01", "2024-08-31", "11:00:00", "12:00:00", 30, "Saturday"),
(6, "2024-06-01", "2024-08-31", "12:30:00", "13:30:00", 30, "Saturday"),
(9, "2024-06-01", "2024-08-31", "15:30:00", "16:00:00", 30, "Saturday"),
(7, "2024-06-01", "2024-08-31", "16:30:00", "17:30:00", 30, "Saturday"),

-- Thursdays has it's own special timetable.
(3, "2024-05-13","2024-10-18", "11:00:00", "12:45:00", 30, "Thursday"),
(4, "2024-05-13","2024-10-18", "15:45:00", "17:30:00", 30, "Thursday" );

-- Test Users
-- Test Customer User
INSERT INTO AlbaCustomers (firstName, lastName, email, password)
Values 
("Jerald", "Davidson", "jerald.davidson@hotmail.co.uk", "$2y$10$Q2lKqeJlPVgkIFTZzKubyuy5gmTcJ6C6auA4eMLl5G6h8fmDIVm4a"); 

-- Test Staff User
INSERT INTO AlbaStaff (firstName, lastName, email, password)
Values 
("Rochele", "Whitty", "rochele.whitty@albacruises.scot", "$2y$10$VOKClqOX.klHAtzEXegR9OD8IWXnmeHovI6Dharux2vouc99s9qMa");

SELECT * FROM AlbaTimetable;

SELECT * FROM AlbaBookings;
SELECT * FROM AlbaTickets;