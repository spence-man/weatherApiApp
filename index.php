<?php 
  $weather = "";
  $error = "";
  if (array_key_exists('city', $_GET)) {
    if ($urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&units=imperial"."&appid=869b727361cc391a1824f4729efee89d")) {
      $weatherArray = json_decode($urlContents, true);
     $weather = "The weather in ".strtoupper($_GET['city'])." is currently '".$weatherArray['weather'][0]['description']."'.";
     $tempInFahren = round($weatherArray['main']['temp']);
     $tempInCelcius  = round(($weatherArray['main']['temp'] - 32) * (5/9));
     $weather .= " The temperature is ".$tempInFahren."&deg;F (".$tempInCelcius."&deg;C) and the wind speed is ".$weatherArray['wind']['speed']." mi/h.";
    } else {
      $error = "That city could not be found. Please check your spelling and try again.";
    }
   
   
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Weather App</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      html {
        background: url("sunset.jpg") no-repeat 50% 50% fixed;
        background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        -webkit-background-size: cover;
        min-height: 100%; 
      }
      body {
        background: none;
        color:#FFF;
      }
      .container {
        margin-top: 100px;
        text-align: center;
        width: 450px;
      }
      input {
        margin: 20px 0;
      }
      #weather {
        margin-top:15px;
      }
      @media only screen and (max-width: 479px){
        #weather { width: 90%; }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1>What's The Weather?</h1>
      <form>
        <fieldset class="form-group">
          <label for="city">Enter the name of a city.</label>
          <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo" value = "<?php 
          if (array_key_exists('city', $_GET)) {
            echo $_GET['city']; 
          }
          ?>">
        </fieldset>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <div id="weather"><?php 
        if ($weather) {
          echo '<div class="alert alert-success" role="alert">
          '.$weather.'
          </div>';
        } else if ($error) {
          echo '<div class="alert alert-danger" role="alert">
          '.$error.'
          </div>';
        }
      ?></div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript">
    </script>
  </body>
</html>