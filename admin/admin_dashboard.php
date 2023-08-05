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
    <?php include 'adminbase.html'; ?>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="blood">
                            <h2>A+ <i class="fas fa-tint"></i></h2>
                        </div><br><br>
                        <div>
                            <?php echo $A1_unit; ?> ml
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="blood">
                            <h2>B+ <i class="fas fa-tint"></i></h2>
                        </div><br><br>
                        <div>
                            <?php echo $B1_unit; ?> ml
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="blood">
                            <h2>O+ <i class="fas fa-tint"></i></h2>
                        </div><br><br>
                        <div>
                            <?php echo $O1_unit; ?> ml
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="blood">
                            <h2>AB+ <i class="fas fa-tint"></i></h2>
                        </div><br><br>
                        <div>
                            <?php echo $AB1_unit; ?> ml
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="blood">
                            <h2>A- <i class="fas fa-tint"></i></h2>
                        </div><br><br>
                        <div>
                            <?php echo $A2_unit; ?> ml
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="blood">
                            <h2>B- <i class="fas fa-tint"></i></h2>
                        </div><br><br>
                        <div>
                            <?php echo $B2_unit; ?> ml
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="blood">
                            <h2>O- <i class="fas fa-tint"></i></h2>
                        </div><br><br>
                        <div>
                            <?php echo $O2_unit; ?> ml
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="blood">
                            <h2>AB- <i class="fas fa-tint"></i></h2>
                        </div><br><br>
                        <div>
                            <?php echo $AB2_unit; ?> ml
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-sm-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="blood">
                            <i class="fas fa-users"></i>
                        </div><br>
                        <div>
                            Total Donors <br>
                            <?php echo $totaldonors; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="blood">
                            <i class="fas fa-spinner"></i>
                        </div><br>
                        <div>
                            Total Requests <br>
                            <?php echo $totalrequest; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="blood">
                            <i class="far fa-check-circle"></i>
                        </div><br>
                        <div>
                            Approved Requests <br>
                            <?php echo $totalapprovedrequest; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="blood">
                            <i class="fas fa-tint xyz"></i>
                        </div><br>
                        <div>
                            Total Blood Unit (in ml) <br>
                            <?php echo $totalbloodunit; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
