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

    private function uploadImage($fileTmpPath) {
        $uploader = new CloudinaryUploader();
        return $uploader->upload($fileTmpPath);
    }

    public function saveBlog($provinceID, $userID, $blogContent, $blogCreateDate){
        $sql = "INSERT INTO blog (provinceID, userID, blogContent, blogCreateDate) 
                VALUES ($provinceID, '$userID', '$blogContent', '$blogCreateDate')";
        
        $insert_query = mysqli_query($this->conn->connect(), $sql);
        
        if ($insert_query) {
            // Kiểm tra ID của bản ghi mới chèn vào
            $blogID = $this->conn->getInsertId();
            if ($blogID > 0) {
                return $blogID;
            } else {
                echo "Không thể lấy ID của blog mới!";
                return null;
            }
        } else {
            echo "Lỗi khi chèn blog: " . mysqli_error($this->conn->connect());
            return null;
        }
    }
    
    

    private function saveBlogImage($blogId, $imgBlogURL) {
        if ($blogId !== null) {
            $sql = "INSERT INTO imgblog (blogID, imgBlogURL) VALUES ($blogId, '$imgBlogURL')";
            $insert_query = mysqli_query($this->conn->connect(), $sql);
            
            if (!$insert_query) {
                // In thông báo lỗi nếu có
                echo "Lỗi khi lưu ảnh: " . mysqli_error($this->conn->connect());
            }
        } else {
            echo "Blog ID không hợp lệ!";
        }
    }
    

    //các hàm của blogger
    public function addblog(){
        $provinceID = $_POST['location'];
        $blogContent = $_POST['review'];
        $userID = $_SESSION['blogger_id'];
        $blogCreateDate = date('Y-m-d H:i:s');

        // Gọi hàm saveBlog để lưu bài viết
        $blogid = $this->saveBlog($provinceID, $userID, $blogContent, $blogCreateDate);

        if ($blogid !== null) {
            echo "Blog đã được tạo với ID: $blogid <br>";

            // Tiến hành upload ảnh
            foreach ($_FILES['photos']['tmp_name'] as $index => $tmpName) {
                if (!empty($tmpName)) {
                    $imageUrl = $this->uploadImage($tmpName);
                    echo "Ảnh đã upload: $imageUrl <br>";
                    $this->saveBlogImage($blogid, $imageUrl);
                } else {
                    echo "Ảnh không hợp lệ hoặc không có ảnh được chọn. <br>";
                }
            }
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

}
?>