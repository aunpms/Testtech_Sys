<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้งานหายไปจากระบบ</title>
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
        <h2 class="text-center mb-4">เลือกพื้นที่สำหรับแก้ไขงานที่หายไป</h2>
        <div class="card-container">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">กรุงเทพมหานคร</h5>
                    <p class="card-text">คลิกเพื่อดำเนินการแก้ไขงานที่หายไปในพื้นที่กรุงเทพฯ</p>
                    <a href="lostjobbkk.php" class="btn btn-primary">เลือกกรุงเทพฯ</a>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">ชลบุรี</h5>
                    <p class="card-text">คลิกเพื่อดำเนินการแก้ไขงานที่หายไปในพื้นที่ชลบุรี</p>
                    <a href="lostjobcb.php" class="btn btn-primary">เลือกชลบุรี</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>