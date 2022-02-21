<?php
    include("config.php");
    if(isset($_POST['submit'])){
        $from = $_GET['id'];
        $to = $_POST['to'];
        $amount = $_POST['amount'];
    
        $sql = "select * from viewcus where id=$from";
        $query = mysqli_query($conn,$sql);
        $pro1 = mysqli_fetch_assoc($query);
    
        $sql = "select * from viewcus where id=$to";
        $query = mysqli_query($conn,$sql);
        $pro2 = mysqli_fetch_assoc($query);
    
        
            //deducting balance from sender account.
            $transfer = $pro1['balance'] - $amount;
            $sql= "update viewcus set balance=$transfer where id=$from";
            mysqli_query($conn,$sql);
    
            //Adding balance to receiver account.
            $transfer = $pro2['balance'] + $amount;
            $sql= "update viewcus set balance=$transfer where id=$to";
            mysqli_query($conn,$sql);
    
            //showing Transaction History
    
            if($amount < 0){
                echo '<script>alert("Amount cannot be negative.")</script>';
            }
            else if($amount == 0){
                echo '<script>alert("Amount cannot be zero")</script>';
            }
            else if($amount > $pro1['balance']){
                echo '<script>alert("Insufficient Balance");</script>';
            }
            else{
                //deducting balance from sender account.
                $transfer = $pro1['balance'] - $amount;
                $sql= "update viewcus set balance=$transfer where id=$from";
                mysqli_query($conn,$sql);
        
                //Adding balance to receiver account.
                $transfer = $pro2['balance'] + $amount;
                $sql= "update viewcus set balance=$transfer where id=$to";
                mysqli_query($conn,$sql);
        
                //showing Transaction History
        
                $sender = $pro1['name'];
                $receiver = $pro2['name'];
                $sql = "insert into transcationdetails (sender,receiver,amount) values('$sender','$receiver','$amount')";
                $query = mysqli_query($conn,$sql);
                if($query){
                    echo '<script>alert("Transcation Successfull!");</script>';
                    echo '<script>window.location.href="transhis.php"</script>';
                }
                $transfer=0;
                $amount=0;
            }
        }
    
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
            <h1>Transfer Money</h1>
            <hr>
            <?php
                $sid=$_GET['id'];
                $sql = "select * from viewcus where id=$sid";
                $query=mysqli_query($conn,$sql);
                $rows=mysqli_fetch_assoc($query);
            ?>
            <form>
                Name:<input type="text" name="name" value="<?php echo $rows['name'];?>" readonly>
                Email:<br><br><input type="email" value="<?php echo $rows['email'];?>" readonly><br><br>
            Balance:<br><br><input type="text" value="<?php echo $rows['balance'];?>" readonly><br><br>
            To:<br><br><select name="to" class="select" required>
                <option disabled selected>Select another account for transfer</option>
                <?php
                    $sql = "select * from viewcus where id!=$sid";
                    $query_run = mysqli_query($conn,$sql);
                    while($rows=mysqli_fetch_assoc($query_run)){
                ?>
                <option class="option" value="<?php echo $rows['id'];?>"><?php echo $rows['name']?></option>
                        <?php
                    }
                        ?>
            </select><br><br>
            Amount:<br><br><input type="text" name="amount"><br><br>
            <input type="submit" name="submit">
            </form>
        </div>
    </div>
</body>
</html>