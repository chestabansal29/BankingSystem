<?php

    $Server = "sql107.epizy.com";
    $username = "epiz_26913113";
    $password = "i6tpR0ZQ4gJ";
    $dbname = "epiz_26913113_customers";
    $conn=mysqli_connect($Server,$username,$password,$dbname);
    extract($_POST);

    ///Read record
    
    if(isset($_POST['readrecord'])){

        $data = '<table class="table table-bordered table-striped">
                    <tr>
                        <th>Account Number</th>
                        <th>Name</th>
                        <th>Current Balance</th>
                        <th>Email Id</th>
                        <th>Contact Number</th>
                        <th>Delete</th>
                    </tr>';

        $displayquery = "SELECT * FROM custrecord";
        $result = mysqli_query($conn,$displayquery);

        if($result && mysqli_num_rows($result) > 0 )
        {
            while($row = mysqli_fetch_array($result))
            {
                $data .= '<tr>
                    <td>'.$row['Account Number'].'</td>
                    <td>'.$row['Name'].'</td>
                    <td>'.$row['Amount'].'</td>
                    <td>'.$row['Email'].'</td>
                    <td>'.$row['Mobile'].'</td>
                    <td>
                        <button onclick="DeleteUser('.$row['Account Number'].')" class="btn btn-danger">Delete</button>
                    </td>
                </tr>';
            }
        }

        $data .= '</table>';
        echo $data;
    }
    ///Insert record
    
    if(isset($_POST['name']) && isset($_POST['amount']) && isset($_POST['email']) && isset($_POST['mobile']))
    {
        $query = "INSERT INTO `custrecord`(`Name`, `Amount`, `Email`, `Mobile`) VALUES ('$name',$amount,'$email','$mobile')";
        mysqli_query($conn,$query);
    }

    ///Delete user record

    if(isset($_POST['deleteid']))
    {
        $userid = $_POST['deleteid'];
        $deletequery = "DELETE FROM `custrecord` WHERE `Account Number`='$userid'";
        mysqli_query($conn,$deletequery);
    }

    ///Perform Transaction

    if(isset($_POST['from']) && isset($_POST['to']) && isset($_POST['t_amount']))
    {
        $sql1 = "SELECT `Account Number` FROM custrecord where `Account Number`='$from'";
        $sql2 = "SELECT `Account Number` FROM custrecord where `Account Number`='$to'";
        
        $check1 = mysqli_query($conn,$sql1);
        $check2 = mysqli_query($conn,$sql2);

        if(mysqli_num_rows($check1) == 1 && mysqli_num_rows($check2) == 1)
        {
            $am = "SELECT `Amount` FROM custrecord where `Account Number`='$from' AND `Amount`>='$t_amount' ";
            $x = mysqli_query($conn,$am);

            if(mysqli_num_rows($x) == 1)
            {
                $minus = "UPDATE `custrecord` SET `Amount`=`Amount`-'$t_amount' WHERE `Account Number`='$from'";
                $add = "UPDATE `custrecord` SET `Amount`=`Amount`+'$t_amount' WHERE `Account Number`='$to'";
                $abc = "INSERT INTO `transaction`(`From_account`, `To_account`, `Amount`,`Transaction_time`) VALUES ('$from','$to','$t_amount',curdate())";

                mysqli_query($conn,$minus);
                mysqli_query($conn,$add);
                mysqli_query($conn,$abc);
                echo 'success';
                
            }
            else{
                echo 'amount_failure';
            }
        }

        else{
            echo 'id_failure';
        }
        
    }

?>