<?php session_unset();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="~/../libs/fontawesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="~/../libs/bootstrap.css">
    <script src="~/../libs/jquery.min.js"></script>
    <script src="~/../libs/bootstrap.js"></script>
    <style type="text/css">
    .wrapper {
        width: 650px;
        margin: 0 auto;
    }

    .page-header h2 {
        margin-top: 0;
    }

    table tr td:last-child a {
        margin-right: 15px;
    }

    .list {
        margin-left: 60px;

    }

    .home {
        margin-left: 10px;
        padding-right: 10px;
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <a href="index.php" class="btn btn-success home">Home</a>
                        <h2 class="pull-left">Patient Details</h2>
                        <a href="view/insert.php" class="btn btn-success pull-right">Add New Patient</a>
                        <a href="index.php?act=patients-list"" class="btn btn-success list">View Patients List</a>
                    </div>
                    <?php
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Name</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Contact</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['first_name'] . " " .$row['surname']."</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['contact'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='index.php?act=update&id=". $row['id'] ."' title='Update Record' data-toggle='tooltip' style='color:blue'><i class='fa fa-edit'></i></a>";
                                        echo "<a href='index.php?act=delete&id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip' style='color:red'><i class='fa fa-trash'></i></a>";
                                        echo "<a href='index.php?act=accepted&id=". $row['id'] ."' title='Accept Record' data-toggle='tooltip' style='color:green'><i class='fa fa-check'></i></a>";
                                        echo "<a href='index.php?act=rejected&id=". $row['id'] ."' title='Reject Record' data-toggle='tooltip' style='color:black'><i class='fa fa-ban'></i></a>";                                        
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>