<html>
   <head>
       
   </head>
   <body>
 

<div id="distance"></div>

<script>
 var lt = 51.472447;
var lt1 = 51.465097;
var ln = -3.176151;
var ln1 = -3.170893;
var dLat = (lt - lt1) * Math.PI / 180;
var dLon = (ln - ln1) * Math.PI / 180;
var a = 0.5 - Math.cos(dLat) / 2 + Math.cos(lt1 * Math.PI / 180) * Math.cos(lt * Math.PI / 180) * (1 - Math.cos(dLon)) / 2;
d = Math.round(6371000 * 2 * Math.asin(Math.sqrt(a)));

$('#distance').html(d);
 </script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 
     
    </body>
</html>
