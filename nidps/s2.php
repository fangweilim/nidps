<?php 
	include 'header.php';
?>
<select onChange="window.location.href=this.value">
	<option value="s2.php">Secured</option>
    <option value="s1.php">Insecure</option>
</select>
<form action="s2.php" method="POST">
	<input type="text" name="search" placeholder="Search Username">
	<button  type="submit">Find</button>
	<td><a href="home.php"><button type="button" name="Home">Home</button></a></td>
</form>

<h2> SQL Injection Demo </h2>
<h3> Secured </h3>
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
	if(isset($_POST['search'])){
		//real_escape_string puts extra protectionn
		$search= mysqli_real_escape_string($con,"%{$_POST['search']}%");
		
		// by inserting ? we are seperating user input from query both won't know same information
		$stmt =$con->prepare("SELECT * FROM login WHERE name LIKE ?");
		//The bind_param() method is where you attach variables to the dummy values in the prepare template.
		// s means just a piece of data
		$stmt->bind_param("s",$name);
		
		//tells which param inside the bind_param
		$name = $search; 
		// execute the stmt
		$stmt->execute();
		
		$result = $stmt->get_result();
		//getting as number of rows
		$rowNum = $result->num_rows;
		
		echo "Total results: ".$rowNum."";
		
		if($rowNum> 0) {
				while($row = $result->fetch_assoc()){
				echo "<tr><td>".$row["name"]."</td>";
				echo "<td>".$row["md"]."</td>";
				echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["localIP"]."</td>";
			}
		}
		$stmt->close();		
	}
?>
		</tbody>
    </table>
</div>