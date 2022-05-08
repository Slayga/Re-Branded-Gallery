<?php
/**
 * DbCon (Database Connection) instantiates a new connection to the database.
 */
class DbCon {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname;
    public $conn;

    public function __construct($dbname, $host = "localhost", $user = "root", $pass = "") {
        $this->dbname = $dbname;
        // Assigns callable method to $conn that connects to the database
        $this->conn = $this->connect();
    }

    private function connect() {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            return false; // Make sure function stops running
        }
        return $conn;
    }
}

/**
 * DbCtrl (Database Controller) is a class that handles all database queries, extends from DbCon (Database Connection)
 * 
 */
class DbCtrl extends DbCon {
    /**
     * Insets a new user into the database, 
     * if not already present
     *
     * @param string $username
     * @param string $password
     * @return array On error: ["error"] is true and ["message"] represents the error message,
     *               else: ["error"] is false and ["message"] declare the success message
     */
    public function insertUser($username, $password): array {
        $return;
        // error becomes false at end of the method: TL:DR; no error has occurred
        $return["error"] = true;
        $return["message"] = "Unknown error";
        

        // Check if user is in database
        $result = $this->getUsername($username);
        if ($result->num_rows > 0) {
            $return["message"] = "User already exists";
            return $return;
        }
        
        if ($this->validUserName($username, $not=true)) {
            $return["message"] = "Username is not valid";
            return $return;
        }

        if ($this->validPassword($password, $not=true)) {
            $return["message"] = "Password is not valid";
            return $return;
        }

        // Hash password for security
        $password = password_hash($password, PASSWORD_DEFAULT);

        // SQL statement that gets prepared and executed, error check stmt
        $stmt = $this->conn->prepare("INSERT INTO tblusers (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->close();

        $return["error"] = false;
        $return["message"] = "User created";
        return $return;
    }

    public function loginUser($username, $password): array {
        $return;
        $return["error"] = true;
        $return["message"] = "Unknown error";

        // Validate
        if ($this->validUserName($username, $not=true)) {
            $return["message"] = "Username is not valid";
            return $return;
        }

        if ($this->validPassword($password, $not=true)) {
            $return["message"] = "Password is not valid";
            return $return;
        }

        // Hash password for security
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Find exact username and password, check that only 1 is found
        $stmt = $this->db->prepare("SELECT * FROM tblusers WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 1) {
            $return["error"] = false;
            $return["message"] = "User logged in";
            $return["result"] = $result;
            return $return;

        } else {
            $return["message"] = "Username or password is incorrect";
            return $return;
        }

    }
    /**
     * Checks if the user exists in the database, 
     * and returns the user's information if it does
     *
     * @param string $username
     * @return mysqli_result
     */
    public function getUsername($username): mysqli_result {
        $sql = "SELECT * FROM tblusers WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    
    }

    /**
     * Checks if the username is valid
     * 
     * @param string $username
     * @param bool $not (inverts the result)
     * @return bool true if valid, false if not
     **/
    public function validUserName($username, $not=false): bool {
        if ($not) {
            return !preg_match("/^[a-zA-Z0-9 .!_-]{3,20}+$/", $username);
        } else {
            return preg_match("/^[a-zA-Z0-9 .!_-]{3,20}+$/", $username);
        }
    }

    /**
     * Checks if the password is valid
     * 
     * @param string $password
     * @param bool $not (inverts the result)
     * @return bool true if valid, false if not
     **/
    public function validPassword($password, $not=false): bool {
        if ($not) {
            return !preg_match("/^[a-zA-Z0-9 .!_-]{7,255}+$/", $password);
        } else {
            return preg_match("/^[a-zA-Z0-9 .!_-]{7,255}+$/", $password);
        }
    }
}

/**
 * 
 */
class LoginUser {
    public function __construct($username, $password, $db) {
        return $this->login($username, $password, $db);
    }

    private function login($username, $password, $db) {
        $result = $db->loginUser($username, $password);
        if ($result["error"]) {
            return $result["message"];
        } else {
            return $result["result"];
        }
    }
}

// https://www.youtube.com/watch?v=BaEm2Qv14oU

// // Testing //
// $dbCtrl = new DbCtrl("test");
// $outcome = $dbCtrl->insertUser("test5", "test123");
// echo $outcome["message"]."<br>";
// $outcome = $dbCtrl->insertUser("test5", "test123");
// echo $outcome["message"];

// $result = $dbCtrl->getUsername("test5");
// // print_r($result->fetch_all());
// echo "<br>";
// foreach($result as $row)
// {
//     print_r($row);
//     echo "<br>";