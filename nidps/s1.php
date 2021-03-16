<?php 
	include 'header.php';
?>
<select onChange="window.location.href=this.value">
    <option value="s1.php">Insecure</option>
	<option value="s2.php">Secured</option>
</select>
<form action="s1.php" method="GET">
	<input type="text" name="search" placeholder="Search Username">
	<button  type="submit">Find</button>
	<td><a href="home.php"><button type="button" name="Home">Home</button></a></td>
</form>

<h2> SQL Injection Demo </h2>
<h3> Insecure</h3>
<div class="container" style = "width: 80%;">
	<table border="2" cellspacing="0" cellpadding="10">
        <tbody>
           <tr>
              <th>Username</th>
              <th>Password(md5)</th>
			  <th>Email</th>
              <th>IP Address</th>
           </tr>
<?php
	if(isset($_GET['search'])){		
		$search= $_GET['search'];
		if(empty($search)){
            echo "Please fill in the search bar";

            exit();
        }
		$sql ="SELECT * FROM login WHERE name LIKE '%$search%'";
		print "<p> $sql </p>";
		print "<hr>";
		$result = mysqli_query($con, $sql);
		$queryResult = mysqli_num_rows($result);
		
		echo "Total results: ".$queryResult."";

		if($queryResult > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo "<tr><td>".$row["name"]."</td>";
				echo "<td>".$row["md"]."</td>";
				echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["localIP"]."</td>";
			}
		}
		
	}
?>
		</tbody>
    </table>
</div>