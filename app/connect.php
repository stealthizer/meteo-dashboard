<?php

    function Connection(){
        $server={_SERVER_};
        $user={_USER_};
        $pass={_PASS_};
        $db={_DB_};
              
        $connection = mysql_connect($server, $user, $pass);

        if (!$connection) {
            die('MySQL ERROR: ' . mysql_error());
        }
				            
        mysql_select_db($db) or die( 'MySQL ERROR: '. mysql_error() );

        return $connection;
    }
?>

