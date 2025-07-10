<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/a-unit/">A-Unit HR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/a-unit/pages/dashboard.php">Dashboard</a>
                    </li>
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/a-unit/pages/employees.php">พนักงาน</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ตั้งค่าองค์กร
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownAdmin">
                                <li><a class="dropdown-item" href="/a-unit/pages/departments.php">จัดการแผนก</a></li>
                                <li><a class="dropdown-item" href="/a-unit/pages/divisions.php">จัดการฝ่าย</a></li>
                                <li><a class="dropdown-item" href="/a-unit/pages/manage_positions.php ">จัดการตำแหน่ง</a></li>
                                </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/a-unit/pages/salary_slips.php">สลิปเงินเดือน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/a-unit/pages/ot_requests_admin.php">จัดการ OT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/a-unit/pages/my_maintenance_requests.php">แจ้งซ่อม</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/a-unit/pages/my_salary_slips.php">สลิปเงินเดือนฉัน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/a-unit/pages/my_ot_requests.php">ขอ OT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/a-unit/pages/my_maintenance_requests.php">แจ้งซ่อม</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ยินดีต้อนรับ, <?php echo htmlspecialchars($_SESSION['first_name'] ?? 'ผู้ใช้'); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/a-unit/pages/profile.php">ข้อมูลส่วนตัว</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/a-unit/pages/logout.php">ออกจากระบบ</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/a-unit/pages/login.php">เข้าสู่ระบบ</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>