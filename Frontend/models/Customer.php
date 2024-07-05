<?php
class Customer {
    private $conn;
    private $table_name = "customers";

    public $email;
    public $firstname;
    public $lastname;
    public $companyname;
    public $phone;
    public $password;
    public $reemail;
    public $cpass;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (email, firstname,  companyname, password, reemail, lastname, phone, cpass) VALUES (:email, :firstname, :companyname,  :password, :reemail, :lastname, :phone, :cpass)";
        
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->companyname = htmlspecialchars(strip_tags($this->companyname));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->reemail = htmlspecialchars(strip_tags($this->reemail));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->cpass = htmlspecialchars(strip_tags($this->cpass));

        // Bind data
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':companyname', $this->companyname);
        $stmt->bindParam(':password', password_hash($this->password, PASSWORD_DEFAULT));
        $stmt->bindParam(':reemail', $this->reemail);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':cpass', $this->cpass);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Store user data in session
            session_start();
            $_SESSION['customer'] = $user;
            return $user;
        } else {
            return false;
        }
    }
}
?>
