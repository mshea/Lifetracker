<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="apple-touch-icon" href="./apple-touch-icon.png">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lifetracker</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0-rc.1/jquery.mobile-1.4.0-rc.1.min.css">
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.0-rc.1/jquery.mobile-1.4.0-rc.1.min.js"></script>
<script src="http://momentjs.com/downloads/moment.min.js" type="text/javascript"></script>
<style>
.activities { font-size: .8em; font-style: italic; color: #555; }
</style>
<script type="text/javascript">

// Generate Date and Datetime fields
$( document ).ready(function() {
var date = moment().format('MM/DD/YYYY');
var datetime = moment().format('MM/DD/YYYY h:mm:ss a');

// Use JQuery to insert date and datetime fields into the form and display
$('#date').text(date);
$('input[name=date]').val(date);
$('#datetime').text(datetime);
$('input[name=datetime]').val(datetime);
});

// Variables and code for grabbing location data
var options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

// On success, move geodata to the form and display
function success(pos) {
  var crd = pos.coords;
  $('#lat').text(crd.latitude);
  $('#long').text(crd.longitude);
  $('input[name=lat]').val(crd.latitude);
  $('input[name=long]').val(crd.longitude);
};

function error(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
};

navigator.geolocation.getCurrentPosition(success, error, options);

// Add tags on click
$(function(){
	$('.tag').click(function() {
  		$('#tags').val($('#tags').val() + ' ' + $(this).text());
  		$( "#tags" ).textinput( "refresh" );
	});
});
</script>
</head>
<body>
<div data-role="page">
<div data-role="content">
<form method="post" action="insert.php">
<label for="create">Create <span class="activities"><a href="#" class="tag">write</a>, <a href="#" class="tag">edit</a>, <a href="#" class="tag">code</a>, <a href="#" class="tag">dnd</a>, <a href="#" class="tag">freelance</a>, <a href="#" class="tag">slyflourish</a>, <a href="#" class="tag">paint</a>, <a href="#" class="tag">dndprep</a></span></label>

<input type="range" name="create" step="1" min="1" max="10">
<label for="relax">Relax <span class="activities"><a href="#" class="tag">read</a>, <a href="#" class="tag">videogame</a>, <a href="#" class="tag">watchtv</a>, <a href="#" class="tag">watchmovie</a>, <a href="#" class="tag">readcomic</a>, <a href="#" class="tag">busy</a></span></label>

<input type="range" name="relax" step="1" min="1" max="10">
<label for="love">Love <span class="activities"><a href="#" class="tag">dishes</a>, <a href="#" class="tag">chores</a>, <a href="#" class="tag">listenedtoshell</a>, <a href="#" class="tag">calledmom</a>, <a href="#" class="tag">family</a>, <a href="#" class="tag">impatient</a>, <a href="#" class="tag">critical</a></span></label>

<input type="range" name="love" step="1" min="1" max="10">
<label for="befriend">Befriend <span class="activities"><a href="#" class="tag">listenedtofriend</a>, <a href="#" class="tag">emailedfriend</a>, <a href="#" class="tag">gamewithfriends</a>, <a href="#" class="tag">helpedfriend</a></span></label>

<input type="range" name="befriend" step="1" min="1" max="10">
<label for="health">Health <span class="activities"><a href="#" class="tag">steps:10000</a>, <a href="#" class="tag">steps:8000</a>, <a href="#" class="tag">stairs:240</a>, <a href="#" class="tag">stairs:360</a>, <a href="#" class="tag">atewell</a>, <a href="#" class="tag">atepoorly</a>, <a href="#" class="tag">hike</a></span></label>

<input type="range" name="health" step="1" min="1" max="10">
<label for="happiness">Happiness<span class="activities">
<a href="#" class="tag">perfectday</a>, <a href="#" class="tag">jobstress</a></span>
</label>
<input type="range" name="happiness" step="1" min="1" max="10">

<label for="tags">Tags</label>
<textarea name="tags" id="tags" rows="4"></textarea>

<input type="hidden" name="lat" value=""> <input type="hidden" name="long" value="">

<input type="hidden" name="date" value=""> <input type="hidden" name="datetime" value="">

<p><input type="submit" value="Submit">

</form>

<p>Geolocation: <span id="lat"></span>, <span id="long"></span></p>
<p>Date / Time: <span id="datetime"></span></p>
</div><!-- /content -->
</div><!-- /page -->
</body>
</html>