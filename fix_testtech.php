<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบแก้ปัญหางานในโปรแกรม Test Tech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 40px;
        }
        .card {
            width: 18rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-title {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">ระบบแก้ปัญหางานในโปรแกรม Test Tech</h2>
        <div class="card-container">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">งานหายไปจากระบบ</h5>
                    <p class="card-text">คลิกเพื่อแก้ไขปัญหางานที่หายไปจากระบบ</p>
                    <a href="fix_lost_job.php" class="btn btn-primary">ดำเนินการ</a>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">ฟอนต์เพี้ยน</h5>
                    <p class="card-text">คลิกเพื่อแก้ไขปัญหาเกี่ยวกับฟอนต์ที่แสดงผลผิดปกติ</p>
                    <a href="#" class="btn btn-primary disabled" aria-disabled="true">เร็วๆ นี้</a>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">โปรแกรมขึ้น The Server Threw an Exception</h5>
                    <p class="card-text">คลิกเพื่อแก้ไขปัญหาที่เกิดจากข้อผิดพลาดของเซิร์ฟเวอร์</p>
                    <a href="#" class="btn btn-primary disabled" aria-disabled="true">เร็วๆ นี้</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>