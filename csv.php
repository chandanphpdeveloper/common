<?php 


	$filename = 'order.csv'; 
	$handle = fopen($filename, 'w+');
	// Write the spreadsheet column titles / labels
	fputcsv($handle, array(
						'Member Id',
						'User Name',
						'First Name',
						'Last Name' ,
						'Address 1', 
						'Address 2', 
						'City', 
						'Zip Code', 
						'Last Transaction',
						'Last Transaction Active'
						));
	
	foreach($listArr as $row)
	{
		fputcsv($handle,array(
						$row['member_id'],
						$row['userName'], 
						$row['firstName'],
						$row['LastName'],
						$row['address'],
						$row['address2'],
						$row['city'],
						$row['ZipCode'],
						$row['lastTransaction'],
						$row['lastTransactionActive']
					));
	}
					
	// Finish writing the file
	fclose($handle);
		
	header('Content-Type: application/csv'); 
	header('Content-Disposition: attachment; filename='.$filename.''); 
	header('Pragma: no-cache');
	
	readfile(''.$filename.''); 
	exit; 
	
	


?>