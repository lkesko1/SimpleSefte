<?php
	global $tekst, $greska, $button;

	session_start();
	if (isset($_SESSION['username']) && !empty($_SESSION['username']))
	{
		$username = $_SESSION['username'];
		Logovan();	 
	}
	else if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
		
		if (file_exists("Admin.xml"))
		{
			$file = new DOMDocument();
			$file->load("Admin.xml");
			$admin = $file->documentElement;
			foreach($admin->childNodes as $stavka) { 
				if ($stavka->nodeName == "Username")
					$user =$stavka->nodeValue;
				if ($stavka->nodeName == "Password")
					$password = $stavka->nodeValue;
			} 

			if ($_REQUEST['username'] === $user && $_REQUEST['password'] === $password)
			{
				if (isset($_REQUEST['button'])){
					$username = $_REQUEST['username'];
					$_SESSION['username'] = $username;
					$_SESSION['start'] = time(); 
					$_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
					Logovan();
					

				}
			}
			else 
			{
				NijeLogovan();
				echo "<script type='text/javascript'> alert('Pogresan username ili sifra')  </script>";
			}
		}
	}
	else  NijeLogovan();

	
	if (isset($_REQUEST['logout']))
	{
		session_unset();
		NijeLogovan();
	}
	
    function Logovan() {
		global $tekst, $greska, $button;
        $tekst = 'Prijavljeni ste kao ' . $_SESSION['username'] . '!  ' ;
        $greska= '';
        $button = '<button type="submit" name="logout" value="true">Logout</button>';
    }
    function NijeLogovan() {
		global $tekst, $greska, $button;
        $tekst = '';
        $button= '';
		session_unset();
    }
	
	
?>
	