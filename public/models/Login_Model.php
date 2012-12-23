<?php
class Login_Model
{
	// generate random string
	function get_random_string() {
		$valid_chars = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
		$length = '10';
		// start with an empty random string
		$random_string = "";

		// count the number of chars in the valid chars string so we know how many choices we have
		$num_valid_chars = strlen($valid_chars);

		// repeat the steps until we've created a string of the right length
		for ($i = 0; $i < $length; $i++) {
			// pick a random number from 1 up to the number of valid chars
			$random_pick = mt_rand(1, $num_valid_chars);

			// take the random character out of the string of valid chars
			// subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
			$random_char = $valid_chars[$random_pick-1];

			// add the randomly-chosen char onto the end of our string so far
			$random_string .= $random_char;
		}
		// return our finished random string
		return $random_string;
	}

	// cryptozoology xD
	function better_crypt($input, $rounds = "7") {
		$salt = "";
		$salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
		for($i=0; $i < 22; $i++) {
			$salt .= $salt_chars[array_rand($salt_chars)];
		}
		return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
	}
	
	// Login
	function login() {
			$user = UserQuery::create()->findOneByUsername(strtolower($_POST['username']));
			if ($user) {
				if (crypt($_POST['password'], $user->getPassword()) === $user->getPassword()) {
					$dbactivated = $user->getIsActivated();
					if ($dbactivated = 1) {
						$_SESSION['uid'] = $user->getId();
						$_SESSION['firstname'] = $user->getFirstName();
						$_SESSION['lastname'] = $user->getLastName();
						$_SESSION['username'] = $user->getUsername();
						header("Location: /stream");
					} else {
						echo "Your account is not activated, check your email address and find your activation email. Be sure to check the spam folder just in case.";
					}
				} else {
					echo "password/username is incorrect";
				}
			} else {
				echo "password/username is incorrect";
			}
	}

	//Register user, validation is handled by jquery
	function register() {
		$user = new User();
		$user->setUsername(strtolower($_POST['username']));
		$user->setPassword($this->better_crypt($_POST['password']));
		$user->setEmail(strtolower($_POST['email']));
		$user->setFirstName(ucwords($_POST['firstname']));
		$user->setLastName(ucwords($_POST['lastname']));
		$user->setActivateCode($this->get_random_string());
		$user->setIsActivated('1');
		$user->save();
	}
	
	//TODO: create activation email function
}