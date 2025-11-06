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
    callingID INT (3) NOT NULL,
    destinationID INT (3) NOT NULL,
    category ENUM("Adult","Teen", "Child", "Infant") NOT NULL,
    fare DECIMAL(4,2) NOT NULL,
    FOREIGN KEY (destinationID) REFERENCES AlbaDestinations(destinationID),
    FOREIGN KEY (callingID) REFERENCES AlbaDestinations(destinationID)
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

-- Insert Statements

-- Test Data (Covering 1st-16th october)
INSERT INTO AlbaDestinations (destinationname, destinationDescription)
VALUES 
("Mallaig", "Dummy Data 1"),
("Eigg", "Dummy Data 2"),
("Rum", "Dummy Data 3"),
("Muck", "Dummy Data 4");

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