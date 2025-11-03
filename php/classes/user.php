<?php

// Saul Maylin
// User Functionality
//  v2
//  03/11/2025

class User
{
    private $email;
    private $firstName;
    private $lastName;
    private $password;
    private $passwordHash;

    private $UID;
    private $error;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function registerAccount($DB)
    {
        // Prepare
        $stmt = $DB->prepare("INSERT INTO AlbaCustomers (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $this->firstName, $this->lastName, $this->email, $this->passwordHash);

        // Execute
        if ($stmt->execute()) { // success

            // Prepare statement to get the UID of the newly created account.
            $stmt2 = $DB->prepare("SELECT UID FROM AlbaCustomers WHERE email = ?");
            $stmt2->bind_param("s", $this->email);

            // if the result is successful, get the ID.
            if ($stmt2->execute()) {
                $stmt2->store_result();
                $UID = null;

                $stmt2->bind_result($UID);
                $stmt2->fetch(); // Fetch the result

                $this->UID = $UID;
            } else { // Failed to retrieve UID, query failed.
                $this->error = 'UID';
                $stmt->close();
                $stmt2->close();
                return false;
            }

            // Continues on.
            $stmt->close();
            $stmt2->close();
            return true; // Registration successful
        } else {
            // Failed to register user, query failed.
            $this->error = 'REG';
            $stmt->close();
            return false; // Registration failed

        }
    }

    public function loginAccount($DB)
    {
        // Prepare statement to check if the user exists.
        $stmt = $DB->prepare("SELECT customerID, firstName, lastName, email, password FROM AlbaCustomers WHERE email = ?;");
        $stmt->bind_param("s", $this->email);

        // Execute

        if ($stmt->execute()) {
            $stmt->store_result();

            $UID = null;
            $firstName = null;
            $lastName = null;
            $email = null;
            $passwordHash = null;

            $stmt->bind_result($UID, $firstName, $lastName, $email, $passwordHash);
            if ($stmt->fetch()) { // User found
                $this->UID = $UID;
                $this->firstName = $firstName;
                $this->lastName = $lastName;
                $this->email = $email;
                $this->passwordHash = $passwordHash;

                // Verify password
                if ($this->verifyPassword($this->password, $passwordHash)) {
                    $stmt->close();
                    return true; // Login successful
                } else {
                    $this->error = 'PASS'; // Incorrect password
                    $stmt->close();
                    return false; // Login failed
                }
            } else {
                $this->error = 'NOT_FOUND'; // User not found
                $stmt->close();
                return false; // Login failed
            }

        }
    }

    public function checkDuplicate($DB)
    {
        // Check if the email already exists in the database.
        $stmt = $DB->prepare("SELECT * FROM AlbaCustomers WHERE email = ?");
        $stmt->bind_param("s", $this->email);

        // execute statement
        $stmt->execute();
        $stmt->store_result();
        $stmt->fetch();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            $this->error = 'DUP';
            return true; // Duplicate found
        } else {
            $stmt->close();
            return false; // No duplicate
        }
    }

    // Set password hash
    public function createHashPassword($password)
    {
        $this->passwordHash = $this->hash($password);
    }

    // hash given password using PHP's password hashing function.
    public function hash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // Verify the given password against the hashed version of the password.
    public function verifyPassword($password, $hash)
    {

        return password_verify($password, $hash);
    }

    // Getters / Setters
    public function getUID()
    {
        return $this->UID;
    }

    public function setUID($UID)
    {
        $this->UID = $UID;
    }

    public function getError()
    {
        return $this->error;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }


}

?>