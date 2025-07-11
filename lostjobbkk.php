<?php
// Include ไฟล์เชื่อมต่อฐานข้อมูล
include_once 'conn.php';

// --- ส่วน PHP ---
$searchResult = '';
$statusMessage = '';
$connBKK = connectDB($serverBKK, $databaseBKK, $userBKK, $passwordBKK); // เชื่อมต่อฐานข้อมูลไว้ก่อน

// ===================================================================
//  (เพิ่มใหม่) ส่วนประมวลผล POST สำหรับการกดปุ่ม "ตรวจสอบแล้ว/แก้ไข"
// ===================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_request_no'])) {
    
    // ดำเนินการแก้ไขจริงเมื่อพบปัญหา
    
    // 1. เมื่อกดปุ่ม ตรวจสอบแล้ว/แก้ไข ให้เก็บค่า เลขที่รับคำขอ และ เลขที่ job order ไว้ที่ตัวแปร rqno และ jobno ตามลำดับ
    $rqno = $_POST['edit_request_no'];
    $jobno = $_POST['edit_job_no'];

    // 2. เลขที่ jobno 2 ตัวแรก เปลี่ยนค่า ให้ตรงกับ 2 ตัวแรกของ rqno นอกนั้นให้คงไว้ตามปกติ แล้วเก็บเป็นตัวแปรอีกตัวนึงชื่อว่า newjobno
    $newjobno = substr($rqno, 0, 2) . substr($jobno, 2);

    // 3. echo ตัวแปรละค่าที่เก็บออกมา
    // (แสดงผลในหน้าใหม่เนื่องจากฟอร์มมี target="_blank")
    header('Content-Type: text/html; charset=utf-8'); // ตั้งค่าให้แสดงผลภาษาไทยได้ถูกต้อง
    echo "<h1>ผลการทดสอบการแก้ไข</h1>";
    echo "<p><strong>Request No. ที่รับมา (rqno):</strong> " . htmlspecialchars($rqno) . "</p>";
    echo "<p><strong>Job No. เดิม (jobno):</strong> " . htmlspecialchars($jobno) . "</p>";
    echo "<p><strong>Job No. ใหม่ (newjobno):</strong> " . htmlspecialchars($newjobno) . "</p>";
    
    // จบการทำงานทันทีหลังจาก echo ค่าแล้ว
    exit();
}


// ===================================================================
//  ส่วนประมวลผล POST สำหรับการ "ค้นหา"
// ===================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['job_id'])) {
    $jobId = trim($_POST['job_id']);
    if (preg_match('/^[A-Za-z0-9\/]{1,9}$/', $jobId)) {
        header("Location: lostjobbkk.php?search=" . urlencode($jobId));
        exit();
    } else {
        header("Location: lostjobbkk.php?error=invalid_format");
        exit();
    }
}

// ===================================================================
//  ส่วนประมวลผล GET สำหรับการ "แสดงผล"
// ===================================================================
if (isset($_GET['search'])) {
    $jobId = htmlspecialchars($_GET['search']);
    
    if ($connBKK) {
        $processedJobId = str_replace('/', '', $jobId);
        $sql = "SELECT request_no, job_no FROM tbrequestorder WHERE request_no = ?";
        $params = array($processedJobId);
        $stmt = sqlsrv_query($connBKK, $sql, $params);

        if ($stmt !== false) {
            if (sqlsrv_has_rows($stmt)) {
                $tableHtml = '<div class="table-responsive mt-4"><table class="table table-bordered table-striped align-middle">';
                $tableHtml .= '<thead class="table-light"><tr><th>เลขที่รับคำขอ</th><th>เลขที่ job order</th><th class="text-center">ดำเนินการ</th></tr></thead>';
                $tableHtml .= '<tbody>';
                
                $testButtonHtml = '';
                $isFirstRow = true;

                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    
                    // สร้างปุ่มทดสอบจากข้อมูลแถวแรก
                    if ($isFirstRow) {
                        $testButtonHtml = '
                            <div class="my-3 text-start">
                                <form action="lostjobbkk.php" method="POST" target="_blank" class="d-inline-block">
                                    <input type="hidden" name="edit_request_no" value="' . htmlspecialchars($row['request_no']) . '">
                                    <input type="hidden" name="edit_job_no" value="' . htmlspecialchars($row['job_no']) . '">
                                    <button type="submit" class="btn btn-info">ทดสอบด้วยข้อมูลแถวแรก</button>
                                </form>
                            </div>
                        ';
                        $isFirstRow = false; 
                    }

                    $req_prefix = substr($row['request_no'], 0, 2);
                    $job_prefix = substr($row['job_no'], 0, 2);
                    
                    $actionContent = '';
                    if ($req_prefix === $job_prefix) {
                        $actionContent = '<span class="text-success fw-bold">ข้อมูลถูกต้องแล้ว</span><br><small class="text-muted">หากไม่พบข้อมูลในโปรแกรมให้ติดต่อ IT</small>';
                    } else {
                        $actionContent = '
                            <form action="lostjobbkk.php" method="POST" target="_blank">
                                <input type="hidden" name="edit_request_no" value="' . htmlspecialchars($row['request_no']) . '">
                                <input type="hidden" name="edit_job_no" value="' . htmlspecialchars($row['job_no']) . '">
                                <button type="submit" class="btn btn-warning btn-sm">ตรวจสอบแล้ว/แก้ไข</button>
                            </form>
                        ';
                    }
                    
                    $tableHtml .= '<tr>';
                    $tableHtml .= '<td>' . htmlspecialchars($row['request_no']) . '</td>';
                    $tableHtml .= '<td>' . htmlspecialchars($row['job_no']) . '</td>';
                    $tableHtml .= '<td class="text-center">' . $actionContent . '</td>';
                    $tableHtml .= '</tr>';
                }
                
                $tableHtml .= '</tbody></table></div>';
                $searchResult = $testButtonHtml . $tableHtml;
            } else {
                $searchResult = "<p class='alert alert-warning mt-4'>ไม่พบข้อมูลสำหรับเลขที่ใบคำขอ: " . htmlspecialchars($jobId) . "</p>";
            }
            sqlsrv_free_stmt($stmt);
        } else {
             $searchResult = "<p class='alert alert-danger'>เกิดข้อผิดพลาดในการค้นหาข้อมูล</p>";
        }
    }
} elseif (isset($_GET['error']) && $_GET['error'] === 'invalid_format') {
    $searchResult = "<p class='alert alert-danger'>รูปแบบเลขที่ใบคำขอไม่ถูกต้อง!</p>";
}

// ตรวจสอบสถานะการเชื่อมต่อเพื่อแสดงผล
if ($connBKK) {
    $statusMessage = "<p class='alert alert-success'>เชื่อมต่อฐานข้อมูลกรุงเทพฯ สำเร็จ!</p>";
} else {
    $statusMessage = "<p class='alert alert-danger'>ไม่สามารถเชื่อมต่อฐานข้อมูลกรุงเทพฯ ได้!</p>";
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้งานหาย - กรุงเทพฯ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; }
        .container { max-width: 900px; margin-top: 50px; background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h2 { color: #007bff; margin-bottom: 30px; font-weight: 600; }
        .alert { font-size: 1.1rem; }
        .btn-back { background-color: #6c757d; border-color: #6c757d; color: white; font-size: 1.1rem; padding: 10px 20px; border-radius: 8px; transition: background-color 0.2s; }
        .btn-back:hover { background-color: #5a6268; border-color: #545b62; }
    </style>
</head>
<body>
    <div class="container text-center">
        <h2>ระบบแก้งานหาย - สาขากรุงเทพฯ</h2>
        <?php echo $statusMessage; ?>

        <div class="mt-4 text-start">
            <form action="lostjobbkk.php" method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="jobIdInput" class="form-label fw-bold">เลขที่ใบคำขอ (ตัวอย่าง 68S/09145)</label>
                    <input
                        type="text"
                        class="form-control form-control-lg"
                        id="jobIdInput"
                        name="job_id"
                        maxlength="9"
                        pattern="[A-Za-z0-9/]{1,9}"
                        title="ต้องเป็นตัวอักษรภาษาอังกฤษ, ตัวเลข หรือ / และมีความยาวไม่เกิน 9 ตัวอักษร"
                        required
                        placeholder="กรอกเลขที่ใบคำขอที่นี่..."
                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                    >
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">ค้นหา</button>
                </div>
            </form>
            
            <?php if (!empty($searchResult)) echo $searchResult; ?>
        </div>

        <div class="mt-5">
            <a href="fix_lost_job.php" class="btn btn-back">กลับไปหน้าเลือกสาขา</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const jobIdInput = document.getElementById('jobIdInput');
        jobIdInput.addEventListener('input', function (event) {
            const forbiddenCharsRegex = /[^A-Za-z0-9/]/g;
            const cleanedValue = this.value.replace(forbiddenCharsRegex, '');
            this.value = cleanedValue;
        });
    </script>
</body>
</html>
<?php
if ($connBKK) {
    sqlsrv_close($connBKK);
}
?>
