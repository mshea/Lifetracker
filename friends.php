<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="apple-touch-icon" href="./apple-touch-icon.png">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="viewport" content="width=device-width initial-scale=1">
<title>Friend Tracker</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0-rc.1/jquery.mobile-1.4.0-rc.1.min.css">
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.0-rc.1/jquery.mobile-1.4.0-rc.1.min.js"></script>
<script src="http://momentjs.com/downloads/moment.min.js" type="text/javascript"></script>
<style>
.activities { font-size: 1em; color: #555; line-height: 2em;}
</style>
<script type="text/javascript">

// Generate Date and Datetime fields
$( document ).ready(function() {
var date = moment().format('MM/DD/YYYY');
var datetime = moment().format('MM/DD/YYYY h:mm:ss a');

// Use JQuery to insert date and datetime fields into the form and display
$('#datetime').text(datetime);
$('input[name=datetime]').val(datetime);
});

</script>
</head>
<body>
<div data-role="page">
<div data-role="content">
<form method="post" action="controller.php">
<div data-role="fieldcontain">
<select name="Friend Contact[]" id="friend" multiple="multiple" data-native-menu="false">
<option>Friend Contact</option>
<option value="Friend Name">Friend Name</option>
<option value="Friend Name">Friend Name</option>
<option value="Friend Name">Friend Name</option>
<option value="Friend Name">Friend Name</option>
<option value="Friend Name">Friend Name</option>

</select>
</div>
<input type="hidden" name="datetime" value="">
<p><input type="submit" value="Submit">
</form>
<p>Date / Time: <span id="datetime"></span></p>
</div><!-- /content -->
</div><!-- /page -->
</body>
</html>