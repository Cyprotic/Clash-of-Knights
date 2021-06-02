<?php
	//Make Connection
	$mysqli = new mysqli("localhost", "root", "", "alunos_GPSIT1_Clash_of_Knights");
	
	//Variable from the user	
	$username = $_POST['username']; 
	$password = $_POST['password'];
	$verify = 0;
	
	// Verificar se o email está disponivel
	if($stmt = $mysqli->prepare('SELECT Email FROM conta')) {
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($email);
		$num_rows = $stmt->num_rows;

		if($num_rows>0) {
			while ($stmt->fetch()) {
				if($_POST['email'] == $email){
					$verify = 1;
				}			
            }
		}
	}
	
    // Verificar se o nome está disponivel
    if($stmt1 = $mysqli->prepare('SELECT Name FROM conta')) {
		$stmt1->execute();
		$stmt1->store_result();
		$stmt1->bind_result($name);
		$num_rows = $stmt1->num_rows;

		if($num_rows>0) {
			while ($stmt1->fetch()) {
				if($_POST['username'] == $name){
					$verify = 2;
				}
            }
		}
	}

	if($_POST['password'] != $_POST['c_password']) {
        $verify =3;
	}

    if($verify == 1) {
		$message = "Email already taken!";
		echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<meta http-equiv='refresh' content='0; url=../signup.html'>";
    } else if($verify == 2) {
		$message1 = "Username already taken!";
		echo "<script type='text/javascript'>alert('$message1');</script>";
        echo "<meta http-equiv='refresh' content='0; url=../signup.html'>";
    } else if($verify == 3) {
		$message2 = "Password doesn't match!";
		echo "<script type='text/javascript'>alert('$message2');</script>";
        echo "<meta http-equiv='refresh' content='0; url=../signup.html'>";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO conta (Name, Password, Email) VALUES (?, ?, ?)");
		$stmt->bind_param('sss', $username, $password, $_POST['email']);
		$stmt->execute();
		$stmt->close();

        echo "<meta http-equiv='refresh' content='0; url=../index.html'>";
    }
?>