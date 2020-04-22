<?php

			/*This webservice will insert a new table
 			*
			 *
			 * */

			//check for the needed parameters
			if( ! array_key_exists('tableNumber', $_GET))
                        {
                                exit('Missing tableNumber parameter');
                        }
			if( ! array_key_exists('x', $_GET))
                        {
                                exit('Missing x parameter');
			}
			 if( ! array_key_exists('y', $_GET))
                        {
                                exit('Missing y parameter');
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

						
			//construct the query
			$sql = 'INSERT INTO `TableLayout` (`tableNumber`, `xCordinate`, `yCordinate`) VALUES (' . $_GET['tableNumber'] . ', "' . $_GET['x'] . '", ' . $_GET['y'] . ')';			
			//echo $sql
			//
			//execute the query
			$res = mysqli_query($con, $sql);

			//should return true then exit
			echo json_encode($res);

			

			
			



			//close connection
			mysqli_close($con);
		?>
