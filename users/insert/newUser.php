<?php

			/*This webservice will insert a new drink type
			 *
			 *
			 * */

			//check for the needed parameters
			if( ! array_key_exists('userName', $_GET))
                        {
                                exit('Missing username parameter');
                        }
			if( ! array_key_exists('pin', $_GET))
                        {
                                exit('Missing pin parameter');
			}
			 if( ! array_key_exists('isAdmin', $_GET))
                        {
                                exit('Missing isAdmin parameter');
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
			$sql  ='SELECT `userId` FROM `Users` WHERE 1';

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
			        $largest['userId']++;

				
				//construct the query
				$sql = 'INSERT INTO `Users` (`userId`, `userName`, `PIN`, `isAdmin`) VALUES (' . $largest['userId'] . ', "' . $_GET['userName'] . '", ' . $_GET['pin'] .', ' . $_GET['isAdmin'] . ')';			

				//echo $sql;

				//execute the query
				$res = mysqli_query($con, $sql);

				//should return true then exit
				echo json_encode($res);


			}
			else
			{
				//return an empty json object if there are no results and exit the program
				exit('{}');
			}

			

			
			



			//close connection
			mysqli_close($con);
		?>
