<?php
require 'session.php';
include 'data.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .container {
        position: relative;
        left: 100px;
    }

    .row{
        padding: 5px;
    }
    .fa-tint{     
        color: red;    
    }
    .blood{
        float: right;
    }
    .fa-users{     
        color: blue; 
        font-size: 3ex;   
    }
    .fa-spinner{     
        color: blue; 
        font-size: 3ex;   
    }
    .fa-check-circle{     
        color: blue; 
        font-size: 3ex;   
    }
    .xyz{     
        color: blue; 
        font-size: 3ex;   
    }
</style>
</head>
<body>
  <?php include 'donorbase.html'; ?>

<br><br>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="blood">
                        <i class="fas fa-sync-alt xyz"></i>
                    </div><br>
                    <div>
                        Request Made <br>
                        <?php echo $requestmade; ?>
                    </div>                            
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="blood">
                        <i class="fas fa-sync xyz"></i>
                    </div><br>
                    <div>
                        Pending Request <br>
                        <?php echo $requestpending; ?>
                    </div>                            
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="blood">
                        <i class="fas fa-check-circle xyz"></i>
                    </div><br>
                    <div>
                        Approved Request<br>
                        <?php echo $requestapproved; ?>
                    </div>                            
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="blood">
                        <i class="fas fa-times-circle xyz"></i>
                    </div><br>
                    <div>
                        Rejected Request <br>
                        <?php echo $requestrejected; ?>
                    </div>                            
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>