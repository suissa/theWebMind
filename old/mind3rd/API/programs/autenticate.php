<?php
	/**
	* function taken from: http://www.dasprids.de/blog/2008/08/22/getting-a-password-hidden-from-stdin-with-php-cli
	*/
	function getPassword($stars = false)
	{
		// Get current style
		$oldStyle = shell_exec('stty -g');

		if ($stars === false) {
		    shell_exec('stty -echo');
		    $password = rtrim(fgets(STDIN), "\n");
		} else {
		    shell_exec('stty -icanon -echo min 1 time 0');

		    $password = '';
		    while (true) {
		        $char = fgetc(STDIN);

		        if ($char === "\n") {
		            break;
		        } else if (ord($char) === 127) {
		            if (strlen($password) > 0) {
		                fwrite(STDOUT, "\x08 \x08");
		                $password = substr($password, 0, -1);
		            }
		        } else {
		            fwrite(STDOUT, "*");
		            $password .= $char;
		        }
		    }
		}

		// Reset old style
		shell_exec('stty ' . $oldStyle);

		// Return the password
		return $password;
	}

	class Autenticate implements program
	{
		public function __construct($p=false){
			GLOBAL $_MIND;
			if(!$p || sizeof($p)<1)
			{
				$_MIND->write('autenticate_requiredFields');
				exit;
			}
			// if it does not have a password
			if(!isset($p[1]))
			{
				$_MIND->write('autenticate_requiredPwd');
				// Get the password
				fwrite(STDOUT, "Password: ");
				$password = getPassword(true);
				echo "\n";
			}else{
                                $password = $p[1];
                             }

                        if($db = new SQLiteDatabase(_MINDSRC_.'/mind3rd/SQLite/mind'))
                        {
                                $result= $db->query("SELECT * FROM user where login='".$p[0]."' AND pwd='".sha1($password)."' AND status= 'A'");
                                $row= false;
                                while ($result->valid())
                                {
                                        $row = $result->current();
                                        echo "Logged: ".$row['login']."\n";
                                        $_SESSION['auth']= JSON_encode($row);
                                        $_SESSION['login']= $row['login'];
                                        break;
                                }
                                if(!$row)
                                {
                                        $_MIND->write('auth_fail');
                                }
                        }else{
                                 die('Database not found!');
                             }
		}
	}
