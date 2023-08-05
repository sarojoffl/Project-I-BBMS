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
    <head>
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
    .xyz {
        display: table;
        margin-right: auto;
        margin-left: auto;
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
    <br>
    <h3 class="text-center">Update Blood Unit</h3><br>
    <div class="xyz">
        <form action="update_blood_stock.php" class="form-inline" method="POST">
            <div class="form-group mx-sm-3 mb-6">
                <select name="bloodgroup" class="form-control">
                    <option disabled="disabled" selected="selected">Choose Blood Group</option>
                    <option>O+</option>
                    <option>O-</option>
                    <option>A+</option>
                    <option>A-</option>
                    <option>B+</option>
                    <option>B-</option>
                    <option>AB+</option>
                    <option>AB-</option>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-6">
                <input type="number" class="form-control" name="unit" placeholder="Unit">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Update</button>
        </form>
    </div>
</div>
 </body>
</html>