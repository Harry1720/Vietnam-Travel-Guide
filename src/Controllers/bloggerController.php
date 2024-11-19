<?php

include_once "CloudinaryUploader.php";
include_once __DIR__ . "/../config/config.php";

class bloggerController{
    private Config $conn;
    // hàm tạo
    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        $this->conn = new Config();
    }


    //hàm load ảnh - mặc định sẽ được lưu vào folder - blog trong cloud
    private function uploadImage($fileTmpPath,$folder) {
        $uploader = new CloudinaryUploader();
        return $uploader->upload($fileTmpPath,$folder);
    }
    
    public function saveBlog($provinceID, $userID, $blogTitle, $blogContent, $blogCreateDate){
        //mặc định để chờ duyệt cho admin
        $sql = "INSERT INTO blog (provinceID, userID, blogTitle ,blogContent, blogCreateDate, status, approvalStatus) 
                VALUES ($provinceID, $userID ,'$blogTitle', '$blogContent', '$blogCreateDate', TRUE, 'Chờ Duyệt')";

        $insert_query = mysqli_query($this->conn->connect(), $sql);
        
        if ($insert_query) {
            // Kiểm tra ID của bản ghi mới chèn vào - có cách sử lý - option: thêm 1 thuộc tính time - lấy thời gian thực để check (chưa thực hiện, mới dùng ppcheck bằng date)
            $sqlBlogID = "SELECT blogID FROM blog
            WHERE provinceID = $provinceID  AND userID = $userID
            AND blogTitle = '$blogTitle'
            AND blogCreateDate = '$blogCreateDate'";

            $blogID = mysqli_query($this->conn->connect(), $sqlBlogID);
            if ($blogID && $row = mysqli_fetch_assoc($blogID)) {
                return $row['blogID']; // Return only the blogID - để dùng cho insert vào imgBlog table
            } 
            else {
                echo "Không thể lấy ID của blog mới!";
                return null;
            }
        } else {
            echo "Lỗi khi chèn blog: " . mysqli_error($this->conn->connect());
            return null;
        }
    }

    private function uploadBlogImage($blogId, $imgBlogURL) {
        if ($blogId != null) {
            $sql = "INSERT INTO imgblog (blogID, imgBlogURL) 
                    VALUES ($blogId, '$imgBlogURL')";
            $insert_query = mysqli_query($this->conn->connect(), $sql);
            
            if (!$insert_query) {
                echo "Lỗi khi lưu ảnh: " . mysqli_error($this->conn->connect());
            }
        } else {
            echo "Lỗi lưu ảnh";
        }
    }

    //các hàm của blogger
    //hàm add từ trang blog.php - SESSION là phiên đăng nhập của người dùng đã login - form này nhận được bởi name attributes, sau khi click
    public function addblog(){

        $provinceID = $_POST['location'];
        $userID = $_SESSION['blogger_id'];
        $blogTitle = $_POST['title'];
        $blogContent = $_POST['review'];
        $blogCreateDate = $_POST['date'];//date('Y-m-d H:i:s');

        // Gọi hàm saveBlog để lưu bài viết - sau đó trả về ID blog - fetch_assoc
        $blogid = $this->saveBlog($provinceID, $userID, $blogTitle, $blogContent, $blogCreateDate);
        if ($blogid !== null) {
            //vòng lặp up ảnh - $file chưa tập ảnh kiểu post 
            foreach ($_FILES['photos']['tmp_name'] as $tmpName) {

                if (!empty($tmpName)) {
                    //đường dẫn này để upload lên cloud - vào folder blog
                    $imageUrl = $this->uploadImage($tmpName, 'blog');
                    
                    //dường dẫn này để upload lên database
                    $this->uploadBlogImage($blogid, $imageUrl);
                } else {
                    echo "Ảnh không hợp lệ hoặc không có ảnh được chọn. <br>";
                }
            }
            
            echo "<script>alert('Viết blog thành công!');</script>";
            echo "<script>window.location.href = '../../Views/blogger/WriteReview.php';</script>"; 
        }
        
    }
    

    public function deleteBlog($blogid){
        $userID = $_SESSION['blogger_id'];
        
        // Cập nhật lại câu lệnh SQL
        $sql = "DELETE FROM blog WHERE blogID = $blogid AND userID = $userID";
        
        $delete_query = mysqli_query($this->conn->connect(), $sql);
        
        if ($this->conn->getAffectedRows() > 0) {
            echo "Blog đã được xóa thành công!";
        } else {
            echo "Không tìm thấy blog để xóa!";
        }
    }
    

    public function updateBlog($blogId) {
        $provinceID = $_POST['provinceID'];
        $userID = $_SESSION['blogger_id'];
        $blogContent = $_POST['blogContent'];
    
        // Tạo câu lệnh SQL để cập nhật blog
        $sql = "UPDATE blogs
                SET provinceID = $provinceID, 
                    blogContent = '$blogContent', 
                WHERE blogID = $blogId and userID = $userID";

        $update_query = mysqli_query($this->conn->connect(),$sql);
    }

    public function addComment($blogID)
    {
        $cmtContent = $_POST['cmtContent'];
        $userID = $_SESSION['blogger_id'];
        $createDate = date('Y-m-d H:i:s');

        $sql = "INSERT INTO userComment (blogID, userID, cmtContent, createDate) 
                VALUES ($blogID, $userID, '$cmtContent', '$createDate')";

        $insert_query = mysqli_query($this->conn->connect(),$sql);
    }

    public function updateComment($commentID)
    {
        $cmtContent = $_POST['cmtContent'];
        $userID = $_SESSION['blogger_id'];
        $sql = "UPDATE userComment 
                SET cmtContent = '$cmtContent' 
                WHERE commentID = $commentID AND userID = $userID";

        $update_query = mysqli_query($this->conn->connect(),$sql);
    }

    public function deleteComment($commentID)
    {
        $userID = $_SESSION['blogger_id'];
        $sql = "DELETE FROM userComment 
                WHERE commentID = $commentID AND userID = $userID";

        $delete_query = mysqli_query($this->conn->connect(),$sql);

        if ($this->conn->getAffectedRows() > 0) {
            echo "Comment đã được xóa thành công!";
        } else {
            echo "Không tìm thấy Comment để xóa!";
        }
    }

    public function addRepComment($commentID)
    {
        $userID = $_SESSION['blogger_id'];
        $repContent = $_POST['repContent'];
        $createDateRep = date('Y-m-d H:i:s');

        $sql = "INSERT INTO repComment (userID,commentID, repContent, createDateRep) 
                VALUES ($userID, $commentID, '$repContent', '$createDateRep')";

        $insert_query = mysqli_query($this->conn->connect(),$sql);
    }

    public function updateRepComment($repCommentID)
    {
        $userID = $_SESSION['blogger_id'];
        $repContent = $_POST['repContent'];
        $createDateRep = date('Y-m-d H:i:s');

        $sql = "UPDATE repComment 
                SET repContent = '$repContent'
                WHERE repCommentID = $repCommentID AND userID = $userID";
        $update_query = mysqli_query($this->conn->connect(),$sql);
    }

    public function deleteRepComment($repCommentID)
    {
        $userID = $_SESSION['blogger_id'];
        $sql = "DELETE FROM repComment 
                WHERE repCommentID = $repCommentID AND userID = $userID";

        $delete_query = mysqli_query($this->conn->connect(),$sql);

        if ($this->conn->getAffectedRows() > 0) {
            echo "RepComment đã được xóa thành công!";
        } else {
            echo "Không tìm thấy RepComment để xóa!";
        }
    }

    public function getBloggerById($blogger){
        

        $sql = "SELECT * FROM users WHERE userID = '$blogger'";
        $user = mysqli_query($this->conn->connect(), $sql);

        if($user){
            return $user->fetch_assoc();
        }
        else{
            echo "Ngươi Dùng Không Tồn Tại";
            return null;
        }
    }
    public function updateBlogger($blogger){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $gender =  $_POST['gender'] ;

        if (!empty($blogger) && !empty($name) && !empty($email)) {

            $sql = "UPDATE users
            SET userName = '$name', email = '$email', gender = '$gender', address_ = '$address'
            WHERE userid = '$blogger' AND status = 1";

            $update_query = mysqli_query($this->conn->connect(),$sql);
            
            if($update_query){
                echo "<script>alert('Cập Nhật Thành Công!');</script>";
                header("Location: ../../views/blogger/profile.php");
                exit();
            }
            else {
                echo "<script>alert('Cập Nhật Thất Bại!');</script>";
                header("Location: ../../views/blogger/profile.php");
            }
        } else {
            echo "<script>alert('Vui Lòng Điền Đủ Thông Tin!');</script>";
            header("Location: ../../views/blogger/profile.php");
        }
    }

}
?>