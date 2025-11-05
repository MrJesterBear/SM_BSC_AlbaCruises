-- Saul Maylin
-- Alba Cruises
-- V1
-- 29/10/2025
 
-- CREATE DATABASE 21005729_AlbaCruises;

USE 21005729_AlbaCruises;

DROP TABLE IF EXISTS AlbaDestinationTimetable;
DROP TABLE IF EXISTS AlbaFares;
DROP TABLE IF EXISTS AlbaTickets;
DROP TABLE IF EXISTS AlbaDestinations;
DROP TABLE IF EXISTS AlbaBookings;
DROP TABLE IF EXISTS AlbaCustomers;
DROP TABLE IF EXISTS AlbaStaff;


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
    destinationID INT (3) NOT NULL,
    category ENUM("Adult","Teen", "Child", "Infant") NOT NULL,
    fare DECIMAL(4,2) NOT NULL,
    FOREIGN KEY (destinationID) REFERENCES AlbaDestinations(destinationID)
);

CREATE TABLE AlbaDestinationTimetable(
	destinationTimetableID INT (3) PRIMARY KEY AUTO_INCREMENT,
	destinationID INT(3) NOT NULL,
	departureDate DATE NOT NULL,
	departureTime TIME NOT NULL,
	seatOccupancy INT(3) NOT NULL,
	FOREIGN KEY (destinationID) REFERENCES AlbaDestinations(destinationID)
);

CREATE TABLE AlbaBookings(
	bookingID INT(10) PRIMARY KEY AUTO_INCREMENT,
    customerID INT(8) NOT NULL,
    FOREIGN KEY (customerID) REFERENCES AlbaCustomers(customerID)
);

CREATE TABLE AlbaTickets(
	ticketID INT(10) PRIMARY KEY AUTO_INCREMENT,
    bookingID INT(10) NOT NULL,
    destinationID INT(3) NOT NULL,
    bookingDate DATE NOT NULL,
    feeApplicable BOOLEAN NOT NULL,
    FOREIGN KEY (bookingID) REFERENCES AlbaBookings(bookingID),
    FOREIGN KEY (destinationID) REFERENCES AlbaDestinations(destinationID)
);

-- Test Data (Covering 1st-16th october)
INSERT INTO AlbaDestinations (destinationname, destinationDescription)
VALUES 
("Mallaig - Eigg", "Route departing from Mallaig and ariving at Eigg"), 
("Mallaig - Rum", "Route departing from Mallaig and ariving at Rum"),
("Eigg - Muck", "Route departing from Eigg and ariving at Muck"),
("Eigg - Rum","Route departing from Eiig and ariving at Rum"), 
("Muck - Eigg", "Route departing from Muck and ariving at Eigg"),
("Eigg - Mallaig", "Route departing from Eigg and ariving at Mallaig"),
("Rum - Mallaig","Route departing from Rum and ariving at Mallaig");

INSERT INTO AlbaFares (destinationID, category, fare)
VALUES 
-- Mallaig - Eigg 
(1, 'Adult', 18.00), -- Adult
(1, 'Teen', 10.00), -- Teen
(1, 'Child', 7.00), -- Child
(1, 'Infant', 0.00), -- Infant

-- Mallaig -> Rum
(), -- Adult
(), -- Teen
(), -- Child
(), -- Infant

-- Eigg -> Muck
(), -- Adult
(), -- Teen
(), -- Child
(), -- Infant

-- Eigg -> Rum
(), -- Adult
(), -- Teen
(), -- Child
(), -- Infant

-- Rum -> Eigg
(), -- Adult
(), -- Teen
(), -- Child
(), -- Infant

-- Muck -> Eigg
(), -- Adult
(), -- Teen
(), -- Child
(), -- Infant

-- Eigg -> Mallaig
(), -- Adult
(), -- Teen
(), -- Child
(), -- Infant

-- Rum -> Mallaig
(), -- Adult
(), -- Teen
(), -- Child
(); -- Infant 