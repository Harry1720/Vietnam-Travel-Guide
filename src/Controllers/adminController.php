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
    private function uploadImage($fileTmpPath,$folder) {
        $uploader = new CloudinaryUploader();
        return $uploader->upload($fileTmpPath,$folder);
    }

    private function savePost($provinceID, $postCreateDate, $imageUrl) {
        $sql = "INSERT INTO post (provinceID, postCreateDate, imgPostURL) 
                VALUES ('$provinceID', '$postCreateDate', '$imageUrl')";
        $insert_query = mysqli_query($this->conn->connect(),$sql);
        $postID = $this->conn->getInsertId();
        return $postID;
    }

    private function addPostDetail($postId, $sectionTitle, $sectionContent, $imageDetailUrl) {
        $sql = "INSERT INTO postdetail (postID, sectionTitle, sectionContent, imgPostDetURL	) 
                VALUES ($postId, '$sectionTitle', '$sectionContent', '$imageDetailUrl')";
        $insert_query = mysqli_query($this->conn->connect(),$sql);
    }

    // các hàm post của admin
    public function addPost($formPost, $formPostDetail) {

        $provinceID = $formPost['province'];
        $postCreateDate = $formPost['postCreateDate'];
        $fileTmpPath = $formPost['image_post'];

        $imageUrl = $this->uploadImage($fileTmpPath,'post');

        if ($imageUrl !== false) {
            $postId = $this->savePost($provinceID, $postCreateDate, $imageUrl);
            echo "Bài viết đã được thêm thành công!";

            foreach ($formPostDetail as $postDetail) {
                $sectionTitle = $postDetail['sectionTitle'];
                $sectionContent = $postDetail['sectionContent'];
                $fileTmpPathDetail = $postDetail['image'];
        
                $imageDetailUrl = $this->uploadImage($fileTmpPathDetail, 'postDetail');
        
                $this->addPostDetail($postId, $sectionTitle, $sectionContent, $imageDetailUrl);
            }
        } else {
            echo "Lỗi khi upload ảnh.";
        }
    }

    public function deletePost($postId) {
        $sqlDetailDelete = "UPDATE post SET status = False WHERE postID = $postId";
        $delete_query = mysqli_query($this->conn->connect(),$sqlDetailDelete);
    
        if ($delete_query) {
            echo "Bài viết đã được xóa thành công!";
        } else {
            echo "Không tìm thấy bài viết để xóa!";
        }
    }

    public function TotalPost(){
        $sql = "SELECT COUNT(*) AS TotalPost
                FROM post
                WHERE status = TRUE";

        $CountUser = mysqli_query($this->conn->connect(),$sql);

        return $CountUser->fetch_assoc();
    }

    public function getPostbyID($postID){
        $sql = "SELECT provinceID, postID, postCreateDate, imgPostURL FROM post  WHERE postID = $postID AND status = 1";
        $get_query = mysqli_query($this->conn->connect(),$sql);

        return $get_query->fetch_assoc();
    }

    public function getPostOfPage($Start, $limit){
        $sql = "SELECT post.postID, post.postCreateDate, post.imgPostURL, province.provinceName, province.provinceID
                FROM post
                JOIN province ON post.provinceID = province.provinceID
                WHERE post.status = 1";
        $get_query = mysqli_query($this->conn->connect(),$sql);

        return $get_query;
    }
    
    public function updatePost(){

        $postID = $_POST['postID'];
        $provinceID = $_POST['province'];

        if (isset($_FILES['image-post']) && $_FILES['image-post']['error'] == 0){
            $fileTmpPath = $_FILES['image-post']['tmp_name'];
            $imgPostURL = $this->uploadImage($fileTmpPath,'post');
            echo "Ảnh thêm thành công";
        }
        else{
            $imgPostURL = $_POST['imageposted'];
            echo "Ảnh cũ";
        }

        $sql = "UPDATE post
                SET provinceID = '$provinceID',imgPostURL = '$imgPostURL'
                WHERE postID = $postID";
        $get_query = mysqli_query($this->conn->connect(),$sql);
    }

    //cac Ham PostDetail
    public function getAllPostDetailByPostID($postID){
        $sql = "SELECT postDetailID, sectionTitle, sectionContent,imgPostDetURL FROM postDetail WHERE postID = $postID";
        $get_query = mysqli_query($this->conn->connect(),$sql);

        return $get_query;
    }

    public function getPostDetailByID($postDetailID){
        $sql = "SELECT postDetailID, sectionTitle, sectionContent,imgPostDetURL FROM postdetail  WHERE postDetailID = $postDetailID";
        $get_query = mysqli_query($this->conn->connect(),$sql);

        return $get_query->fetch_assoc();
    }

    public function updatePostDetal(){

        $postDetailID = $_POST['postDetailID'];
        $sectionTitle = $_POST['title'];
        $sectionContent = $_POST['content'];
        

        if (isset($_FILES['imagenew']) && $_FILES['imagenew']['error'] == 0){
            $fileTmpPath = $_FILES['imagenew']['tmp_name'];
            $imgPostDetURL = $this->uploadImage($fileTmpPath,'postDetaill');
            echo "Ảnh thêm thành công";
        }
        else{
            $imgPostDetURL = $_POST['imgposted'];
            echo "Ảnh cũ";
        }

        $sql = "UPDATE postdetail
                SET sectionTitle = '$sectionTitle',sectionContent = '$sectionContent', imgPostDetURL = '$imgPostDetURL'
                WHERE postDetailID = $postDetailID";
        $get_query = mysqli_query($this->conn->connect(),$sql);
    }

    public function deletePostDetail($postDetailID){
        $sql = "DELETE FROM postdetail WHERE postDetailID = $postDetailID";

        $delete_query = mysqli_query($this->conn->connect(),$sql);

        if ($this->conn->getAffectedRows() > 0) {
            echo "Xóa chi tiết bài viết thành công!";
        } else {
            echo "Xóa chi tiết bài viết thất bại!";
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
            echo "Người dùng đã được thêm thành công!";
            header("location: ../../Views/admin/user_management.php");
        } else {
            echo "Có lỗi xảy ra khi thêm người dùng!";
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
    
        if ($update_query) {
            echo "Người dùng đã được cập nhật thành công!";
        } else {
            echo "Có lỗi xảy ra khi cập nhật người dùng!";
        }
    }

    public function deleteUser($userID) {
        $sql = "UPDATE users SET status = False WHERE userID = '$userID'";
        $update_query = mysqli_query($this->conn->connect(), $sql);
    
        if ($update_query) {
            echo "Người dùng đã được xóa thành công!";
        } else {
            echo "Có lỗi xảy ra khi xóa người dùng!";
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
        // Lấy ID của người dùng từ session
        // if($_SESSION['blogger_id']){
        //     $admin = $_SESSION['blogger_id'];
        // }
        // else{
        //      $admin = 0;
        // }

        $admin = 2;
        // Truy vấn thông tin người dùng từ cơ sở dữ liệu
        $sql = "SELECT userID, userName, pass_word, address_,role_,email,gender FROM users WHERE userID = '$admin'";
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
        $admin = 2;
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
        echo "Cập nhật điểm đến thành công!";
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
        echo "Thêm địa danh thành công!";
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

        echo "Update Thành Công";
    }

    public function deleteDestination($destinationID) {
        $sql = "DELETE FROM destination WHERE destinationID = $destinationID";
    
        $delete_query = mysqli_query($this->conn->connect(),$sql);
        
        if ($this->conn->getAffectedRows() > 0) {
            echo "Xóa điểm đến thành công!";
        } else {
            echo "Xóa điểm đến thất bại!";
        }
    }

    //dashboard
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
}
?>