<?php

include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Customer</title>
</head>
<body>
    <h2> Daftar Customer</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Company Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT CustomerID, CompanyName FROM Customers ORDER BY CompanyName";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo $row['CustomerID']; ?></td>
                        <td><?php echo $row['CompanyName']; ?></td>
                        <td> 
                            <a href="orderlist.php?customerID=<?php echo $row['CustomerID']; ?>"> Lihat Order </a>
                        </td>
                    </tr>
                    <?php
                }
                } else {
                    echo"<tr><td colspan='3'>Tidak ada data customer. </td></tr>";
                }
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
    
</body>
</html>