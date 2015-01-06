<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="apple-touch-icon" href="./apple-touch-icon.png">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="viewport" content="width=device-width initial-scale=1">
<title>Lifetracker</title>
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
var datetime = moment().format('MM/DD/YYYY h:mm:ss a');

// Use JQuery to insert date and datetime fields into the form and display
$('#datetime').text(datetime);
$('input[name=datetime]').val(datetime);
});

// Variables and code for grabbing location data
var options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0,
};

// On success move geodata to the form and display
function success(pos) {
  var crd = pos.coords;
  $('#latitude').text(crd.latitude);
  $('#longitude').text(crd.longitude);
  $('input[name=Latitude]').val(crd.latitude);
  $('input[name=Longitude]').val(crd.longitude);
};

function error(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
};

navigator.geolocation.getCurrentPosition(success, error, options);

// Add tags on click
$(function(){
  $('.tag').click(function() {
      $('#tags').val($('#tags').val() + $(this).text() + '\n,');
      $( "#tags" ).textinput( "refresh" );
  });
});
</script>
</head>
<body>
<div data-role="page">
<div data-role="content">
<form method="post" action="controller.php">
<label for="Create">
<strong>Create</strong>
<input type="range" name="Create" step="1" min="1" max="10">
<span class="activities">
<a href="#" class="tag">Write:</a><br>
<a href="#" class="tag">Write:Sly Flourish</a><br>
<a href="#" class="tag">Edit:</a><br>
<a href="#" class="tag">Code:</a><br>
<a href="#" class="tag">Ran RPG:D&amp;D</a><br>
<a href="#" class="tag">RPG Prep</a><br>
<a href="#" class="tag">Podcast</a>
</span>
</label>
<label for="relax">
<strong>Relax</strong><br>
<input type="range" name="Relax" step="1" min="1" max="10">
<span class="activities">
<a href="#" class="tag">Read:Sword Art Online</a><br>
<a href="#" class="tag">Read:</a><br>
<a href="#" class="tag">Audiobook:Revival</a><br>
<a href="#" class="tag">Videogame:</a><br>
<a href="#" class="tag">Videogame:Dragon Age Inquisition</a><br>
<a href="#" class="tag">Videogame:Neverwinter MMO</a><br>
<a href="#" class="tag">Tabletop Game:</a><br>
<a href="#" class="tag">TV:</a><br>
<a href="#" class="tag">Movie:</a><br>
<a href="#" class="tag">Painted Minis</a><br>
<a href="#" class="tag">Busy</a>
</span>
</label>
<label for="love">
<strong>Love</strong>
<input type="range" name="Love" step="1" min="1" max="10">
<span class="activities">
<a href="#" class="tag">Listened to Michelle</a><br>
<a href="#" class="tag">Movie With Michelle:</a><br>
<a href="#" class="tag">Walked With Michelle</a><br>
<a href="#" class="tag">TV With Michelle:</a><br>
<a href="#" class="tag">TV With Michelle:Deep Space 9</a><br>
<a href="#" class="tag">Game With Michelle:</a><br>
<a href="#" class="tag">Called Mom</a><br>
<a href="#" class="tag">Impatient</a><br>
<a href="#" class="tag">Sarcastic</a><br>
<a href="#" class="tag">Critical</a>
</span>
</label>
<label for="befriend">
<strong>Befriend</strong>
<input type="range" name="Befriend" step="1" min="1" max="10">
<span class="activities">
<select name="Friend Contact[]" id="friend" multiple="multiple" data-native-menu="false">
<option>Friend Contact</option>
<option value="Friend Name">Friend Name</option>
<option value="Friend Name">Friend Name</option>
<option value="Friend Name">Friend Name</option>
<option value="Friend Name">Friend Name</option>
<option value="Friend Name">Friend Name</option>
<option value="Friend Name">Friend Name</option>

</select>
<a href="#" class="tag">Listened to Friend</a><br>
<a href="#" class="tag">Emailed Friend</a><br>
<a href="#" class="tag">Game With Friends:</a>
</span>
</label>
<label for="health">
<strong>Health</strong>
<input type="range" name="Health" step="1" min="1" max="10">
<span class="activities">
<a href="#" class="tag">10k Steps</a><br>
<a href="#" class="tag">7k Steps</a><br>
<a href="#" class="tag">Stairs</a><br>
<a href="#" class="tag">Tracked Calories</a><br>
<a href="#" class="tag">2200 Calories</a><br>
<a href="#" class="tag">Ate Poorly</a><br>
<a href="#" class="tag">Sick:</a>
</span>
</label>
<label for="happiness"><strong>Happiness</strong>
<input type="range" name="Happiness" step="1" min="1" max="10">
<span class="activities">
<a href="#" class="tag">Great Day</a><br>
<a href="#" class="tag">Bad Day:</a><br>
<a href="#" class="tag">Stress:</a><br>
<a href="#" class="tag">Thinking About:</a>
</span>
</label>

<label for="tags">Tags</label>
<textarea name="tags" id="tags" rows="4"></textarea>
<input type="hidden" name="Latitude" value="">
<input type="hidden" name="Longitude" value="">
<input type="hidden" name="datetime" value="">

<p><input type="submit" value="Submit">

</form>
<p>Geolocation: <span id="latitude"></span> <span id="longitude"></span></p>
<p>Date / Time: <span id="datetime"></span></p>
</div><!-- /content -->
</div><!-- /page -->
</body>
</html>