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

    public function getProvincesByRegion($provinceRegion) {

        $sql = "SELECT * FROM provinces WHERE provinceRegion = '$provinceRegion'";
        $get_query = mysqli_query($this->conn->connect(),$sql);
    
        return $get_query;
    }

    public function getAllProvinces() {
    
        $sql = "SELECT * FROM province";
        $get_query = mysqli_query($this->conn->connect(),$sql);
    
        return $get_query;
    }

    public function getAllDestinationByProvinceID($provinceID) {
        
        $sql = "SELECT * FROM destination WHERE provinceID = $provinceID";
        $get_query = mysqli_query($this->conn->connect(),$sql);
    
        return $get_query;
    }
}
?>