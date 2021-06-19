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
        b {
            display: inline-block;
            min-width: 5rem;
        }
    </style>
</head>
<body>
    <h1>Đơn đặt hàng</h1>
    <p>
        <b>Số phiếu: </b>
        <?php echo $viewData['sophieu'] ?>
    </p>
    <p>
        <b>Ngày giao: </b>
        <?php echo $viewData['ngaygiao'] ?>
    </p>
    <table>
        <tr>
            <th>TÊN VĂN PHÒNG PHẨM</th>
            <th>SỐ LƯỢNG</th>
            <th>ĐƠN VỊ TÍNH</th>
            <th>ĐƠN GIÁ</th>
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
                <td><?php echo intval($ct['THANHTIEN']) * intval($ct['SOLUONG']) ?></td>
            </tr>
            <?php   
        }
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>TỔNG CỘNG</td>
            <td><?php echo $viewData['tongcong'] ?></td>
        </tr>
    </table>
</body>
</html>