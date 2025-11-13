<?php

include 'config/koneksi.php';

if (!isset($_GET['orderID'])) {
    die("Order ID tidak ditemukan. Silahkan kembali ke <a href='customers.php'>halaman customer</a>.");
}
$orderID = (int)$_GET['orderID'];

$totalHarga = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Order - <?php echo $orderID; ?> </title>
</head>
<body>
    <h2> Detail Order ID : <?php echo $orderID; ?> </h2>
    <table border="1">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Discount</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT od.OrderID, p.ProductName, od.UnitPrice, od.Quantity, od.Discount
                    FROM OrderDetails AS od
                    JOIN Products AS p ON od.ProductID = p.ProductID
                    WHERE od.OrderID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $orderID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    $subTotal = ($row['UnitPrice'] * $row['Quantity']) * (1 - $row['Discount']);
                    $totalHarga += $subTotal;
                    ?>
                    <tr>
                        <td><?php echo $row['OrderID']; ?></td>
                        <td><?php echo $row['ProductName']; ?></td>
                        <td><?php echo number_format($row['UnitPrice'], 2); ?></td>
                        <td><?php echo $row['Quantity']; ?></td>
                        <td><?php echo $row['Discount']; ?></td>
                        <td><?php echo number_format($subTotal, 2); ?></td>
                    </tr>
                    <?php 
                }
                } else {
                    echo "<tr?><td colspan= '6'>Tidak ada detail produk untuk order ini. </td></tr>";
                }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            ?>
        </tbody>
    </table>

    <h3> Total Harga Keseluruhan: <?php echo number_format($totalHarga, 2); ?> </h3>
    <br>
    <a href="customers.php">Kembali ke Daftar Customer</a>
    
</body>
</html>
