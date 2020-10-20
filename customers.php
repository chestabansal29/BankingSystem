<!DOCTYPE html>
<html>
    <head>
        <title>Customer Records</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
    </head>
    <body>
        <div class="container">
            <h1 class="text-primary text-uppercase text-center">CUSTOMER RECORDS</h1>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
                Insert Record</button>
            </div>
            <h3>ALL ACCOUNTS STATUS</h3>
    
            <div id="records_contant"></div>
            <!--Insert form-->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Enter Details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Customer Name: </label>
                                <input type="text" name="" id="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label>Account Balance: </label>
                                <input type="text" name="" id="amount" class="form-control" placeholder="Amount">
                            </div>
                            <div class="form-group">
                                <label>Email Id: </label>
                                <input type="text" name="" id="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label>Contact Number: </label>
                                <input type="text" name="" id="mobile" class="form-control" placeholder="Mobile Number">
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addrecord()">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <!--transaction form-->
            <div class="modal" id="transact">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Enter Transaction Details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <h6>From:</h6>
                                <input type="text" name="" id="from" class="form-control" placeholder="Account Number">
                            </div>
                            <div class="form-group">
                                <h6>To:</h6>
                                <input type="text" name="" id="to" class="form-control" placeholder="Account Number">
                            </div>
                            <div class="form-group">
                                <h6>Amount to be transfer:</h6>
                                <input type="text" name="" id="t_amount" class="form-control" placeholder="Amount">
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="transfer()">Proceed</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <div>
                <h3>Proceed for Transaction</h3>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#transact">
                        Transaction</button>
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-warning" data-toggle="modal" onclick="location.href='transaction.php'">
                    View Transaction Records</button>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script type="text/javascript">

            $(document).ready(function(){
                readRecords();
            });
            

            ///read records
            function readRecords()
            {
                var readrecord = "readrecord";
                $.ajax({
                    url:"backend.php",
                    type:'post',
                    data:{ readrecord:readrecord },
                    success:function(data,status){
                        $('#records_contant').html(data);
                    }
                });
            }
            ///insert record
            function addrecord()
            {
                var name= $('#name').val();
                var amount= $('#amount').val();
                var email= $('#email').val();
                var mobile= $('#mobile').val();

                $.ajax({

                    url:"backend.php",
                    type:'post',
                    data: { name :name,
                            amount :amount,
                            email :email,
                            mobile :mobile
                    },

                    success:function(data,status){
                        readRecords();
                    }

                });
            }

            /// Delete record

            function DeleteUser(deleteid)
            {
                var conf = confirm("Do you want to delete this record ?");
                if(conf==true)
                {
                    $.ajax({

                        url:"backend.php",
                        type:"post",
                        data:{ deleteid:deleteid },
                        success:function(data,status)
                        {
                            readRecords();
                        }

                    });
                }
            }

            ///Transaction

            function transfer()
            {
                var conf = confirm("Do you really want to proceed the Transaction ?");
                if(conf==true)
                {
                    var from= $('#from').val();
                    var to= $('#to').val();
                    var t_amount= $('#t_amount').val();
                    $.ajax({

                        url:"backend.php",
                        type:"post",
                        data:{ from :from,
                            to :to,
                            t_amount :t_amount
                        },
                        success:function(data,status)
                        {
                            if(data=='success')
                            {
                                alert("Transaction Successfull!")
                            }
                            else if(data=='id_failure')
                                alert(" Transaction Failed!...Invalid Account Number...")
                            else
                                alert(" Transaction Failed!...Insufficient Balance...")
                            readRecords();
                        }

                    });
                }
            }

        </script>

    </body>
</html>