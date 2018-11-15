<?php
/**
 * Copyright (C) 2013 peredur.net
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
sec_session_start();

 // CSRF Protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token']; 


include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Paper Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="../assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />

    <!--  Fonts and icons     -->
    
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/themify-icons.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.0/css/all.css">


	
</head>
<body>
<?php if (login_check($mysqli) == true) : ?>

<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="danger">


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    <?php echo htmlentities($_SESSION['username']); ?> <br> Medical Record
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="#">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="ti-user"></i>
                        <p>Patient</p>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
                        <i class="ti-view-list-alt"></i>
                        <p>Medical Record</p>
                    </a>
                </li>
                <li>
                    <a href="doctors-list.php">
                        <i class="fas fa-user-md"></i>
                        <p>Doctor List</p>
                    </a>
                </li>				
                <li>
                    <a href="fitness.php">
                        <i class="far fa-heart"></i>
                        <p>Fitness Data</p>
                    </a>
                </li>
                <li>
                    <a href="medicine.php">
                        <i class="fas fa-pills"></i>
                        <p>Medicine</p>
                    </a>
                </li>
                <li>
                    <a href="allergies.php">
                        <i class="fas fa-allergies"></i>
                        <p>Allergies</p>
                    </a>
                </li>				
                <li>
                    <a href="vaccination.php">
                        <i class="fas fa-syringe"></i>
                        <p>Vaccinations</p>
                    </a>
                </li>
                <li>
                    <a href="sleep.php">
                        <i class="fas fa-bed"></i>
                        <p>Sleep Data</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Documentation</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
								<p>Statistics</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">5</p>
									<p>Notifications</p>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
						<li>
                            <a href="../includes/logout.php?csrf=$_SESSION['csrf_token']">
								<i class="ti-settings"></i>
								<p>logout</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">New Entry</h4>
                                <p class="category">Here a new entry for the medical record is written</p>
                            </div>
                                <table class="table table-hover">
                                    <thead>
                                    	<th>Location</th>
                                    	<th>Doctor treating</th>
                                    	<th>Patient complaints</th>
										<th>Diagnosis</th>
										<th>Treatment</th>
                                    </thead>
                                    <tbody>							
										<tr>
										<form action="../includes/insert-medical-record.php?csrf=$_SESSION['csrf_token']" method="post">
											<td><input type="text" class="form-control" name="location" placeholder="Location"></td>
											<td><input type="text" class="form-control" name="responsive_doctor" placeholder="Doctor name"></td>
											<td><textarea id="note" class="form-control" name="issue_description" placeholder="Patient complaints"></textarea></td>
											<td><textarea id="note" class="form-control" name="diagnosis" placeholder="Diagnosis"></textarea></td>
											<td><textarea id="note" class="form-control" name="prescribed_solution" placeholder="Treatment"></textarea></td>
											<td><button type="submit" class="btn btn-primary">Save entry</button></td>
											<!-- CSRF Protection -->
											<input type="hidden" name="csrf" value="'.$_SESSION['csrf_token'].'">

										</form>
										</tr>
									</tbody>
								</table>
                        </div>
                    </div>

                </div>
            </div>
      <!--  </div> -->		
		
		
		
		
		
		
     <!--   <div class="content"> -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Medical Record</h4>
                                <p class="category">Here is the medical record</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <thead>
                                        <th>Date</th>
                                    	<th>Location</th>
                                    	<th>Doctor treating</th>
                                    	<th>Patient complaints</th>
										<th>Diagnosis</th>
										<th>Treatment</th>
                                    </thead>
                                    
                                       
<?php
 // check whether csrf token in _SESSION is valid, if not, die and stop script
if($_POST['csrf'] !== $_SESSION['csrf_token']) {
  die("invalid Token");
}
require "../includes/db_connect.php";

$query = "SELECT date,location, AES_DECRYPT(location, $SECRET),responsive_doctor, AES_DECRYPT(responsive_doctor, $SECRET),issue_description, AES_DECRYPT(issue_description, $SECRET),diagnosis, AES_DECRYPT(diagnosis, $SECRET),prescribed_solution,AES_DECRYPT(prescribed_solution, $SECRET) FROM medicalrecords"; //You don't need a ; like you do in SQL
$result = mysqli_query($connection, $query);					
while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
										echo "<tbody>";
										echo "<tr>";
                                        echo "<td>" . XSSdisarm($row['date']) . "</td>";
										echo "<td>" . XSSdisarm($row["AES_DECRYPT(location, $SECRET)"]) . "</td>";
										echo "<td>" . XSSdisarm($row["AES_DECRYPT(responsive_doctor, $SECRET)"]) . "</td>";
										echo "<td>" . XSSdisarm($row["AES_DECRYPT(issue_description, $SECRET)"]) . "</td>";
										echo "<td>" . XSSdisarm($row["AES_DECRYPT(diagnosis, $SECRET)"]) . "</td>";
										echo "<td>" . XSSdisarm($row["AES_DECRYPT(prescribed_solution, $SECRET)"]) . "</td>";
										echo "</tr>";
										echo "</tbody>";
										}
mysqli_close ($connection); //Make sure to close out the database connection
?>										
                                        
                                    
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
		
        <footer class="footer">

        </footer>

    </div>
</div>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="../index.php">login</a>.
            </p>
        <?php endif; ?>
</body>

    <!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="../assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="../assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="../assets/js/demo.js"></script>

	<script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>

	
	<script>
	autosize(document.getElementById("note"));

	
	</script>
</html>
