<?php
    include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sparks Bank</title>
    <link rel="stylesheet" href="viewcus.css">
</head>
<body>
    <div class="container">
        <nav>
            <label class="logo"><a href="index.php">Sparks Bank</a></label>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <div class="home">
            <h1>View Customer</h1>
            <hr>
            <table>
                <?php
                $sql ="Select * from viewcus";
                $query = mysqli_query($conn,$sql);
                ?>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Balance</th>
                    <th>Operations</th>
                </tr>
                <?php
                    while($rows=mysqli_fetch_assoc($query)){
                ?>
                <tr>
                    <td><?php echo $rows['id'];?></td>
                    <td><?php echo $rows['name'];?></td>
                    <td><?php echo $rows['email'];?></td>
                    <td><?php echo $rows['phone'];?></td>
                    <td><?php echo $rows['balance'];?></td>
                    <td><a href="trans.php?id=<?php echo $rows['id'];?>">Transfer</a></td>
                </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>