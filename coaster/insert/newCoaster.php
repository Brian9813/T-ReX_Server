<?php

			/*This webservice will insert new coaster into the database
			 *
			 *
			 * */



			





			//credentials for connection
			$dbhost = 'localhost';
			$db = 'capstone';
			$user = 'user1';
			$pswd = 'password';
			//echo 'Before Connect<br>';
	
			//open connection to mysql
			$con = mysqli_connect($dbhost, $user, $pswd, $db);


			if(! $con )
			{
				die('Could not connect -> '.$con->connect_error);
			}


			//Query with the column and the value passed via the parameters
			$sql  = 'SELECT `coasterId`FROM `Coaster` ORDER BY `coasterId`';

			//echo print_r($sql);
			
			//result of the query, also runs the query
			$res = mysqli_query($con, $sql);
			
			

			//Load results into array
			if( mysqli_num_rows($res) > 0 )
			{
				//declare an array to hold the resulting rows from the query 
				
				$rows = array();



				//loop through rows of the result of the query
				while ( $r = mysqli_fetch_assoc($res) )
				{

					array_push($rows, $r);
				}

				//return the array of the result rows
				//
				//echo json_encode($rows);
				//

				//now get the largest coaster ID
				$largest = max($rows);

				
				//increment the highest coaster number
			        $largest['coasterId']++;

				
				//construct the query
				$sql = 'INSERT INTO `Coaster`(`coasterId`) VALUES (' . $largest['coasterId'] . ')';			

				//execute the query
				$res = mysqli_query($con, $sql);

				//should return true then exit
				echo json_encode($res);


			}
			else
			{
				//if there are no coasters in the table
				//


				//query
				$sql = 'INSERT INTO `Coaster` (`coasterId`) VALUES (0)';

				//submit the query to the db
				$res = mysqli_query($con, $sql);


				//print the result
				echo json_encode($res);
				
			}

			

			
			



			//close connection
			mysqli_close($con);
		?>
