<?php
include_once 'config/dbconfig.php';
include_once 'models/Customer.php';

class CustomerController {
    private $customerModel;

    public function __construct($db) {
        $this->customerModel = new Customer($db);
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $firstname = $_POST['firstname'];
            $companyname = $_POST['companyname'];
            $password = $_POST['password'];
            $reemail = $_POST['reemail'];
            $lastname = $_POST['lastname'];
            $phone = $_POST['phone'];
            $cpass = $_POST['cpass'];

            if ($email != $reemail) {
                echo "<script>alert('Email addresses do not match.');</script>";
                return;
            }

            if ($password != $cpass) {
                echo "<script>alert('Passwords do not match.');</script>";
                return;
            }

            // Set properties in Customer model
            $this->customerModel->email = $email;
            $this->customerModel->firstname = $firstname;
            $this->customerModel->companyname = $companyname;
            $this->customerModel->password = $password;
            $this->customerModel->reemail = $reemail;
            $this->customerModel->lastname = $lastname;
            $this->customerModel->phone = $phone;
            $this->customerModel->cpass = $cpass;

            // Attempt to create customer
            if ($this->customerModel->create()) {
                echo "<script>alert('Registration Successful');</script>";
                header("Location: ./views/indexNew.php");
                exit();
            } else {
                echo "<script>alert('Failed to register customer.');</script>";
                return;
            }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->customerModel->login($email, $password);

            if ($user) {
                // Start session and store user data
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['firstname'] = $user['firstname'];

                // Redirect to checkout page or wherever needed
                header("Location: ./views/indexNew.php");
                exit();
            } else {
                // Handle login failure
                echo "<script>alert('Invalid email or password. Please try again.');</script>";
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>
