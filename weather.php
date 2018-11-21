<?php
// Fehler anzeigen, ausser Deprecated Meldungen
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set( 'display_errors', 1 );

// API-Key eintragen.
$apikey = "YOURAPIKEY";

// LocationID entspricht der ID einer Stadt.
// 3413829 = Reykjavik
$locationID = "3413829";
$units = "metric";

$url = "http://api.openweathermap.org/data/2.5/weather?appid=".$apikey."&units=".$units."&id=".$locationID;



// Lese die JSON Daten unter $location
function readURL($location) {

  $str = "";

  // Die URL des zu lesenden API-Endpoints (JSON)
  try {

    //set your own error handler before the call
    set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context) {
      throw new ErrorException( $err_msg, 0, $err_severity, $err_file, $err_line );
    }, E_WARNING);

    $str = file_get_contents($location);

    if ($str === false) {
      // Handle the error
    }
  } catch (Exception $e) {
    // Handle exception
    // Ist die URL korrekt?
  }

  //restore the previous error handler
  restore_error_handler();

  return $str;
}




// Lese API als String ein
$data = readURL($url);

// API Inhalt verarbeiten. $json entspricht einem assoziativem Array.
// Zugriff mittels $json['foo'] bzw $json['foo']['bar']
$json = json_decode($data, true);


// Nur weiterarbeiten wenn json_decode() keinen Fehler aufweist.
// Welche Werte gelesen werden sollen ist dem eigenem Anspruch anzupassen.
if ( json_last_error() == JSON_ERROR_NONE ) {

  // Location name
  echo "Location name: ".nl2br($json['name']."\r\n");

  // temperature
  echo "temparature: ".nl2br($json['main']['temp']."\r\n");

  // wind speed
  echo "Wind speed: ".nl2br($json['wind']['speed']."\r\n");

  // snow. Show only if there is snow
  // Dient als Beispiel wie behandelt werden kann sollte ein Element nicht existieren.
  if ( isset( $json['snow'] ) ) echo "Snow: ".nl2br($json['snow']."\r\n");
}
else {
  // Hier eine Fehlerbehandlung sollte json_decode nicht erfolgreich gewesen sein.
  // Möglicher Grund: Antwort war leer.
  // Genaueres kann mit json_last_error() und json_last_error_msg() ermittelt werden.
  // https://secure.php.net/manual/en/function.json-last-error.php
  // https://secure.php.net/manual/en/function.json-last-error-msg.php
  echo "Konnte die API nicht lesen.";
}

?>
