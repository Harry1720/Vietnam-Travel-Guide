<?php
include_once __DIR__ . "/../config/config.php";

class AuthController{
    private Config $conn;

    // hàm tạo
        public function __construct()
        {
            //bắt đầu phiên - session
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
    public function checkIssetEmail($email)
    {
        $sql = mysqli_query($this->conn->connect(), "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            return true;
        }
        return false;
    }
    
    public function checkVerificationEmail($email){
        // Ensure session is started
        if (!isset($_SESSION['attempts'])) {
            $_SESSION['attempts'] = 1;  // Initialize attempts if not already set
        }

        // Checking the email verification logic
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];  // Email from form

            // Check if email exists using the class method
            $isEmailExist = $this->checkIssetEmail($email);  

            // If the email exists in the database, reset attempts and proceed
            if ($isEmailExist) {
                $_SESSION['attempts'] = 1;  // Reset attempts if email is correct
                echo "Email found, proceeding to next step.";
                header("Location: /Vietnam-Travel-Guide/src/Views/Blogger/home.html");  // Redirect to home or another page
                exit();  // Stop script execution after redirect
            } else {
                // If email is not found, increment the attempt count
                $_SESSION['attempts']++;

                // Check if attempts have reached the limit (5 attempts)
                if ($_SESSION['attempts'] >= 5) {
                    header("Location: /Vietnam-Travel-Guide/src/Views/forgotPassword.html");  // Redirect to forgot password page
                    exit();  // Stop script execution after redirect
                } else {
                    echo "Invalid email. You have " . (5 - $_SESSION['attempts']) . " attempts left.";
                }
            }
        }
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
            echo "$email - Email này đã tồn tại!";
            return;
        }

        //$hashedPassword = md5($password);
        $hashedPassword = password_hash($password, PASSWORD_ARGON2I);

        $sql = "INSERT INTO users (userName, email, pass_word, role_) 
        VALUES ('$username','$email','$hashedPassword','Blogger')";
        $insert_query = mysqli_query($this->conn->connect(),$sql);

        //add session: để kiểm tra login - mặc định User signup là blogger
        $_SESSION['role_'] = 'Blogger';
        if($insert_query){
            header("location: /Vietnam-Travel-Guide/src/Views/blogger/home.php");
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
                header("location: /Vietnam-Travel-Guide/src/Views/admin/admin.php");
            }
            else{
                header( "location: /Vietnam-Travel-Guide/src/Views/blogger/home.php");
            }
            exit;
        } else {
            echo "Email hoặc mật khẩu không đúng!";
        }

    }

    public function logout() {
        // 1. Start the session if it hasn't already been started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // 2. Unset all session variables
       //session_unset();
    
        // 3. Destroy the session
        session_destroy();
    
        // 4. Prevent caching 
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    
        // 5. Redirect to the login page
        header("Location: login.php"); 
        exit;
    }
}?>