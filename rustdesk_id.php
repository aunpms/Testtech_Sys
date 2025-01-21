<!DOCTYPE html>
<html>

<head>
    <title>Google Sheets Data</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #00f;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    RUSTDESK ID
    <?php
    function getSheetData($spreadsheetId, $sheetName)
    {
        $csvUrl = "https://docs.google.com/spreadsheets/d/$spreadsheetId/gviz/tq?tqx=out:csv&sheet=$sheetName";
        $dataArray = [];
        if (($handle = fopen($csvUrl, "r")) !== FALSE) {
            $headers = [];
            $firstRow = true;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($firstRow) {
                    $headers = $data;
                    $firstRow = false;
                } else {
                    $dataArray[] = $data;
                }
            }
            fclose($handle);
            return [$headers, $dataArray];
        } else {
            return null;
        }
    }

    $spreadsheetId = '16KeWb-6DH-7drxqosD8BWwFk7tReZiY5D2OREblSUnE';
    $sheetName = 'rustdesk_id';

    list($headers, $dataArray) = getSheetData($spreadsheetId, $sheetName);

    function displayTable($headers, $dataArray)
    {
        if ($headers && $dataArray) {
            echo "<table>";
            echo "<tr>";
            foreach ($headers as $header) {
                echo "<th>" . htmlspecialchars($header) . "</th>";
            }
            echo "</tr>";
            foreach ($dataArray as $row) {
                echo "<tr>";
                foreach ($row as $index => $cell) {
                    // ตรวจสอบว่า Header คือ RustdeskId
                    if (strcasecmp($headers[$index], 'RustdeskId') == 0) {
                        echo "<td><a href='rustdesk://$cell'>" . htmlspecialchars($cell) . "</a></td>";
                    } else {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "ไม่สามารถดึงข้อมูลได้";
        }
    }

    displayTable($headers, $dataArray);
    ?>
</body>

</html>
