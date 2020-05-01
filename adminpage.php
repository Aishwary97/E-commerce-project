 <?php
$servername = "localhost";
$username = "root";
$password = "----";
$dbname = "bitnami_wordpress";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<style>
      table, th, td {
      padding: 10px;
      border: 1px solid black; 
      border-collapse: collapse;
      }
    </style>
	<head>
		<title>Admin Page</title>
	</head>
	<body>
		<h1 style="text-align:center">Share Your Experience With Us!</h1>
		
		<!-- FILE UPLOADING -->
		<style type="text/css">
				output *{
				color: red !important;
			}
			</style>
		<!-- Javascript Part -->
		<script>
			window.addEventListener("load", function () {

			function clearAllOutputs(){
				var outputs = document.querySelectorAll('output');
				for(i = 0; i < outputs.length; i++) {
					outputs[i].innerHTML="";
				}
			}
		  function sendData(form,url,outputid) {
			var XHR = new XMLHttpRequest();

			// Bind the FormData object and the form element
			var FD = new FormData(form);

			// Define what happens on successful data submission
			XHR.addEventListener("load", function(event) {
				clearAllOutputs();
			  document.getElementById(outputid).innerHTML = event.target.responseText;
			});

			// Define what happens in case of error
			XHR.addEventListener("error", function(event) {
			  alert('Oops! Something went wrong.');
			});

			// Set up our request
			XHR.open("POST", url);

			// The data sent is what the user provided in the form
			XHR.send(FD);
		  }
		 
		  function setupform(formid,url, outputid) {
			var form = document.getElementById(formid);
			form.addEventListener("submit", function (event) {
			event.preventDefault();
			sendData(form, url, outputid);
		  });
		  
		  }
		  setupform("fileform", "FileUpload_Non.php", "fileoutput");  
		});
		</script>
		<!-- HTML Part-->
		<div>
			<h2>
				Upload Your Images for Other Customers 
			</h2>
			<p>
			Please submit photes of you enjoying our products and we will post them for everyone to see!!<br>
			Only submit files with a .png or .jpg extentions. Thank you! 
			</p>
			<div class="body_padded">
				<div class="vulnerable_code_area">
					<form id = "fileform" action="FileUpload_Non.php" method="post" enctype="multipart/form-data">
						Select file to upload:
						<input type="file" name="fileToUpload" id="fileToUpload">
						<input type="submit" value="Upload File" name="submit">
					</form>
					<output id="fileoutput"></output>
				</div>
			</div>
		</div>
		
		<br>
		
		
			
				<?php


				require('wp-load.php');
				if ( is_user_logged_in() ) {
					global $current_user;
					$role = $current_user->roles[0];
					
					
					if($role == "administrator"){
						?>
						<button onClick="viewLog()">Show User Activity Log</button>
						<script>
							function viewLog(){
								var x = document.getElementById("userLog");
								if (x.style.display === "none") {
									x.style.display = "block";
								} else {
									x.style.display = "none";
								}
							}
						</script>
			<div id="userLog" style="display:none;">
			<h2>Registered Users:</h2>
			<table>
				<tr>
					<th>ID</th>
					<th>Username</th>
					<th>User Password</th>
				</tr>
			
						<?php
						$sql1 = "SELECT * FROM `wp_users`";
						$result = $conn->query($sql1);
						if ($result->num_rows > 0) {
						// output data of each row
						
						while($row1 = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<th>" . $row1["ID"] . "</th>";
							echo "<th>" . $row1["user_login"] . "</th>";
							echo "<th>" . $row1["user_pass"] . "</th>";

							echo "</tr>";
						}
						} else {
							echo "0 results";
						}
					
				?> 

				</table>
			<h2>Users Activity Log:</h2>
			<table>
				<tr>
					<th>#</th>
					<th>Username</th>
					<th>User Role</th>
					<th>Activity</th>
					<th>Email</th>
					<th>Date</th>
				</tr>
			
				<?php
				$sql = "SELECT * FROM `wp_ualp_user_activity`";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				// output data of each row
				
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<th>" . $row["uactid"] . "</th>";
					echo "<th>" . $row["user_name"] . "</th>";
					echo "<th>" . $row["user_role"] . "</th>";
					echo "<th>" . $row["action"] . "</th>";
					echo "<th>" . $row["user_email"] . "</th>";
					echo "<th>" . $row["modified_date"] . "</th>";
					echo "</tr>";
				}
				} else {
					echo "0 results";
				}
				$conn->close();
					}
				}
				
				?> 

			</table>
		</div>
	</body>
</html> 
