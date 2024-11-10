<?php

include_once "CloudinaryUploader.php";
include_once __DIR__ . "/../config/config.php";
class AdminController{
    
    private Config $conn;

    // hàm tạo
    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        $this->conn = new Config();
    }

    private function uploadImage($fileTmpPath) {
        $uploader = new CloudinaryUploader();
        return $uploader->upload($fileTmpPath);
    }

    private function savePost($provinceID, $postCreateDate, $imageUrl) {
        $sql = "INSERT INTO posts (provinceID, postCreateDate, imageUrl) 
                VALUES ('$provinceID', '$postCreateDate', '$imageUrl')";
        $insert_query = mysqli_query($this->conn->connect(),$sql);
        return $insert_query['userID'];
    }

    private function addPostDetail($postId, $sectionTitle, $sectionContent, $category, $imageDetailUrl) {
        $sql = "INSERT INTO postdetails (postID, sectionTitle, sectionContent, category, imgURL) 
                VALUES ($postId, '$sectionTitle', '$sectionContent', '$category', '$imageDetailUrl')";
        $insert_query = mysqli_query($this->conn->connect(),$sql);
    }

    // các hàm post của admin
    public function addPost() {
        // lấy form
        $provinceID = $_POST['provinceID'];
        $postCreateDate = date('Y-m-d H:i:s');
        $fileTmpPath = $_FILES['postIMG']['tmp_name'];

        // ảnh
        $imageUrl = $this->uploadImage($fileTmpPath);

        if ($imageUrl !== false) {
            
            $postId = $this->savePost($provinceID, $postCreateDate, $imageUrl);
            echo "Bài viết đã được thêm thành công!";

            // lưu postDetail
            if (isset($_POST['postDetails']) && is_array($_POST['postDetails'])) {
                foreach ($_POST['postDetails'] as $postDetail) {
                    $postSectionTitle = $postDetail['sectionTitle'];
                    $postSectionContent = $postDetail['sectionContent'];
                    $postCategory = $postDetail['category'];
                    $fileTmpPathDetail = $_FILES['postDetailIMG']['tmp_name'];

                    $imageDetailUrl = $this->uploadImage($fileTmpPathDetail);

                    $this->addPostDetail($postId, $postSectionTitle, $postSectionContent, $postCategory, $imageDetailUrl);
                }
            }
        } else {
            echo "Lỗi khi upload ảnh.";
        }
    }

    public function deletePost($postId) {
        // Xóa các chi tiết của bài viết trước
        $sqlDetailDelete = "DELETE FROM post_details WHERE postID = $postId";
        $delete_query = mysqli_query($this->conn->connect(),$sqlDetailDelete);
    
        // Xóa bài viết
        $sqlPostDelete = "DELETE FROM posts WHERE postID = $postId";
        $delete_post_query = mysqli_query($this->conn->connect(),$sqlPostDelete);
    
        if ($this->conn->getAffectedRows() > 0) {
            echo "Bài viết đã được xóa thành công!";
        } else {
            echo "Không tìm thấy bài viết để xóa!";
        }
    }

    //các hàm province của admin
    public function addProvince(){

        $provinceName = $_POST['provinceName'];
        $provinceRegion = $_POST['provinceRegion'];

        $sql =  "INSERT INTO provinces (provinceName, provinceRegion) 
                VALUES ('$provinceName', '$provinceRegion')";

        $insert_query = mysqli_query($this->conn->connect(),$sql);
    }

    public function updateProvince($provinceID) {
        $provinceName = $_POST['provinceName'];
        $provinceRegion = $_POST['provinceRegion'];
    
        $sql = "UPDATE provinces 
                SET provinceName = '$provinceName', provinceRegion = '$provinceRegion' 
                WHERE provinceID = $provinceID";
    
        $update_query = mysqli_query($this->conn->connect(),$sql);
        echo "Cập nhật tỉnh thành công!";
    }

    public function getAllUsers(){

        $sql = "SELECT * FROM users";
        $get_query = mysqli_query($this->conn->connect(),$sql);

        return $get_query;
    }

    public function getUserOfPage($Start, $litmit){
        //WHERE status_ = 'active'
        $sql = "SELECT * FROM users  LIMIT $Start, $litmit";
        $get_query = mysqli_query($this->conn->connect(),$sql);

        return $get_query;
    }

    public function getUserbyId($userID){
        //WHERE status_ = 'active'
        $sql = "SELECT * FROM users  WHERE userId = $userID";
        $get_query = mysqli_query($this->conn->connect(),$sql);

        return $get_query->fetch_assoc();
    }

    public function getAllBlogs() {
        
        $sql = "SELECT * FROM blogs";
        $get_query = mysqli_query($this->conn->connect(),$sql);

        return $get_query;
    }

    public function getAllPost() {

        $sql = "SELECT * FROM posts";
        $get_query = mysqli_query($this->conn->connect(),$sql);
    
        return $get_query;
    }

    public function getAdminById()
    {
        // Lấy ID của người dùng từ session
        // $admin = $_SESSION['blogger_id'];
        $admin = 50;

        // Truy vấn thông tin người dùng từ cơ sở dữ liệu
        $sql = "SELECT * FROM users WHERE userID = '$admin'";
        $user = mysqli_query($this->conn->connect(), $sql);

        if($user){
            // if($user['role_'] == 'Admin'){
            //     echo "Hợp Lệ";
            //     return $user;
            // }
            // else{
            //     echo "Bạn Không Có Quyền Truy Cập Trang Web Này";
            //     return null;
            // }
            return $user->fetch_assoc();
        }
        else{
            echo "Ngươi Dùng Không Tồn Tại";
            return null;
        }
    }


    public function updateAdmin(){
        // $admin = $_SESSION['blogger_id'];
        $admin = 50;
        $name = $_POST['name'];
        $email = $_POST['email1'];
        $address = $_POST['address'];

        echo  $admin;
        echo $name;
        echo $email;
        echo $address;

        if (!empty($admin) && !empty($name) && !empty($email)) {

            $sql = "UPDATE users
                    SET userName = '$name', email = '$email'
                    WHERE userid = '$admin'";

            $update_query = mysqli_query($this->conn->connect(),$sql);
            
            if($update_query){
                header("Location: ../../views/admin/admin.php");
                exit();
            }
            else {
                // Cập nhật thất bại
                echo "Cập nhật thông tin thất bại. Vui lòng thử lại.";
            }
        } else {
            echo "Vui lòng điền đầy đủ thông tin.";
        }
    }
}
?>