<?php

  include("connect.php");     
  $link=Connection();

  $result=mysql_query("SELECT * FROM `data` ORDER BY `date` DESC",$link);
?>

<html>
   <head>
      <title>Sensor Data</title>
   </head>
<body>
   <h1>Temperature / moisture sensor readings</h1>

   <table border="1" cellspacing="1" cellpadding="1">
        <tr>
            <td>&nbsp;Timestamp&nbsp;</td>
            <td>&nbsp;Temperature&nbsp;</td>
            <td>&nbsp;Moisture&nbsp;</td>
            <td>&nbsp;Sensor_id&nbsp;</td>
        </tr>

      <?php 
          if($result!==FALSE){
             while($row = mysql_fetch_array($result)) {
                printf("<tr><td> &nbsp;%s </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td></tr>", 
                   $row["date"], $row["temperature"], $row["humidity"], $row["sensor_id"]);
             }
             mysql_free_result($result);
             mysql_close();
          }
      ?>

   </table>
</body>
</html>
