<?php

			/*This webservice will delete a  coaster in the database
			 *
			 *
			 * */

            if( ! array_key_exists('coasterId', $_GET))
            {
                exit('Missing coasterId');
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
			$sql  = 'DELETE FROM `Coaster` WHERE `coasterId` = ' . $_GET['coasterId'];


			//echo print_r($sql);
			
			//result of the query, also runs the query
			$res = mysqli_query($con, $sql);
			
            echo json_encode($res);


			//close connection
			mysqli_close($con);
		?>
