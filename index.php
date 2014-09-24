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
var date = moment().format('MM/DD/YYYY');
var datetime = moment().format('MM/DD/YYYY h:mm:ss a');
var spindex = $.getJSON("http://www.google.com/finance/info?q=^GSPC&callback=?", function( json ) {
  $('#sp500').text(json[0].l_fix);
  $('input[name=sp500]').val(json[0].l_fix);
});

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
  var weatherurl = "http://api.openweathermap.org/data/2.5/weather?lat=" + crd.latitude + "&lon=" + crd.longitude + "&callback=?";
  var weathercall = $.getJSON(weatherurl, function( json ) {
    //$('#sp500').text(json[0].l_fix);
    weatherd = (json.weather[0].main)
    tempk = (json.main['temp'])
    tempf = ((((tempk - 273.15)*1.8) + 32).toFixed(0)).toString();
    $('#temp_f').text(tempf);
    $('input[name=temp_f]').val(tempf);
    $('#weather_desc').text(weatherd);
    $('input[name=weather_desc]').val(weatherd);
    // (K - 273.15)* 1.8000
  }); 

  $('#latitude').text(crd.latitude);
  $('#longitude').text(crd.longitude);
  $('input[name=latitude]').val(crd.latitude);
  $('input[name=longitude]').val(crd.longitude);
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
<form method="post" action="controller.php">
<label for="create">Create <span class="activities"><a href="#" class="tag">write</a> <a href="#" class="tag">edit</a> <a href="#" class="tag">code:</a> <a href="#" class="tag">ranrpg</a> <a href="#" class="tag">freelance</a> <a href="#" class="tag">slyflourish</a> <a href="#" class="tag">rpgprep</a> <a href="#" class="tag">podcast</a></span></label>

<input type="range" name="create" step="1" min="1" max="10">
<label for="relax">Relax <span class="activities"><a href="#" class="tag">read:companions</a> <a href="#" class="tag">read:y</a> <a href="#" class="tag">audiobook:nos4a2</a> <a href="#" class="tag">videogame:</a> <a href="#" class="tag">videogame:hearthstone</a> <a href="#" class="tag">videogame:gw2</a> <a href="#" class="tag">tv:</a> <a href="#" class="tag">movie:</a> <a href="#" class="tag">read:</a> <a href="#" class="tag">busy</a></span></label>

<input type="range" name="relax" step="1" min="1" max="10">
<label for="love">Love <span class="activities"><a href="#" class="tag">listenedtoshell</a> <a href="#" class="tag">moviewithshell:</a> <a href="#" class="tag">tvwithshell:</a> <a href="#" class="tag">gamewithshell:</a> <a href="#" class="tag">calledmom</a> <a href="#" class="tag">impatient</a> <a href="#" class="tag">sarcastic</a> <a href="#" class="tag">critical</a></span></label>

<input type="range" name="love" step="1" min="1" max="10">
<label for="befriend">Befriend <span class="activities"><a href="#" class="tag">listenedtofriend</a> <a href="#" class="tag">emailedfriend</a> <a href="#" class="tag">gamewithfriends:</a></span></label>
<div data-role="fieldcontain">
<select name="friends[]" id="friends" multiple="multiple" data-native-menu="false">
<option>Friend Contact</option>
<option value="Friend_Name">Friend Name</option>
<option value="Friend_Name">Friend Name</option>
<option value="Friend_Name">Friend Name</option>
</select>
</div>
<input type="range" name="befriend" step="1" min="1" max="10">
<label for="health">Health <span class="activities"><a href="#" class="tag">10ksteps</a> <a href="#" class="tag">stairs</a> <a href="#" class="tag">atewell</a> <a href="#" class="tag">atepoorly</a></span></label>

<input type="range" name="health" step="1" min="1" max="10">
<label for="happiness">Happiness<span class="activities">
<a href="#" class="tag">greatday</a> <a href="#" class="tag">badday:</a> <a href="#" class="tag">stress:</a> <a href="#" class="tag">thinkingabout:</a> </span>
</label>
<input type="range" name="happiness" step="1" min="1" max="10">

<label for="tags">Tags</label>
<textarea name="tags" id="tags" rows="4"></textarea>

<input type="hidden" name="latitude" value="">

<input type="hidden" name="longitude" value="">

<input type="hidden" name="sp500" value="">

<input type="hidden" name="temp_f" value="">

<input type="hidden" name="weather_desc" value="">

<input type="hidden" name="datetime" value="">

<p><input type="submit" value="Submit">

</form>
<p>S&P 500 Index: <span id="sp500"></span></p>
<p>Geolocation: <span id="latitude"></span> <span id="longitude"></span></p>
<p>Local Weather: <span id="weather_desc"></span></p>
<p>Local Temperature (F): <span id="temp_f"></span></p>
<p>Date / Time: <span id="datetime"></span></p>
</div><!-- /content -->
</div><!-- /page -->
</body>
</html>