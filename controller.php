<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Submitted</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
</head>
<body>
<div data-role="page">
<div data-role="content">

<?php

if ($_GET['buildcsv']) {
	writeCSV();
} elseif ($_POST['datetime']){
	echo "<p>Submitting data";
	submitData();
	echo "<p>Data submitted";
} else {
	echo "No submitted data found.";
}

function submitData() {
	$pairs = array();
	$datetime = $_POST['datetime'];
	foreach ($_POST as $key => $value) {
		if ($key == 'tags') {
			$tagarrays = splitTags($value);
			foreach($tagarrays as $tagitem) {
				$pairs[] = array($tagitem[0], $tagitem[1]);
			}
		} elseif (is_array($value)) {
			foreach ($value as $valueitem) {
				$pairs[] = array($key, $valueitem);
			}
		} else {
			if (!$value) {
				$value = 1;
			}
			$pairs[] = array($key, $value);
		}
	}

	foreach ($pairs as $pair) {
		if ($pair[0] == 'datetime') { continue; } # skip datetime key and value since that's the object ID.
		$dbinsert = array(':DATETIME' => $datetime, ':KEY' => $pair[0], ':VALUE' => $pair[1]);
		$DBH = new PDO("sqlite:lifetracker.sqlite3");
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$STH = $DBH->exec("create table if not exists lifedata (datetime text, key text, value text);");
		try {
				$STH = $DBH->prepare("INSERT INTO lifedata (datetime, key, value) VALUES (:DATETIME, :KEY, :VALUE)");
			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		$STH->execute($dbinsert);
	}
	writeCSV();
}

function splitTags($tagcloud) {
	$tags = explode(",",$tagcloud);
	$tagpairs = array();
	foreach($tags as $tag) {
		if (trim($tag) != "") {
			if (strpos($tag,':') !== false) {
				list($tagkey,$tagvalue) = split(":",$tag);
				$tagkey = str_replace(":","",$tagkey);
			} else {
				$tagkey = $tag;
				$tagvalue = 1;
			}
			if (!$tagvalue) {
				$tagkey = $tag;
				$tagkey = str_replace(":","",$tagkey);
				$tagvalue = 1;
			}
			$tagpairs[] = array(trim($tagkey), trim($tagvalue));
		}
	}
	return $tagpairs;
}

function writeCSV(){
	$DBH = new PDO("sqlite:lifetracker.sqlite3");
	$results = $DBH->query("SELECT * FROM LIFEDATA");
	$handle = fopen("lifedata.csv", "w");
	$totalhandle = fopen("lifedatatotal.csv", "w");
	fputcsv($handle, array("datetime", "key", "value"));	
	fputcsv($totalhandle, array("datetime", "key", "value"));	
	foreach ($results as $row) {
		fputcsv($totalhandle, array(trim($row['datetime']), trim($row['key']), trim($row['value'])));
		$datearray = strptime($row['datetime'], '%m/%d/%Y %I:%M:%S %P');
		if ($datearray[tm_year] + 1900 >= date("Y")) {
			fputcsv($handle, array(trim($row['datetime']), trim($row['key']), trim($row['value'])));
		}
	}
	fclose($totalhandle);
	fclose($handle);


	echo "<p>CSV files written.";
}

?>
</div><!-- /content -->
</div><!-- /page -->
</body>
</html>