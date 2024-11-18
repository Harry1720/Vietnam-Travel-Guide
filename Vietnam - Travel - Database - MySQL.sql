CREATE DATABASE IF NOT EXISTS vietnamtravel;
USE vietnamtravel;

CREATE TABLE users (
  userID INT AUTO_INCREMENT PRIMARY KEY,
  userName VARCHAR(50) NOT NULL,
  pass_word VARCHAR(255) NOT NULL,
  address_ VARCHAR(250) NOT NULL,
  role_ VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL UNIQUE,
  gender VARCHAR(10) NOT NULL,
  status BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE province (
  provinceID INT AUTO_INCREMENT PRIMARY KEY,
  provinceName VARCHAR(50) NOT NULL UNIQUE,
  provinceRegion VARCHAR(20) NOT NULL,
  status BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE destination (
  destinationID INT AUTO_INCREMENT PRIMARY KEY,
  provinceID INT NOT NULL,
  destinationName VARCHAR(50) NOT NULL,
  destinationContent TEXT NOT NULL,
  imgDesURL TEXT NOT NULL,
  FOREIGN KEY (provinceID) REFERENCES province(provinceID)
);

CREATE TABLE post (
  postID INT AUTO_INCREMENT PRIMARY KEY,
  provinceID INT NOT NULL, 
  postCreateDate DATE NOT NULL,
  imgPostURL TEXT NOT NULL,
  status BOOLEAN NOT NULL DEFAULT TRUE,
  FOREIGN KEY (provinceID) REFERENCES province(provinceID)
);

-- Bảng postDetail (Thêm trạng thái)
CREATE TABLE postDetail (
  postDetailID INT AUTO_INCREMENT PRIMARY KEY,
  postID INT NOT NULL,
  sectionTitle TEXT NOT NULL,
  sectionContent MEDIUMTEXT NOT NULL,
  imgPostDetURL TEXT,
  FOREIGN KEY (postID) REFERENCES post(postID)
);

CREATE TABLE blog (
  blogID INT AUTO_INCREMENT PRIMARY KEY,
  provinceID INT NOT NULL,
  userID INT NOT NULL,
  blogTitle TEXT NOT NULL,
  blogContent TEXT NOT NULL,
  blogCreateDate DATE NOT NULL,
  status BOOLEAN NOT NULL DEFAULT TRUE,
  approvalStatus VARCHAR(20) NOT NULL DEFAULT 'Chờ Duyệt',
  FOREIGN KEY (userID) REFERENCES users(userID),
  FOREIGN KEY (provinceID) REFERENCES province(provinceID)
);

CREATE TABLE imgBlog (
  imgID INT AUTO_INCREMENT PRIMARY KEY,
  blogID INT NOT NULL, 
  imgBlogURL TEXT NOT NULL,
  FOREIGN KEY (blogID) REFERENCES blog(blogID)
);

CREATE TABLE userComment (
  commentID INT AUTO_INCREMENT PRIMARY KEY,
  blogID INT NOT NULL, 
  userID INT NOT NULL, 
  cmtContent TEXT NOT NULL,
  createDate DATE NOT NULL,
  status BOOLEAN NOT NULL DEFAULT TRUE,
  FOREIGN KEY (blogID) REFERENCES blog(blogID),
  FOREIGN KEY (userID) REFERENCES users(userID)
);

CREATE TABLE repComment (
  repCommentID INT AUTO_INCREMENT PRIMARY KEY,
  commentID INT NOT NULL, 
  userID INT NOT NULL, 
  repContent TEXT NOT NULL,
  createDateRep DATE NOT NULL,
  status BOOLEAN NOT NULL DEFAULT TRUE,
  FOREIGN KEY (commentID) REFERENCES userComment(commentID),
  FOREIGN KEY (userID) REFERENCES users(userID)
);

INSERT INTO users (userName, pass_word, address_, role_, email, gender, status)
VALUES
('Trần Anh Quân', 'admin1', 'TP Hồ Chí Minh', 'Admin', 'admin@gmail.com', 'Male', TRUE),
('Trần Ngọc Anh', 'password9', 'Hà Nội', 'admin', 'ngocanh@example.com', 'Female', TRUE);

-- Dữ liệu cho bảng province
INSERT INTO province (provinceName, provinceRegion, status)
VALUES
('Hà Nội', 'North', TRUE),
('TP Hồ Chí Minh', 'South', TRUE),
('Đà Nẵng', 'Central', TRUE),
('Cần Thơ', 'South', TRUE),
('Quảng Bình', 'Central', TRUE),
('Quảng Ninh', 'North', TRUE),
('Khánh Hòa', 'Central', TRUE),
('Quảng Nam', 'Central', TRUE),
('Thừa Thiên Huế', 'Central', TRUE),
('Ninh Bình', 'North', TRUE),

('Thanh Hóa', 'Central', TRUE),
('Bắc Ninh', 'North', TRUE),
('Nghệ An', 'Central', TRUE),
('Quảng Trị', 'Central', TRUE),
('Quảng Ngãi', 'Central', TRUE),
('Bình Định', 'Central', TRUE),
('Đắk Lắk', 'Central', TRUE),
('Lâm Đồng', 'Central', TRUE),
('Hải Phòng', 'North', TRUE),	
('Hà Giang', 'North', TRUE),

('Cao Bằng', 'North', TRUE),
('Bà Rịa - Vũng Tàu', 'South', TRUE),
('Phú Yên', 'Central', TRUE),
('Ninh Thuận', 'Central', TRUE),
('Bình Thuận', 'Central', TRUE),
('Gia Lai', 'Central', TRUE),
('Đồng Nai', 'South', TRUE),
('Long An', 'South', TRUE),
('Tiền Giang', 'South', TRUE),
('Cà Mau', 'South', TRUE),

('Bắc Kạn', 'North', TRUE),
('Tuyên Quang', 'North', TRUE),
('Lào Cai', 'North', TRUE),
('Điện Biên', 'North', TRUE),
('Lai Châu', 'North', TRUE),
('Sơn La', 'North', TRUE),
('Yên Bái', 'North', TRUE),
('Hòa Bình', 'North', TRUE),
('Thái Nguyên', 'North', TRUE),
('Lạng Sơn', 'North', TRUE),

('Bắc Giang', 'North', TRUE),
('Phú Thọ', 'North', TRUE),
('Vĩnh Phúc', 'North', TRUE),
('Hải Dương', 'North', TRUE),
('Hưng Yên', 'North', TRUE),
('Thái Bình', 'North', TRUE),
('Hà Nam', 'North', TRUE),
('Nam Định', 'North', TRUE),
('Hà Tĩnh', 'Central', TRUE),
('Kon Tum', 'Central', TRUE),

('Đắk Nông', 'Central', TRUE),
('Bình Phước', 'South', TRUE),
('Tây Ninh', 'South', TRUE),
('Bình Dương', 'South', TRUE),
('Bến Tre', 'South', TRUE),
('Trà Vinh', 'South', TRUE),
('Vĩnh Long', 'South', TRUE),
('Đồng Tháp', 'South', TRUE),
('An Giang', 'South', TRUE),
('Kiên Giang', 'South', TRUE),

('Hậu Giang', 'South', TRUE),
('Sóc Trăng', 'South', TRUE),
('Bạc Liêu', 'South', TRUE);

-- Dữ liệu cho bảng destination
INSERT INTO destination (provinceID, destinationName, destinationContent, imgDesURL)
VALUES
(1, 'Hồ Hoàn Kiếm', 'Biểu tượng Thủ đô Việt Nam', 'https://res.cloudinary.com/dt5xizv10/image/upload/destination/hoankiem'),
(1, 'Lăng Chủ tịch Hồ Chí Minh', 'Di tích Quốc gia', 'https://res.cloudinary.com/dt5xizv10/image/upload/destination/hn'),
(2, 'TP Hồ Chí Minh', 'Thành phố đáng sống', 'https://res.cloudinary.com/dt5xizv10/image/upload/destination/hcm'),
(3, 'Biển Mỹ Khê', 'Bãi biển nối tiếng thế giới', 'https://res.cloudinary.com/dt5xizv10/image/upload/destination/mykhe'),
(15, 'Đảo Lý Sơn', 'Thiên đường biển đảo tại Quảng Ngãi','https://res.cloudinary.com/dt5xizv10/image/upload/destination/lyson'),
(17, 'Thác Đray Nur', 'Thác nước nổi tiếng tại Đắk Lắk', 'https://res.cloudinary.com/dt5xizv10/image/upload/destination/draynu'),
(21, 'Thác Bản Giốc', 'Thác nước đẹp như tranh vẽ ở biên giới Việt - Trung.', 'https://res.cloudinary.com/dt5xizv10/image/upload/destination/bgioc'),
(26, 'Biển Hồ', 'Hồ nước đẹp tại Gia Lai', 'https://res.cloudinary.com/dt5xizv10/image/upload/destination/pleiku'),
(33, 'Đỉnh Fansipan', 'Nóc nhà Đông Dương', 'https://res.cloudinary.com/dt5xizv10/image/upload/destination/fansi'),
(60, 'Đảo Phú Quốc', 'Khu nghỉ dưỡng nổi tiếng tại Kiên Giang', 'https://res.cloudinary.com/dt5xizv10/image/upload/destination/pquoc');


-- Dữ liệu cho bảng post
INSERT INTO post (provinceID, postCreateDate, imgPostURL, status)
VALUES
(1, '2023-11-01', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/hanoi.jpg', TRUE),
(2, '2023-11-02', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/tphcm.jpg', TRUE),
(3, '2023-11-03', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/dn.jpg', TRUE),
(4, '2023-11-04', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/ctho.jpg', TRUE),
(5, '2023-11-05', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/qb.jpg', TRUE),
(6, '2023-11-06', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/qninh.jpg', TRUE),
(7, '2023-11-07', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/ntrang.jpg', TRUE),
(8, '2023-11-08', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/qn.jpg', TRUE),
(9, '2023-11-09', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/hue.jpg', TRUE),
(10, '2023-11-09', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/nb.jpg', TRUE),

(11, '2023-11-10', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/thoa.jpg', TRUE),
(12, '2023-11-11', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/bninh.jpg', TRUE),
(13, '2023-11-12', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/nghean.jpg', TRUE),
(14, '2023-11-13', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/qtri.jpg', TRUE),
(15, '2023-11-14', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/qngai.jpg', TRUE),
(16, '2023-11-15', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/bdinh.jpg', TRUE),
(17, '2023-11-16', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/dlak.jpg', TRUE),
(18, '2023-11-17', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/dlat.jpg', TRUE),
(19, '2023-11-18', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/hphong.jpg', TRUE),
(20, '2023-11-18', 'https://res.cloudinary.com/dt5xizv10/image/upload/post/hgiang.jpg', TRUE);


INSERT INTO postDetail  (postID, sectionTitle, sectionContent, imgPostDetURL)
VALUES
(1, 'Hà Nội - Thủ đô văn hiến', 'Những công trình từ thời Pháp thuộc, hàng quán vỉa hè bày bán đặc sản địa phương, xe máy luồn lách trên đường đông đúc... là những ấn tượng đầu tiên của du khách về Hà Nội. Với nhiều người, Hà Nội có tất cả những thứ thú vị để khám phá nơi đây theo cách riêng của mình.', 'https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/hanoi.jpg'),
(1, 'Di Chuyển', 'Hà Nội được ví như trái tim của Việt Nam, do đó du khách có thể di chuyển thuận lợi đến thủ đô bằng máy bay, tàu hỏa, xe khách, ôtô riêng hay xe máy từ các tỉnh thành khác.', ''),
(1, 'Lưu trú', 'Hà Nội có nhiều lựa chọn lưu trú cho du khách như nhà nghỉ bình dân, homestay, khách sạn, resort... Một số khách sạn đặc biệt phải kể đến như Sofitel Legend Metropole Hà Nội mang nét kiến trúc thời thuộc địa Pháp, chỉ cách Nhà hát Lớn vài bước chân là Hilton Hanoi Opera, Apricot Hotel ngay bên bờ hồ Hoàn Kiếm, khách sạn nổi tiếng với view ngắm hồ Tây là Sheraton Hà Nội và InterContinental Hanoi Westlake.', 'https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/luutru.jpg'),
(1, 'Tham quan', 'Lăng chủ tịch Hồ Chí Minh, đối với người Việt, đây là một trong những điểm tham quan quan trọng nhất trong nước. Du khách tới để bày tỏ lòng thành kính với Chủ tịch Hồ Chí Minh. Khách tham quan cần giữ im lặng, mặc quần áo phù hợp và không chụp ảnh tại những khu vực cấm.', 'https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/langBac.jpg'),
(1, 'Ẩm thực', 'Đến Hà Nội không thể bỏ qua phở, đặc biệt là phở bò, thường có hai loại chính: chín và tái. Một số địa chỉ tham khảo là phở Thìn, Bát Đàn, Tư Lùn, Phở Lâm phố Hàng Vải, Phở Trâm phố Yên Ninh.', 'https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/pho'),

(2, 'TPHCM - TP mang tên Bác', 'TP HCM là nơi hội tụ nhiều nền văn hóa, là trung tâm kinh tế chính của cả nước, với các sản phẩm du lịch đa dạng, là "thành phố không ngủ" với những hoạt động vui chơi, giải trí sôi động cả ngày lẫn đêm.', 'https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/tphcm'),
(2, 'Di Chuyển', 'Là thành phố lớn nên việc di chuyển đến TP HCM thuận tiện, với đầy đủ phương tiện giao thông gồm máy bay, tàu hỏa, tàu biển, ôtô...Các hãng hàng không nội địa đều khai thác chuyến bay thẳng đến sân bay Tân Sơn Nhất từ nhiều địa phương mỗi ngày. TP HCM là nơi có các chuyến đi và đến có tần suất lớn nhất cả nước. Giá vé khứ hồi từ đến TP HCM dao động từ 2 đến 4 triệu đồng, tùy nơi xuất phát và thời điểm mua vé. Đường bộ nối miền Nam và miền Bắc có hai tuyến chính: quốc lộ 1A và đường mòn Hồ Chí Minh. Tùy theo nhu cầu, các điểm đến trên hành trình mà du khách lựa chọn tuyến đường phù hợp.', ''),
(2, 'Lưu trú','Dịch vụ lưu trú tại TP HCM đa dạng với hệ thống khách sạn, homestay, căn hộ dịch vụ, đáp ứng nhu cầu của du khách. Có thể tìm được phòng nghỉ với mức giá từ vài trăm nghìn đến hàng chục triệu đồng một đêm. Có nhiều khách sạn 5 sao mức giá khoảng 3-7 triệu đồng như Park Hyatt Sài Gòn, Hotel Majestic Saigon, Hotel des Arts Saigon, Pullman Saigon Centre, Hotel Nikko Saigon, Norfolk Mansion, La Vela Saigon. Ở phân khúc tầm trung 1-2 triệu đồng, du khách có thể tham khảo các khách sạn như Wink Hotel Saigon Centre, La Memoria Hotel, The Hammock Hotel Ben Thanh, Millennium Boutique Hotel, The Odys Boutique Hotel. Căn hộ dịch vụ với đầy đủ tiện nghi như căn hộ thông thường nhưng được trang trí đẹp mắt phù hợp nhu cầu du lịch. Một số địa chỉ du khách có thể tham khảo gồm Ariosa, The Bloom, City Oasis, S Home, M Village Boutique. Các căn hộ dịch vụ có mức giá từ 800.000 đồng đến 2 triệu đồng. Homestay có mức giá chưa đến 1 triệu đồng mỗi phòng. Một số địa chỉ homestay ở trung tâm có thể kể đến Nấp Saigon, Home, Hostie Saigon Wanderlust Home, Cactusland Homestay, Zooz Studio. Ngoài ra, còn có nhiều nhà nghỉ bình dân khác. Du khách có thể tham khảo đặt phòng tại Agoda hay Booking.',''),	
(2, 'Vui chơi', 'Phố đi bộ Nguyễn Huệ, quận 1, được xem là điểm đến quen thuộc của cả du khách và người dân địa phương. Phố đi bộ Nguyễn Huệ dài hơn 670 m, bắt đầu từ trụ sở UBND TP HCM đến công viên Bạch Đằng và cắt qua một số con đường như: Lê Lợi, Tôn Thất Đạm, Ngô Đức Kế, Hải Triều. Tuyến phố thường là địa điểm tổ chức các hoạt động văn hóa, nghệ thuật lớn của thành phố.', 'https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/nguyenhue'),
(2, 'Ăn uống', 'Từ những đặc trưng chung: nhanh gọn, tiện lợi, rẻ tiền, bánh mì và cà phê ngẫu nhiên trở thành một cặp đôi ăn ý đến lạ và không thể tách rời. Cắn một miếng bánh mì sau đó uống một ngụm cà phê sẽ càng tăng thêm sự kích thích của vị giác. Vị thơm, đắng đặc trưng của cà phê hòa quyện với vị bùi, béo… của bánh mì khiến bữa sáng càng trở nên hấp dẫn hơn bao giờ hết. Chỉ cần ăn một ổ bánh mì, uống 1 ly cà phê vào buổi sáng, vậy là đủ tỉnh táo và tràn đày năng lượng để bắt đầu một ngày làm việc.','https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/banhmi'),	

(3,'Đà Nẵng','Thành phố Đà Nẵng nằm ở miền Trung, chia đều khoảng cách giữa thủ đô Hà Nội và TP HCM. Đà Nẵng còn là trung tâm của 3 di sản văn hóa thế giới là Cố đô Huế, phố cổ Hội An và thánh địa Mỹ Sơn. Phía bắc Đà Nẵng giáp tỉnh Thừa Thiên - Huế, phía tây và nam giáp tỉnh Quảng Nam, phía đông giáp biển Đông.','https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/dn'),
(3,'Di chuyển','Du khách từ Hà Nội và TP HCM thường di chuyển bằng máy bay, với giá vé khoảng 1.300.000 - 3.000.000 đồng khứ hồi, tùy thời điểm đặt. Thời gian bay khoảng 1 tiếng. Dư dả thời gian hơn, du khách có thể đi tàu hỏa để trải nghiệm ngắm cảnh dọc đường, đặc biệt là đoạn qua đèo Hải Vân nếu bạn đi từ phía bắc vào.',''),	
(3,'Khách sạn và resort','Du lịch tại Đà Nẵng phát triển nhanh chóng. Dọc con đường ven biển, du khách dễ dàng tìm thấy các khách sạn với nhiều mức giá khác nhau. Bên cạnh đó, Đà Nẵng còn có rất nhiều hình thức lưu trú khác như homestay, căn hộ, phòng tập thể nằm trong trung tâm. Tùy theo túi tiền và nhu cầu mà du khách có thể lựa chọn phù hợp, nhưng nên đặt trước để tránh tình trạng cháy phòng vào cuối tuần, mùa cao điểm. Những resort, khách sạn 5 sao nổi tiếng ở Đà Nẵng bạn có thể tham khảo gồm InterContinental Đà Nẵng Sun Peninsula Resort, Hyatt Regency Danang Resort and Spa, Pullman, Furama Resort Danang, Four Points by Sheraton Danang, Novotel, Hilton, Fusion Suites, Danang Golden Bay Hotel... Giá phòng dao động từ 1.200.000 đến 10.000.000 đồng một đêm.','https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/ksdn'),	
(3,'Chơi đâu','Được ví như viên ngọc quý của Đà Nẵng, bán đảo Sơn Trà đây sở hữu cánh rừng nguyên sinh rộng lớn và nhiều bãi tắm đẹp như Tiên Sa, Đá Đen, bãi Bụt... Con đường trên bán đảo uốn lượn đi qua các vị trí có thể ngắm toàn cảnh thành phố từ trên cao như đỉnh Bàn Cờ, chùa Linh Ứng, nhà Vọng Cảnh, hải đăng Sơn Trà, trạm radar "mắt thần Đông Dương".','https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/sontra'),	
(3,'Đặc sản','Bánh xèo nem lụi, Các quán bánh xèo ngon tập trung ở đường Hoàng Diệu, Trưng Nữ Vương, Châu Thị Vĩnh Tế, Đống Đa. Giá cả trung bình từ 20.000 đến 100.000 đồng một phần tùy số lượng bánh và nem. Bánh xèo miền Trung thường nhỏ bằng cái đĩa nên có độ giòn và khi cuốn bánh tráng vừa vặn hơn. Gia vị ăn kèm là nước tương nóng, vị vừa phải để chấm bánh.','https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/banhxeo'),	

(4, 'Cần Thơ', 'Vốn được mệnh danh là Tây Đô  Thủ phủ của miền Tây Nam bộ từ hơn trăm năm trước, Cần Thơ là một trong những điểm đến hấp dẫn bậc nhất phía Nam. Cần Thơ nằm ở trung tâm của đồng bằng sông Cửu Long, thuộc vùng hạ lưu sông Mekong. Mặc cho tốc độ kinh tế phát triển nhanh, "Tây Đô" vẫn giữ lại những nét văn hoá đặc trưng của miền sông nước. Dưới đây là những gợi ý để du khách có thể thoải mái khám phá hết những điểm đến nổi tiếng của thủ phủ miền Tây.', 'https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/chonoi'),	
(4, 'Di chuyển', 'Từ thủ đô Hà Nội và Đà Nẵng bạn có thể mua vé máy bay của các hãng Vietnam Airlines, Bamboo Airways và Vietjet Air... Giá vé khứ hồi khoảng 1.700.000 đến 2.000.000 đồng. Từ TP HCM, du khách có thể đi xe máy hoặc ôtô, chạy theo quốc lộ 1A là đến Cần Thơ. Quãng đường di chuyển khoảng gần 170 km, hết 3 đến 4 tiếng vào ban ngày.', ''),	
(4, 'Khách sạn, resort', 'Du khách có thể chọn nghỉ homestay ở trung tâm thành phố hoặc resort bên sông tuỳ theo túi tiền. Một số điểm lưu trú cao cấp là Azerai Cần Thơ Resort và Victoria Can Tho Resort, giá từ khoảng 1.200.000 đến 5.000.000 đồng một đêm.', 'https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/aze'),	
(4, 'Chơi đâu', 'Sau ngày dài rong chơi, buổi tối bạn nên tới bến Ninh Kiều, lên cầu tình yêu, đi chợ đêm để cảm nhận hết nhịp sống Cần Thơ. Bến Ninh Kiều được xây dựng thành công viên với diện tích khoảng 7. 000 m2. Buổi tối, nơi đây thu hút rất nhiều du khách và người dân địa phương ra ngắm cảnh, hóng mát. Bến Ninh Kiều nằm ngay ngã ba sông Hậu và sông Cần Thơ, gần trung tâm thành phố Cần Thơ. Từ bến Ninh Kiều du khách có thể nhìn thấy cầu Cần Thơ, đây từng là cây cầu có nhịp chính dài nhất Đông Nam Á vào năm 2010.', 'https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/ninhkieu'),
(4, 'Ăn gì', 'Bún gỏi dà: Món ăn có vị khá giống bún mắm. Nước lèo chua vị me và có mùi đặc trưng của tương hột. Đây là điểm nhấn khiến món ăn dễ nhận biết hơn. Ngoài bún trắng, một tô còn có tôm lột màu đỏ. Nhiều nơi cho thêm ít dừa nạo hoặc trứng vịt lộn để đậm đà hơn. Giá một tô là 30.000 đồng.', 'https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/bun'),
	
(5,'Quảng Bình','Tỉnh Quảng Bình nằm ở Bắc Trung Bộ, phía bắc giáp Hà Tĩnh, phía nam giáp Quảng Trị, phía tây giáp Lào còn phía đông là Biển Đông. Thủ phủ của Quảng Bình là thành phố Đồng Hới, ngoài ra có thị xã Ba Đồn và các huyện Bố Trạch, Lệ Thuỷ, Minh Hoá, Quảng Ninh, Quảng Trạch, Tuyên Hoá.','https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/phongnha'),
(5,'Di chuyển','TP Đồng Hới cách Hà Nội khoảng 500 km, cách TP HCM khoảng 1.000 km. Các phương tiện tới TP Đồng Hới khá đa dạng, thuận tiện cho du khách. Từ Hà Nội và TP HCM có các chuyến bay thẳng tới Đồng Hới với giá vé khứ hồi từ 2 đến 3 triệu đồng. Tần suất các chuyến bay tới Quảng Bình không nhiều, thường chỉ có 2 chuyến mỗi ngày. Thời gian bay Hà Nội - Đồng Hới gần 1 tiếng, TP HCM - Đồng Hới gần 2 tiếng.',''),	
(5,'Lưu trú','Dịch vụ lưu trú ở Quảng Bình phát triển và nhiều lựa chọn từ khách sạn, nhà nghỉ cho đến homestay, farmstay hoặc cắm trại. Meliá Vinpearl Quảng Bình, Mường Thanh Holiday, Mường Thanh Luxury Nhật Lệ, Sun Spa Resort, Celina Peninsula Resort, Gold Coast,..các khu nghỉ gần gũi với thiên nhiên như Chày Lập Farmstay, Nguyen Shack - Phong Nha Eco, Phong Nha Coco Riverside, Phong Nha Lake House, Lucky Home... Mỗi đêm ở đây giá từ 400.000 đến 2 triệu đồng một phòng hai người.','https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/vinQB'),
(5,'Điểm tham quan và vui chơi','Vườn quốc gia Phong Nha - Kẻ Bàng Vườn Quốc gia Phong Nha - Kẻ Bàng được UNESCO công nhận là Di sản thiên nhiên thế giới. Nơi đây có hơn 400 hang động có tổng chiều dài 220 km, ba sông chính là sông Chày, sông Son và sông Troóc. Vườn quốc gia thuộc huyện Bố Trạch và Minh Hóa, cách TP Đồng Hới khoảng 50 km. Hang Sơn Đoòng hiện là hang động tự nhiên lớn nhất thế giới, được hình thành khoảng 2-5 triệu năm trước, có chiều rộng 150 m, cao hơn 200 m, chiều dài gần 9 km. Ước tính dung tích của Hang Sơn Đoòng là 38,5 triệu m3. Các cột nhũ đá của hang cao 14 m. Trong hang còn có dòng sông ngầm dài 2,5 km. Hang có những quần thể san hô và di tích thú hóa thạch. Sơn Đoòng còn có hai "giếng trời", là hai nơi có ánh nắng chiếu, tạo điều kiện cho cây cối phát triển như một khu rừng nhiệt đới, một trong đó được gọi là "vườn Edam".','https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/sondoong'),
(5,'Ẩm thực','Bún chả cá thác lác có nước dùng nấu từ xương cá hoặc xương lợn, ăn kèm hành tím ngâm, ớt xắt lát. Rau sống ăn kèm là xà lách và hoa chuối. Mỗi tô được bán với giá khoảng 30.000 đồng, thích hợp ăn sáng.','https://res.cloudinary.com/dt5xizv10/image/upload/postDetail/bunqb'),

(6, 'Quảng Ninh','Là một tỉnh ở địa đầu phía đông bắc Việt Nam, Quảng Ninh được ví như một Việt Nam thu nhỏ. Phía tây tựa lưng vào núi, phía đông nghiêng xuống nửa phần đầu vịnh Bắc Bộ với bờ biển dài khoảng 250 km, nhiều cửa sông. Quảng Ninh có biên giới trên đất liền và hải phận giáp với Trung Quốc. Trên đất liền, phía bắc của tỉnh giáp với Quảng Tây, Trung Quốc; phía đông là vịnh Bắc Bộ; phía tây giáp các tỉnh Lạng Sơn, Bắc Giang, Hải Dương; phía nam giáp Hải Phòng. Quảng Ninh là tỉnh có nhiều thành phố nhất cả nước, với bốn thành phố: Hạ Long, Uông Bí, Cẩm Phả và Móng Cái. Bên cạnh đó là hai thị xã Đông Triều và Quảng Yên, hai huyện đảo là Vân Đồn và Cô Tô.',''), 
(6,'Di chuyển','Giao thông đến Quảng Ninh dễ dàng và thuận tiện dù bạn đi máy bay, ôtô, xe máy, xe khách... Quảng Ninh có sân bay quốc tế Vân Đồn, kết nối một số tỉnh thành trong nước như TP HCM, Đà Nẵng, Phú Quốc... và có các đường bay tới Trung Quốc, Nhật Bản, Hàn Quốc...',''),	
(6,'Nghỉ dưỡng, lưu trú','Khách sạn, khu nghỉ dưỡng ở Hạ Long rất đa dạng về cả phân khúc lẫn giá cả. Bạn có thể thoải mái lựa chọn tùy theo nhu cầu, tài chính và lịch trình. Một trải nghiệm nên thử là ngủ đêm trên vịnh Hạ Long hoặc Bái Tử Long, với những hãng du thuyền được đánh giá cao như Paradise, Indochine, Scarlet Pearl, Stellar of the Seas, Dragon Legend, Bhaya, Emeraude... Giá từ khoảng 2.000.000 đồng một người cho tour 2 ngày 1 đêm.',''),	
(6,'Biển đảo','Vịnh Hạ Long đã được UNESCO công nhận là di sản thiên nhiên thế giới và di sản thế giới bởi giá trị địa chất địa mạo. Thiên nhiên ban tặng cho Hạ Long cảnh sắc tuyệt đẹp cùng một nền văn hóa có chiều sâu, hoạt động du lịch tại đây rất đa dạng. Toàn bộ vịnh có gần 2.000 đảo đá vôi, trong đó có khoảng 900 đảo đã đặt tên, với đủ mọi hình dạng. Các đảo đá chỗ thì tập trung, có nơi lại tách rời, tạo nên nét chấm phá cho vịnh Hạ Long. Trên một số đảo có hệ thống hang nhũ đá kỳ thú để du khách chiêm ngưỡng như hang Sửng Sốt, hang Trống, hang Trinh Nữ , hang Luồn, hang Đầu Gỗ, động Kim Quy, động Mê Cung...',''),	
(6,'Ẩm thực','Mực hấp ổi: Sử dụng lá ổi làm nguyên liệu khiến món này có vị chát đặc trưng, lại thêm chua nhẹ từ nước me, phù hợp ăn cùng cơm hoặc chấm mắm gừng ớt. Một số địa chỉ gợi ý gồm khu du lịch Bãi Cháy, Vườn Đào, chợ Cái Dăm, Bến Đoan...',''),

(7,'Khánh Hòa','Khánh Hòa là tỉnh ven biển, thuộc vùng Nam Trung Bộ, thủ phủ là thành phố Nha Trang. Khánh Hòa giáp Phú Yên ở phía bắc, phía tây giáp Đắk Lắk và Lâm Đồng, phía nam giáp Ninh Thuận và phía đông giáp biển, với đường bờ biển dài 380 km. Quần đảo Trường Sa thuộc Khánh Hòa.',''),
(7,'Di chuyển','Là trung tâm du lịch lớn của cả nước nên di chuyển tới Khánh Hòa thuận tiện từ đường bộ, đường không, đường sắt đến đường thủy.',''),
(7,'Lưu trú','Tại TP Nha Trang, du khách có thể chọn các khu khách sạn bình dân trong phố, các homestay, với giá từ 200.000 đồng một đêm. Dọc đường Trần Phú có các khách sạn cao cấp hơn như Mường Thanh, Melia Vinpearl, InterContinental, Sheraton với giá dao động từ một đến bốn triệu đồng một đêm. Cam Ranh tập trung nhiều resort, tiêu chuẩn sao quốc tế như: Ana Mandara Cam Ranh, The Anam Cam Ranh, Movenpick resort, Radisson Blu Resort, Meliá Vinpearl Cam Ranh Beach Resort, Cam Ranh Riviera Beach Resort & Spa, Selectum Noa Resort Cam Ranh, Duyên Hà resort, Alma Resort. Ở khu vực vịnh Ninh Vân, Six Senses Ninh Van Bay là khu nghỉ dưỡng có cảnh đẹp và không gian riêng tư. Giá phòng tại đây từ 15 triệu đồng một đêm. Ngoài ra còn có An Lam Retreats Ninh Van Bay, LAlya Ninh Van Bay, giá khoảng 10 triệu đồng một đêm.',''),
(7,'Tham quan','Thành phố Nha Trang',''),
(7,'Ẩm thực','Bánh căn','Nhắc đến ẩm thực Nha Trang nói riêng và Khánh Hòa nói chung, bánh căn thường lọt vào danh sách món ăn "phải thử". Những chiếc bánh nhỏ, giòn xốp, nướng bằng khuôn đất nung, không bị ngấy dầu mỡ, với nhân bánh thường là trứng, mực, tôm. Bánh căn ăn kèm với nước mắm chua ngọt, mỡ hành.'),

(8,'Quảng Nam','Tỉnh Quảng Nam nằm ở khu vực Nam Trung Bộ, trong vùng kinh tế trọng điểm miền Trung, cách Hà Nội 820 km về phía bắc, thành phố Đà Nẵng 60 km về phía bắc và TP HCM 900 km về phía nam. Quảng Nam giáp thành phố Đà Nẵng, tỉnh Thừa Thiên Huế, Kon Tum và Quảng Ngãi, đường bờ biển dài 125 km và gần 160 km đường biên giới với Lào. Thủ phủ của tỉnh là thành phố Tam Kỳ, ngoài ra còn có đô thị cổ Hội An, thị xã Điện Bàn và 15 huyện. Quảng Nam cũng là địa phương có nhiều di sản văn hóa thế giới được UNESCO công nhận nhất cả nước, gồm phố cổ Hội An và thánh địa Mỹ Sơn.',''),
(8,'Di chuyển','Có nhiều phương tiện để đến Quảng Nam, đường bộ, đường sắt, đường biển và đường hàng không.',''),
(8,'Lưu trú','Là địa phương phát triển mạnh về du lịch, Quảng Nam có lượng lớn phòng khách sạn, các homestay và resort. Trong đó, hạng mục resort phát triển mạnh nhất với hàng chục khu, chủ yếu nằm ven biển Hà My, An Bàng, Cửa Đại hay Thăng Bình. Four Seasons Resort The Nam Hai là resort cao cấp nhất ở Quảng Nam, giá phòng dao động từ khoảng 20 triệu đồng đến hơn 100 triệu đồng một đêm. Các resort ven biển khác như Victoria Hoi An Beach Resort & Spa, Palm Garden Resort & Spa, Wyndham Hoi An Royal Beachfront Resort & Villas, Citadines Pearl Hoi An, Vinpearl Resort & Golf Nam Hoi An, Hoiana Hotel and Suites, Hoi An Beach Resort, Tui Blue Nam Hoi An có giá dao động từ 1 đến khoảng 5 triệu đồng một phòng một đêm.',''),
(8,'Tham quan','Hội An chắc chắn là nơi không thể bỏ qua khi đến Quảng Nam. Đây là một trong hai Di sản văn hoá thế giới của tỉnh với giá trị văn hoá và kiến trúc cổ còn gần như nguyên vẹn. Hội An còn là điểm đến cho người yêu ẩm thực, thời trang và nhiếp ảnh. Ở Hội An có nhiều món ăn ngon và đặc trưng như cao lầu, mì Quảng, bánh đập, bánh bao - bánh vạc. Hội An còn có những góc phố đẹp, những bức tường vàng cổ kính, mái ngói rêu phong. Phổ cổ Hội An được du khách nước ngoài đánh giá là "thành phố đẹp nhất", có các dịch vụ được du khách thích thú như may quần áo hay đóng giày lấy ngay.',''),
(8,'Ẩm thực','Mì Quảng Đây là món ăn có nguồn gốc từ Quảng Nam - Đà Nẵng (xưa). Mì Quảng được làm từ bột gạo xay mịn với nước từ hạt dành dành và trứng cho màu vàng, sau đó tráng thành từng lớp, rồi thái để có những sợi 5-10 mm. Dưới lớp mì là các loại rau sống, đúng kiểu xứ Quảng phải có 9 loại mới tạo được hương vị gồm húng quế, xà lách, cải non, giá chần (hoặc sống), ngò rí, rau răm, hành hoa thái nhỏ và hoa chuối cắt mỏng. Ăn cùng là thịt lợn, tôm, thịt gà, thịt cá lóc (cá quả), trứng cút. Các thành phần phụ khác có lạc rang giã dập, sa tế ớt. Nước dùng được gọi là nước nhân, cô đặc và sệt sệt. Tô mì Quảng luôn được dùng kèm với bánh đa.',''),

(9,'Huế mộng mơ','Nằm trên dải đất miền Trung, Huế là thành phố di sản văn hóa thế giới. Cố đô vốn có lịch sử và truyền thống lâu đời với những giá trị và bản sắc độc đáo.',''),
(9,'Di chuyển','Máy bay: Vietnam Airlines, Bamboo Airways, Vietjet Air đều khai thác các chặng đến sân bay Phú Bài, Huế. Thời gian bay từ Hà Nội là khoảng 1 tiếng 15 phút, giá vé khứ hồi từ 1.600.000 đồng. Thời gian bay từ TP HCM là khoảng 1 tiếng 30 phút, giá vé khứ hồi từ 1.300.000 đồng. Tàu hỏa: Từ Hà Nội, TP HCM hoặc các tỉnh thành các, du khách có thể đi tàu hỏa để ngắm cảnh dọc đường. Tàu có loại ghế ngồi cứng, ngồi mềm và giường nằm, có hoặc không có điều hòa. Giá vé khoảng 400.000 - 900.000 đồng một người. Nếu đi xa vào mùa nóng, bạn hãy chọn tàu SE3, SE1 để rút ngắn thời gian di chuyển, mua vé khoang giường nằm có điều hòa cho thoải mái. Xe khách: Từ Hà Nội đến Huế bạn mua vé xe các hãng như Hưng Thành, Camel, Queen, Đức Thịnh... Chặng Hà Nội - Huế và ngược lại có giá 250.000 - 300.000 đồng một chiều. Xe thường chạy từ 18h hôm trước tới 6h sáng hôm sau đến Huế nên bạn chỉ cần đặt chỗ giường nằm và ngủ một giấc sẽ tới nơi.',''),
(9,'Khách sạn, resort','Khách sạn ở Huế giá dễ chịu. Bạn nên đặt phòng ở trung tâm, gần các bến tàu, xe để dễ đi lại cũng như tham quan các địa điểm du lịch nội đô và điểm ăn uống. Các homestay, hostel nằm ngay trung tâm như a-mâze house, Sunshine, Tò Vò, Trầm... giá chỉ 100.000 - 200.000 đồng một đêm phù hợp cho người đi một mình hoặc nhóm bạn trẻ. Nếu đi đông, bạn nên đặt trước qua các kênh đặt phòng trực tuyến như Booking, Agoda, Traveloka, Vntrip... để có giá tốt. Huế cũng không thiếu khách sạn 4-5 sao và khu nghỉ dưỡng cao cấp. Những thương hiệu nổi tiếng phải kể đến Banyan Tree Lăng Cô, Laguna Lăng Cô, Làng Hành Hương Pilgrimage Village, Lapochine Beach Resort, khách sạn Silk Path Grand Hue, Indochine Palace, khách sạn Hoàng Cung (Imperial), Azerai La Residence Huế, Vinpearl... Giá phòng khoảng 2.000.000 - 8.000.000 đồng một đêm.',''),
(9,'Tham quan','Đại Nội Huế có hơn 100 công trình kiến trúc nổi bật như Ngọ Môn, Điện Thái Hòa, Cung Diên Thọ, Cung Trường Sanh, Hưng Miếu, Thế Miếu... Quần thể công trình cổ kính này được bố trí theo nguyên tắc "tả nam hữu nữ", "tả văn hữu võ", tính từ trong ra. Ngay cả các miếu thờ cũng có sự sắp xếp theo thứ tự "tả chiêu hữu mục" (trái trước, phải sau, lần lượt theo thời gian). Vì khuôn viên Đại Nội Huế rất rộng cũng như tiết trời nắng nóng mùa hè, bạn nên đến từ sáng sớm ngay khi mở cửa lúc 7h và mang theo mũ, nón tránh nắng. Bạn cần ít nhất 3 tiếng tham quan khu di tích. Vé vào Đại Nội giá 200.000 đồng một người. Khi ghé thăm các điểm tham quan tại Huế, du khách có thể thuê áo Nhật Bình chụp ảnh để hóa thân thành hậu, phi, công chúa thời xưa.',''),
(9,'Ăn chơi','Từ lâu ẩm thực Huế nổi tiếng đa dạng, tinh tế bởi người Huế quan niệm đồ ăn không chỉ ngon mà còn phải đẹp. Các món bạn nhất định phải thử khi du lịch Huế là bún bò, cơm hến, bánh canh, các loại bánh bèo, nậm, lọc, bánh ép, bánh ướt thịt nướng, chè... Mỗi món ăn chơi chỉ từ 7.000 - 20.000 đồng một suất, các món ăn no như bún bò, thịt luộc cuốn tôm, bún mắm, cơm niêu... có giá từ 30.000 đồng một suất. Vì đồ ăn Huế rẻ và ngon nên bạn chỉ cần dắt túi 100.000 - 300.000 đồng là có thể ăn no nê trong ngày.',''),

(10,'Ninh Bình','Ninh Bình là nơi bạn có thể ghé thăm vào nhiều thời điểm trong năm. Tuy nhiên, nên đến đây vào mùa xuân (tháng 1 - 3) khi tiết trời mát mẻ, có nhiều lễ hội và mùa hè (tháng 5 - 8) để ngắm những cánh đồng lúa chín vàng hay các đầm sen thơm ngát.',''),
(10,'Di chuyển','Từ Hà Nội, có thể bắt xe khách tại bến xe Giáp Bát hoặc đặt xe Limousine đến Ninh Bình. Giá vé dao động từ 100.000 - 150.000 đồng, thời gian di chuyển khoảng 2 giờ. Nếu xuất phát từ TP. HCM, du khách bay ra Hà Nội và đi xe khách về Ninh Bình với các lựa chọn như trên. Các hãng hàng không Việt Nam như Vietnam Airlines, Vietjet Air, Jetstar, đều khai thác chuyến bay từ TP. HCM đến Hà Nội. Hiện giá vé dao động từ 900.000 - 1,3 triệu đồng/ chiều.',''),
(10,'Lưu trú','Du khách đến Ninh Bình theo cặp đôi, theo nhóm bạn hoặc một mình có thể chọn ở tại các homestay gần các điểm tham quan với không gian xanh mát, bình yên, dịch vụ thân thiện. Một số địa chỉ được yêu thích và có vị trí thuận tiện là: Ninh Binh Friendly Homestay, Hang Múa Ecolodge, Dieps House, Ninh Binh Palm Homestay, ChezBeo Homestay... Với chi phí dao động khoảng 200.000 đồng/ người/ đêm.',''),
(10,'Điểm tham quan','Tràng An Nơi đây thu hút du khách với phong cảnh núi non hùng vĩ cùng những dòng sông nhỏ quanh co, các thung lũng hoang sơ... Giá vé tham quan Tràng An là 250.000 đồng với người lớn, trẻ em dưới 1,4 m là 100.000 đồng. Hướng dẫn viên đi cùng sẽ mất phí 300.000 đồng một tour.',''),
(10,'Tâm linh','Chùa Bái Đính - Quần thể chùa Bái Đính được xây dựng từ năm 2003, có diện tích hơn 500 ha, được bao bọc bởi những vòng cung núi đá vôi kỳ vĩ. Chùa được chia thành 2 khu: Tân tự và Cổ tự. Tại đây, du khách có thể đi bộ tham quan hoặc di chuyển bằng xe điện (giá 30.000 đồng/ người/ lượt). Một số điện mà du khách thường ghé thăm khi tới là chùa Pháp Chủ (gồm có 5 gian, gian giữa đặt tượng Phật Thích Ca cao 10m, nặng 100 tấn), điện Tam Thế... hoặc có thể lên tháp chuông để chiêm ngưỡng Đại hồng chung nặng 36 tấn.','');


-- Dữ liệu cho bảng blog
INSERT INTO blog (provinceID, userID, blogTitle, blogContent, blogCreateDate, status, approvalStatus) VALUES
(1, 1, 'Mùa thu Hà Nội tuyệt vời', 'Nếu được đến Hà Nội 1 ngày thu mát dịu, bạn sẽ làm gì?
LỊCH TRÌNH MỘT BUỔI SÁNG MÙA THU CHO NGƯỜI U MÊ HÀ NỘI  ĐÂY NHÉ 🌥️
📌 6h - 6h30: Xem thượng cờ ở Lăng Bác
📌 6h30 - 7h30: Ăn sáng đá bát phở gà
📌 7h30 - 8h: Check in tại Nhà thờ lớn
📌 8h - 9h: Mua bó cúc họa mi, chụp ảnh trên đường Phan Đình Phùng, Thanh Niên
📌 9h - 9h30: Ăn kem mơ tây Tràng Tiền
📌 9h30 - 10h: Dạo quanh chợ Đồng Xuân và phố cổ
📌 10h - 11h: Ghé vào một quán nước, nhâm nhi xôi cốm với cà phê trứng
📌 11h - 12h: Ghé thăm nhà sách Mão, bưu điện thành phố và ngắm hồ Gươm
Nếu không phải là con người “ngủ nướng” thì hãy mau ra đường và tận hưởng không khí Hà Nội những ngày thu đi thôi 🍃🍃
📷  Cảm ơn chia sẻ của Nguyễn Minh Đức', '2024-11-01', TRUE, 'Đã Duyệt'),

(2, 2,'Bạn đã đến Hội An - Đà Nẵng chưa?', '
Một thành phố có biển siêu đẹp và sạch sẽ 
Một thành phố có những cây cầu quá đặc sắc 
Một thành phố có quá nhiều đặc sản ngon bổ rẻ
Một thành phố có núi trong lòng phố 
Và một thành phố, có thêm một phố cổ cực cổ kính. Nơi mà biết bao du khách gần xa trong và ngoài nước đều muốn về nơi đây
Một chuyến đi quá tuyệt vời mn ạ ❤️ 
📸Hoàng Rin 
#vietnamoi
#hoian #danang', '2024-11-02', TRUE, 'Đã Duyệt'),
(1, 10,'KHÁM PHÁ MŨI NGHÊ, SƠN TRÀ ĐÀ NẴNG🌊🌿', 'Sở dĩ có tên Mũi Nghê vì ở đó có 1 tảng đá khổng lồ, được thiên nhiên trạm trổ thành hình con nghê có mặt hướng vào núi và lưng hướng ra biển.
Vị trí cách thành phố khoảng 10km, nằm ở phía Đông Sơn Trà. Nơi này còn khá hoang sơ, được mệnh danh là điểm đón bình minh đẹp nhất Đà Nẵng.
Nếu đến đây để chụp hình check-in thì các bạn nên đi vào buổi sáng, thời tiết, ánh sáng sẽ dễ chịu hơn.
Ngoài ra cũng có thể trải nghiệm các hoạt động bơi lội xung quành hồ nước xanh ngắt chill xĩu ở đây. Đặc biệt cũng có nhiều bãi đá và đất trống có thể cắm trại qua đêm, dã ngoại cùng bạn bè nữa nha!',
'2024-11-10', TRUE, 'Đã Duyệt'),
(3, 6,'Dinh Độc Lập - Điểm đến không thể bỏ qua tại TPHCM', 
'Gọi em là Sài Gòn năm 1975
Vì nụ cười em đẹp như ngày Giải Phóng
_________
📍 Dinh Độc Lập - Tphcm 
40k/ng tham quan bên ngoài mình vẫn có hình sống ảo luôn mn ạ. Hihi 😝', '2024-11-06', TRUE, 'Đã Duyệt'),


(1, 1, 'Blog Title 1', 'Blog Content 1', '2022-01-15', TRUE, 'Chờ Duyệt'),
(2, 2, 'Blog Title 2', 'Blog Content 2', '2022-02-18', TRUE, 'Đã Duyệt'),
(3, 3, 'Blog Title 3', 'Blog Content 3', '2022-03-21', TRUE, 'Không Được Duyệt'),
(4, 4, 'Blog Title 4', 'Blog Content 4', '2022-04-10', TRUE, 'Chờ Duyệt'),
(5, 5, 'Blog Title 5', 'Blog Content 5', '2022-05-14', TRUE, 'Đã Duyệt'),
(6, 6, 'Blog Title 6', 'Blog Content 6', '2022-06-12', TRUE, 'Chờ Duyệt'),
(7, 7, 'Blog Title 7', 'Blog Content 7', '2022-07-19', TRUE, 'Đã Duyệt'),
(8, 8, 'Blog Title 8', 'Blog Content 8', '2022-08-22', TRUE, 'Không Được Duyệt'),
(9, 9, 'Blog Title 9', 'Blog Content 9', '2022-09-25', TRUE, 'Chờ Duyệt'),
(10, 10, 'Blog Title 10', 'Blog Content 10', '2022-10-30', TRUE, 'Đã Duyệt'),
(11, 11, 'Blog Title 11', 'Blog Content 11', '2022-11-05', TRUE, 'Chờ Duyệt'),
(12, 12, 'Blog Title 12', 'Blog Content 12', '2022-12-09', TRUE, 'Không Được Duyệt'),

-- Dữ liệu cho năm 2023
(13, 13, 'Blog Title 13', 'Blog Content 13', '2023-01-15', TRUE, 'Đã Duyệt'),
(14, 14, 'Blog Title 14', 'Blog Content 14', '2023-02-18', TRUE, 'Chờ Duyệt'),
(15, 15, 'Blog Title 15', 'Blog Content 15', '2023-03-21', TRUE, 'Không Được Duyệt'),
(16, 16, 'Blog Title 16', 'Blog Content 16', '2023-04-10', TRUE, 'Đã Duyệt'),
(17, 17, 'Blog Title 17', 'Blog Content 17', '2023-05-14', TRUE, 'Chờ Duyệt'),
(18, 18, 'Blog Title 18', 'Blog Content 18', '2023-06-12', TRUE, 'Không Được Duyệt'),
(19, 19, 'Blog Title 19', 'Blog Content 19', '2023-07-19', TRUE, 'Đã Duyệt'),
(20, 20, 'Blog Title 20', 'Blog Content 20', '2023-08-22', TRUE, 'Chờ Duyệt'),
(1, 1, 'Blog Title 21', 'Blog Content 21', '2023-09-25', TRUE, 'Đã Duyệt'),
(2, 2, 'Blog Title 22', 'Blog Content 22', '2023-10-30', TRUE, 'Chờ Duyệt'),
(3, 3, 'Blog Title 23', 'Blog Content 23', '2023-11-05', TRUE, 'Không Được Duyệt'),
(4, 4, 'Blog Title 24', 'Blog Content 24', '2023-12-09', TRUE, 'Đã Duyệt'),

-- Dữ liệu cho năm 2024
(5, 5, 'Blog Title 25', 'Blog Content 25', '2024-01-15', TRUE, 'Chờ Duyệt'),
(6, 6, 'Blog Title 26', 'Blog Content 26', '2024-02-18', TRUE, 'Đã Duyệt'),
(7, 7, 'Blog Title 27', 'Blog Content 27', '2024-03-21', TRUE, 'Không Được Duyệt'),
(8, 8, 'Blog Title 28', 'Blog Content 28', '2024-04-10', TRUE, 'Chờ Duyệt'),
(9, 9, 'Blog Title 29', 'Blog Content 29', '2024-05-14', TRUE, 'Đã Duyệt'),
(10, 10, 'Blog Title 30', 'Blog Content 30', '2024-06-12', TRUE, 'Không Được Duyệt'),
(11, 11, 'Blog Title 31', 'Blog Content 31', '2024-07-19', TRUE, 'Chờ Duyệt'),
(12, 12, 'Blog Title 32', 'Blog Content 32', '2024-08-22', TRUE, 'Đã Duyệt'),
(13, 13, 'Blog Title 33', 'Blog Content 33', '2024-09-25', TRUE, 'Không Được Duyệt'),
(14, 14, 'Blog Title 34', 'Blog Content 34', '2024-10-30', TRUE, 'Đã Duyệt'),
(15, 15, 'Blog Title 35', 'Blog Content 35', '2024-11-05', TRUE, 'Chờ Duyệt'),
(16, 16, 'Blog Title 36', 'Blog Content 36', '2024-12-09', TRUE, 'Không Được Duyệt');

-- Dữ liệu cho bảng imgBlog - mặc định cho 4 blog
INSERT INTO imgBlog (blogID, imgBlogURL)
VALUES
(1, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog1a'),
(1, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog1b'),
(1, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog1c'),
(1, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog1d'),
(1, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog1e'),

(2, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog2a'),
(2, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog2b'),
(2, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog2c'),
(2, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog2d'),

(3, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog3a'),
(3, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog3b'),
(3, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog3c'),

(4, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog4a'),
(4, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog4b'),
(4, 'https://res.cloudinary.com/dt5xizv10/image/upload/blog/blog4c'); 


-- Dữ liệu cho bảng userComment
INSERT INTO userComment (blogID, userID, cmtContent, createDate, status)
VALUES
(1, 1, 'Very insightful blog about Hanoi!', '2023-11-01', TRUE),
(1, 2, 'Food is extremely marvelous!', '2023-11-01', TRUE),
(2, 2, 'I loved the information about Hoi An, so vibrant!', '2023-11-02', TRUE),
(3, 3, 'Da Nang is really a great vacation destination.', '2023-11-03', TRUE),
(4, 4, 'Thành phố Hồ Chí Minh đẹp thật hhhhh.', '2023-11-04', TRUE),



(5, 5, 'Hue is so full of history, definitely on my list.', '2023-11-05', TRUE),
(6, 6, 'Great post, Can Tho is beautiful!', '2023-11-06', TRUE),
(7, 7, 'Ha Long Bay is one of the most beautiful places I have seen.', '2023-11-07', TRUE),
(8, 8, 'Binh Duong is growing so fast!', '2023-11-08', TRUE),
(9, 9, 'Nghe An is underrated, great natural beauty.', '2023-11-09', TRUE),
(10, 10, 'Khanh Hoa looks like an amazing destination.', '2023-11-10', TRUE),
(11, 11, 'Bac Ninh has such a rich culture, I need to visit!', '2023-11-11', TRUE),
(12, 12, 'Tay Ninh sounds interesting, especially Ba Den Mountain.', '2023-11-12', TRUE),
(13, 13, 'Quang Nam has beautiful landscapes.', '2023-11-13', TRUE),
(14, 14, 'Thanh Hoa has so much to offer in terms of history and nature.', '2023-11-14', TRUE),
(15, 15, 'Dak Lak is a peaceful place with rich nature.', '2023-11-15', TRUE),
(16, 16, 'Gia Lai seems like a hidden gem in Vietnam.', '2023-11-16', TRUE),
(17, 17, 'Long An looks like a great agricultural hub.', '2023-11-17', TRUE),
(18, 18, 'Vinh Phuc is a peaceful place to relax and enjoy.', '2023-11-18', TRUE),
(19, 19, 'Lam Dong is perfect for those who love cool weather and mountains.', '2023-11-19', TRUE),
(20, 20, 'Bac Giang has such a scenic beauty, will visit soon.', '2023-11-20', TRUE);

-- Dữ liệu cho bảng repComment
INSERT INTO repComment (commentID, userID, repContent, createDateRep, status)
VALUES
(1, 2, 'I agree, Hanoi is amazing!', '2023-11-01', TRUE),
(1, 2, 'For sure!', '2023-11-01', TRUE),
(1, 3, 'Yes, I should go there!', '2023-11-01', TRUE),

(2, 4, 'For sure!', '2023-11-01', TRUE),
(2, 5, 'Pho is always beautiful!', '2023-11-01', TRUE),

(3, 2, 'Đi Hội An thích thật!', '2023-11-02', TRUE),
(3, 10, 'Sẽ cố gắng có dịp ra thăm!', '2023-11-02', TRUE),

(4, 15, 'Tôi đã đi Đà Năng và nới đó rất đẹp', '2023-11-03', TRUE),
(5, 13, 'Sài Gòn dạo này xinh thật ', '2023-11-03', TRUE),


(2, 3, 'Definitely, Hoi An has a unique vibe.', '2023-11-02', TRUE),
(3, 4, 'Absolutely, Da Nang is a must-see.', '2023-11-03', TRUE),
(4, 5, 'Yes, đợt này thành phố xinh quá', '2023-11-04', TRUE),
(5, 6, 'Hue is great for history lovers.', '2023-11-05', TRUE),
(6, 7, 'Yes, Can Tho is quite a sight!', '2023-11-06', TRUE),
(7, 8, 'Indeed, Ha Long Bay is magical.', '2023-11-07', TRUE),
(8, 9, 'Binh Duong is indeed growing rapidly.', '2023-11-08', TRUE),
(9, 10, 'Nghe An is so beautiful, nature is its charm.', '2023-11-09', TRUE),
(10, 11, 'Yes, Khanh Hoa is very relaxing.', '2023-11-10', TRUE),
(11, 12, 'Bac Ninh"s culture is unique and rich.', '2023-11-11', TRUE),
(12, 13, 'Tay Ninh is very special with its Cao Dai religion.', '2023-11-12', TRUE),
(13, 14, 'Yes, Quang Nam has so much to explore.', '2023-11-13', TRUE),
(14, 15, 'Thanh Hoa is definitely worth exploring.', '2023-11-14', TRUE),
(15, 16, 'Dak Lak has such a peaceful atmosphere.', '2023-11-15', TRUE),
(16, 17, 'Gia Lai is really a peaceful place to visit.', '2023-11-16', TRUE),
(17, 18, 'Long An is great for agriculture and nature lovers.', '2023-11-17', TRUE),
(18, 19, 'Vinh Phuc is great for relaxation and family vacations.', '2023-11-18', TRUE),
(19, 20, 'Lam Dong offers amazing views and pleasant weather.', '2023-11-19', TRUE),
(20, 1, 'Bac Giang looks stunning, hope to visit soon!', '2023-11-20', TRUE);