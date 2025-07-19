# Vietnam Travel Guide

Một website cẩm nang du lịch Việt Nam toàn diện, cho phép người dùng khám phá các địa điểm du lịch và chia sẻ trải nghiệm qua blog.

## Mô tả dự án

Website được thiết kế với mục tiêu trở thành người bạn đồng hành đáng tin cậy của du khách, giúp họ dễ dàng tìm kiếm, khám phá và tận hưởng những trải nghiệm tuyệt vời trên mọi miền đất nước Việt Nam.

### Lý do chọn đề tài

Việt Nam sở hữu tiềm năng du lịch phong phú với cảnh quan đa dạng, di sản văn hóa quý giá và ẩm thực đặc sắc. Tuy nhiên, du khách thường gặp khó khăn trong việc:
- Tìm kiếm thông tin đáng tin cậy về các tỉnh thành
- Xây dựng kế hoạch du lịch phù hợp
- Khám phá các điểm đến ít được biết đến
- Chia sẻ và học hỏi kinh nghiệm từ cộng đồng
Vì thế cần có một nền tảng để giúp cho trải nghiệm của du khách thêm thuận lợi, cũng như khắc phục các vấn đề nêu trên.

## Các thành viên thực hiện
- Nguyễn Lê Hiếu Nhi
- Phạm Thanh Trúc
- Trần Đăng Nam
- Nguyễn Hoàng Việt
- Huỳnh Nguyễn Quốc Bảo

## Các tính năng chính

### Cho Guest (Khách)
- **Xem nội dung**: Khám phá các tỉnh thành, điểm đến và blog nổi bật
- **Đăng ký/Đăng nhập**: Tạo tài khoản để truy cập các tính năng nâng cao

### Cho Blogger (Người dùng đăng ký)
- **Viết Blog**: Chia sẻ trải nghiệm du lịch với hình ảnh và nội dung chi tiết
- **Tương tác**: Comment và reply trên các bài blog
- **Quản lý profile**: Cập nhật thông tin cá nhân
- **Xem nội dung**: Truy cập đầy đủ các bài viết và thông tin

### Cho Admin (Quản trị viên)
- **Quản lý người dùng**: CRUD tài khoản người dùng
- **Quản lý nội dung**: Duyệt blog, quản lý bài viết về 63 tỉnh thành **(dự án được thực hiện trước ngày 12.06.25)**
- **Quản lý địa điểm**: CRUD thông tin các điểm đến du lịch
- **Thống kê**: Dashboard với biểu đồ phân tích dữ liệu
- **Cài đặt hệ thống**: Đổi mật khẩu, cấu hình hệ thống

## Thiết kế cơ sở dữ liệu

### Các bảng chính:
- **users**: Thông tin người dùng (Admin & Blogger)
- **provinces**: 63 tỉnh thành Việt Nam **(dự án được thực hiện trước ngày 12.06.25)**
- **destinations**: Các điểm đến du lịch nổi tiếng
- **blog**: Bài viết của Blogger
- **post**: Bài viết về tỉnh thành (Admin)
- **userComment**: Bình luận trên blog
- **repComment**: Phản hồi bình luận
- **imgBlog**: Hình ảnh blog
- **postDetails**: Chi tiết bài viết post

### Đặc điểm thiết kế:
- Sử dụng "xóa mềm" để đảm bảo tính toàn vẹn dữ liệu
- Phân quyền rõ ràng: **Guest, Blogger, Admin**
- Lưu trữ hình ảnh trên Cloudinary

## 🛠️ Công nghệ sử dụng

- **Frontend**: HTML5, CSS3, JavaScript, jQuery
- **Backend**: PHP
- **Database**: MySQL
- **Cloud Storage**: Cloudinary (lưu trữ hình ảnh)
- **Authentication**: Session-based authentication
- **Architecture**: MVC pattern

## Cài đặt và chạy dự án

### Yêu cầu hệ thống
- **XAMPP** (bao gồm PHP 7.4+, MySQL 5.7+, Apache)
- **Cloudinary account** (cho upload hình ảnh)
- **Git** (để clone dự án)

### Hướng dẫn cài đặt với XAMPP

#### 1. Chuẩn bị môi trường
- Tải và cài đặt XAMPP từ https://www.apachefriends.org/
- Khởi động XAMPP Control Panel
- Khởi chạy Apache và MySQL services


#### 2. Clone dự án vào thư mục htdocs
```bash
# Di chuyển đến thư mục htdocs của XAMPP
cd C:\xampp\htdocs

# Clone dự án
git clone <repository-url>
cd Vietnam-Travel-Guide
```

#### 3. Tạo và cấu hình Database
- Truy cập phpMyAdmin: http://localhost/phpmyadmin
- Tạo database mới tên ```vietnamtravel``` (hoặc tên khác tùy chọn)
- Import file SQL có sẵn trong dự án

#### 4. Cấu hình kết nối Database
Chỉnh sửa file [`src/config/config.php`](src/config/config.php):
```php
<?php
class Config {
    public function connect() {
        $hostname = "localhost";
        $username = "root";            // Username mặc định của XAMPP
        $password = "";                // Password mặc định của XAMPP (để trống)
        $dbname = "vietnamtravel";    // Thay bằng tên database vừa tạo ở phpMyAdmin 

        $this->conn = mysqli_connect($hostname, $username, $password, $dbname) 
                     or die("Lỗi kết nối Database");
        return $this->conn;
    }
}
?>
```
#### 5. Khởi chạy dự án
- Đảm bảo Apache và MySQL đang chạy trong XAMPP
- Truy cập website qua browser:
http://localhost/Vietnam-Travel-Guide/src/Views/blogger/home.php

### 6. Đăng nhập/Đăng ký
Sau khi import database, bạn có thể đăng nhập với:
- **Admin**: Tài khoản được tạo sẵn trong database
- **Blogger**: Tự đăng ký tài khoản mới qua trang đăng ký

### 7. Xử lý sự cố thường gặp

#### Lỗi kết nối Database
- Kiểm tra MySQL service trong XAMPP Control Panel
- Đảm bảo MySQL đang chạy (màu xanh)
- Kiểm tra lại thông tin trong `config.php`

#### Lỗi đường dẫn (404 Not Found)
- Đảm bảo dự án được đặt đúng trong htdocs
- Kiểm tra Apache service đang chạy
- Xem lại đường dẫn URL

#### Port conflicts
- Nếu port 80 bị chiếm:
    - Vào XAMPP → Apache → Config → httpd.conf
    - Thay đổi Listen 80 thành Listen 8080
- Truy cập lại trang chủ qua đường dẫn đã cung cấp ở bước 5

## Phát triển trong tương lai

### Tính năng đang phát triển
- Hệ thống đánh giá và yêu thích bài viết
- Sắp xếp nội dung theo tiêu chí (lượt xem, mới nhất)
- Chức năng comment với hình ảnh
- Lưu bài viết để đọc sau

### Tính năng mở rộng & khắc phục
- Gợi ý lịch trình du lịch thông minh
- Ứng dụng mobile (iOS/Android)
- Hỗ trợ đa ngôn ngữ
- Tích hợp mạng xã hội
- System feedback và liên hệ
- API cho third-party integration
- Push notification real-time
- Advanced analytics với AI
- Tách hệ thống của user và admin để đảm bảo tính bảo mật


**Hãy cùng nhau khám phá và quảng bá vẻ đẹp Việt Nam!**
