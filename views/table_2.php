<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table tr th,table tr td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>BÁO CÁO THEO PHÒNG BAN</h1>
    <table>
        <tr>
            <th>STT</th>
            <th>SỐ PHIẾU</th>
            <th>Mã nhân viên</th>
            <th>NGÀY CẤP</th>
            <th>TÊN VĂN PHÒNG PHẨM</th>
            <th>TRỊ GIÁ</th>
        </tr>
        <?php
        foreach ($viewData as $key => $row) {
            ?>
            <tr>
                <td><?php echo $row->STT ?></td>
                <td><?php echo $row->SOPHIEU ?></td>
                <td><?php echo $row->MANV ?></td>
                <td><?php echo $row->NGAYCAP ?></td>
                <td><?php echo $row->TENVPP ?></td>
                <td><?php echo $row->TRIGIA ?></td>
            </tr>
            <?php   
        }
        ?>
    </table>
</body>
</html>