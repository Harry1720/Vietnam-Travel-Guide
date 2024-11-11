<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tỉnh thành</title>
    <link rel="stylesheet" href="../../../public/css/Admin/province_management.css">
    <link rel="stylesheet" href="../../../public/css/navbar.css">
    <link rel="stylesheet" href="../../../public/css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    
    <?php
        include_once "../../Controllers/bothController.php";

        $bothcontroller = new bothController();
        $provinces = $bothcontroller->getAllProvinces();

        //Phan Trang
        $limit= 10;
        $stt = 1;
        $CountData = mysqli_num_rows($provinces);

        $countPage = ceil($CountData/$limit);

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $Start = ($page - 1) * $limit;

        $provinceOfPage = $bothcontroller->getprovinceOfPage($Start,$limit);
    ?>

    <?php
        include_once "../../Controllers/bothController.php";
        
            $bothcontroller = new bothController();
            $provinces = $bothcontroller->getAllProvinces();
    ?>
</head>
<body>
    <script src="../../../public/js/Admin/province_management.js"></script>
    <script src="../../../include/navbar.js"></script>
    <script src="../../../include/sidebar.js"></script>

<div class="main-content">
    <div class="province-management">
        <button class="add-destination-btn" id="open">
            Thêm Địa Điểm <ion-icon style="margin-left: 5px;" name="add-circle-outline"></ion-icon>
        </button>

        <div class="search-container">
            <input type="text" placeholder="Tìm kiếm tỉnh thành" class="search-bar">
            <ion-icon name="search-outline" class="search-icon"></ion-icon>
        </div>
        <!-- List Province Table -->
        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Tỉnh Thành</th>
                    <th>Mã Vùng</th>
                    <th>Thao Tác</th>
                </tr>
                </thead>
                <tbody id="province-List">
                    <?php
                        if(mysqli_num_rows($provinceOfPage)>0){
                            while($province = mysqli_fetch_array($provinceOfPage)){
                                ?>
                                        <!-- Ví dụ một tỉnh thành -->
                                    <tr onclick="toggleDestinations(<?php echo $stt?>)">
                                        <td><?php echo $stt++ ?></td>
                                        <td><?php echo $province['provinceName'] ?? 'Lỗi Hiển Thị'?></td>
                                        <td><?php echo $province['provinceRegion'] ?? 'Lỗi Hiển Thị'?></td>
                                        <td>
                                            <button class="edit-btn">
                                                <ion-icon name="create-outline"></ion-icon> 
                                            </button>
                                            <button class="delete-btn">
                                                <ion-icon name="trash-outline"></ion-icon> 
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                $destinations = $bothcontroller->getAllDestinationByProvinceID($province['provinceID']);
                                if(mysqli_num_rows(result: $destinations)>0){
                                        ?>
                                            <!-- Bảng con ẩn chứa các điểm đến -->
                                            <tr class="destination-row" id="destinations-<?php echo $stt-1 ?>" style="display: none;">
                                                <td colspan="4">
                                                    <div class="destination-table-wrapper">
                                                        <table class="destination-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Điểm Đến</th>
                                                                    <th>Mô Tả</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                while($destination = mysqli_fetch_array($destinations)){
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $destination['destinationName'] ?? 'Lỗi Hiển Thị'?></td>
                                                                    <td><?php echo $destination['destinationContent'] ?? 'Lỗi Hiển Thị'?></td>
                                                                </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                }
                            }
                        }
                        else{
                            echo "Không Lấy được dữ liệu";
                        }
                    ?>
                </tbody>
            </table>
            <div class="pagination">
                <?php
                    for ($i = 1; $i <= $countPage; $i++) {
                        echo "<a class='page-btn' href='?page=$i'>$i</a>";
                    }
                ?>
            </div>
        </div>
        <div id="popup" class="popup-overlay">
            <div class="popup-content">
                <p>Bạn có muốn xóa người dùng này?</p>
                <button id="yes-btn" class="popup-btn">Có</button>
                <button id="no-btn" class="popup-btn">Không</button>
            </div>
        </div>
    </div>
</div>
<div class="popup1-overlay" id="popup1Overlay">
    <div class="popup1-content">
        <span class="popup1-close" id="close">&times;</span>
        <div class="wrapper" id = "">
            <form id="destination-form" enctype="multipart/form-data" name = "add" method = "POST" action="../../FunctionOfActor/admin/addDestination.php">
                <div class="field input">
                    <label for="destinationName">Tên điểm đến</label>
                    <input type="text" id="destinationName" name="destinationName" placeholder="Hội An" required>
                </div>
                <div class="field input" style="margin-bottom: 20px;">
                    <label for="province" >Tỉnh/Thành Phố</label>
                    <select id="province" name="province">
                        <?php
                            foreach ($provinces as $province) {
                                echo '<option value="' . $province['provinceID'] . '">' . $province['provinceName'] . '</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="field input">
                    <label for="description">Mô tả điểm đến</label>
                    <textarea wrap="soft" id="description" name="description" required></textarea>
                </div>                

                <div class="field input" style="margin-bottom: 20px;">
                    <label for="image" >Tải ảnh:</label>
                    <input type="file" id="image" name="image">
                </div>
                <div class="button">
                    <input type="submit" value="Lưu" class="save" id="saveButton">
                    <input type="button" value="Hủy" class="cancel" id="cancelButton">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="popup1-overlay" id="popup2Overlay">
    <div class="popup1-content">
        <span class="popup1-close" id="close2">&times;</span>
        <div class="wrapper" id = "">
            <form id="destination-form2" enctype="multipart/form-data" method="POST" action="your_php_handler.php">
                <div class="field input">
                    <label for="destinationName1">Tên điểm đến</label>
                    <input type="text" id="destinationName1" name="destinationName1" placeholder="Hội An" required>
                </div>
                <div class="field input" style="margin-bottom: 20px;">
                    <label for="province1">Tỉnh/Thành Phố</label>
                    <select id="province1" name="province1">
                        <?php
                            foreach ($provinces as $province) {
                                echo '<option value="' . $province['provinceID'] . '">' . $province['provinceName'] . '</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="field input">
                    <label for="description1">Mô tả điểm đến</label>
                    <textarea wrap="soft" id="description1" name="description1" required></textarea>
                </div>                

                <div class="field input" style="margin-bottom: 20px;">
                    <label for="image1">Tải ảnh:</label>
                    <input type="file" id="image1" name="image1">
                </div>
                <div class="button">
                    <input type="submit" value="Lưu" class="save" id="saveButton1">
                    <input type="button" value="Hủy" class="cancel" id="cancelButton1">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>