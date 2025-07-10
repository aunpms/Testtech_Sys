<?php
// Include ไฟล์เชื่อมต่อฐานข้อมูล
include_once 'conn.php';

// เชื่อมต่อฐานข้อมูลสำหรับชลบุรี
$connCB = connectDB($serverCB, $databaseCB, $userCB, $passwordCB);

// ตรวจสอบการเชื่อมต่อ
if ($connCB) {
    $statusMessage = "<p class='alert alert-success'>เชื่อมต่อฐานข้อมูลชลบุรี สำเร็จ!</p>";
    // *** คุณสามารถเพิ่มโค้ด PHP สำหรับดึงข้อมูล หรือจัดการฐานข้อมูลที่นี่ ***
    // ตัวอย่าง: การดึงข้อมูล
    // $sql = "SELECT * FROM YourLostJobsTable";
    // $stmt = sqlsrv_query($connCB, $sql);
    // if ($stmt === false) {
    //     die(print_r(sqlsrv_errors(), true));
    // }
    // while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    //     echo $row['JobName'] . "<br />";
    // }

} else {
    $statusMessage = "<p class='alert alert-danger'>ไม่สามารถเชื่อมต่อฐานข้อมูลชลบุรี ได้!</p>";
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้งานหาย - ชลบุรี</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #007bff;
            margin-bottom: 30px;
            font-weight: 600;
        }
        .alert {
            font-size: 1.1rem;
        }
        .btn-back {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.2s;
        }
        .btn-back:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h2>ระบบแก้งานหาย - สาขาชลบุรี</h2>
        <?php echo $statusMessage; ?>

        <div class="mt-4">
            <p class="text-muted">ในหน้านี้ คุณสามารถเพิ่มโค้ดสำหรับค้นหา ดึงข้อมูล หรือดำเนินการแก้ไขงานที่หายไปในฐานข้อมูลของสาขาชลบุรี</p>
            <p class="text-info">ตัวอย่างเช่น: ฟอร์มค้นหา Job ID, ตารางแสดงรายการงานที่หายไป</p>
            </div>

        <div class="mt-5">
            <a href="fix_lost_job.php" class="btn btn-back">กลับไปหน้าเลือกสาขา</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// ปิดการเชื่อมต่อฐานข้อมูลเมื่อใช้งานเสร็จสิ้น
if ($connCB) {
    sqlsrv_close($connCB);
}
?>