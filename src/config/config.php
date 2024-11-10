<?php
class Config {
    private $conn; // Khai báo biến kết nối

    public function connect() {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vietnamtravel";

        // Tạo kết nối và lưu vào biến $conn
        $this->conn = mysqli_connect($hostname, $username, $password, $dbname) or die("Lỗi kết nối Database");
        return $this->conn;
    }

    public function getAffectedRows() {
        if ($this->conn) {
            return mysqli_affected_rows($this->conn); 
        }
        return 0; 
    }

    // Phương thức lấy ID của bản ghi vừa được thêm vào
    public function getInsertId() {
        if ($this->conn) {
            return mysqli_insert_id($this->conn);
        }
        return 0; 
    }

    // Phương thức đóng kết nối (tùy chọn)
    public function close() {
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }
}

