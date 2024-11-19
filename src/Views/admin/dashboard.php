<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard</title>
    <link rel="stylesheet" href="../../../public/css/Admin/dashboard.css">
    <link rel="stylesheet" href="../../../public/css/sidebar.css">
    <link rel="stylesheet" href="../../../public/css/navbar.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="../../../public/js/Admin/dashboard.js"></script>
    <script src="../../../include/navbar.js"></script>
    <script src="../../../include/sidebar.js"></script>
    <script src="../../../public/js/Admin/Notifications.js"></script>
</head>
<body>

    <?php
        include_once "../../Controllers/adminController.php";
        include_once "../../Controllers/authController.php";
        
        $auth = new AuthController();
        $auth->checkAdmin();
            
        $adController = new AdminController();

        $view = isset($_GET['view']) ? $_GET['view'] : '5';

        $TotalUsers = $adController->TotalUsers();
        $TotalBlogs = $adController->TotalBlogs();
        $TotalComment = $adController->TotalComment();
        $TotalDestination = $adController->TotalDestination();
        $TopBlog = $adController->TopBlog($view);
    ?>
    
    <div class="main-content">
        <div class="date-picker">
            <select name="yearSelect" id="yearSelect">
            </select>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card card-1">
                <div class="stat-title">Total users</div>
                <div class="stat-value"><?php echo $TotalUsers['TotalUsers']; ?></div>
            </div>
            <div class="stat-card card-2">
                <div class="stat-title">Total blogs</div>
                <div class="stat-value"><?php echo $TotalBlogs['TotalBlogs']; ?></div>
            </div>
            <div class="stat-card card-3">
                <div class="stat-title">Total comments</div>
                <div class="stat-value"><?php echo $TotalComment['TotalComment']; ?></div>
            </div>
            <div class="stat-card card-4">
                <div class="stat-title">Total destinations</div>
                <div class="stat-value"><?php echo $TotalDestination['TotalDestination']; ?></div>
            </div>
        </div>

        <!-- Graph Section -->
        <div class="graph-section">
            <div class="graph-card">
                <div class="graph-title">Follower growth</div>
                <div class="graph-subtitle">Follower growth compared to last years</div>
                <div class="graph-container">
                    <canvas id="growthChart"></canvas>
                </div>
            </div>

            <div class="graph-card">
                <div class="graph-title">Engagement Growth</div>
                <div class="graph-subtitle">Engagement compared to last years</div>
                <div class="graph-container">
                    <canvas id="engagementChart"></canvas>
                </div>
            </div>
        </div>
        

        <!-- Top Followers Section -->
        <div class="followers-card">
            <div class="followers-header">
                <div>
                    <h2 class="graph-title">Top-User with high interactions</h2>
                    <p class="graph-subtitle">Top-Blog with high interactions</p>
                </div>
                <div class="search-container">
                    <button class="view-all-btn"><a href="?view=20">View Top 20</a></button>
                    <button class="view-all-btn"><a href="?view=5">View Top 5</a></button>
                </div>
            </div>

            <table class="followers-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Bài Viết</th>
                        <th>Tổng lượt tương tác</th>
                        <th>Tỉnh/Thành Phố</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (mysqli_num_rows($TopBlog) > 0) {
                    while ($index = mysqli_fetch_array($TopBlog)) {
                    ?>
                            <tr>
                                <td>
                                    <div><?php echo $index['userName'] ?? 'Lỗi Hiển Thị' ?></div>
                                    <!-- <div style="color: #666; font-size: 14px;">1.5M follower</div> -->
                                </td>
                                <td><?php echo $index['blogTitle'] ?? 'Lỗi Hiển Thị' ?></td>
                                <td><span class="stat-change change-positive"><?php echo $index['totalComments'] ?? 'Lỗi Hiển Thị' ?> Comment</span></td>
                                <td>
                                    <div class="follower-info">
                                            <div><?php echo $index['provinceName'] ?? 'Lỗi Hiển Thị' ?></div>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                            }
                        }
                        ?>
                    <!-- More rows similar to above -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>