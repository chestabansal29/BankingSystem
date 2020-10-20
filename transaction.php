<!DOCTYPE html>
<html>
    <head>
        <title>Transaction Records</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <h1 class="text-primary text-uppercase text-center">TRANSACTION RECORDS</h1>
            <div id="transaction_contant"></div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-warning" data-toggle="modal" onclick="location.href='index.php'">
                    BACK TO HOME</button>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script type="text/javascript">

            $(document).ready(function(){
                Records();
            });
            

            ///read records
            function Records()
            {
                var readrecord = "readrecord";
                $.ajax({
                    url:"backend_t.php",
                    type:'post',
                    data:{ readrecord:readrecord },
                    success:function(data,status){
                        $('#transaction_contant').html(data);
                    }
                });
            }
        </script>
    </body>
</html>