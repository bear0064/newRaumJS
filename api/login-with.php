<?php
        session_start();
        $config = 'config.php';
        require_once("../Hybrid/Auth.php");
        require_once("dbconnect.php");

        if(isset($_GET['provider']))
        {
        	$provider = $_GET['provider'];
        	
        	try{

                $hybridauth = new Hybrid_Auth( $config );

        	$authProvider = $hybridauth->authenticate($provider);
	        $user_profile = $authProvider->getUserProfile();
                $tokenFinder = $hybridauth->getSessionData();
			if($user_profile && isset($user_profile->identifier))
	        {


                $tokenFinder = unserialize($tokenFinder);

                if (array_key_exists("hauth_session.facebook.token.access_token", $tokenFinder)){
                    $fb = $tokenFinder["hauth_session.facebook.token.access_token"];
                    $fb = unserialize($fb);
                    $_SESSION['user_token'] = $fb;
                }

                if (array_key_exists("hauth_session.linkedin.token.access_token_linkedin", $tokenFinder)){
                    $li = $tokenFinder["hauth_session.linkedin.token.access_token_linkedin"];
                    $li = unserialize($li);
                    $_SESSION['user_token'] = $li["oauth_token"];
                }


                //Check for country based on IP Address
                if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip_address = $_SERVER['REMOTE_ADDR'];
                }
                $details = json_decode(file_get_contents("http://ipinfo.io/{$ip_address}"));

                $sqlQuery = "SELECT * FROM users WHERE user_email = '$user_profile->email'";

                $results = $conn->prepare($sqlQuery);
                $results->execute();
                $results2 = $results->fetchAll(PDO::FETCH_OBJ);
                if (!empty($results2)) {
                    //User exists Log them in and capture the authentication token to session

                    $sqlQuery = "UPDATE users SET photoURL = '$user_profile->photoURL' WHERE user_email = '$user_profile->email'";

                    $results = $conn->prepare($sqlQuery);
                    $results->execute();

                    $_SESSION["user_type"] = $results2[0]->user_type;
                    $_SESSION["user_id"] = $results2[0]->user_id;
                    $_SESSION["current_mode"] = $results2[0]->current_mode;
                    $_SESSION["user_pic"] = $user_profile->photoURL;

                    if ($_SESSION["current_mode"] == 'homeowner'){

                        header('Location: https://ten23mb.edumedia.ca/homeowner-profile.php');
                    } else {

                        header('Location: https://ten23mb.edumedia.ca/designer-profile.php');
                    }



                } else if (empty($results2)) {
                    //redirect home
                    exit("User does not exist!");
                }

	        }	        

			}
			catch( Exception $e )
			{ 
			
				 switch( $e->getCode() )
				 {
                        case 0 : echo "Unspecified error."; break;
                        case 1 : echo "Hybridauth configuration error."; break;
                        case 2 : echo "Provider not properly configured."; break;
                        case 3 : echo "Unknown or disabled provider."; break;
                        case 4 : echo "Missing provider application credentials."; break;
                        case 5 : echo "Authentication failed. "
                                         . "The user has canceled the authentication or the provider refused the connection.";
                                 break;
                        case 6 : echo "User profile request failed. Most likely the user is not connected "
                                         . "to the provider and he should to authenticate again.";
                                 $twitter->logout();
                                 break;
                        case 7 : echo "User not connected to the provider.";
                                 $twitter->logout();
                                 break;
                        case 8 : echo "Provider does not support this feature."; break;
                }

                // well, basically your should not display this to the end user, just give him a hint and move on..
                echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

                echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";

			}
        
        }
?>