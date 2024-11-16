<?php

include_once "CloudinaryUploader.php";
include_once __DIR__ . "/../config/config.php";
class AdminController{
    
    private Config $conn;

    // hàm tạo
    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        $this->conn = new Config();
    }

    //hàm up ảnh
    private function uploadImage($fileTmpPath, $folder) {
        $uploader = new CloudinaryUploader();
        $result = $uploader->upload($fileTmpPath, $folder);
        
        if ($result) {
            echo "Upload ảnh thành công!\n";
        } else {
            echo "Lỗi khi upload ảnh!\n";
        }
        
        return $result;
    }

    // ALL ADD
    private function savePost($provinceID, $postCreateDate, $imageUrl) {
        $sql = "INSERT INTO post (provinceID, postCreateDate, imgPostURL) 
                VALUES ('$provinceID', '$postCreateDate', '$imageUrl')";
        $insert_query = mysqli_query($this->conn->connect(), $sql);

        if ($insert_query) {
            echo "Lưu bài viết thành công!\n";
            return $this->conn->getInsertId();
        } else {
            echo "Lỗi khi lưu bài viết!\n";
            return false;
        }
    }

    private function addPostDetail($postId, $sectionTitle, $sectionContent, $imageDetailUrl) {
        $sql = "INSERT INTO postdetail (postID, sectionTitle, sectionContent, imgPostDetURL) 
                VALUES ($postId, '$sectionTitle', '$sectionContent', '$imageDetailUrl')";
        $insert_query = mysqli_query($this->conn->connect(), $sql);

        if ($insert_query) {
            echo "Thêm chi tiết bài viết thành công!\n";
        } else {
            echo "Lỗi khi thêm chi tiết bài viết!\n";
        }
    }

    public function addPost($formPost, $formPostDetail) {
        $provinceID = $formPost['province'];
        $postCreateDate = $formPost['postCreateDate'];
        $fileTmpPath = $formPost['image_post'];

        $imageUrl = $this->uploadImage($fileTmpPath, 'post');

        if ($imageUrl !== false) {
            $postId = $this->savePost($provinceID, $postCreateDate, $imageUrl);

            if ($postId) {
                echo "Bài viết đã được thêm thành công!\n";
                foreach ($formPostDetail as $postDetail) {
                    $sectionTitle = $postDetail['sectionTitle'];
                    $sectionContent = $postDetail['sectionContent'];
                    $fileTmpPathDetail = $postDetail['image'];

                    $imageDetailUrl = $this->uploadImage($fileTmpPathDetail, 'postDetail');
                    $this->addPostDetail($postId, $sectionTitle, $sectionContent, $imageDetailUrl);
                }

                echo "<script>alert('Thêm Thành Công Post Nhưng Lỗi Thêm PostDetail!');</script>";
                echo "<script>window.location.href = '../../Views/admin/post_management.php';</script>";
            } else {
                echo "<script>alert('Thêm Post Thất Bại!');</script>";
                echo "<script>window.location.href = '../../Views/admin/post_management.php';</script>";
            }
        } else {
            echo "<script>alert('Ảnh Không Hợp Lệ!');</script>";
            echo "<script>window.location.href = '../../Views/admin/post_management.php';</script>";
        }
    }


    //All GET
    public function getPostbyID($postID) {
        $sql = "SELECT provinceID, postID, postCreateDate, imgPostURL 
                FROM post 
                WHERE postID = $postID AND status = 1";
        $get_query = mysqli_query($this->conn->connect(), $sql);
        $post = $get_query->fetch_assoc();

        if ($post) {
            return $post;
        }
    }

    public function getPostOfPage($Start, $limit) {
        $sql = "SELECT post.postID, post.postCreateDate, post.imgPostURL, province.provinceName, province.provinceID
                FROM post
                JOIN province ON post.provinceID = province.provinceID
                WHERE post.status = 1
                LIMIT $Start, $limit";
        $get_query = mysqli_query($this->conn->connect(), $sql);

        if ($get_query) {
            return $get_query;
        }
    }

    public function getAllPostDetailByPostID($postID) {
        $sql = "SELECT postDetailID, sectionTitle, sectionContent, imgPostDetURL 
                FROM postdetail 
                WHERE postID = $postID";
        $get_query = mysqli_query($this->conn->connect(), $sql);

        if ($get_query) {
            return $get_query;
        } 
    }
    
    public function getPostDetailByID($postDetailID) {
        $sql = "SELECT postDetailID, sectionTitle, sectionContent, imgPostDetURL 
                FROM postdetail  
                WHERE postDetailID = $postDetailID";
        $get_query = mysqli_query($this->conn->connect(), $sql);
        $postDetail = $get_query->fetch_assoc();

        if ($postDetail) {
            return $postDetail;
        }
    }
        

    //ALL UPDATE
    public function updatePost() {
        $postID = $_POST['postID'];
        $provinceID = $_POST['province'];

        if (isset($_FILES['image-post']) && $_FILES['image-post']['error'] == 0) {
            $fileTmpPath = $_FILES['image-post']['tmp_name'];
            $imgPostURL = $this->uploadImage($fileTmpPath, 'post');
            echo "Ảnh bài viết được cập nhật thành công!\n";
        } else {
            $imgPostURL = $_POST['imageposted'];
            echo "Sử dụng ảnh cũ của bài viết.\n";
        }

        $sql = "UPDATE post 
                SET provinceID = '$provinceID', imgPostURL = '$imgPostURL' 
                WHERE postID = $postID";
        $update_query = mysqli_query($this->conn->connect(), $sql);

        if($update_query){
            echo "<script>alert('Cập Nhật Thành Công!');</script>";
            echo "<script>window.location.href = '../../Views/admin/post_management.php';</script>";
        }
        else{
            echo "<script>alert('Cập Nhật Thất Bại!');</script>";
            echo "<script>window.location.href = '../../Views/admin/post_management.php';</script>";
        }
    }

    //cac Ham PostDetail
    public function updatePostDetal() {
        $postDetailID = $_POST['postDetailID'];
        $sectionTitle = $_POST['title'];
        $sectionContent = $_POST['content'];

        if (isset($_FILES['imagenew']) && $_FILES['imagenew']['error'] == 0) {
            $fileTmpPath = $_FILES['imagenew']['tmp_name'];
            $imgPostDetURL = $this->uploadImage($fileTmpPath, 'postDetail');
            echo "Ảnh chi tiết bài viết được cập nhật thành công!\n";
        } else {
            $imgPostDetURL = $_POST['imgposted'];
            echo "Sử dụng ảnh cũ của chi tiết bài viết.\n";
        }

        $sql = "UPDATE postdetail 
                SET sectionTitle = '$sectionTitle', sectionContent = '$sectionContent', imgPostDetURL = '$imgPostDetURL' 
                WHERE postDetailID = $postDetailID";
        $update_query = mysqli_query($this->conn->connect(), $sql);

        if($update_query){
            echo "<script>alert('Cập Nhật Thành Công!');</script>";
            echo "<script>window.location.href = '../../Views/admin/post_management.php';</script>";
        }
        else{
            echo "<script>alert('Cập Nhật Thất Bại!');</script>";
            echo "<script>window.location.href = '../../Views/admin/post_management.php';</script>";
        }
    }

    //các hàm User của
    public function addUser(){

        $userName = $_POST["userName"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $role = $_POST["role"];
        $gender = $_POST["gender"];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email không hợp lệ!";
            return;
        }

        if (strlen($userName) < 2) {
            echo "Tên người dùng phải có ít nhất 2 ký tự!";
            return;
        }

        if (strlen($password) < 8) {
            echo "Mật khẩu phải có ít nhất 8 ký tự!";
            return;
        }

        if($this->checkIssetEmail($email)){
            echo "Email đã tồn tại!";
            return;
        }
        
        $hashedPassword = password_hash($password, PASSWORD_ARGON2I);
        
        // Thêm người dùng mới
        $sql = "INSERT INTO users (userName, email, pass_word, role_, gender, address_) 
                VALUES ('$userName','$email','$hashedPassword','$role','$gender','$address')";
        $insert_query = mysqli_query($this->conn->connect(),$sql);
        
        if ($insert_query) {
            echo "<script>alert('Thêm Người Dùng Thành Công!');</script>";
            echo "<script>window.location.href = '../../Views/admin/user_management.php';</script>";
        } else {
            echo "<script>alert('Thêm Người Dùng Thất Bại!');</script>";
            echo "<script>window.location.href = '../../Views/admin/user_management.php';</script>";
        }
    }

    public function updateUser() {
        $userID = $_POST["userID"];
        $userName = $_POST["userName1"];
        $address = $_POST["address1"];
        $gender = $_POST["gender1"];

        if (strlen($userName) < 2) {
            echo "Tên người dùng phải có ít nhất 2 ký tự!";
            return;
        }

        // Cập nhật thông tin người dùng
        $sql = "UPDATE users SET userName = '$userName', address_ = '$address', gender = '$gender' WHERE userID = '$userID'";
        $update_query = mysqli_query($this->conn->connect(), $sql);
    
        if($update_query){
            echo "<script>alert('Cập Nhật Thành Công!');</script>";
            echo "<script>window.location.href = '../../Views/admin/user_management.php';</script>";
        }
        else{
            echo "<script>alert('Cập Nhật Thất Bại!');</script>";
            echo "<script>window.location.href = '../../Views/admin/user_management.php';</script>";
        }
    }

    public function deleteUser($userID) {
        $sql = "UPDATE users SET status = False WHERE userID = '$userID'";
        $update_query = mysqli_query($this->conn->connect(), $sql);
    
        if ($update_query) {
            echo "<script>alert('Update Người Dùng Thành Công!');</script>";
            echo "<script>window.location.href = '../../Views/admin/user_management.php';</script>";
        } else {
            echo "<script>alert('Update Người Dùng Thất Bại!');</script>";
            echo "<script>window.location.href = '../../Views/admin/user_management.php';</script>";
        }
    }
    
    public function getAllUsers(){

        $sql = "SELECT userID, userName, pass_word, address_,role_,email, gender FROM users WHERE status = 1";
        $get_query = mysqli_query($this->conn->connect(),$sql);

        return $get_query;
    }

    public function getUserOfPage($Start, $limit){
        //WHERE status_ = 'active'
        $sql = "SELECT userID, userName, pass_word, address_,role_,email,gender, province.provinceName, province.provinceID
                FROM users
                JOIN province ON users.address_ = province.provinceID
                WHERE users.status = 1
                LIMIT $Start,$limit";
        $get_query = mysqli_query($this->conn->connect(),$sql);

        return $get_query;
    }

    public function getUserbyId($userID){
        //WHERE status_ = 'active'
        $sql = "SELECT userID, userName, pass_word, address_,role_,email,gender FROM users  WHERE userId = $userID";
        $get_query = mysqli_query($this->conn->connect(),$sql);

        return $get_query->fetch_assoc();
    }

    public function getAdminById(){
        //Lấy ID của người dùng từ session
        if($_SESSION['blogger_id']){
            $admin = $_SESSION['blogger_id'];
        }
        else{
             $admin = 0;
        }
        // Truy vấn thông tin người dùng từ cơ sở dữ liệu
        $sql = "SELECT userID, userName, pass_word, address_,role_,email,gender FROM users WHERE userID = '$admin'";
        $user = mysqli_query($this->conn->connect(), $sql);

        if($user){
            if($user['role_'] == 'Admin'){
                echo "Hợp Lệ";
                return $user->fetch_assoc();
            }
            else{
                echo "Bạn Không Có Quyền Truy Cập Trang Web Này";
                return null;
            }
        }
        else{
            echo "Ngươi Dùng Không Tồn Tại";
            return null;
        }
    }

    public function updateAdmin(){
        // $admin = $_SESSION['blogger_id'];
        if($_SESSION['blogger_id']){
            $admin = $_SESSION['blogger_id'];
        }
        else{
             $admin = 0;
        }
        $name = $_POST['name'];
        $email = $_POST['email1'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];

        echo  $admin;
        echo $name;
        echo $email;
        echo $address;

        if (!empty($admin) && !empty($name) && !empty($email)) {

            $sql = "UPDATE users
                    SET userName = '$name', email = '$email', gender = '$gender', address_ = '$address'
                    WHERE userid = '$admin'";

            $update_query = mysqli_query($this->conn->connect(),$sql);
            
            if($update_query){
                echo "<script>alert('Cập Nhật Thành Công!');</script>";
                echo "<script>window.location.href = '../../Views/admin/admin.php';</script>";
            }
            else {
                echo "<script>alert('Cập Nhật Thất Bại!');</script>";
                echo "<script>window.location.href = '../../Views/admin/admin.php';</script>";
            }
        } else {
            echo "<script>alert('Vui Lòng Điền Đủ Thông Tin!');</script>";
            echo "<script>window.location.href = '../../Views/admin/admin.php';</script>";
        }
    }

    private function checkIssetEmail($email){
        $sql = mysqli_query($this->conn->connect(), "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            echo "$email - Email này đã tồn tại!";
            return true;
        }
        return false;
    }

    //các hàm province của admin
    public function addProvince(){

        $provinceName = $_POST['provinceName'];
        $provinceRegion = $_POST['provinceRegion'];

        $sql =  "INSERT INTO provinces (provinceName, provinceRegion) 
                VALUES ('$provinceName', '$provinceRegion')";

        $insert_query = mysqli_query($this->conn->connect(),$sql);
    }

    public function updateDestination() {

        if (isset($_FILES['image1']) && $_FILES['image1']['error'] == 0){
            $fileTmpPath = $_FILES['image1']['tmp_name'];
            $imgDesURL = $this->uploadImage($fileTmpPath,'postDetail');
            echo "Ảnh thêm thành công";
        }
        else{
            $imgDesURL = $_POST['imgdesURL'];
            echo "Ảnh cũ";
        }

        $destinationID = $_POST['destinationID'];
        $destinationName = $_POST['destinationName1'];
        $destinationContent = $_POST['description1'];
    
        $sql = "UPDATE destination
                SET destinationName = '$destinationName', destinationContent = '$destinationContent', imgDesURL = '$imgDesURL'
                WHERE destinationID = $destinationID";
    
        $update_query = mysqli_query($this->conn->connect(),$sql);
        
        if($update_query){
            echo "<script>alert('Cập Nhật Thành Công!');</script>";
            echo "<script>window.location.href = '../../Views/admin/province_management.php';</script>";
        }
        else{
            echo "<script>alert('Cập Nhật Thất Bại!');</script>";
            echo "<script>window.location.href = '../../Views/admin/province_management.php';</script>";
        }
    }

    public function addDestination() {
   
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $result = $this->uploadImage($fileTmpPath,'postDetail');

        if ($result) {
            echo "File uploaded successfully";
        } else {
            echo "File upload failed.";
        }

        $provinceID = $_POST['province'];
        $destinationName = $_POST['destinationName'];
        $description = $_POST['description'];
    
        $sql = "INSERT INTO destination (provinceID, destinationName,destinationContent,imgDesURL) 
                VALUES ('$provinceID', '$destinationName','$description','$result')";
    
        $update_query = mysqli_query($this->conn->connect(),$sql);

        if($update_query){
            echo "<script>alert('Thêm Thành Công Địa Danh!');</script>";
            echo "<script>window.location.href = '../../Views/admin/province_management.php';</script>";
        }
        else{
            echo "<script>alert('Thêm Địa Danh Không Thành Công!');</script>";
            echo "<script>window.location.href = '../../Views/admin/province_management.php';</script>";
        }
    }

    public function getDestination($destinationID){
        $sql = "SELECT destinationID,destinationName,destinationContent,imgDesURL
                FROM destination WHERE destinationID = $destinationID";
        $destination = mysqli_query($this->conn->connect(),$sql);

        return $destination->fetch_assoc();
    }

    public function TotalBlogsStatus($approvalStatus){
        $sql = "SELECT COUNT(*) AS TotalBlogs
                FROM blog
                WHERE approvalStatus = '$approvalStatus' AND status = 1";

        $CountUser = mysqli_query($this->conn->connect(),$sql);

        return $CountUser->fetch_assoc();
    }

    public function getBlogOfPage($Start, $limit,$filter){
        $sql = "SELECT blog.blogID, blog.blogContent, blog.blogCreateDate, blog.approvalStatus, users.userName, province.provinceName
                FROM blog
                JOIN users ON blog.userID = users.userID
                JOIN province ON blog.provinceID = province.provinceID
                WHERE blog.status = 1 AND approvalStatus = '$filter'
                LIMIT $Start, $limit";
        
        $get_query = mysqli_query($this->conn->connect(), $sql);
    
        return $get_query;
    }

    public function updateStatusBlog(){
        $blogID = $_POST['blogID'];
        $approvalStatus = $_POST['update'];

        $sql = "UPDATE blog 
                SET approvalStatus = '$approvalStatus'
                WHERE blogID = $blogID";
        $update_query = mysqli_query($this->conn->connect(),$sql);

        if($update_query){
            echo "<script>alert('Cập Nhật Thành Công!');</script>";
            echo "<script>window.location.href = '../../Views/admin/blog_management.php';</script>";
        }
        else{
            echo "<script>alert('Cập Nhật Thất Bại!');</script>";
            echo "<script>window.location.href = '../../Views/admin/blog_management.php';</script>";
        }
    }

    public function deleteDestination($destinationID) {
        $sql = "DELETE FROM destination WHERE destinationID = $destinationID";
    
        $delete_query = mysqli_query($this->conn->connect(),$sql);
        
        if ($this->conn->getAffectedRows() > 0) {
            echo "<script>alert('Xóa Điểm Đến Thành Công!');</script>";
            echo "<script>window.location.href = '../../Views/admin/province_management.php';</script>";
        } else {
            echo "<script>alert('Xóa Điểm Đến Thất Bại!');</script>";
            echo "<script>window.location.href = '../../Views/admin/province_management.php';</script>";
        }
    }

    //dashboard and total
    public function TotalPost() {
        $sql = "SELECT COUNT(*) AS TotalPost FROM post WHERE status = TRUE";
        $CountUser = mysqli_query($this->conn->connect(), $sql);
        $result = $CountUser->fetch_assoc();

        return $result;
    }

    public function getTotalBlogInYear($year){
        
        $sql = "SELECT YEAR(blogCreateDate) AS Year, MONTH(blogCreateDate) AS Month, COUNT(*) AS TotalBlog
        FROM blog
        WHERE status = TRUE
        AND YEAR(blogCreateDate) = '$year'
        GROUP BY YEAR(blogCreateDate), MONTH(blogCreateDate)
        ORDER BY Year, Month";

        $blogInYear = mysqli_query($this->conn->connect(),$sql);

        $dataInYear = [];
        if (mysqli_num_rows($blogInYear) > 0 ) {
            // Lặp qua kết quả và thêm vào mảng
            while($row = mysqli_fetch_array($blogInYear)) {
                $dataInYear[] = $row['TotalBlog']; 
            }
        }
        
        return $dataInYear;
    }

    public function getTotalBlogInPorvinceAndYear($year){
        $sql = "SELECT p.provinceName, COUNT(b.blogID) AS blogCount
                FROM blog b
                JOIN province p ON b.provinceID = p.provinceID
                WHERE YEAR(b.blogCreateDate) = '$year' AND b.status = TRUE
                GROUP BY p.provinceName
                ORDER BY blogCount DESC";

        $blogOfBlogInYear = mysqli_query($this->conn->connect(),$sql);

        $dataOfProvinceInYear = [];
        if (mysqli_num_rows($blogOfBlogInYear) > 0 ) {
            while($row = mysqli_fetch_array($blogOfBlogInYear)) {
                $dataOfProvinceInYear[] = [
                    'provinceName' => $row['provinceName'],
                    'blogCount' => $row['blogCount']
                ];
            }
        }

        return $dataOfProvinceInYear;
    }

    public function TotalUsers(){
        $sql = "SELECT COUNT(*) AS TotalUsers
                FROM users
                WHERE status = TRUE";

        $CountUser = mysqli_query($this->conn->connect(),$sql);

        return $CountUser->fetch_assoc();
    }

    public function TotalBlogs(){
        $sql = "SELECT COUNT(*) AS TotalBlogs
                FROM blog
                WHERE status = TRUE";

        $CountUser = mysqli_query($this->conn->connect(),$sql);

        return $CountUser->fetch_assoc();
    }

    public function TotalComment(){
        $sql = "SELECT (COUNT(c.commentID) + COUNT(r.repCommentID)) AS TotalComment
                FROM userComment c
                LEFT JOIN repComment r ON c.commentID = r.commentID;
                ";

        $CountUser = mysqli_query($this->conn->connect(),$sql);

        return $CountUser->fetch_assoc();
    }

    public function TotalDestination(){
        $sql = "SELECT COUNT(*) AS TotalDestination
                FROM destination";

        $CountUser = mysqli_query($this->conn->connect(),$sql);

        return $CountUser->fetch_assoc();
    }

    public function TopBlog($view){

        $sql = "SELECT u.userName,  b.blogTitle, p.provinceName, 
                COUNT(c.commentID) + COUNT(r.repCommentID) AS totalComments
                FROM users u
                JOIN blog b ON u.userID = b.userID
                JOIN province p ON b.provinceID = p.provinceID
                LEFT JOIN userComment c ON b.blogID = c.blogID
                LEFT JOIN repComment r ON c.commentID = r.commentID
                GROUP BY u.userID, u.userName, b.blogID, b.blogTitle, p.provinceName
                ORDER BY totalComments DESC
                LIMIT $view";
        
        $data = mysqli_query($this->conn->connect(),$sql);

        if($data){
            return $data;
        }
    }

    //delete
    public function deletePost($postId) {
        $sql = "UPDATE post SET status = False WHERE postID = $postId";
        $delete_query = mysqli_query($this->conn->connect(), $sql);

        if ($delete_query && mysqli_affected_rows($this->conn->connect()) > 0) {
            echo "<script>alert('Xóa Post Thành Công!');</script>";
            echo "<script>window.location.href = '../../Views/admin/province_management.php';</script>";
        } else {
            echo "<script>alert('Xóa Post Thất Bại!');</script>";
            echo "<script>window.location.href = '../../Views/admin/province_management.php';</script>";
        }
    }

    public function deletePostDetail($postDetailID) {
        $sql = "DELETE FROM postdetail WHERE postDetailID = $postDetailID";
        $delete_query = mysqli_query($this->conn->connect(), $sql);

        if ($delete_query && $this->conn->getAffectedRows() > 0) {
            echo "<script>alert('Xóa PostDetail Thành Công!');</script>";
            echo "<script>window.location.href = '../../Views/admin/province_management.php';</script>";
        } else {
            echo "<script>alert('Xóa PostDetail Thất Bại!');</script>";
            echo "<script>window.location.href = '../../Views/admin/province_management.php';</script>";
        }
    }
}
?>