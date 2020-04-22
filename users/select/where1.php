<?php

			/*This web service is for one column and one value
			 *
			 *
			 * */



			//print all of the parameters
			//echo print_r($_GET[value]);
			//echo print_r($_GET[column]);

			//make sure the value and column parms are there 
			//if not the program will exit with an error message 

			if( ! array_key_exists('value', $_GET))
			{	
				exit('Missing value parameter');
			}
			if( ! array_key_exists('column', $_GET))
			{
				exit('Missing column parameter');
			}





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
			$sql  = 'SELECT * FROM `Users` WHERE `' . $_GET[column] .  '` = ' . $_GET[value] . '';

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
				echo json_encode($rows);
			}
			else
			{
				//return an empty json object if there are no results and exit the program
				echo '{}';
			}

			

			
			



			//close connection
			mysqli_close($con);
		?>
