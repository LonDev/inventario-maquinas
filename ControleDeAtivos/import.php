<?php 
// including the config file
include('config.php');
$pdo = connect();

$csv_file =  $_FILES['csv_file']['tmp_name'];
if (is_file($csv_file)) {
	$input = fopen($csv_file, 'a+');
	// if the csv file contain the table header leave this line
	$row = fgetcsv($input, 1024, ';'); // here you got the header
	$sql = 'DELETE FROM tivitcorp WHERE id > 0';
		$query = $pdo->prepare($sql);
		$query->execute();
	while ($row = fgetcsv($input, 1024, ';')) {
		// insert into the database	
		$sql = 'INSERT INTO tivitcorp(usuario, hostname,ip,ramal,office,contato,dominio) VALUES(:usuario, :hostname,:ip,:ramal,:office,:contato,:dominio)';
		$query = $pdo->prepare($sql);
		$query->bindParam(':usuario', $row[0], PDO::PARAM_STR);
		$query->bindParam(':hostname', $row[1], PDO::PARAM_STR);
		$query->bindParam(':ip', $row[2], PDO::PARAM_STR);
		$query->bindParam(':ramal', $row[3], PDO::PARAM_STR);
		$query->bindParam(':office', $row[4], PDO::PARAM_STR);
		$query->bindParam(':contato', $row[5], PDO::PARAM_STR);
		$query->bindParam(':dominio', $row[6], PDO::PARAM_STR);
		$query->execute();
	}
}

// redirect to the index page
header('location: index.php');
?>


