<?php
include_once __DIR__ . "/../config/config.php";

class AuthController{
    private Config $conn;

    // hàm tạo
    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        $this->conn = new Config();
    }

    public function checkAuth()
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION['blogger_id'])) {
            header("location: login.php");
            exit;
        }
    }

    // hàm check người dùng có đăng nhập chưa
    public function checkAdmin()
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION['blogger_id'])) {
            header("location: login.php");
            exit;
        }
    
        // Kiểm tra vai trò của người dùng có phải là "admin" hay không
        if ($_SESSION['role'] !== 'admin') {
            echo "Bạn không có quyền truy cập vào trang này!";
            header("location: forbidden.php");
            exit;
        }
    }

    
    public function checkBlogger()
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION['blogger_id'])) {
            header("location: login.php");
            exit;
        }

        // Kiểm tra vai trò của người dùng có phải là "blogger" hay không
        if ($_SESSION['role'] !== 'blogger') {
            echo "Bạn không có quyền truy cập vào trang này!";
            header("location: forbidden.php"); // hoặc trang báo lỗi
            exit;
        }
    }


    // check Email tồn tại chưa
    private function checkIssetEmail($email)
    {
        $sql = mysqli_query($this->conn->connect(), "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            echo "$email - Email này đã tồn tại!";
            return true;
        }
        return false;
    }

    public function signUp()
    {
        
        $username = $_POST['username'] ?? null;
        $password = trim($_POST['password']) ?? null;
        $email = $_POST['email'] ?? null;
        $confirm = $_POST['confirm-password'] ?? null;

        if (!$username || !$password || !$email || !$confirm) {
            echo "Vui lòng điền đầy đủ thông tin!";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email không hợp lệ!";
            return;
        }

        if (strlen($username) < 2) {
            echo "Tên người dùng phải có ít nhất 2 ký tự!";
            return;
        }

        if (strlen($password) < 8) {
            echo "Mật khẩu phải có ít nhất 8 ký tự!";
            return;
        }

        if ($confirm != $password){
            echo "Xác Nhận Mật Khẩu Sai";
            return;
        }

        if($this->checkIssetEmail($email)){
            echo "Email đã tồn tại!";
            return;
        }

        //$hashedPassword = md5($password);
        $hashedPassword = password_hash($password, PASSWORD_ARGON2I);

        $sql = "INSERT INTO users (userName, email, pass_word, role_) 
        VALUES ('$username','$email','$hashedPassword','Blogger')";
        $insert_query = mysqli_query($this->conn->connect(),$sql);

        if($insert_query){
            header("location: /Vietnam-Travel-Guide/src/Views/home.html");
        }
    }

    public function login()
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;


        if (!$email || !$password) {
            echo "Vui lòng điền đầy đủ thông tin!";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email không hợp lệ!";
            return;
        }

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $get_query = mysqli_query($this->conn->connect(), $sql);

        if (mysqli_num_rows($get_query) === 0) {
            echo "Email Chưa Đăng Ký!";
            return;
        }

        $user = mysqli_fetch_array($get_query);
        
        //if (md5($password) === $user['pass_word']) {
        //hash - PASSWORD_ARGON2 
        if(password_verify($password, $user['pass_word'])) {
            $_SESSION['blogger_id'] = $user['userID'];
            $_SESSION['role'] = $user['role_'];
            
            if($user['role_'] == "Admin"){
                header("location: /Vietnam-Travel-Guide/src/Views/admin.html");
            }
            else{
                header("location: /Vietnam-Travel-Guide/src/Views/home.html");
            }
            exit;
        } else {
            echo "Email hoặc mật khẩu không đúng!";
        }

    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // xóa tất cả mọi thứ trong phiên đăng nhập
        session_unset();

        // hủy session
        session_destroy();

        header("location: login.php");
        exit;
    }
}