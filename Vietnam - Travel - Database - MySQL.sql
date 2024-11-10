
CREATE TABLE users (
  userID INT AUTO_INCREMENT PRIMARY KEY,
  userName VARCHAR(50) NOT NULL,
  pass_word VARCHAR(20) NOT NULL,
  role_ VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL UNIQUE,
  status BOOLEAN NOT NULL
);

CREATE TABLE province (
  provinceID INT AUTO_INCREMENT PRIMARY KEY,
  provinceName VARCHAR(50) NOT NULL UNIQUE,
  provinceRegion VARCHAR(20) NOT NULL  
);

CREATE TABLE destination (
  destinationID INT AUTO_INCREMENT PRIMARY KEY,
  provinceID INT NOT NULL,
  destinationName VARCHAR(50) NOT NULL,
  destinationContent TEXT NOT NULL,
  imgDesURL TEXT NOT NULL,
  FOREIGN KEY (provinceID) REFERENCES province(provinceID)
);

CREATE table post(
    postID INT AUTO_INCREMENT PRIMARY KEY,
	provinceID INT NOT NULL, 
	postCreateDate DATE NOT NULL,
	imgPostURL TEXT NOT NULL,
	FOREIGN KEY (provinceID) REFERENCES province(provinceID)
);

CREATE table postDetail(
    postDetailID INT AUTO_INCREMENT PRIMARY KEY,
	postID INT NOT NULL,
	sectionTitle TEXT NOT NULL,
	sectionContent TEXT NOT NULL,
	category VARCHAR(20) NOT NULL,
	imgPostDetURL TEXT NOT NULL,
	FOREIGN KEY (postID) REFERENCES post(postID)
);

CREATE table blog(
    blogID INT AUTO_INCREMENT PRIMARY KEY,
	provinceID INT NOT NULL,
	userID INT NOT NULL,
	blogContent TEXT NOT NULL,
	blogCreateDate DATE NOT NULL,
	approve BOOLEAN NOT NULL,	
	
	FOREIGN KEY (userID) REFERENCES users(userID),
	FOREIGN KEY (provinceID) REFERENCES province(provinceID)
);

CREATE table imgBlog(
    imgID INT AUTO_INCREMENT PRIMARY KEY,
	blogID INT NOT NULL, 
	imgBlogURL TEXT NOT NULL,
	FOREIGN KEY (blogID) REFERENCES blog(blogID)
);

CREATE table userComment (
    commentID INT AUTO_INCREMENT PRIMARY KEY,
	blogID INT NOT NULL, 
	userID INT NOT NULL, 
	cmtContent TEXT NOT NULL,
	createDate DATE NOT NULL,

	FOREIGN KEY (blogID) REFERENCES blog(blogID),
	FOREIGN KEY (userID) REFERENCES users(userID)
);

CREATE table repComment (
    repCommentID INT AUTO_INCREMENT PRIMARY KEY,
	commentID INT NOT NULL, 
	userID INT NOT NULL, 
	repContent TEXT NOT NULL,
	createDateRep DATE NOT NULL,

	FOREIGN KEY (commentID) REFERENCES userComment(commentID),
	FOREIGN KEY (userID) REFERENCES users(userID)
);

INSERT INTO users (userName, pass_word, role_, email, status) VALUES 
('Admin', 'adminPassword', 'Admin', 'admin@example.com', true),
('Trần Đăng B', 'password3', 'Blogger', 'user3@example.com', true),
('Trần Thị C', 'password4', 'Blogger', 'user4@example.com', true),
('Trần Thị Thanh D', 'password5', 'Blogger', 'user5@example.com', true),
('Trần Thị Thanh E', 'password6', 'Blogger', 'user6@example.com', true),
('Nguyễn Văn F', 'password7', 'Blogger', 'user7@example.com', true),
('Trần Đình G', 'password8', 'Blogger', 'user8@example.com', true),
('Nguyễn Trần Khả H', 'password9', 'Blogger', 'user9@example.com', true),
('Trần Đại I', 'password10', 'Blogger', 'user10@example.com', true),
('Trần Đăng A', 'password2', 'Blogger', 'user2@example.com', true),
('Huỳnh Nguyễn Quốc J', 'password11', 'Blogger', 'user11@example.com', true),
('Nguyễn Lê Hiếu K', 'password12', 'Blogger', 'user12@example.com', true),
('Phạm Thanh L', 'password13', 'Blogger', 'user13@example.com', true),
('Nguyễn Hoàng M', 'password14', 'Blogger', 'user14@example.com', true),
('Trần Minh N', 'password15', 'Blogger', 'user15@example.com', true),
('Phạm Văn O', 'password16', 'Blogger', 'user16@example.com', true),
('Hoàng Thị P', 'password17', 'Blogger', 'user17@example.com', true),
('Vũ Văn Q', 'password18', 'Blogger', 'user18@example.com', true),
('Đặng Thị R', 'password19', 'Blogger', 'user19@example.com', true),
('Bùi Văn S', 'password20', 'Blogger', 'user20@example.com', true),
('Đỗ Thị T', 'password21', 'Blogger', 'user21@example.com', true),
('Hồ Văn U', 'password22', 'Blogger', 'user22@example.com', true),
('Ngô Thị V', 'password23', 'Blogger', 'user23@example.com', true),
('Nguyễn Văn X', 'password24', 'Blogger', 'user24@example.com', true),
('Trần Thị Y', 'password25', 'Blogger', 'user25@example.com', true),
('Lê Văn Z', 'password26', 'Blogger', 'user26@example.com', true),
('Phạm Thị A1', 'password27', 'Blogger', 'user27@example.com', true),
('Hoàng Văn B1', 'password28', 'Blogger', 'user28@example.com', true),
('Vũ Thị C1', 'password29', 'Blogger', 'user29@example.com', true),
('Đặng Văn D1', 'password30', 'Blogger', 'user30@example.com', true);




INSERT INTO province (provinceName, provinceRegion) VALUES
('Hà Nội', 'north'),
('Hà Giang', 'north'),
('Cao Bằng', 'north'),
('Bắc Kạn', 'north'),
('Tuyên Quang', 'north'),
('Lào Cai', 'north'),
('Điện Biên', 'north'),
('Lai Châu', 'north'),
('Sơn La', 'north'),
('Yên Bái', 'north'),

('Hòa Bình', 'north'),
('Thái Nguyên', 'north'),
('Lạng Sơn', 'north'),
('Quảng Ninh', 'north'),
('Bắc Giang', 'north'),
('Phú Thọ', 'north'),
('Vĩnh Phúc', 'north'),
('Bắc Ninh', 'north'),
('Hải Dương', 'north'),
('Hải Phòng', 'north'),
('Hưng Yên', 'north'),
('Thái Bình', 'north'),
('Hà Nam', 'north'),
('Nam Định', 'north'),
('Ninh Bình', 'north'),
('Thanh Hóa', 'middle'),
('Nghệ An', 'middle'),
('Hà Tĩnh', 'middle'),

('Quảng Bình', 'middle'),
('Quảng Trị', 'middle'),
('Thừa Thiên Huế', 'middle'),
('Đà Nẵng', 'middle'),
('Quảng Nam', 'middle'),
('Quảng Ngãi', 'middle'),
('Bình Định', 'middle'),
('Phú Yên', 'middle'),
('Khánh Hòa', 'middle'),
('Ninh Thuận', 'middle'),
('Bình Thuận', 'middle'),
('Kon Tum', 'middle'),
('Gia Lai', 'middle'),
('Đắk Lắk', 'middle'),
('Đắk Nông', 'middle'),
('Lâm Đồng', 'middle'),

('Bình Phước', 'south'),
('Tây Ninh', 'south'),
('Bình Dương', 'south'),
('Đồng Nai', 'south'),
('Bà Rịa - Vũng Tàu', 'south'),
('Hồ Chí Minh', 'south'),
('Long An', 'south'),
('Tiền Giang', 'south'),
('Bến Tre', 'south'),
('Trà Vinh', 'south'),
('Vĩnh Long', 'south'),
('Đồng Tháp', 'south'),
('An Giang', 'south'),
('Kiên Giang', 'south'),
('Cần Thơ', 'south'),
('Hậu Giang', 'south'),
('Sóc Trăng', 'south'),
('Bạc Liêu', 'south'),
('Cà Mau', 'south');


INSERT INTO destination (provinceID, destinationName, destinationContent, imgDesURL) VALUES
(1, 'Hồ Hoàn Kiếm', 'Biểu tượng Thủ đô Việt Nam', 'https://cloudinary.com/'),
(1, 'Lăng Chủ tịch Hồ Chí Minh', 'Di tích Quốc gia, nơi Bác Hồ nghỉ ngơi', 'https://cloudinary.com/'),
(2, 'Đồng Văn', 'Thị trấn đá cổ đẹp nhất Việt Nam', 'https://cloudinary.com/'),
(2, 'Mèo Vạc', 'Cổng trời Hà Giang', 'https://cloudinary.com/'),
(2, 'Cột cờ Lũng Cú', 'Biểu tượng thiêng liêng của Hà Giang, cột cờ Lũng Cú đánh dấu địa đầu tổ quốc.', 'https://cloudinary.com/ha-giang-lung-cu'),
(3, 'Thác Bản Giốc', 'Thác nước đẹp như tranh vẽ ở biên giới Việt - Trung.', 'https://cloudinary.com/cao-bang-ban-gioc'),
(4, 'Hồ Ba Bể', 'Hồ nước ngọt lớn nhất miền Bắc', 'https://cloudinary.com/image4'),
(5, 'Núi Pắc Tạ', 'Điểm cao nhất tại Tuyên Quang', 'https://cloudinary.com/image5'),
(6, 'Đỉnh Fansipan', 'Nóc nhà Đông Dương', 'https://cloudinary.com/image6'),
(7, 'Mường Phăng', 'Căn cứ địa lịch sử Điện Biên', 'https://cloudinary.com/image7'),
(8, 'Đèo Ô Quy Hồ', 'Một trong tứ đại đỉnh đèo Tây Bắc', 'https://cloudinary.com/image8'),
(9, 'Rừng thông Bản Áng', 'Rừng thông đẹp tại Sơn La', 'https://cloudinary.com/image9'),
(10, 'Ruộng bậc thang Mù Cang Chải', 'Ruộng bậc thang nổi tiếng của Yên Bái', 'https://cloudinary.com/image10'),

(11, 'Thung Nai', 'Điểm đến nổi tiếng tại Hòa Bình', 'https://cloudinary.com/image11'),
(12, 'Hồ Núi Cốc', 'Hồ nhân tạo và khu du lịch nổi tiếng Thái Nguyên', 'https://cloudinary.com/image12'),
(13, 'Động Tam Thanh', 'Hang động đẹp tại Lạng Sơn', 'https://cloudinary.com/image13'),
(14, 'Vịnh Hạ Long', 'Di sản thiên nhiên thế giới tại Quảng Ninh', 'https://cloudinary.com/image14'),
(15, 'Tây Yên Tử', 'Di tích văn hóa lịch sử tại Bắc Giang', 'https://cloudinary.com/image15'),
(16, 'Đền Hùng', 'Nơi thờ các vua Hùng ở Phú Thọ', 'https://cloudinary.com/image16'),
(17, 'Tam Đảo', 'Khu nghỉ dưỡng nổi tiếng tại Vĩnh Phúc', 'https://cloudinary.com/image17'),
(18, 'Chùa Dâu', 'Ngôi chùa cổ nhất tại Bắc Ninh', 'https://cloudinary.com/image18'),
(19, 'Đảo Cò Chi Lăng Nam', 'Điểm du lịch sinh thái tại Hải Dương', 'https://cloudinary.com/image19'),
(20, 'Đồ Sơn', 'Bãi biển nổi tiếng ở Hải Phòng', 'https://cloudinary.com/image20'),
(21, 'Phố Hiến', 'Khu phố cổ nổi tiếng ở Hưng Yên', 'https://cloudinary.com/image21'),
(22, 'Chùa Keo', 'Ngôi chùa cổ nổi tiếng tại Thái Bình', 'https://cloudinary.com/image22'),
(23, 'Chùa Bà Đanh', 'Chùa nổi tiếng tại Hà Nam', 'https://cloudinary.com/image23'),
(24, 'Phủ Dầy', 'Di tích văn hóa tâm linh tại Nam Định', 'https://cloudinary.com/image24'),
(25, 'Tràng An', 'Danh thắng và di sản thế giới tại Ninh Bình', 'https://cloudinary.com/image25'),
(26, 'Biển Sầm Sơn', 'Bãi biển nổi tiếng tại Thanh Hóa', 'https://cloudinary.com/image26'),
(27, 'Làng Sen', 'Quê hương Chủ tịch Hồ Chí Minh tại Nghệ An', 'https://cloudinary.com/image27'),
(28, 'Biển Thiên Cầm', 'Bãi biển đẹp tại Hà Tĩnh', 'https://cloudinary.com/image28'),

(29, 'Hang Sơn Đoòng', 'Hang động lớn nhất thế giới tại Quảng Bình', 'https://cloudinary.com/image29'),
(30, 'Thành cổ Quảng Trị', 'Di tích lịch sử thời chiến tại Quảng Trị', 'https://cloudinary.com/image30'),
(31, 'Đại Nội Huế', 'Di sản văn hóa thế giới tại Thừa Thiên Huế', 'https://cloudinary.com/image31'),
(32, 'Bà Nà Hills', 'Khu du lịch nổi tiếng tại Đà Nẵng', 'https://cloudinary.com/image32'),
(33, 'Phố cổ Hội An', 'Di sản văn hóa thế giới tại Quảng Nam', 'https://cloudinary.com/image33'),
(34, 'Đảo Lý Sơn', 'Thiên đường biển đảo tại Quảng Ngãi', 'https://cloudinary.com/image34'),
(35, 'Tháp Đôi', 'Di tích văn hóa Chăm tại Bình Định', 'https://cloudinary.com/image35'),
(36, 'Gành Đá Đĩa', 'Danh thắng nổi tiếng tại Phú Yên', 'https://cloudinary.com/image36'),
(37, 'Vinpearl Nha Trang', 'Khu du lịch nổi tiếng tại Khánh Hòa', 'https://cloudinary.com/image37'),
(38, 'Vịnh Vĩnh Hy', 'Vịnh biển đẹp tại Ninh Thuận', 'https://cloudinary.com/image38'),
(39, 'Mũi Né', 'Bãi biển và đồi cát nổi tiếng tại Bình Thuận', 'https://cloudinary.com/image39'),
(40, 'Ngã ba Đông Dương', 'Giao điểm giữa Việt Nam, Lào và Campuchia tại Kon Tum', 'https://cloudinary.com/image40'),
(41, 'Biển Hồ', 'Hồ nước đẹp tại Gia Lai', 'https://cloudinary.com/image41'),
(42, 'Buôn Đôn', 'Làng văn hóa nổi tiếng của người Ê Đê tại Đắk Lắk', 'https://cloudinary.com/image42'),
(43, 'Thác Đray Nur', 'Thác nước nổi tiếng tại Đắk Nông', 'https://cloudinary.com/image43'),
(44, 'Thung lũng Tình Yêu', 'Danh thắng nổi tiếng tại Lâm Đồng', 'https://cloudinary.com/image44'),

(45, 'Khu du lịch sinh thái Hồ Dầu Tiếng', 'Hồ lớn tại Bình Phước', 'https://cloudinary.com/image45'),
(46, 'Núi Bà Đen', 'Nóc nhà Nam Bộ tại Tây Ninh', 'https://cloudinary.com/image46'),
(47, 'Khu du lịch Đại Nam', 'Khu du lịch nổi tiếng tại Bình Dương', 'https://cloudinary.com/image47'),
(48, 'Vườn Quốc gia Cát Tiên', 'Vườn quốc gia lớn tại Đồng Nai', 'https://cloudinary.com/image48'),
(49, 'Bãi Sau Vũng Tàu', 'Bãi biển nổi tiếng tại Bà Rịa - Vũng Tàu', 'https://cloudinary.com/image49'),
(50, 'Chợ Bến Thành', 'Biểu tượng thương mại tại Hồ Chí Minh', 'https://cloudinary.com/image50'),
(51, 'Khu du lịch Cần Giuộc', 'Khu du lịch sinh thái tại Long An', 'https://cloudinary.com/image51'),
(52, 'Chùa Vĩnh Tràng', 'Ngôi chùa nổi tiếng tại Tiền Giang', 'https://cloudinary.com/image52'),
(53, 'Vườn dừa Bến Tre', 'Vườn dừa nổi tiếng tại Bến Tre', 'https://cloudinary.com/image53'),
(54, 'Chùa Bà Chúa Xứ', 'Chùa nổi tiếng tại Trà Vinh', 'https://cloudinary.com/image54'),
(55, 'Chợ Vĩnh Long', 'Chợ nổi tiếng tại Vĩnh Long', 'https://cloudinary.com/image55'),
(56, 'Vườn Quốc gia Tràm Chim', 'Vườn quốc gia tại Đồng Tháp', 'https://cloudinary.com/image56'),
(57, 'Chùa Nam Bộ', 'Chùa lớn tại An Giang', 'https://cloudinary.com/image57'),
(58, 'Đảo Phú Quốc', 'Khu nghỉ dưỡng nổi tiếng tại Kiên Giang', 'https://cloudinary.com/image58'),
(59, 'Bến Ninh Kiều', 'Điểm du lịch nổi tiếng tại Cần Thơ', 'https://cloudinary.com/image59'),
(60, 'Cồn Sơn', 'Đảo du lịch nổi tiếng tại Hậu Giang', 'https://cloudinary.com/image60'),
(61, 'Chùa Dơi', 'Chùa cổ tại Sóc Trăng', 'https://cloudinary.com/image61'),
(62, 'Công viên Hồ Nam', 'Công viên lớn tại Bạc Liêu', 'https://cloudinary.com/image62'),
(63, 'Rừng U Minh Hạ', 'Khu rừng nguyên sinh tại Cà Mau', 'https://cloudinary.com/image63');


INSERT INTO post(provinceID, postCreateDate, imgPostURL )VALUES
--imgPostURL: hình của từng provinced ứng với provinceID
(1, '20/11/2024', 'https://cloudinary.com/image1'),
(2, '20/11/2024', 'https://cloudinary.com/image2'),
(3, '20/11/2024', 'https://cloudinary.com/image3'),
(4, '20/11/2024', 'https://cloudinary.com/image4'),
(5, '20/11/2024', 'https://cloudinary.com/image5'),
(6, '20/11/2024', 'https://cloudinary.com/image6'),
(7, '20/11/2024', 'https://cloudinary.com/image7'),
(8, '20/11/2024', 'https://cloudinary.com/image8'),
(9, '20/11/2024', 'https://cloudinary.com/image9'),
(10, '20/11/2024', 'https://cloudinary.com/image10'),

(11, '20/11/2024', 'https://cloudinary.com/image11'),
(12, '20/11/2024', 'https://cloudinary.com/image12'),
(13, '20/11/2024', 'https://cloudinary.com/image13'),
(14, '20/11/2024', 'https://cloudinary.com/image14'),
(15, '20/11/2024', 'https://cloudinary.com/image15'),
(16, '20/11/2024', 'https://cloudinary.com/image16'),
(17, '20/11/2024', 'https://cloudinary.com/image17'),
(18, '20/11/2024', 'https://cloudinary.com/image18'),
(19, '20/11/2024', 'https://cloudinary.com/image19'),
(20, '20/11/2024', 'https://cloudinary.com/image20'),
(21, '20/11/2024', 'https://cloudinary.com/image21'),
(22, '20/11/2024', 'https://cloudinary.com/image22'),
(23, '20/11/2024', 'https://cloudinary.com/image23'),
(24, '20/11/2024', 'https://cloudinary.com/image24'),
(25, '20/11/2024', 'https://cloudinary.com/image25'),
(26, '20/11/2024', 'https://cloudinary.com/image26'),
(27, '20/11/2024', 'https://cloudinary.com/image27'),
(28, '20/11/2024', 'https://cloudinary.com/image28'),

(29, '20/11/2024', 'https://cloudinary.com/image29'),
(30, '20/11/2024', 'https://cloudinary.com/image30'),
(31, '20/11/2024', 'https://cloudinary.com/image31'),
(32, '20/11/2024', 'https://cloudinary.com/image32'),
(33, '20/11/2024', 'https://cloudinary.com/image33'),
(34, '20/11/2024', 'https://cloudinary.com/image34'),
(35, '20/11/2024', 'https://cloudinary.com/image35'),
(36, '20/11/2024', 'https://cloudinary.com/image36'),
(37, '20/11/2024', 'https://cloudinary.com/image37'),
(38, '20/11/2024', 'https://cloudinary.com/image38'),
(39, '20/11/2024', 'https://cloudinary.com/image39'),
(40, '20/11/2024', 'https://cloudinary.com/image40'),
(41, '20/11/2024', 'https://cloudinary.com/image41'),
(42, '20/11/2024', 'https://cloudinary.com/image42'),
(43, '20/11/2024', 'https://cloudinary.com/image43'),
(44, '20/11/2024', 'https://cloudinary.com/image44'),

(45, '20/11/2024', 'https://cloudinary.com/image45'),
(46, '20/11/2024', 'https://cloudinary.com/image46'),
(47, '20/11/2024', 'https://cloudinary.com/image47'),
(48, '20/11/2024', 'https://cloudinary.com/image48'),
(49, '20/11/2024', 'https://cloudinary.com/image49'),
(50, '20/11/2024', 'https://cloudinary.com/image50'),
(51, '20/11/2024', 'https://cloudinary.com/image51'),
(52, '20/11/2024', 'https://cloudinary.com/image52'),
(53, '20/11/2024', 'https://cloudinary.com/image53'),
(54, '20/11/2024', 'https://cloudinary.com/image54'),
(55, '20/11/2024', 'https://cloudinary.com/image55'),
(56, '20/11/2024', 'https://cloudinary.com/image56'),
(57, '20/11/2024', 'https://cloudinary.com/image57'),
(58, '20/11/2024', 'https://cloudinary.com/image58'),
(59, '20/11/2024', 'https://cloudinary.com/image59'),
(60, '20/11/2024', 'https://cloudinary.com/image60'),
(61, '20/11/2024', 'https://cloudinary.com/image61'),
(62, '20/11/2024', 'https://cloudinary.com/image62'),
(63, '20/11/2024', 'https://cloudinary.com/image63');




INSERT INTO postDetail(postID, sectionTitle, sectionContent, imgPostDetURL )VALUES
(1, 'Phở Hà Nội', 'Món phở truyền thống của Hà Nội, nước dùng thơm ngon, bánh phở mềm mịn.', 'https://cloudinary.com/image1_food1'),
(1, 'Hồ Hoàn Kiếm', 'Biểu tượng nổi bật của thủ đô, gắn liền với lịch sử và văn hóa Việt Nam.', 'https://cloudinary.com/image1_travel1'),

(2, 'Thắng Cố Hà Giang', 'Món ăn đặc sản của người dân tộc Mông, được nấu từ thịt ngựa, gia vị đặc trưng.', 'https://cloudinary.com/image2_food1'),
(2, 'Đồng Văn', 'Thị trấn đá cổ nổi tiếng, địa điểm du lịch hấp dẫn ở Hà Giang.', 'https://cloudinary.com/image2_travel1'),

(3, 'Bánh cuốn Cao Bằng', 'Món bánh cuốn ngon đặc sản Cao Bằng, ăn kèm với gia vị hấp dẫn.', 'https://cloudinary.com/image3_food1'),
(3, 'Thác Bản Giốc', 'Thác nước đẹp như tranh vẽ, một trong những thác nước đẹp nhất Việt Nam.', 'https://cloudinary.com/image3_travel1'),

(4, 'Cơm lam Bắc Kạn', 'Cơm lam đặc sản của vùng núi, nấu bằng ống tre, dẻo thơm tự nhiên.', 'https://cloudinary.com/image4_food1'),
(4, 'Hồ Ba Bể', 'Hồ nước ngọt lớn nhất miền Bắc, cảnh quan thiên nhiên tuyệt đẹp.', 'https://cloudinary.com/image4_travel1'),

(5, 'Bánh nếp Tuyên Quang', 'Bánh nếp dẻo, nhân đậu xanh, đặc sản Tuyên Quang thường xuất hiện trong các dịp lễ.', 'https://cloudinary.com/image5_food1'),
(5, 'Núi Pắc Tạ', 'Núi Pắc Tạ, điểm cao nhất tại Tuyên Quang, thu hút du khách yêu thích khám phá.', 'https://cloudinary.com/image5_travel1'),

(6, 'Cải ngồng xào Lào Cai', 'Món ăn đậm đà hương vị vùng cao, làm từ cải ngồng và gia vị đặc trưng.', 'https://cloudinary.com/image6_food1'),
(6, 'Đỉnh Fansipan', 'Nóc nhà Đông Dương, điểm đến tuyệt vời cho những ai yêu thích thử thách leo núi.', 'https://cloudinary.com/image6_travel1'),

(7, 'Xôi nếp Điện Biên', 'Xôi nếp dẻo thơm, ăn kèm với thịt gà, đặc sản của vùng đất Điện Biên.', 'https://cloudinary.com/image7_food1'),
(7, 'Mường Phăng', 'Căn cứ địa lịch sử Điện Biên, nơi ghi dấu chiến thắng oai hùng của dân tộc.', 'https://cloudinary.com/image7_travel1'),

(8, 'Lợn cắp nách Lai Châu', 'Món thịt lợn nướng đặc sản Lai Châu, được ướp gia vị dân tộc.', 'https://cloudinary.com/image8_food1'),
(8, 'Đèo Ô Quy Hồ', 'Một trong tứ đại đỉnh đèo Tây Bắc, cảnh quan hùng vĩ, mây mù bao phủ.', 'https://cloudinary.com/image8_travel1'),

(9, 'Cơm lam Sơn La', 'Cơm lam nấu trong ống tre, đặc sản của Sơn La, thơm ngon đặc biệt.', 'https://cloudinary.com/image9_food1'),
(9, 'Rừng thông Bản Áng', 'Rừng thông nổi tiếng của Sơn La, không gian tĩnh lặng, thích hợp để thư giãn.', 'https://cloudinary.com/image9_travel1'),

(10, 'Cơm gà Yên Bái', 'Món cơm gà hấp dẫn, được làm từ gà ta, ăn kèm với rau sống và gia vị đặc biệt.', 'https://cloudinary.com/image10_food1'),
(10, 'Ruộng bậc thang Mù Cang Chải', 'Một trong những cảnh đẹp thiên nhiên nổi tiếng của Yên Bái, ruộng bậc thang mênh mông.', 'https://cloudinary.com/image10_travel1'),

(11, 'Cơm lam Hòa Bình', 'Cơm lam là món ăn đặc sản của người dân tộc Mường tại Hòa Bình, được nấu trong ống tre.', 'https://cloudinary.com/image11_food1'),
(11, 'Thung Nai', 'Điểm đến nổi tiếng của Hòa Bình với phong cảnh thiên nhiên tuyệt đẹp, là địa điểm du lịch lý tưởng.', 'https://cloudinary.com/image11_travel1'),

(12, 'Chè Thái Nguyên', 'Chè Thái Nguyên nổi tiếng với hương vị đặc biệt, là loại trà ngon nổi tiếng của vùng đất này.', 'https://cloudinary.com/image12_food1'),
(12, 'Hồ Núi Cốc', 'Hồ nhân tạo lớn nhất Thái Nguyên, kết hợp với khu du lịch sinh thái, thu hút nhiều du khách.', 'https://cloudinary.com/image12_travel1'),

(13, 'Bánh cuốn Lạng Sơn', 'Bánh cuốn Lạng Sơn có lớp vỏ mỏng, nhân đầy đặn và nước chấm đặc trưng, là món ăn nổi tiếng của địa phương.', 'https://cloudinary.com/image13_food1'),
(13, 'Động Tam Thanh', 'Động Tam Thanh với những hình thù kỳ bí của thạch nhũ, thu hút khách du lịch yêu thích khám phá thiên nhiên.', 'https://cloudinary.com/image13_travel1'),

(14, 'Hải sản Quảng Ninh', 'Quảng Ninh nổi tiếng với hải sản tươi ngon, đặc biệt là ghẹ, hàu và cá mực, rất được du khách ưa chuộng.', 'https://cloudinary.com/image14_food1'),
(14, 'Vịnh Hạ Long', 'Vịnh Hạ Long là di sản thiên nhiên thế giới, nổi tiếng với các đảo đá vôi kỳ vĩ và cảnh quan tuyệt đẹp.', 'https://cloudinary.com/image14_travel1'),

(15, 'Bánh đa Kế', 'Bánh đa Kế đặc sản Bắc Giang, với lớp vỏ giòn tan, nhân đầy đặn, ăn kèm nước mắm chua ngọt.', 'https://cloudinary.com/image15_food1'),
(15, 'Tây Yên Tử', 'Di tích văn hóa và lịch sử của Bắc Giang, nơi linh thiêng và nổi tiếng với các ngôi chùa cổ.', 'https://cloudinary.com/image15_travel1'),

(16, 'Cơm nắm lá cọ', 'Cơm nắm lá cọ là món ăn đặc sản của Phú Thọ, ăn cùng với cá suối nướng thơm ngon.', 'https://cloudinary.com/image16_food1'),
(16, 'Đền Hùng', 'Đền Hùng là nơi thờ các vua Hùng, biểu tượng của lịch sử và văn hóa dân tộc Việt Nam.', 'https://cloudinary.com/image16_travel1'),

(17, 'Bánh chưng Vĩnh Phúc', 'Bánh chưng tại Vĩnh Phúc được làm từ gạo nếp, đậu xanh, thịt heo, là món ăn đặc sản của vùng đất này.', 'https://cloudinary.com/image17_food1'),
(17, 'Tam Đảo', 'Khu nghỉ dưỡng nổi tiếng tại Vĩnh Phúc, với khí hậu mát mẻ và cảnh đẹp thiên nhiên tuyệt vời.', 'https://cloudinary.com/image17_travel1'),

(18, 'Bánh đúc Bắc Ninh', 'Bánh đúc Bắc Ninh có hương vị ngọt ngào, ăn cùng với nước mắm chua ngọt đặc trưng.', 'https://cloudinary.com/image18_food1'),
(18, 'Chùa Dâu', 'Chùa Dâu là ngôi chùa cổ nhất tại Bắc Ninh, có giá trị lịch sử và văn hóa đặc biệt.', 'https://cloudinary.com/image18_travel1'),

(19, 'Bánh gai Hải Dương', 'Bánh gai Hải Dương với lớp vỏ bánh mềm dẻo, nhân đậu xanh và lá chuối thơm ngon.', 'https://cloudinary.com/image19_food1'),
(19, 'Đảo Cò Chi Lăng Nam', 'Đảo Cò Chi Lăng Nam nổi tiếng với cảnh quan sinh thái tuyệt vời, là điểm đến hấp dẫn cho du khách.', 'https://cloudinary.com/image19_travel1'),

(20, 'Cá rô đồng Hải Phòng', 'Cá rô đồng là món đặc sản nổi tiếng của Hải Phòng, được chế biến thành nhiều món ngon hấp dẫn.', 'https://cloudinary.com/image20_food1'),
(20, 'Đồ Sơn', 'Bãi biển nổi tiếng ở Hải Phòng, thu hút du khách bởi bãi cát trắng mịn và nước biển trong xanh.', 'https://cloudinary.com/image20_travel1');

(21, 'Nhãn lồng Hưng Yên', 'Nhãn lồng Hưng Yên nổi tiếng với hương vị ngọt ngào, quả nhãn giòn và thơm đặc biệt.', 'https://cloudinary.com/image21_food1'),
(21, 'Phố Hiến', 'Phố Hiến là khu phố cổ nổi tiếng ở Hưng Yên, với các di tích lịch sử và kiến trúc cổ kính.', 'https://cloudinary.com/image21_travel1'),

(22, 'Bánh cáy Thái Bình', 'Bánh cáy là đặc sản Thái Bình, với lớp vỏ giòn, nhân đậu xanh thơm ngọt.', 'https://cloudinary.com/image22_food1'),
(22, 'Chùa Keo', 'Chùa Keo là ngôi chùa cổ nổi tiếng tại Thái Bình, nơi thu hút nhiều tín đồ hành hương.', 'https://cloudinary.com/image22_travel1'),

(23, 'Bánh đa cua Hà Nam', 'Bánh đa cua Hà Nam được nấu từ cua đồng và bánh đa, hương vị đậm đà, rất nổi tiếng ở địa phương.', 'https://cloudinary.com/image23_food1'),
(23, 'Chùa Bà Đanh', 'Chùa Bà Đanh là ngôi chùa nổi tiếng tại Hà Nam, thu hút khách du lịch và tín đồ phật tử.', 'https://cloudinary.com/image23_travel1'),

(24, 'Phở bò Nam Định', 'Phở bò Nam Định nổi tiếng với nước dùng trong, thơm ngon, bánh phở mềm mịn.', 'https://cloudinary.com/image24_food1'),
(24, 'Phủ Dầy', 'Phủ Dầy là di tích văn hóa tâm linh tại Nam Định, nơi thu hút khách du lịch trong và ngoài nước.', 'https://cloudinary.com/image24_travel1'),

(25, 'Cơm cháy Ninh Bình', 'Cơm cháy Ninh Bình có hương vị giòn tan, ăn kèm với thịt gà và nước mắm đặc trưng.', 'https://cloudinary.com/image25_food1'),
(25, 'Tràng An', 'Tràng An là danh thắng nổi tiếng tại Ninh Bình, nơi có cảnh quan thiên nhiên tuyệt vời và nhiều hang động.', 'https://cloudinary.com/image25_travel1'),

(26, 'Nem chua Thanh Hóa', 'Nem chua Thanh Hóa có vị cay nồng, ăn kèm với lá ổi và gia vị rất đặc trưng.', 'https://cloudinary.com/image26_food1'),
(26, 'Biển Sầm Sơn', 'Biển Sầm Sơn là bãi biển nổi tiếng tại Thanh Hóa, thu hút du khách với cát trắng và nước biển trong xanh.', 'https://cloudinary.com/image26_travel1'),

(27, 'Cháo lươn Nghệ An', 'Cháo lươn Nghệ An là món ăn đặc sản với hương vị ngọt ngào từ thịt lươn tươi.', 'https://cloudinary.com/image27_food1'),
(27, 'Làng Sen', 'Làng Sen là quê hương của Chủ tịch Hồ Chí Minh, một điểm du lịch lịch sử và văn hóa đặc biệt tại Nghệ An.', 'https://cloudinary.com/image27_travel1'),

(28, 'Súp lươn Hà Tĩnh', 'Súp lươn Hà Tĩnh có hương vị đặc biệt, nước dùng thanh mát, ăn kèm với rau sống.', 'https://cloudinary.com/image28_food1'),
(28, 'Biển Thiên Cầm', 'Biển Thiên Cầm là một trong những bãi biển đẹp nhất của Hà Tĩnh, với cát trắng và nước biển trong xanh.', 'https://cloudinary.com/image28_travel1'),

(29, 'Bánh bột lọc Quảng Bình', 'Bánh bột lọc là món ăn đặc sản Quảng Bình, có lớp vỏ mỏng, nhân tôm thịt thơm ngon.', 'https://cloudinary.com/image29_food1'),
(29, 'Hang Sơn Đoòng', 'Hang động lớn nhất thế giới, nằm trong Vườn Quốc gia Phong Nha-Kẻ Bàng, Quảng Bình.', 'https://cloudinary.com/image29_travel1'),

(30, 'Bánh tráng Quảng Trị', 'Bánh tráng Quảng Trị có hương vị đặc trưng, giòn và ăn kèm với nhiều loại gia vị.', 'https://cloudinary.com/image30_food1'),
(30, 'Thành cổ Quảng Trị', 'Di tích lịch sử nổi tiếng của Quảng Trị, nơi ghi dấu sự kiện quan trọng trong cuộc chiến tranh Việt Nam.', 'https://cloudinary.com/image30_travel1'),

(31, 'Bánh bèo Huế', 'Bánh bèo Huế là món ăn nổi tiếng, với bánh mỏng và nước mắm đặc trưng.', 'https://cloudinary.com/image31_food1'),
(31, 'Đại Nội Huế', 'Di sản văn hóa thế giới, Đại Nội Huế là quần thể cung điện cổ kính của triều đại Nguyễn.', 'https://cloudinary.com/image31_travel1'),

(32, 'Mì Quảng Đà Nẵng', 'Mì Quảng là đặc sản nổi tiếng của Đà Nẵng, với nước dùng đậm đà, ăn kèm với các loại gia vị.', 'https://cloudinary.com/image32_food1'),
(32, 'Bà Nà Hills', 'Khu du lịch nổi tiếng với Cầu Vàng và các công trình kiến trúc độc đáo tại Đà Nẵng.', 'https://cloudinary.com/image32_travel1'),

(33, 'Cao lầu Hội An', 'Cao lầu là món ăn nổi tiếng của Quảng Nam, với sợi mì dai, thịt heo, rau sống và nước dùng đặc trưng.', 'https://cloudinary.com/image33_food1'),
(33, 'Phố cổ Hội An', 'Phố cổ Hội An được UNESCO công nhận là di sản văn hóa thế giới, với kiến trúc cổ kính và các công trình lịch sử.', 'https://cloudinary.com/image33_travel1'),

(34, 'Bánh xèo Quảng Ngãi', 'Bánh xèo Quảng Ngãi được chế biến từ bột gạo, nhân tôm, thịt và rau sống, rất ngon miệng.', 'https://cloudinary.com/image34_food1'),
(34, 'Đảo Lý Sơn', 'Lý Sơn là một thiên đường biển đảo nổi tiếng tại Quảng Ngãi, thu hút du khách với cảnh quan tuyệt đẹp và bãi biển trong xanh.', 'https://cloudinary.com/image34_travel1'),

(35, 'Bánh hỏi Bình Định', 'Bánh hỏi là món ăn đặc trưng của Bình Định, được làm từ bột gạo, ăn kèm với thịt heo và gia vị.', 'https://cloudinary.com/image35_food1'),
(35, 'Tháp Đôi', 'Tháp Đôi là di tích văn hóa Chăm nổi tiếng tại Bình Định, được xây dựng từ thế kỷ 12.', 'https://cloudinary.com/image35_travel1'),

(36, 'Bánh canh Phú Yên', 'Bánh canh Phú Yên có sợi mì dẻo, nước dùng đậm đà, ăn kèm với chả cá và tôm.', 'https://cloudinary.com/image36_food1'),
(36, 'Gành Đá Đĩa', 'Gành Đá Đĩa nổi tiếng với những phiến đá hình tổ ong đặc biệt, là danh thắng của Phú Yên.', 'https://cloudinary.com/image36_travel1'),

(37, 'Bánh căn Nha Trang', 'Bánh căn Nha Trang là món ăn dân dã với bánh mỏng, ăn kèm nước mắm chua ngọt và hải sản.', 'https://cloudinary.com/image37_food1'),
(37, 'Vinpearl Nha Trang', 'Vinpearl Nha Trang là khu du lịch nổi tiếng với bãi biển tuyệt đẹp, khu vui chơi giải trí và các hoạt động thể thao dưới nước.', 'https://cloudinary.com/image37_travel1'),

(38, 'Bánh tráng Ninh Thuận', 'Bánh tráng Ninh Thuận được làm từ gạo và có hương vị đặc biệt, thường ăn kèm với cá và gia vị.', 'https://cloudinary.com/image38_food1'),
(38, 'Vịnh Vĩnh Hy', 'Vịnh Vĩnh Hy là một trong những vịnh biển đẹp nhất tại Ninh Thuận, là điểm đến lý tưởng cho các du khách yêu thích biển.', 'https://cloudinary.com/image38_travel1'),

(39, 'Cơm hến Bình Thuận', 'Cơm hến Bình Thuận là món ăn truyền thống với cơm, hến, gia vị và nước mắm đặc trưng.', 'https://cloudinary.com/image39_food1'),
(39, 'Mũi Né', 'Mũi Né nổi tiếng với bãi biển dài và đồi cát vàng, là địa điểm du lịch lý tưởng cho những ai yêu thích thiên nhiên.', 'https://cloudinary.com/image39_travel1'),

(40, 'Bánh tráng Kon Tum', 'Bánh tráng Kon Tum được làm từ bột gạo, ăn kèm với các loại rau và gia vị đặc biệt.', 'https://cloudinary.com/image40_food1'),
(40, 'Ngã ba Đông Dương', 'Ngã ba Đông Dương là giao điểm giữa Việt Nam, Lào và Campuchia, là điểm du lịch độc đáo tại Kon Tum.', 'https://cloudinary.com/image40_travel1'),

(41, 'Bò né Gia Lai', 'Bò né Gia Lai là món ăn nổi tiếng với thịt bò mềm, được nướng và ăn kèm với rau sống và gia vị.', 'https://cloudinary.com/image41_food1'),
(41, 'Biển Hồ', 'Biển Hồ là một hồ nước ngọt đẹp tại Gia Lai, với cảnh quan thiên nhiên tuyệt vời và không khí trong lành.', 'https://cloudinary.com/image41_travel1'),

(42, 'Cà phê Buôn Ma Thuột', 'Cà phê Buôn Ma Thuột nổi tiếng với hương vị đậm đà, được trồng tại các khu vực núi rừng Đắk Lắk.', 'https://cloudinary.com/image42_food1'),
(42, 'Buôn Đôn', 'Buôn Đôn là làng văn hóa của người Ê Đê tại Đắk Lắk, nổi tiếng với nghề săn voi và các lễ hội truyền thống.', 'https://cloudinary.com/image42_travel1'),

(43, 'Gà nướng Đắk Nông', 'Gà nướng Đắk Nông có hương vị đậm đà, được ướp gia vị đặc biệt và nướng trên than hồng.', 'https://cloudinary.com/image43_food1'),
(43, 'Thác Đray Nur', 'Thác Đray Nur là một trong những thác nước nổi tiếng tại Đắk Nông, với cảnh đẹp hùng vĩ và không khí trong lành.', 'https://cloudinary.com/image43_travel1'),

(44, 'Bánh mì Lâm Đồng', 'Bánh mì tại Lâm Đồng có lớp vỏ giòn, nhân đầy đặn và được chế biến từ các nguyên liệu tươi ngon.', 'https://cloudinary.com/image44_food1'),
(44, 'Thung lũng Tình Yêu', 'Thung lũng Tình Yêu là một danh thắng nổi tiếng tại Lâm Đồng, với cảnh quan đẹp và không gian lãng mạn.', 'https://cloudinary.com/image44_travel1'),

(45, 'Bánh canh Bình Phước', 'Bánh canh Bình Phước có sợi mì dai, nước dùng đậm đà, ăn kèm với cá và thịt.', 'https://cloudinary.com/image45_food1'),
(45, 'Khu du lịch sinh thái Hồ Dầu Tiếng', 'Hồ Dầu Tiếng là hồ lớn tại Bình Phước, nổi tiếng với cảnh quan thiên nhiên và hoạt động thể thao dưới nước.', 'https://cloudinary.com/image45_travel1'),

(46, 'Bánh canh Trảng Bàng', 'Bánh canh Trảng Bàng là món ăn nổi tiếng tại Tây Ninh, với sợi mì mềm và nước dùng thơm ngon.', 'https://cloudinary.com/image46_food1'),
(46, 'Núi Bà Đen', 'Núi Bà Đen là nóc nhà Nam Bộ, nổi tiếng với cảnh đẹp hùng vĩ và truyền thuyết tâm linh.', 'https://cloudinary.com/image46_travel1'),

(47, 'Bánh xèo Bình Dương', 'Bánh xèo Bình Dương có lớp vỏ giòn, nhân tôm, thịt và rau sống, là món ăn đặc trưng của địa phương.', 'https://cloudinary.com/image47_food1'),
(47, 'Khu du lịch Đại Nam', 'Đại Nam là khu du lịch nổi tiếng tại Bình Dương với các trò chơi giải trí, vườn thú và công viên nước.', 'https://cloudinary.com/image47_travel1'),

(48, 'Cơm tấm Đồng Nai', 'Cơm tấm tại Đồng Nai có hương vị đặc trưng với cơm tấm mềm, ăn kèm với thịt nướng và nước mắm thơm ngon.', 'https://cloudinary.com/image48_food1'),
(48, 'Vườn Quốc gia Cát Tiên', 'Vườn quốc gia Cát Tiên nổi tiếng với hệ sinh thái đa dạng và là điểm đến lý tưởng cho những người yêu thiên nhiên.', 'https://cloudinary.com/image48_travel1'),

(49, 'Bánh khọt Vũng Tàu', 'Bánh khọt là món ăn nổi tiếng tại Vũng Tàu, với vỏ giòn và nhân tôm, mực.', 'https://cloudinary.com/image49_food1'),
(49, 'Bãi Sau Vũng Tàu', 'Bãi Sau là bãi biển nổi tiếng tại Bà Rịa - Vũng Tàu, với bãi cát trắng mịn và nước biển trong xanh.', 'https://cloudinary.com/image49_travel1'),

(50, 'Hủ tiếu Hồ Chí Minh', 'Hủ tiếu là món ăn đặc trưng của Hồ Chí Minh, với sợi hủ tiếu dai và nước dùng đậm đà.', 'https://cloudinary.com/image50_food1'),
(50, 'Chợ Bến Thành', 'Chợ Bến Thành là biểu tượng thương mại nổi tiếng tại Hồ Chí Minh, nơi bán đủ các loại hàng hóa từ đặc sản đến quà lưu niệm.', 'https://cloudinary.com/image50_travel1'),

(51, 'Bánh tét Long An', 'Bánh tét Long An là món ăn truyền thống, với nhân đậu xanh, thịt ba chỉ và lá chuối thơm.', 'https://cloudinary.com/image51_food1'),
(51, 'Khu du lịch Cần Giuộc', 'Khu du lịch sinh thái Cần Giuộc là điểm đến lý tưởng với không gian xanh mát và các hoạt động ngoài trời.', 'https://cloudinary.com/image51_travel1'),

(52, 'Mít Tiền Giang', 'Mít Tiền Giang nổi tiếng với trái mít ngọt, thơm và chất lượng, là đặc sản của vùng đồng bằng sông Cửu Long.', 'https://cloudinary.com/image52_food1'),
(52, 'Chùa Vĩnh Tràng', 'Chùa Vĩnh Tràng là ngôi chùa nổi tiếng tại Tiền Giang, với kiến trúc đẹp và lịch sử lâu đời.', 'https://cloudinary.com/image52_travel1'),

(53, 'Vườn dừa Bến Tre', 'Vườn dừa Bến Tre nổi tiếng với những vườn dừa xanh mướt và sản phẩm dừa phong phú.', 'https://cloudinary.com/image53_travel1'),
(53, 'Bánh tráng Bến Tre', 'Bánh tráng Bến Tre nổi tiếng với hương vị thơm ngon, được làm từ gạo và dừa.', 'https://cloudinary.com/image53_food1'),

(54, 'Chùa Bà Chúa Xứ', 'Chùa Bà Chúa Xứ tại Trà Vinh là ngôi chùa nổi tiếng, với kiến trúc độc đáo và lễ hội truyền thống đặc sắc.', 'https://cloudinary.com/image54_travel1'),
(54, 'Bánh xèo Trà Vinh', 'Bánh xèo Trà Vinh có hương vị đặc biệt, giòn và thơm với nhân tôm, thịt và rau sống.', 'https://cloudinary.com/image54_food1'),

(55, 'Chợ Vĩnh Long', 'Chợ Vĩnh Long là điểm đến nổi tiếng tại Vĩnh Long, với nhiều mặt hàng đặc sản và trái cây tươi ngon.', 'https://cloudinary.com/image55_travel1'),
(55, 'Bánh canh Vĩnh Long', 'Bánh canh Vĩnh Long có nước dùng thơm ngon, ăn kèm với cá hoặc tôm, là món ăn đặc trưng của địa phương.', 'https://cloudinary.com/image55_food1'),

(56, 'Vườn Quốc gia Tràm Chim', 'Vườn Quốc gia Tràm Chim là một khu bảo tồn thiên nhiên nổi tiếng, với nhiều loài chim quý hiếm.', 'https://cloudinary.com/image56_travel1'),
(56, 'Bánh xèo Đồng Tháp', 'Bánh xèo Đồng Tháp có lớp vỏ giòn, nhân tôm, thịt và rau sống, rất được ưa chuộng tại đây.', 'https://cloudinary.com/image56_food1'),

(57, 'Chùa Nam Bộ', 'Chùa Nam Bộ là chùa lớn tại An Giang, nổi tiếng với những công trình kiến trúc độc đáo và các lễ hội tôn giáo.', 'https://cloudinary.com/image57_travel1'),
(57, 'Cá lóc nướng trui', 'Cá lóc nướng trui là đặc sản An Giang, được chế biến với hương vị đặc biệt, ăn kèm với rau sống và gia vị.', 'https://cloudinary.com/image57_food1'),

(58, 'Đảo Phú Quốc', 'Đảo Phú Quốc là khu nghỉ dưỡng nổi tiếng với bãi biển đẹp, khu vui chơi giải trí và các resort cao cấp.', 'https://cloudinary.com/image58_travel1'),
(58, 'Bánh hỏi Kiên Giang', 'Bánh hỏi Kiên Giang là món ăn đặc trưng với bánh hỏi mỏng, thịt heo nướng và gia vị thơm ngon.', 'https://cloudinary.com/image58_food1'),

(59, 'Bến Ninh Kiều', 'Bến Ninh Kiều là một điểm du lịch nổi tiếng tại Cần Thơ, nơi du khách có thể tham quan cảnh quan sông nước miền Tây.', 'https://cloudinary.com/image59_travel1'),
(59, 'Cơm gà Cần Thơ', 'Cơm gà Cần Thơ được chế biến từ gà ta và cơm thơm ngon, là món ăn phổ biến tại thành phố này.', 'https://cloudinary.com/image59_food1'),

(60, 'Cồn Sơn', 'Cồn Sơn là một đảo du lịch nổi tiếng tại Hậu Giang, với cảnh quan yên bình và các hoạt động ngoài trời.', 'https://cloudinary.com/image60_travel1'),
(60, 'Cháo cá Hậu Giang', 'Cháo cá Hậu Giang là món ăn đặc sản, được nấu từ cá đồng và gia vị truyền thống.', 'https://cloudinary.com/image60_food1'),

(61, 'Chùa Dơi', 'Chùa Dơi là một ngôi chùa cổ tại Sóc Trăng, nổi tiếng với kiến trúc và các nghi lễ truyền thống.', 'https://cloudinary.com/image61_travel1'),
(61, 'Bánh Pía Sóc Trăng', 'Bánh Pía là món bánh nổi tiếng tại Sóc Trăng, với vỏ bánh mỏng, nhân sầu riêng và thập cẩm.', 'https://cloudinary.com/image61_food1'),

(62, 'Công viên Hồ Nam', 'Công viên Hồ Nam là công viên lớn tại Bạc Liêu, với không gian xanh và các hoạt động giải trí.', 'https://cloudinary.com/image62_travel1'),
(62, 'Bánh tằm Bạc Liêu', 'Bánh tằm Bạc Liêu có hương vị đặc trưng, với bánh tằm mềm, nước cốt dừa và thịt ba chỉ.', 'https://cloudinary.com/image62_food1'),

(63, 'Rừng U Minh Hạ', 'Rừng U Minh Hạ là khu rừng nguyên sinh tại Cà Mau, với hệ động thực vật phong phú và là nơi lý tưởng cho các chuyến du lịch sinh thái.', 'https://cloudinary.com/image63_travel1'),
(63, 'Mắm Cà Mau', 'Mắm Cà Mau là đặc sản của vùng đất Cà Mau, với hương vị đậm đà và là món ăn gắn liền với văn hóa ẩm thực địa phương.', 'https://cloudinary.com/image63_food1');






INSERT INTO blog (provinceID, userID, blogContent, blogCreateDate, approve) VALUES 
(26, 9, 'Thanh Hóa là nơi có bãi biển Sầm Sơn nổi tiếng và những di tích lịch sử như thành Nhà Hồ. Các món ăn đặc trưng là nem chua, chè lam rất hấp dẫn.', '2024-11-05', true),
(19, 12, 'Hải Dương nổi tiếng với những món ăn như bánh đậu xanh, bánh cuốn. Đặc biệt, bạn có thể tham quan làng cổ Đông Giao với nét kiến trúc truyền thống.', '2024-11-02', true),
(8, 3, 'Lai Châu sở hữu những con đường đèo hùng vĩ và bản làng của các dân tộc thiểu số. Cảnh sắc thiên nhiên ở đây rất hoang sơ và yên bình.', '2024-11-03', true),
(17, 16, 'Vĩnh Phúc với hồ Đại Lải là nơi lý tưởng cho những ai muốn tìm kiếm không gian nghỉ dưỡng. Những món ăn dân dã nơi đây rất đáng thử, như cá kho Vĩnh Tường.', '2024-11-04', true),
(6, 4, 'Lào Cai là một trong những địa phương đẹp nhất Việt Nam với các thửa ruộng bậc thang tuyệt đẹp ở Sapa. Bạn có thể thưởng thức những món ăn như thịt gà đen, thắng cố.', '2024-11-06', true),
(25, 15, 'Ninh Bình không chỉ nổi tiếng với Tràng An mà còn có những hang động kỳ bí và những đầm sen thơm ngát. Đặc sản Ninh Bình không thể thiếu là cơm cháy.', '2024-11-07', true),
(4, 19, 'Bắc Kạn với hồ Ba Bể đẹp như tranh vẽ là một trong những điểm du lịch hấp dẫn, mang đến cho du khách một không gian yên tĩnh và thư giãn.', '2024-11-08', true),
(5, 20, 'Tuyên Quang là nơi mang đậm dấu ấn văn hóa dân tộc với các lễ hội như lễ hội Lồng Tồng. Khung cảnh thiên nhiên và ẩm thực nơi đây cũng rất đặc sắc.', '2024-11-09', true),
(23, 10, 'Hà Nam là nơi có những ngôi chùa cổ như chùa Bà Đanh và chùa Long Đọi Sơn. Du khách cũng không thể bỏ qua món chè bưởi ngon tuyệt tại đây.', '2024-11-10', true),
(15, 6, 'Bắc Giang là vùng đất nổi tiếng với các sản phẩm nông sản như vải thiều và nhãn lồng. Cảnh vật thiên nhiên ở đây rất thanh bình, là điểm đến lý tưởng cho những ai muốn tìm kiếm sự yên tĩnh.', '2024-11-11', true),
(34, 22, 'Quảng Ngãi có những bãi biển dài và cát trắng mịn màng. Bên cạnh đó, những món ăn đặc sản như bánh xèo Quảng Ngãi rất hấp dẫn du khách.', '2024-11-12', true),
(32, 18, 'Đà Nẵng không chỉ nổi tiếng với bãi biển Mỹ Khê mà còn có những món ăn đường phố tuyệt vời như bánh tráng cuốn thịt heo, bún chả cá.', '2024-11-13', true),
(2, 21, 'Hà Giang là mảnh đất của những cánh đồng hoa tam giác mạch và con đèo Mã Pí Lèng nổi tiếng. Cảnh sắc thiên nhiên hoang sơ nhưng rất thu hút.', '2024-11-14', true),
(11, 23, 'Hòa Bình có những khu du lịch sinh thái như khu du lịch hồ Hòa Bình, nơi bạn có thể thư giãn và thưởng thức món cá nướng rất ngon.', '2024-11-15', true),
(45, 5, 'Bình Phước là vùng đất của những cánh đồng cao su bạt ngàn, cùng với các món ăn đặc trưng như cá lóc nướng trui, đặc biệt thích hợp cho những ai yêu thích sự yên bình.', '2024-11-16', true),
(58, 12, 'Kiên Giang không chỉ nổi tiếng với biển đảo Phú Quốc mà còn có những món ăn ngon như hủ tiếu mì, cá lóc nướng muối ớt.', '2024-11-17', true),
(52, 28, 'Tiền Giang với vườn trái cây trĩu quả, nổi bật là trái sầu riêng và vú sữa, nơi đây cũng có những con sông lớn để bạn khám phá bằng thuyền.', '2024-11-18', true),
(61, 22, 'Sóc Trăng nổi tiếng với các món ăn đặc sản như bánh cống, bánh pía và các ngôi chùa Khmer mang đậm nét văn hóa đặc sắc.', '2024-11-19', true),
(30, 18, 'Quảng Trị là nơi mang đậm dấu ấn lịch sử với những di tích chiến tranh. Du khách có thể tham quan nghĩa trang Trường Sơn và thử những món ăn đặc trưng của miền Trung.', '2024-11-20', true),
(48, 2, 'Đồng Nai có những khu du lịch nổi tiếng như khu du lịch sinh thái Vườn Xoài và những món ăn dân dã như gà nướng, canh chua cá lóc.', '2024-11-21', true),
(36, 9, 'Khánh Hòa với bãi biển Nha Trang luôn thu hút du khách. Món ăn nổi bật là bún chả cá và hải sản tươi sống, rất thích hợp cho những ai yêu thích du lịch biển.', '2024-11-22', true),
(41, 16, 'Gia Lai là nơi có những cánh đồng cà phê xanh mướt, những rừng thông bạt ngàn và các món ăn đặc sản như bánh cuốn thịt heo, gà nướng.', '2024-11-23', true),
(53, 10, 'Bến Tre là xứ sở của dừa, bạn có thể thưởng thức những món ăn đặc sản làm từ dừa như kẹo dừa, nước dừa tươi, ngoài ra còn có các khu du lịch sinh thái rất thú vị.', '2024-11-24', true),
(33, 7, 'Quảng Nam với phố cổ Hội An đẹp như tranh vẽ, là nơi hội tụ của nhiều nền văn hóa. Bạn có thể thưởng thức cao lầu, mì Quảng ngay tại phố cổ.', '2024-11-25', true),
(44, 30, 'Lâm Đồng là thiên đường của những ngôi làng dân tộc, đặc biệt là ở Đà Lạt với những con đường hoa, và các món ăn như bánh mì xíu mại, kem bơ rất nổi tiếng.', '2024-11-26', true),
(39, 3, 'Bình Thuận là nơi có bãi biển Mũi Né nổi tiếng với những cồn cát trắng và các món ăn hải sản như mực nướng, cá dứa nướng muối ớt.', '2024-11-27', true),
(43, 15, 'Đắk Nông có những thác nước hùng vĩ như thác Dray Nur, cùng với các món ăn đặc trưng từ thịt rừng, mang đến cảm giác mộc mạc, hoang sơ rất đặc biệt.', '2024-11-28', true),
(29, 20, 'Quảng Bình nổi tiếng với động Phong Nha, Sơn Đoòng, và các bãi biển hoang sơ như Nhật Lệ. Món ăn đặc trưng là bánh bột lọc, bánh nậm.', '2024-11-29', true),
(50, 17, 'Hồ Chí Minh là trung tâm kinh tế sôi động nhất cả nước, nơi có các món ăn đường phố hấp dẫn như bánh mì, hủ tiếu và cà phê sữa đá.', '2024-11-30', true);


INSERT INTO userComment(blogID, userID, cmtContent, createDate )VALUES
(1,1,'Hanoi - Capital of Vietnam', '20/11/2024'),
(1,2,'Hanoi - 1000 years capital', '20/11/2024'),
(1,1,'Ho Chi Minh City - Must travel City', '20/11/2024'),
(2,1,'Food paradise  in HCMC ', '20/11/2024');

INSERT INTO repComment(provinceID, userID, blogContent, blogCreateDate )VALUES
(1,1, 'Hanoi - Capital of Vietnam', '20/11/2024'),
(1,2,'Hanoi - 1000 years capital', '20/11/2024'),
(3,1,'Ho Chi Minh City - Must travel City', '20/11/2024'),
(3,1,'Food paradise  in HCMC ', '20/11/2024');



INSERT INTO imgBlog(blogID, imgBlogURL) VALUES
(1, 'https://cloudinary.com/image1_1'),
(1, 'https://cloudinary.com/image1_2'),
(2, 'https://cloudinary.com/image2_1'),
(2, 'https://cloudinary.com/image2_2'),
(3, 'https://cloudinary.com/image3_1'),
(3, 'https://cloudinary.com/image3_2'),
(4, 'https://cloudinary.com/image4_1'),
(4, 'https://cloudinary.com/image4_2'),
(5, 'https://cloudinary.com/image5_1'),
(5, 'https://cloudinary.com/image5_2'),
(6, 'https://cloudinary.com/image6_1'),
(6, 'https://cloudinary.com/image6_2'),
(7, 'https://cloudinary.com/image7_1'),
(7, 'https://cloudinary.com/image7_2'),
(8, 'https://cloudinary.com/image8_1'),
(8, 'https://cloudinary.com/image8_2'),
(9, 'https://cloudinary.com/image9_1'),
(9, 'https://cloudinary.com/image9_2'),
(10, 'https://cloudinary.com/image10_1'),
(10, 'https://cloudinary.com/image10_2'),

(11, 'https://cloudinary.com/image11_1'),
(11, 'https://cloudinary.com/image11_2'),
(12, 'https://cloudinary.com/image12_1'),
(12, 'https://cloudinary.com/image12_2'),
(13, 'https://cloudinary.com/image13_1'),
(13, 'https://cloudinary.com/image13_2'),
(14, 'https://cloudinary.com/image14_1'),
(14, 'https://cloudinary.com/image14_2'),
(15, 'https://cloudinary.com/image15_1'),
(15, 'https://cloudinary.com/image15_2'),
(16, 'https://cloudinary.com/image16_1'),
(16, 'https://cloudinary.com/image16_2'),
(17, 'https://cloudinary.com/image17_1'),
(17, 'https://cloudinary.com/image17_2'),
(18, 'https://cloudinary.com/image18_1'),
(18, 'https://cloudinary.com/image18_2'),
(19, 'https://cloudinary.com/image19_1'),
(19, 'https://cloudinary.com/image19_2'),
(20, 'https://cloudinary.com/image20_1'),
(20, 'https://cloudinary.com/image20_2'),

(21, 'https://cloudinary.com/image21_1'),
(21, 'https://cloudinary.com/image21_2'),
(22, 'https://cloudinary.com/image22_1'),
(22, 'https://cloudinary.com/image22_2'),
(23, 'https://cloudinary.com/image23_1'),
(23, 'https://cloudinary.com/image23_2'),
(24, 'https://cloudinary.com/image24_1'),
(24, 'https://cloudinary.com/image24_2'),
(25, 'https://cloudinary.com/image25_1'),
(25, 'https://cloudinary.com/image25_2'),
(26, 'https://cloudinary.com/image26_1'),
(26, 'https://cloudinary.com/image26_2'),
(27, 'https://cloudinary.com/image27_1'),
(27, 'https://cloudinary.com/image27_2'),
(28, 'https://cloudinary.com/image28_1'),
(28, 'https://cloudinary.com/image28_2'),

(29, 'https://cloudinary.com/image29_1'),
(29, 'https://cloudinary.com/image29_2'),
(30, 'https://cloudinary.com/image30_1'),
(30, 'https://cloudinary.com/image30_2'),
(31, 'https://cloudinary.com/image31_1'),
(31, 'https://cloudinary.com/image31_2'),
(32, 'https://cloudinary.com/image32_1'),
(32, 'https://cloudinary.com/image32_2'),
(33, 'https://cloudinary.com/image33_1'),
(33, 'https://cloudinary.com/image33_2'),
(34, 'https://cloudinary.com/image34_1'),
(34, 'https://cloudinary.com/image34_2'),
(35, 'https://cloudinary.com/image35_1'),
(35, 'https://cloudinary.com/image35_2'),
(36, 'https://cloudinary.com/image36_1'),
(36, 'https://cloudinary.com/image36_2'),
(37, 'https://cloudinary.com/image37_1'),
(37, 'https://cloudinary.com/image37_2'),
(38, 'https://cloudinary.com/image38_1'),
(38, 'https://cloudinary.com/image38_2'),

(39, 'https://cloudinary.com/image39_1'),
(39, 'https://cloudinary.com/image39_2'),
(40, 'https://cloudinary.com/image40_1'),
(40, 'https://cloudinary.com/image40_2'),
(41, 'https://cloudinary.com/image41_1'),
(41, 'https://cloudinary.com/image41_2'),
(42, 'https://cloudinary.com/image42_1'),
(42, 'https://cloudinary.com/image42_2'),
(43, 'https://cloudinary.com/image43_1'),
(43, 'https://cloudinary.com/image43_2'),
(44, 'https://cloudinary.com/image44_1'),
(44, 'https://cloudinary.com/image44_2'),

(45, 'https://cloudinary.com/image45_1'),
(45, 'https://cloudinary.com/image45_2'),
(46, 'https://cloudinary.com/image46_1'),
(46, 'https://cloudinary.com/image46_2'),
(47, 'https://cloudinary.com/image47_1'),
(47, 'https://cloudinary.com/image47_2'),
(48, 'https://cloudinary.com/image48_1'),
(48, 'https://cloudinary.com/image48_2'),
(49, 'https://cloudinary.com/image49_1'),
(49, 'https://cloudinary.com/image49_2'),
(50, 'https://cloudinary.com/image50_1'),
(50, 'https://cloudinary.com/image50_2'),
(51, 'https://cloudinary.com/image51_1'),
(51, 'https://cloudinary.com/image51_2'),
(52, 'https://cloudinary.com/image52_1'),
(52, 'https://cloudinary.com/image52_2'),
(53, 'https://cloudinary.com/image53_1'),
(53, 'https://cloudinary.com/image53_2'),
(54, 'https://cloudinary.com/image54_1'),
(54, 'https://cloudinary.com/image54_2'),

(55, 'https://cloudinary.com/image55_1'),
(55, 'https://cloudinary.com/image55_2'),
(56, 'https://cloudinary.com/image56_1'),
(56, 'https://cloudinary.com/image56_2'),
(57, 'https://cloudinary.com/image57_1'),
(57, 'https://cloudinary.com/image57_2'),
(58, 'https://cloudinary.com/image58_1'),
(58, 'https://cloudinary.com/image58_2'),
(59, 'https://cloudinary.com/image59_1'),
(59, 'https://cloudinary.com/image59_2'),
(60, 'https://cloudinary.com/image60_1'),
(60, 'https://cloudinary.com/image60_2'),
(61, 'https://cloudinary.com/image61_1'),
(61, 'https://cloudinary.com/image61_2'),
(62, 'https://cloudinary.com/image62_1'),
(62, 'https://cloudinary.com/image62_2'),
(63, 'https://cloudinary.com/image63_1'),
(63, 'https://cloudinary.com/image63_2');
