<?php
// กำหนดค่าการเชื่อมต่อฐานข้อมูล MS SQL Server สำหรับสาขากรุงเทพฯ
$serverBKK = 'hfj094wvqq6.sn.mynetname.net,41433'; // Host และ Port สำหรับกรุงเทพฯ
$databaseBKK = 'testtechdb';
$userBKK = 'sa';
$passwordBKK = ''; // รหัสผ่านว่าง

// กำหนดค่าการเชื่อมต่อฐานข้อมูล MS SQL Server สำหรับสาขาชลบุรี
$serverCB = 'hfj094wvqq6.sn.mynetname.net,51433'; // Host และ Port สำหรับชลบุรี
$databaseCB = 'testtechdb';
$userCB = 'sa';
$passwordCB = ''; // รหัสผ่านว่าง

// ฟังก์ชันสำหรับสร้างการเชื่อมต่อฐานข้อมูล
function connectDB($server, $database, $user, $password) {
    try {
        $connectionInfo = array(
            "Database" => $database,
            "UID" => $user,
            "PWD" => $password,
            "TrustServerCertificate" => true,
            "Encrypt" => "Mandatory",           // <--- เพิ่มบรรทัดที่ 1
            "SSLCipher" => "DEFAULT@SECLEVEL=1" // <--- เพิ่มบรรทัดที่ 2
        );
        $conn = sqlsrv_connect($server, $connectionInfo);

        if ($conn === false) {
            echo "<h2>เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล:</h2>";
            die(print_r(sqlsrv_errors(), true));
        }
        return $conn;
    } catch (Exception $e) {
        echo "<h2>เกิดข้อผิดพลาด: " . $e->getMessage() . "</h2>";
        return false;
    }
}
?>
