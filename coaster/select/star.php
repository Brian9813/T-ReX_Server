<?php
		
			//print all of the parameters
			//echo print_r($_GET);

			//credentials for connection
			$dbhost = 'localhost';
			$db = 'capstone';
			$user = 'user1';
			$pswd = 'password';
			//echo 'Before Connect<br>';
	
			//open connection to mysql
			$con = mysqli_connect($dbhost, $user, $pswd, $db);
	
			//echo 'After Connect<br>';


			if(! $con )
			{
				die('Could not connect -> '.$con->connect_error);
			}

			//echo 'Connect Successful<br>';


			//Query
			$sql  = 'SELECT * FROM `Coaster`';

			//echo 'Sql OK<br>';
			
			//result of the query, also runs the query
			$res = mysqli_query($con, $sql);
			
			//echo 'Query run<br>';


			//array for parsing the recieved JSON
			$rows = array();

			//Load results into array

			
			
			if( mysqli_num_rows($res) > 0 )
			{
				//echo "in if statement<br>";

				//$its = 0;

				while ( $r = mysqli_fetch_assoc($res) )
				{
					//echo "<br>" . $r;

					array_push($rows, $r);


					//$its++;

					//echo $its;
				}
			}
			else
			{
				echo 'No Data';
			}

			//echo print_r($res);

			//echo 'done';

			echo json_encode($rows);



			//close connection
			mysqli_close($con);
		?>
