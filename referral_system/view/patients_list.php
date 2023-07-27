<!DOCTYPE html>
<html>

<head>
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
    .tab {
        display: none;
    }
    </style>
    <script>

    // JavaScript function to switch between tabs
    function openTab(tabName) {
        var i, x;
        x = document.getElementsByClassName("tab");
     

        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        document.getElementById(tabName).style.display = "block";

    }
    </script>
</head>

<body>
    <h2>Patients</h2>

    <!-- Tab navigation buttons -->
    <button onclick="openTab('referred')">Referred Patients</button>
    <button onclick="openTab('rejected')">Rejected Patients</button>
    <button onclick="openTab('accepted')">Accepted Patients</button>

    <!-- Tab content -->
    <div id="referred" class="tab">
        <h3>Referred Patients</h3>
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
                        if($row['referred'] == "referred"){
                        echo "<tr>";
                            echo "<td>" . $row['first_name'] . " " .$row['surname']."</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['contact'] . "</td>";
                            echo "<td>";
                            echo "<td>";
                            echo "<a href='index.php?act=update&id=". $row['id'] ."' title='Update Record' data-toggle='tooltip' style='color:blue'><i class='fa fa-edit'></i></a>";
                            echo "<a href='index.php?act=delete&id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip' style='color:red'><i class='fa fa-trash'></i></a>";
                            echo "<a href='index.php?act=accepted&id=". $row['id'] ."' title='Accept Record' data-toggle='tooltip' style='color:green'><i class='fa fa-check'></i></a>";
                            echo "<a href='index.php?act=rejected&id=". $row['id'] ."' title='Reject Record' data-toggle='tooltip' style='color:black'><i class='fa fa-ban'></i></a>";                                        
                            echo "</td>";
                        echo "</tr>";
                        }
                    }
                    echo "</tbody>";                            
                echo "</table>";
                // Free result set
            } else{
                echo "<p class='lead'><em>No records were found.</em></p>";
            }
                    
        ?>
    </div>

    <div id="rejected" class="tab">
        <h3>Rejected Patients</h3>
        <?php
            mysqli_data_seek($result,0);
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
                        if($row['accepted'] == '0' && empty($row['accepted'])){
                        echo "<tr>";
                            echo "<td>" . $row['first_name'] . " " .$row['surname']."</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['contact'] . "</td>";
                            echo "<td>";
                            echo "<td>";
                            echo "<a href='index.php?act=update&id=". $row['id'] ."' title='Update Record' data-toggle='tooltip' style='color:blue'><i class='fa fa-edit'></i></a>";
                            echo "<a href='index.php?act=delete&id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip' style='color:red'><i class='fa fa-trash'></i></a>";
                            echo "<a href='index.php?act=accepted&id=". $row['id'] ."' title='Accept Record' data-toggle='tooltip' style='color:green'><i class='fa fa-check'></i></a>";
                            echo "<a href='index.php?act=rejected&id=". $row['id'] ."' title='Reject Record' data-toggle='tooltip' style='color:black'><i class='fa fa-ban'></i></a>";                                        
                            echo "</td>";
                        echo "</tr>";
                        }
                    }
                    echo "</tbody>";                            
                echo "</table>";
                // Free result set
            } else{
                echo "<p class='lead'><em>No records were found.</em></p>";
            }
                    
        ?>
    </div>

    <div id="accepted" class="tab">
        <h3>Accepted Patients</h3>
        <?php
            mysqli_data_seek($result,0);
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
                        if($row['accepted'] == 1){
                        echo "<tr>";
                            echo "<td>" . $row['first_name'] . " " .$row['surname']."</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['contact'] . "</td>";
                            echo "<td>";
                            echo "<td>";
                            echo "<a href='index.php?act=update&id=". $row['id'] ."' title='Update Record' data-toggle='tooltip' style='color:blue'><i class='fa fa-edit'></i></a>";
                            echo "<a href='index.php?act=delete&id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip' style='color:red'><i class='fa fa-trash'></i></a>";
                            echo "<a href='index.php?act=accepted&id=". $row['id'] ."' title='Accept Record' data-toggle='tooltip' style='color:green'><i class='fa fa-check'></i></a>";
                            echo "<a href='index.php?act=rejected&id=". $row['id'] ."' title='Reject Record' data-toggle='tooltip' style='color:black'><i class='fa fa-ban'></i></a>";                                        
                            echo "</td>";
                        echo "</tr>";
                        }
                    }
                    echo "</tbody>";                            
                echo "</table>";
                // Free result set
            } else{
                echo "<p class='lead'><em>No records were found.</em></p>";
            }
            ?>
    </div>

    <script>
    // Show the first tab by default
    openTab('referred');
    </script>
</body>

</html>