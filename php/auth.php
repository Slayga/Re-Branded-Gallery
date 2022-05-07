<?php
// Path: php\auth.php
// Compare this snippet from php\deprecrated.php:
// Make it class based
class Auth {
    /**
     * Database connection
     *
     * @var mysqli
     */
    protected $dbc;
    public $username;
    public $isLoggedIn = false;
    public $userId;
    
    public function __construct(mysqli $dbc) {
        $this->dbc = $dbc;
        // Variables from session (if set)
        $this->username = $_SESSION['username'] ?? null;
        $this->loggedIn = $_SESSION['loggedIn'] ?? false;
        $this->userId = $_SESSION['userId'] ?? null;
    }
    // Database object
    // Signup form
    public function signup($username, $password, $loginOnSignUp) {
        // Called when form is submitted in respective file.
        // Check if username is already taken

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user) {
            // Username is already taken
            return false;
        } else {
            // Username is available
            // Hash password, with password_hash() a better and more secure alternative than md5
            $password = password_hash($password, PASSWORD_DEFAULT);
            // Insert user into database
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $this->dbc->prepare($sql);
            $stmt->execute([$username, $password]);
            // Get user id
            $sql = "SELECT id FROM users WHERE username = ?";
            $stmt = $this->dbc->prepare($sql);
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            $this->userId = $user['id'];
            // Set session variables
            $_SESSION['username'] = $username;
            $_SESSION['loggedIn'] = true;
            $_SESSION['userId'] = $this->userId;
            // Login user
            if ($loginOnSignUp) {
                $this->login($username, $password);
            }
            return true;
        }
    }
    // Login form
    public function login($username, $password) {
        // Implement later
        return;
    }
    // Logout form
    public function logout() {
        // Implement later
        return;
    }
}
// Create object from Auth class
$dbc = new mysqli("rebranded", "localhost", "root", "");
$auth = new Auth($dbc);
?>