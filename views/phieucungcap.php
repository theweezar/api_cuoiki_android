<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<table>
        <tr>
            <th>TÊN VĂN PHÒNG PHẨM</th>
            <th>SỐ LƯỢNG</th>
            <th>ĐƠN VỊ TÍNH</th>
            <th>THÀNH TIỀN</th>
        </tr>
        <?php
        foreach ($viewData['chitietcc'] as $key => $ct) {
            ?>
            <tr>
                <td><?php echo $ct['TENVPP'] ?></td>
                <td><?php echo $ct['SOLUONG'] ?></td>
                <td><?php echo $ct['DVT'] ?></td>
                <td><?php echo $ct['THANHTIEN'] ?></td>
            </tr>
            <?php   
        }
        ?>
    </table>
</body>
</html>