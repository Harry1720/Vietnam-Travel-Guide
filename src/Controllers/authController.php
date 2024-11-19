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

    //check cho phiên đăng nhập là của blogger đúng hay không
    public function checkAuth()
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION['blogger_id'])) {
            echo "<script>alert('Bạn Chưa Đăng Nhập!');</script>";
            echo "<script>window.location.href =  '../../Views/blogger/home.php';</script>";
        }
    }

    // hàm check người dùng có đăng nhập chưa
    public function checkAdmin()
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION['blogger_id'])) {
            echo "<script>alert('Bạn Chưa Đăng Nhập!');</script>";
            echo "<script>window.location.href =  '../../Views/blogger/home.php';</script>";
        }
    
        // Kiểm tra vai trò của người dùng có phải là "admin" hay không
        if ($_SESSION['role'] !== 'Admin') {
            echo "<script>alert('Bạn Không Có Quyền Vào Trang Quản Lý!');</script>";
            echo "<script>window.location.href =  '../../Views/blogger/home.php';</script>";
        }
    }

    
    public function checkBlogger()
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION['blogger_id'])) {
            echo "<script>alert('Bạn Chưa Đăng Nhập!');</script>";
            echo "<script>window.location.href =  '../../Views/blogger/home.php';</script>";
            exit;
        }

        // Kiểm tra vai trò của người dùng có phải là "blogger" hay không
        if ($_SESSION['role'] !== 'blogger') {
            echo "<script>alert('Bạn Không Có Quyền Vào Trang Này Vui Lòng Đăng Nhập!');</script>";
            echo "<script>window.location.href =  '../../Views/blogger/home.php';</script>";
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

        
        //sql này mục đích là lấy userID - để check cho Session và các trang -> do userID autoincrement
        $sql1 = "SELECT * FROM users WHERE email = '$email'";
        $get_query = mysqli_query($this->conn->connect(), $sql1);        
        $user = mysqli_fetch_array($get_query);

        //add session: để kiểm tra login - mặc định User signup là blogger
        $_SESSION['role'] = 'Blogger';
        $_SESSION['blogger_id'] = $user['userID'];
        $_SESSION['loggedIn'] = TRUE;


        if($insert_query){
            header("location: ../../Views/blogger/home.php");
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
            echo "<script>alert('Email Không Hợp Lệ!');</script>";
            echo "<script>window.location.href =  '../../Views/login.html';</script>";
            return;
        }

        $sql = "SELECT * FROM users WHERE email = '$email' AND status = 1";
        $get_query = mysqli_query($this->conn->connect(), $sql);

        if (mysqli_num_rows($get_query) === 0) {
            echo "<script>alert('Email Chưa Đăng Ký!');</script>";
            echo "<script>window.location.href =  '../../Views/login.html';</script>";
            echo "Email Chưa Đăng Ký!";
            return;
        }

        $user = mysqli_fetch_array($get_query);

        $password = (string) $password;
        $passwordU = (string) $user['pass_word'];
        $emailU = (string) $user['email'];

        //trường hợp do admin cấp sắn mật khẩu kh hashed
        if ($password == $passwordU && $email == $emailU) {
            echo "ok";
            if ($user['role_'] == 'Admin') {
                $_SESSION['blogger_id'] = $user['userID'];
                $_SESSION['role'] = $user['role_'];
                $_SESSION['loggedIn'] = TRUE;
                header("location: ../../Views/admin/admin.php");
                exit;
            }
        }
      
       

        //if (md5($password) === $user['pass_word']) {
        //hash - PASSWORD_ARGON2  - dùng cho cả trường hợp mật khẩu admin hashed
        if(password_verify($password, $passwordU)) {
            $_SESSION['blogger_id'] = $user['userID'];
            $_SESSION['role'] = $user['role_'];
            
            //cái này là gán cho session -> để biết nên dùng cho header nào - nếu login hay sign up thì session này dùng để xác định    
            $_SESSION['loggedIn'] = TRUE;
            if(isset($_SESSION['role']) == 'Admin'){
                echo "<script>window.location.href =  '../../Views/admin/admin.php';</script>";
            }
            else {
                echo "<script>window.location.href =  '../../Views/blogger/home.php';</script>";
            }
            exit;
        } 
        else{
            echo "<script>alert('Đăng Nhập Thất Bại!');</script>";
            echo "<script>window.location.href =  '../../Views/login.html';</script>";
        }
      
        //header( "location: /Vietnam-Travel-Guide/src/Views/login.html");
    }

    public function logout() {
        
        if (isset($_GET['action']) && $_GET['action'] == 'logout') {

        // 1. Unset all session variables
        session_unset();
    
        // 2. Destroy the session
        session_destroy();
    
        // 3. Prevent caching 
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    
        // 4. Redirect to the login page
        header("Location: /Vietnam-Travel-Guide/src/Views/blogger/home.php");
        exit;
        }
    }
    
    public function changPasswordAdmin(){
        $currentPassword = $_POST['current-password'];
        $newPassword = $_POST['new-password'];
        $confirmPassword = $_POST['confirm-password'];
        $adminID = $_SESSION['blogger_id'];
        $getSQL = "SELECT * FROM users WHERE userID = '$adminID'";

        if ($newPassword !== $confirmPassword) {
            echo "<script>alert('Mật khẩu xác nhận không khớp!');</script>";
            echo "<script>window.location.href = '../../Views/admin/admin.php';</script>";
            return;
        }

        $adminInfo = mysqli_query($this->conn->connect(),$getSQL);
        $info = $adminInfo->fetch_assoc();
        $indexPassword = $info['pass_word'];

        if ($adminInfo) {
            $info = $adminInfo->fetch_assoc();
        }
        else{
            echo "<script>alert('Không Khớp Với Mật Khẩu Hiện Tại!');</script>";
            echo "<script>window.location.href = '../../Views/admin/admin.php';</script>";
            exit;
        }

        if($indexPassword !== $currentPassword){
            echo "<script>alert('Không Khớp Với Mật Khẩu Hiện Tại!');</script>";
            echo "<script>window.location.href =  '../../Views/admin/admin.php';</script>";
            return;
        }

        $sql = "UPDATE users SET pass_word = '$newPassword' WHERE userID = '$adminID'";
        $updatePassword = mysqli_query($this->conn->connect(),$sql);

        if($updatePassword){
            echo "<script>alert('Đổi Mật Khẩu Thành Công!');</script>";
            echo "<script>window.location.href =  '../../Views/admin/admin.php';</script>";
        }
        else{
            echo "<script>alert('Đổi Mật Khẩu Thất Bại!');</script>";
            echo "<script>window.location.href =  '../../Views/admin/admin.php';</script>";
        }
    }
}?>