<?php
	require("session_handling.php");
?>


<!DOCTYPE html>
<html lang="utf=8">
	<head>
		<title>Admin Users</title>
		<link rel="stylesheet" href="astyle.css">
	</head>
	<body>

		<div class="sidebar">
			<img src ="images/logo.png" width="160" height="100">
				<img src="images/profile.png" class="profile">
					<a href="admin.php">Dashboard</a>
					<a href="apselect.php">Product</a>
					<a href="auser.php">Users</a>
					<a href="index.php">Statistic</a>
					<a href="index.php">Logout</a>
		</div>


		<!-- search function -->
        <div class="invisible-header">
            <div class="search">
                <form action="#" method="post">
                    <input type="text" name="search-query" placeholder="Search user" autocomplete="off">
                    <input type="submit" name="search-btn">
                </form>
            </div>
        </div>


		<div class="content-area">
			<table>				
				<?php
				include("Connectdb.php");

				if (isset($_POST['id'])){
				$id=$_POST['id'];	
				$delete= mysqli_query($con, "DELETE from `db` where id = '$id'");
					
				}

				$query = "";
				
				// if the user uses the search filter
				if (isset($_POST['search-query'])) {
					// cleaning the input from whitespace & special characters
					$userSearch = $_POST['search-query'];
					$userSearch = trim($userSearch);
					$userSearch = addslashes($userSearch);

					$query = "SELECT id, name, email from db WHERE ";
					$query .= "name LIKE '%$userSearch%' OR email LIKE '%$userSearch%'";

					// retriving query result
					$result = mysqli_query($con, $query);

					if (mysqli_num_rows($result) > 0) {
						echo "<tr>";
						echo "	<th>Username</th>";
						echo "	<th>Email</th>";
						echo "	<th></th>";
						echo "</tr>";

						while ($row = mysqli_fetch_assoc($result)){
							echo "<tr>";
							echo "    <td>".$row['name']."</td>";
							echo "    <td>".$row['email']."</td>";
							echo "    <td><button class='delete-btn delete' value='".$row['id']."'>Delete</div></td>";
							echo "</tr>";
						}
						echo"</table>";
					}
					else {
						
						echo"<p style='margin-top: 24%; font-size: 1.5rem;'>0 result</p>";		
					}
				}
				else {
					// display all users if search filter is empty
					$query = "SELECT id, name, email from db ";

					// retriving query result
					$result = mysqli_query($con, $query);

					if (mysqli_num_rows($result) > 0) {
						echo "<tr>";
						echo "	<th>Username</th>";
						echo "	<th>Email</th>";
						echo "	<th></th>";
						echo "</tr>";

						while ($row = mysqli_fetch_assoc($result)){
							echo "<tr>";
							echo "    <td>".$row['name']."</td>";
							echo "    <td>".$row['email']."</td>";
							echo "    <td><button class='delete-btn delete' value='".$userID = $row['id']."'>Delete</div></td>";
							echo "</tr>";
	
						}
						echo"</table>";
					}
					else {
						
						echo"<p style='margin-top: 24%; font-size: 1.5rem;'>0 result</p>";		
					}
				}

				// closing database connection
				$con-> close();
				?>
			</table>
		</div>
		<br/><br/>


		<!-- pop-up alert to confirm if user wants to delete item -->
        <div id="dimOverlay" class="dimmed-overlay" style="display: none;"></div>

        <div id="confirmDel" class="confirm-del" style="display: none;">
            <p>Are you sure you want to delete this user?</p>
            <div class="confirm-del-btn">
                <form action="auser.php" method="post">
                    <input type="hidden" name="id">
                    <button type="submit">Yes</button>
                </form>
                <button id="dismissBtn">No</button>
            </div>
        </div>


		<!-- javascript -->
		<script>
            // 'querySelectorAll' for selecting all elements that match the 'delete-btn' class
            let delButtons = document.querySelectorAll(".delete-btn");
            let dismissBtn = document.getElementById("dismissBtn");
            const dimmedBg = document.getElementById("dimOverlay");
            const alertBox = document.getElementById("confirmDel");

            // if user clicks on "Yes", perform steps to send product ID into `db_deleteproduct.php`
            delButtons.forEach(function(delBtn) {
                delBtn.addEventListener("click", function() {
                    // retrieving the user ID from the button
                    let productID = delBtn.getAttribute("value");

                    // displaying the alertbox
                    if (alertBox.style.display === "none") {
                        dimmedBg.style.display = "block";
                        alertBox.style.display = "block";
                    }
                    else {
                        dimmedBg.style.display = "none";
                        alertBox.style.display = "none";
                    }

                    // locating the hidden input form field & passing productID into it
                    document.querySelector("input[name='id']").value = productID;
                });
            })



            // if user click son "No"
            dismissBtn.addEventListener("click", function() {
                // displaying the alert box
                if (alertBox.style.display === "none") {
                    dimmedBg.style.display = "block";
                    alertBox.style.display = "block";
                }
                else {
                    dimmedBg.style.display = "none";
                    alertBox.style.display = "none";
                }
            });

        </script>
	</body>
</html>