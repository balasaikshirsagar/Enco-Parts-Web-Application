<?php
// controllers/UserController.php
class UserController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($this->userModel->registerUser($name, $email, $password)) {
               
                header('Location: ./views/login.php');
                exit(); 
            } else {
                $result = 'Registration failed. Please try again.';
                echo "<script>alert('$result')</script>";
                
            }

            include('../views/register.php');
        } else {
            include('../views/register.php');
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->loginUser($email, $password);

            if ($user) {
              
                session_start();
                $_SESSION['user'] = $user;
               
                header('Location: ./views/dashboard.php');
                exit();
            } else {
               
                $result = 'Invalid email or password. Please try again.';
                echo "<script>alert('$result')</script>";
               
            }
        } else {
            echo "Invalid Credentials";
        }
    }
}
