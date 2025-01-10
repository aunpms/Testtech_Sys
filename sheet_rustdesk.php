<?php
// functions.php

/**
 * ดึงข้อมูลจาก Google Sheets และแปลงเป็นอาร์เรย์
 *
 * @param string $spreadsheetId รหัสของ Google Sheets
 * @return array ข้อมูลที่ดึงมาในรูปแบบอาร์เรย์
 */
function fetchDataFromGoogleSheets($spreadsheetId) {
    $url = "https://docs.google.com/spreadsheets/d/{$spreadsheetId}/gviz/tq?tqx=out:csv";
    $csvData = file_get_contents($url);
    if ($csvData === false) {
        return [];
    }
    $rows = array_map('str_getcsv', explode("\n", $csvData));
    $header = array_shift($rows);
    $data = [];
    foreach ($rows as $row) {
        if (count($row) === count($header)) {
            $data[] = array_combine($header, $row);
        }
    }
    return $data;
}

/**
 * แสดงข้อมูลในรูปแบบตาราง HTML พร้อมลิงก์ในคอลัมน์ RustdeskId
 *
 * @param array $data ข้อมูลที่ต้องการแสดง
 */
function displayDataAsTable($data) {
    if (empty($data)) {
        echo 'ไม่มีข้อมูลที่จะแสดง';
        return;
    }
    echo '<table border="1">';
    // แสดงส่วนหัวของตาราง
    echo '<tr>';
    foreach (array_keys($data[0]) as $col) {
        echo "<th>{$col}</th>";
    }
    echo '</tr>';
    // แสดงข้อมูลในตาราง
    foreach ($data as $row) {
        echo '<tr>';
        foreach ($row as $key => $value) {
            if ($key === 'RustdeskId') {
                echo "<td><a href=\"{$value}\">{$value}</a></td>";
            } else {
                echo "<td>{$value}</td>";
            }
        }
        echo '</tr>';
    }
    echo '</table>';
}
?>
