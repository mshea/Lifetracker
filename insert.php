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

if (!$_POST['date']){
echo "No submitted data found.";
exit;
}

$data = array(':DATE' => $_POST['date'], ':DATETIME' => $_POST['datetime'], ':CREATE_SCORE' => $_POST['create'], ':RELAX_SCORE' => $_POST['relax'], ':LOVE_SCORE' => $_POST['love'], ':BEFRIEND_SCORE' => $_POST['befriend'], ':HEALTH_SCORE' => $_POST['health'], ':HAPPINESS_SCORE' => $_POST['happiness'], ':TAGS' => $_POST['tags'], ':LATITUDE' => $_POST['lat'], ':LONGITUDE' => $_POST['long']);

$DBH = new PDO("sqlite:lifetracker.sqlite3");

$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
$STH = $DBH->prepare("INSERT OR REPLACE INTO LIFEDATA (DATE, DATETIME, CREATE_SCORE, RELAX_SCORE, LOVE_SCORE, BEFRIEND_SCORE, HEALTH_SCORE, HAPPINESS_SCORE, TAGS, LATITUDE, LONGITUDE) values (:DATE, :DATETIME, :CREATE_SCORE, :RELAX_SCORE, :LOVE_SCORE, :BEFRIEND_SCORE, :HEALTH_SCORE, :HAPPINESS_SCORE, :TAGS, :LATITUDE, :LONGITUDE)");
echo "<p>Submitted!";
} catch(PDOException $e) {
    echo $e->getMessage();
}

$STH->execute($data);

$results = $DBH->query("SELECT * FROM LIFEDATA");

$handle = fopen("lifedata.csv", "w");

fputcsv($handle, array("Date", "DateTime", "Create", "Relax", "Love", "Befriend", "Health", "Happiness", "Tags", "Latitude", "Longitude"));

foreach($results as $row)
{
fputcsv($handle, array($row['DATE'], $row['DATETIME'], $row['CREATE_SCORE'], $row['RELAX_SCORE'], $row['LOVE_SCORE'], $row['BEFRIEND_SCORE'], $row['HEALTH_SCORE'], $row['HAPPINESS_SCORE'], $row['TAGS'], $row['LATITUDE'], $row['LONGITUDE']));
}
fclose($handle)
?>
</div><!-- /content -->
</div><!-- /page -->
</body>
</html>