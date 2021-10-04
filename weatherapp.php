<?php

  $weather = "";
  $error = "";
  
  if ($_GET['city']) {
      
      $url=file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=ac18632aee938246034151538efec8c3");
      
      $decodedurl=json_decode($url, true);
      
      if ($decodedurl["cod"] == 200) {
      
        $weather.="The weather in ".$_GET['city']." is currently ".$decodedurl["weather"][0]["description"].". ";
      
        $temp = $decodedurl["main"]["temp"]-273.15;
      
        $weather.="The temperature is ".$temp." &deg;C, the visibility is ".$decodedurl["visibility"]."m and the wind speed is ".$decodedurl["wind"]["speed"]."m/s.";



      } else {
          
          $error.="This city cannot be found. Please try again."; 
          
      }
  }


?>

<!doctype html>

<html lang="en">
  <head>

    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Weather App</title>
    
    <style type="text/css">
    
      body, html {
          
          margin:0;
          height:100%;
          background-image:url("weatherbackground.jpg");
          background-repeat:no-repeat;
          background-position:cover;
         
      }
        
      .container {
          
          width:30%;
      }
      
      .city {
          
          margin-top:50px;
          height:50px;
      }
      
      .button {
          
          margin-top:50px;
          margin-left:160px;
          margin-bottom:20px;
          
      }
      
      h1 {
          
          font-weight:bold;
          font-size:300%;
          text-align:center;
          padding-top:50px;
          color:white;
      }
      
      p {
          
          color:white;
          font-weight:bold;
          text-align:center;
          padding-top:30px;
          font-size:18px;
      }
      
      .weather {
          
          margin:0 auto;
          width:30%;
          height:130px;
      }

      #errorMessageCont {

        margin:auto;
        width:30%;
        padding-top:20px;
      }
      
      .errorMessage {
          
          color:red;
          text-align:center;

      }
      
    </style>
    
  </head>
  
  <body>

   <div id="errorMessageCont">

    <?php 

    if($error) {
    
    echo '<div class="alert alert-danger errorMessage" role="alert">' .$error. '</div>';
    
    }else {

      echo ' ';

    } ?>

   </div>
      
    <h1>What is the weather?</h1>
    
    <p>Enter the name of a city</p>
    
    <form method="get">
  
     <div class="container">
    
       <input type="text" class="form-control city" name="city" placeholder="E.g. Tokyo, Lagos">
    
     </div>
  
    <div class="container">
        
     <button type="submit" class="btn btn-info button">Submit</button>
     
    </div>
  
   </form>

   <?php 

   if($weather) {
   
   echo '<div class="alert alert-info weather" role="alert">' .$weather. '</div>';
   
   }else{
     
     echo ' '; 
     
   }?>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


  </body>
  
</html>