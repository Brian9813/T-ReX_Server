<?php

			/*This webservice will insert a new drink type
			 *
			 *
			 * */

			//check for the needed parameters
			if( ! array_key_exists('drinkId', $_GET))
                        {
                                exit('Missing drinkId');
			}


			//now check for one weight range to be updated

			if ( ! array_key_exists('drinkWeightTop', $_GET) && ! array_key_exists('drinkWeightMiddle', $_GET) && ! array_key_exists('drinkWeightBottom', $_GET))
			{
				exit('No drink weight arguments found<br>Must be "drinkWeightTop", "drinkWeightMiddle", or "drinkWrightBottom"');
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
			$sql  = 'SELECT `drinkId` FROM `DrinkInfo` WHERE `drinkId` = ' . $_GET['drinkId'] . '';

			//echo print_r($sql);
			
			//result of the query, also runs the query
			$res = mysqli_query($con, $sql);
			
			

			//Load results into array
			if( mysqli_num_rows($res) > 0 )
			{
				//now build the query
				
				$setString = '';

				//add the set statements to the set string var for the query
				if (array_key_exists('drinkWeightTop', $_GET))
				{
					//if there is a drink top add it to the set string

					$setString .= "`drinkWeightTop` = " . $_GET['drinkWeightTop'] . ", ";
				}
				if(array_key_exists('drinkWeightMiddle', $_GET))
				{
					//if there is a middle to add
					

					$setString .= "`drinkWeightMiddle` = " . $_GET['drinkWeightMiddle'] . ", ";
				}
				if(array_key_exists('drinkWeightBottom', $_GET))
				{
					//if there is a bottom to add
					

					$setString .= "`drinkWeightBottom` = " . $_GET['drinkWeightBottom'] . ", ";
				}

				//now chop the back off of the setString

				$setString = substr($setString, 0, -2);







				
				//construct the query
				$sql = "UPDATE `DrinkInfo` SET " . $setString . " WHERE drinkId = " . $_GET['drinkId'];			

				//echo $sql;

				//execute the query
				$res = mysqli_query($con, $sql);

				//should return true then exit
				echo json_encode($res);


			}
			else
			{
				echo 'drinkId not found';
			}

			

			
			



			//close connection
			mysqli_close($con);
		?>
