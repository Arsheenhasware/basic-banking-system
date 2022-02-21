<?php
    include("../config.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trident Bank</title>
    <link rel="stylesheet" href="transhis.css">
</head>
<body>
    <div class="container">
        <nav>
            <label class="logo">IFC Bank</label>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <h1>Transcation History</h1>
        <table>
            <tr>
                    <td>ID</td>
                    <td>Sender</td>
                    <td>Receiver</td>
                    <td>Amount</td>
                    <td>Transcation Date</td>
            </tr>
            <?php
                $sql = "select * from transcationdetails";
                $result = mysqli_query($conn,$sql);
                while($rows=mysqli_fetch_assoc($result)){
            ?>
            
            <tr>
                <td><?php echo $rows['id'];?></td>
                <td><?php echo $rows['sender'];?></td>
                <td><?php echo $rows['receiver'];?></td>
                <td><?php echo $rows['amount'];?></td>
                <td><?php echo $rows['transcationdate'];?></td>
            </tr>
            <?php
        }
        ?>
        </table>
    </div>
</body>
</html>