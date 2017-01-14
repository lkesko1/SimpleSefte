<?php
	global $tekstPrijave, $greska, $button;

	session_start();
	if (isset($_SESSION['username']) && !empty($_SESSION['username']))
	{
		$username = $_SESSION['username'];
		Logovan();	 
	}
	else if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
		try
		{
			//Povezivanje s bazom
				$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
				$veza->exec("set names utf8");
			//Provjeri da li postoji ta tabela 
			if ($rezultat = $veza->query("SHOW TABLES LIKE 'Admin'")) {
					if(sizeof($rezultat) >0) {
						$rezultat = $veza->prepare("SELECT * FROM Admin");
						$rezultat->execute();
						
						foreach($rezultat->fetchAll() as $r)
						{
							$user=$r['username'];
							$password = $r['password'];
							break;
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
				
		}
		catch(PDOException $e)
		{
			$message ="Connection failed!" . $e->getMessage();
					echo "<script type='text/javascript'>
						alert('$message'); 
						location.href='index.php';
						</script>";
		}

	}
	else  NijeLogovan();

	
	if (isset($_REQUEST['logout']))
	{
		session_unset();
		NijeLogovan();
	}
	
    function Logovan() {
		global $tekstPrijave, $greska, $button;
        $tekstPrijave = 'Prijavljeni ste kao ' . $_SESSION['username'] . '!  ' ;
        $greska= '';
        $button = '<button type="submit" name="logout" value="true">Logout</button>';
    }
    function NijeLogovan() {
		global $tekstPrijave, $greska, $button;
        $tekstPrijave = '';
        $button= '';
		session_unset();
    }
	
	
?>
	