<?php

include 'config/koneksi.php';

if (!isset($_GET['customerID'])) {
    die("Customer ID tidak ditemukan. Silahkan kembali ke <a href='customers.php'>halaman customer</a>.");
}
$customerID = $_GET['customerID'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Order - <?php echo $customerID; ?> </title>
</head>
<body>
    <h2> Daftar Order untuk customer: <?php echo $customerID; ?> </h2>
    <table border="1">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Action </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT OrderID, OrderDate FROM Orders WHERE CustomerID = ? ORDER BY OrderDate DESC";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $customerID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo $row['OrderID']; ?></td>
                        <td><?php echo $row['OrderDate']; ?></td>
                        <td>
                            <a href="orderdetail.php?orderID=<?php echo $row['OrderID']; ?>"> Lihat Detail </a>
                        </td>
                    </tr>
                    <?php
                }
                } else {
                    echo"<tr><td colspan='3'>Customer ini tidak memilik order. </td></tr>";
                }

                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                ?>
            
        </tbody>
    </table>
    
</body>
</html>