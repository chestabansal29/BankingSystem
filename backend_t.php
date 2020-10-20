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
                        <th>Transaction ID</th>
                        <th>Transaction From</th>
                        <th>Transaction To</th>
                        <th>Amount</th>
                        <th>Date and Time</th>
                    </tr>';

        $displayquery = "SELECT * FROM `transaction`";
        $result = mysqli_query($conn,$displayquery);

        if($result && mysqli_num_rows($result) > 0 )
        {
            while($row = mysqli_fetch_array($result))
            {
                $data .= '<tr>
                    <td>'.$row['Transaction_ID'].'</td>
                    <td>'.$row['From_account'].'</td>
                    <td>'.$row['To_account'].'</td>
                    <td>'.$row['Amount'].'</td>
                    <td>'.$row['Transaction_time'].'</td>
                </tr>';
            }
        }

        $data .= '</table>';
        echo $data;
    }
    
?>