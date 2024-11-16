<?php
include_once __DIR__ . "/../config/config.php";
class bothController{

    private Config $conn;

    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        $this->conn = new Config();
    }

    public function getPostbyProvinceID($provinceId) {
        $data = [];
    
        // tìm post theo province
        $sql = "SELECT * FROM post WHERE provinceID = $provinceId LIMIT 1"; // Giới hạn 1 bài viết
        $postResult = mysqli_query($this->conn->connect(),$sql);
        
        if (!$postResult || $postResult->num_rows === 0) {
            return null; 
        }
    
        $post = $postResult->fetch_assoc();
    
        // tìm postdetail bằng postID
        $sqlDetail = "SELECT * FROM postDetail WHERE postID = " . $post['postID'];
        $detailsResult = mysqli_query($this->conn->connect(),$sqlDetail);
        $details = [];
    
        // Lưu trữ thông tin chi tiết của post vào mảng
        while ($detail = $detailsResult->fetch_assoc()) {
            $details[] = $detail;
        }
    
        // tìm destination theo province
        $sqlDestination = "SELECT * FROM destination WHERE provinceID = " . $post['provinceID'];
        $destinationResult = mysqli_query($this->conn->connect(),$sqlDestination);
        $destinations = [];
    
        // Lưu trữ thông tin destination vào mảng
        while ($destination = $destinationResult->fetch_assoc()) {
            $destinations[] = $destination;
        }
    
        // Thêm post, details và destinations vào mảng data
        $data = [
            'post' => $post,
            'details' => $details,
            'destinations' => $destinations,
        ];
    
        return $data;
    }

    public function TotalProvincesByRegion($provinceRegion){
        if($provinceRegion){
            $sql = "SELECT COUNT(*) AS TotalProvincesByRegion
                FROM province
                WHERE status = TRUE AND provinceRegion = '$provinceRegion'";
        }
        else{
            $sql = "SELECT COUNT(*) AS TotalProvincesByRegion
                    FROM province
                    WHERE status = TRUE";
        }
        $CountUser = mysqli_query($this->conn->connect(),$sql);

        return $CountUser->fetch_assoc();
    }

    public function getAllProvinces() {
    
        $sql = "SELECT provinceID ,provinceName, provinceRegion FROM province";
        $get_query = mysqli_query($this->conn->connect(),$sql);
    
        return $get_query;
    }

    public function getProvinceOfPage($Start, $limit){
        $sql = "SELECT provinceID ,provinceName, provinceRegion FROM province  LIMIT $Start, $limit";
        $get_query = mysqli_query($this->conn->connect(),$sql);

        return $get_query;
    }

    public function getProvinceByRegionAndPage($filter, $Start, $limit){
        if($filter){
            $sql = "SELECT provinceID ,provinceName, provinceRegion FROM province 
                WHERE provinceRegion = '$filter'  LIMIT $Start, $limit";
        }
        else{
            $sql = "SELECT provinceID ,provinceName, provinceRegion FROM province 
                    LIMIT $Start, $limit";
        }
        $get_query = mysqli_query($this->conn->connect(),$sql);

        return $get_query;
    }

    public function getAllDestinationByProvinceID($provinceID) {
        
        $sql = "SELECT destinationName, destinationContent,destinationID ,imgDesURL FROM destination WHERE provinceID = $provinceID";
        $get_query = mysqli_query($this->conn->connect(),$sql);
    
        return $get_query;
    }


    //Lấy tất cả nội dung kéo lên cho trang Post.php
    public function getAllPostDetail($postID){
        $sql = " 
        SELECT pd.postDetailID, pd.postID, pd.sectionTitle, pd.sectionContent, pd.imgPostDetURL, p.status 
        FROM postDetail pd 
        JOIN post p ON p.postID = pd.postID 
        WHERE pd.postID = $postID AND p.status = 1;";
        $get_query = mysqli_query($this->conn->connect(),$sql);
        
        //return array JSON 
        return $get_query ? mysqli_fetch_all($get_query, MYSQLI_ASSOC) : [];
    }
    
    //Lấy thông tin Province để hiển thị bài bằng cho trang Province.php
    public function getPostProvince($postID){
        $sql = "SELECT p.provinceName, po.imgPostURL, po.postCreateDate
        FROM post po
        JOIN province p ON po.provinceID = p.provinceID
        WHERE po.postID = $postID AND po.status = 1 AND p.status = 1;";
        
        $get_query = mysqli_query($this->conn->connect(),$sql);

        //return array JSON 
        return $get_query->fetch_assoc();
    }

    //Tính tổng số post dùng cho phân trang Province.php
    public function getTotalPostsCount() {
        $sql = "SELECT COUNT(*) AS total FROM post WHERE status = 1 ";
        $result = mysqli_query($this->conn->connect(), $sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
    //Lấy số lượng dựa vào phân trang Province.php
    public function getPostsByPage($limit, $offset) {
        $sql = "SELECT po.postID, p.provinceName, po.imgPostURL, po.postCreateDate, p.provinceRegion
                FROM post po
                JOIN province p ON po.provinceID = p.provinceID
                WHERE po.status = 1
                LIMIT $limit OFFSET $offset";
        $get_query = mysqli_query($this->conn->connect(), $sql);
        $posts = [];
        while ($row = $get_query->fetch_assoc()) {
            $posts[] = $row;
        }
        return $posts;
        //status = 1: check xem ràng buộc còn trong db không 
    }

    //Lấy 1 content của Blog bằng BlogID -> hiển thị bài đăng 
    public function getBlogbyID($blogID){
        $sql = "SELECT bl.blogID, bl.provinceID, bl.userID, bl.blogTitle, bl.blogContent, bl.blogCreateDate 
        FROM blog bl 
        WHERE bl.blogID = $blogID AND bl.status = 1 AND bl.approvalStatus = 'Đã Duyệt';";
        $get_query = mysqli_query($this->conn->connect(),$sql);

        //return array JSON 
        return $get_query->fetch_assoc();
    }

    // Lấy mảng các hình của Blog bằng BlogID -> để hiển thị trong ViewBlog.php
    public function getPictureBlogbyID($blogID){
        $sql = "SELECT ib.imgBlogURL 
        FROM imgblog ib
        JOIN blog bl ON ib.blogID = bl.blogID
        WHERE bl.status = 1 AND bl.approvalStatus = 'Đã Duyệt' AND bl.blogID = $blogID";
        
        $get_query = mysqli_query($this->conn->connect(),$sql);

        $picBlog = [];
        while ($row = $get_query->fetch_assoc()) {
            $picBlog[] = $row;
        }
        return $picBlog;
    }

    //hàm lấy trang blog cho trang home.php và storieslist.php - tức hàm này sẽ lấy ảnh đầu tiên trong bảng img để hiển thị
    public function getBlogByPage($limit, $offset) {
        $sql = 
        "SELECT bl.blogID, ib.imgBlogURL, bl.blogTitle, bl.blogCreateDate 
        FROM blog bl 
        JOIN imgBlog ib ON bl.blogID = ib.blogID 
        WHERE bl.status = 1 AND bl.approvalStatus = 'Đã Duyệt' 
        AND ib.imgID = (SELECT MIN(imgID) 
                        FROM imgBlog 
                        WHERE blogID = bl.blogID) 
        LIMIT 4 OFFSET 0";
        $get_query = mysqli_query($this->conn->connect(), $sql);
        $posts = [];
        while ($row = $get_query->fetch_assoc()) {
            $posts[] = $row;
        }
        return $posts;
        // hàm group by, để group 1 nhóm có chung blogID, blogTitle, blogCreateDate
        // Hàm min(imgBlogURL) --> là lấy thằng imgID nhỏ nhất trong blogID đó
    }

    //2 hàm lấy blog kéo lên trang home.php
    public function getTotalBlogsCount() {
        $sql = "SELECT COUNT(*) AS total FROM blog WHERE status = 1 AND approvalStatus ='Đã duyệt' ";
        $result = mysqli_query($this->conn->connect(), $sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
    
    
    //Các hàm gọi comments,...
    //hàm để comment - giữa 2 bên 
    
    

    //hàm để Lấy các comment lên View.blog.php. 
    function getCommentsAndReplies($blogID) {

        //lấy các comment của blog đó - context: lấy blogId = 1
        $sql = "SELECT userComment.*, users.userName 
        FROM userComment 
        JOIN users ON userComment.userID = users.userID 
        WHERE userComment.blogID = $blogID 
            AND userComment.status = TRUE AND users.status = TRUE
        ORDER BY userComment.commentID ASC;";

        $result = mysqli_query($this->conn->connect(), $sql);
        $UserComment = [];


        // Fetch comments - vì 1 comment có thể có nhiều rep -> nên khởi tạo 1 mảng chứa reply  
        while ($row = $result->fetch_assoc()) {
            //store comment ID of current moment -> dùng dể fetch cho reply ở trong đó
            $commentID = $row['commentID'];
            //dòng này khi fetch từ usercomment -> nó sẽ khởi tạo 1 mảng rỗng
            // nó là 1 cái mảng để lưu reply của từng comment id 
            $row['replies'] = [];
            
            // SQL query to get replies for the current comment
            $replySQL = "SELECT repComment.*, users.userName 
            FROM repComment 
            JOIN users ON repComment.userID = users.userID 
            WHERE repComment.commentID = $commentID 
                AND repComment.status = TRUE  AND users.status = TRUE
            ORDER BY repComment.repCommentID ASC";

            $resultRep = mysqli_query($this->conn->connect(), $replySQL);
            
            while ($replyRow = $resultRep->fetch_assoc()) {
                $row['replies'][] = $replyRow;
            }
            
            $UserComment[] = $row;
        }
        return $UserComment;
    }
}


?>