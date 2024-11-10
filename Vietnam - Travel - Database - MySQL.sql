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
  sectionContent TEXT NOT NULL,
  imgPostDetURL TEXT NOT NULL,
  FOREIGN KEY (postID) REFERENCES post(postID)
);

CREATE TABLE blog (
  blogID INT AUTO_INCREMENT PRIMARY KEY,
  provinceID INT NOT NULL,
  userID INT NOT NULL,
  blogContent TEXT NOT NULL,
  blogCreateDate DATE NOT NULL,
  approve BOOLEAN NOT NULL,
  status BOOLEAN NOT NULL DEFAULT TRUE, 
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



-- Dữ liệu cho bảng province
INSERT INTO province (provinceName, provinceRegion, status)
VALUES
('Hanoi', 'North', TRUE),
('Ho Chi Minh City', 'South', TRUE),
('Da Nang', 'Central', TRUE),
('Hai Phong', 'North', TRUE),
('Hue', 'Central', TRUE),
('Can Tho', 'South', TRUE),
('Quang Ninh', 'North', TRUE),
('Binh Duong', 'South', TRUE),
('Nghe An', 'North', TRUE),
('Khanh Hoa', 'Central', TRUE),
('Bac Ninh', 'North', TRUE),
('Tay Ninh', 'South', TRUE),
('Quang Nam', 'Central', TRUE),
('Thanh Hoa', 'North', TRUE),
('Dak Lak', 'Central', TRUE),
('Gia Lai', 'Central', TRUE),
('Long An', 'South', TRUE),
('Vinh Phuc', 'North', TRUE),
('Lam Dong', 'South', TRUE),
('Bac Giang', 'North', TRUE);

-- Dữ liệu cho bảng users với provinceID thay vì address_
INSERT INTO users (userName, pass_word, address_, role_, email, gender, status)
VALUES
('Nguyen An', 'password1', 1, 'Admin', 'nguyenan@example.com', 'Male', TRUE),
('Tran Mai', 'password2', 1, 'Admin', 'tranmai@example.com', 'FeMale', TRUE),
('Le Minh', 'password3', 3, 'Admin', 'leminh@example.com', 'Male', TRUE),
('Pham Lan', 'password4', 2, 'Blogger', 'phamlan@example.com', 'FeMale', TRUE),
('Nguyen Son', 'password5', 1, 'Blogger', 'nguyenson@example.com', 'Male', TRUE),
('Hoang Minh', 'password6', 5, 'Blogger', 'hoangminh@example.com', 'Male', TRUE),
('Nguyen Tuyet', 'password7', 3, 'Blogger', 'nguyentuyet@example.com', 'FeMale', TRUE),
('Luu Mai', 'password8', 2, 'Blogger', 'luumai@example.com', 'FeMale', TRUE),
('Vu Tam', 'password9', 4, 'Blogger', 'vutam@example.com', 'Male', TRUE),
('Nguyen Le', 'password10', 1, 'Blogger', 'nguyenle@example.com', 'FeMale', TRUE),
('Trinh Bao', 'password11', 2, 'Blogger', 'trinhbao@example.com', 'Male', TRUE),
('Mai Mai', 'password12', 5, 'Blogger', 'maimai@example.com', 'FeMale', TRUE),
('Doan Linh', 'password13', 1, 'Blogger', 'doanlinh@example.com', 'FeMale', TRUE),
('Le Duong', 'password14', 3, 'Blogger', 'leduong@example.com', 'Male', TRUE),
('Tran Son', 'password15', 2, 'Blogger', 'transon@example.com', 'Male', TRUE),
('Nguyen Hien', 'password16', 4, 'Blogger', 'nguyenhien@example.com', 'FeMale', TRUE),
('Hoang Nam', 'password17', 5, 'Blogger', 'hoangnam@example.com', 'Male', TRUE),
('Bui Quyen', 'password18', 3, 'Blogger', 'buiquyen@example.com', 'FeMale', TRUE),
('Lai Lan', 'password19', 1, 'Blogger', 'lailan@example.com', 'FeMale', TRUE),
('Pham Minh', 'password20', 2, 'Blogger', 'phamminh@example.com', 'Male', TRUE);

-- Dữ liệu cho bảng destination
INSERT INTO destination (provinceID, destinationName, destinationContent, imgDesURL)
VALUES
(1, 'Hoan Kiem Lake', 'Beautiful lake in Hanoi.', 'hoankiem.jpg'),
(2, 'Ben Thanh Market', 'Famous market in HCM.', 'benthanh.jpg'),
(3, 'My Khe Beach', 'Famous beach in Da Nang.', 'mykhe.jpg'),
(4, 'Cat Ba Island', 'Popular island in Hai Phong.', 'catba.jpg'),
(5, 'Imperial City', 'Historic city in Hue.', 'imperialcity.jpg'),
(6, 'Can Tho River', 'Famous river in Can Tho.', 'cantho.jpg'),
(7, 'Ha Long Bay', 'Beautiful bay in Quang Ninh.', 'halong.jpg'),
(8, 'Binh Duong Park', 'Famous park in Binh Duong.', 'binhduong.jpg'),
(9, 'Pu Mat National Park', 'Beautiful national park in Nghe An.', 'pumat.jpg'),
(10, 'Nha Trang Beach', 'Famous beach in Khanh Hoa.', 'nhatrang.jpg'),
(11, 'Hoa Lu', 'Historic capital of Vietnam in Ninh Binh.', 'hoalu.jpg'),
(12, 'Tay Ninh Mountains', 'Beautiful mountains in Tay Ninh.', 'tayninh.jpg'),
(13, 'Marble Mountains', 'Famous mountains in Da Nang.', 'marblemountains.jpg'),
(14, 'Pu Luong Nature Reserve', 'Nature reserve in Thanh Hoa.', 'pulong.jpg'),
(15, 'Buon Ma Thuot', 'Coffee capital of Vietnam in Dak Lak.', 'buonmathuot.jpg'),
(16, 'Mount Ba Na', 'Popular mountain in Da Nang.', 'banamoutain.jpg'),
(17, 'Mui Ne Beach', 'Beautiful beach in Binh Thuan.', 'muine.jpg'),
(18, 'Con Dao Islands', 'Island group in Ba Ria-Vung Tau.', 'condao.jpg'),
(19, 'Phong Nha Cave', 'Famous cave in Quang Binh.', 'phongnha.jpg'),
(20, 'Long Son Pagoda', 'Famous pagoda in Ba Ria-Vung Tau.', 'longson.jpg');

-- Dữ liệu cho bảng post
INSERT INTO post (provinceID, postCreateDate, imgPostURL, status)
VALUES
(1, '2023-11-01', 'hanoi_post.jpg', TRUE),
(2, '2023-11-02', 'hcm_post.jpg', TRUE),
(3, '2023-11-03', 'danang_post.jpg', TRUE),
(4, '2023-11-04', 'haiphong_post.jpg', TRUE),
(5, '2023-11-05', 'hue_post.jpg', TRUE),
(6, '2023-11-06', 'cantho_post.jpg', TRUE),
(7, '2023-11-07', 'quangninh_post.jpg', TRUE),
(8, '2023-11-08', 'binhduong_post.jpg', TRUE),
(9, '2023-11-09', 'nghean_post.jpg', TRUE),
(10, '2023-11-10', 'khanhhoa_post.jpg', TRUE),
(11, '2023-11-11', 'bacninh_post.jpg', TRUE),
(12, '2023-11-12', 'tayninh_post.jpg', TRUE),
(13, '2023-11-13', 'quangnam_post.jpg', TRUE),
(14, '2023-11-14', 'thanhhoa_post.jpg', TRUE),
(15, '2023-11-15', 'daklak_post.jpg', TRUE),
(16, '2023-11-16', 'gialai_post.jpg', TRUE),
(17, '2023-11-17', 'longan_post.jpg', TRUE),
(18, '2023-11-18', 'vinhphuc_post.jpg', TRUE),
(19, '2023-11-19', 'lamdong_post.jpg', TRUE),
(20, '2023-11-20', 'bacgiang_post.jpg', TRUE);

-- Dữ liệu cho bảng blog
INSERT INTO blog (provinceID, userID, blogContent, blogCreateDate, approve, status)
VALUES
(1, 1, 'Hanoi is the capital of Vietnam with rich culture and history.', '2023-11-01', TRUE, TRUE),
(2, 2, 'Ho Chi Minh City is the largest city in Vietnam, full of life and energy.', '2023-11-02', TRUE, TRUE),
(3, 3, 'Da Nang offers beautiful beaches and mountains, a perfect vacation spot.', '2023-11-03', TRUE, TRUE),
(4, 4, 'Hai Phong has a great mix of culture and industrial growth.', '2023-11-04', TRUE, TRUE),
(5, 5, 'Hue is the ancient capital, full of history and beautiful architecture.', '2023-11-05', TRUE, TRUE),
(6, 6, 'Can Tho is famous for its floating markets and southern cuisine.', '2023-11-06', TRUE, TRUE),
(7, 7, 'Quang Ninh is home to the UNESCO World Heritage Site, Ha Long Bay.', '2023-11-07', TRUE, TRUE),
(8, 8, 'Binh Duong is a rapidly growing province with modern infrastructure.', '2023-11-08', TRUE, TRUE),
(9, 9, 'Nghe An has beautiful nature and cultural sites to explore.', '2023-11-09', TRUE, TRUE),
(10, 10, 'Khanh Hoa is famous for its coastal beauty and resort towns.', '2023-11-10', TRUE, TRUE),
(11, 11, 'Bac Ninh is known for its rich folk culture and historical sites.', '2023-11-11', TRUE, TRUE),
(12, 12, 'Tay Ninh is famous for its Cao Dai religion and Ba Den Mountain.', '2023-11-12', TRUE, TRUE),
(13, 13, 'Quang Nam offers beautiful beaches and traditional villages.', '2023-11-13', TRUE, TRUE),
(14, 14, 'Thanh Hoa has a rich history and scenic landscapes to explore.', '2023-11-14', TRUE, TRUE),
(15, 15, 'Dak Lak is famous for its coffee plantations and nature reserves.', '2023-11-15', TRUE, TRUE),
(16, 16, 'Gia Lai is known for its beautiful mountains and waterfalls.', '2023-11-16', TRUE, TRUE),
(17, 17, 'Long An is known for its rivers and rich agricultural land.', '2023-11-17', TRUE, TRUE),
(18, 18, 'Vinh Phuc offers beautiful landscapes and cultural heritage.', '2023-11-18', TRUE, TRUE),
(19, 19, 'Lam Dong is home to Da Lat, a famous tourist destination in the mountains.', '2023-11-19', TRUE, TRUE),
(20, 20, 'Bac Giang is known for its agricultural production and scenic beauty.', '2023-11-20', TRUE, TRUE);

-- Dữ liệu cho bảng imgBlog
INSERT INTO imgBlog (blogID, imgBlogURL)
VALUES
(1, 'hanoi_blog.jpg'),
(2, 'hcm_blog.jpg'),
(3, 'danang_blog.jpg'),
(4, 'haiphong_blog.jpg'),
(5, 'hue_blog.jpg'),
(6, 'cantho_blog.jpg'),
(7, 'quangninh_blog.jpg'),
(8, 'binhduong_blog.jpg'),
(9, 'nghean_blog.jpg'),
(10, 'khanhhoa_blog.jpg'),
(11, 'bacninh_blog.jpg'),
(12, 'tayninh_blog.jpg'),
(13, 'quangnam_blog.jpg'),
(14, 'thanhhoa_blog.jpg'),
(15, 'daklak_blog.jpg'),
(16, 'gialai_blog.jpg'),
(17, 'longan_blog.jpg'),
(18, 'vinhphuc_blog.jpg'),
(19, 'lamdong_blog.jpg'),
(20, 'bacgiang_blog.jpg');

-- Dữ liệu cho bảng userComment
INSERT INTO userComment (blogID, userID, cmtContent, createDate, status)
VALUES
(1, 1, 'Very insightful blog about Hanoi!', '2023-11-01', TRUE),
(2, 2, 'I loved the information about HCM, so vibrant!', '2023-11-02', TRUE),
(3, 3, 'Da Nang is really a great vacation destination.', '2023-11-03', TRUE),
(4, 4, 'Interesting post about Hai Phong, I must visit soon.', '2023-11-04', TRUE),
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
(2, 3, 'Definitely, HCM has a unique vibe.', '2023-11-02', TRUE),
(3, 4, 'Absolutely, Da Nang is a must-see.', '2023-11-03', TRUE),
(4, 5, 'Yes, Hai Phong is a beautiful place.', '2023-11-04', TRUE),
(5, 6, 'Hue is great for history lovers.', '2023-11-05', TRUE),
(6, 7, 'Yes, Can Tho is quite a sight!', '2023-11-06', TRUE),
(7, 8, 'Indeed, Ha Long Bay is magical.', '2023-11-07', TRUE),
(8, 9, 'Binh Duong is indeed growing rapidly.', '2023-11-08', TRUE),
(9, 10, 'Nghe An is so beautiful, nature is its charm.', '2023-11-09', TRUE),
(10, 11, 'Yes, Khanh Hoa is very relaxing.', '2023-11-10', TRUE),
(11, 12, 'Bac Ninh's culture is unique and rich.', '2023-11-11', TRUE),
(12, 13, 'Tay Ninh is very special with its Cao Dai religion.', '2023-11-12', TRUE),
(13, 14, 'Yes, Quang Nam has so much to explore.', '2023-11-13', TRUE),
(14, 15, 'Thanh Hoa is definitely worth exploring.', '2023-11-14', TRUE),
(15, 16, 'Dak Lak has such a peaceful atmosphere.', '2023-11-15', TRUE),
(16, 17, 'Gia Lai is really a peaceful place to visit.', '2023-11-16', TRUE),
(17, 18, 'Long An is great for agriculture and nature lovers.', '2023-11-17', TRUE),
(18, 19, 'Vinh Phuc is great for relaxation and family vacations.', '2023-11-18', TRUE),
(19, 20, 'Lam Dong offers amazing views and pleasant weather.', '2023-11-19', TRUE),
(20, 1, 'Bac Giang looks stunning, hope to visit soon!', '2023-11-20', TRUE);
