<?php
// index.php

// เรียกใช้ฟังก์ชันจากไฟล์ functions.php
require 'functions.php';

// กำหนดรหัสของ Google Sheets
$spreadsheetId = '16KeWb-6DH-7drxqosD8BWwFk7tReZiY5D2OREblSUnE';

// ดึงข้อมูลจาก Google Sheets
$data = fetchDataFromGoogleSheets($spreadsheetId);

// แสดงข้อมูลในรูปแบบตาราง
displayDataAsTable($data);
?>
