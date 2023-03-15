<?php 
    class mysqlConex{
        
        public function conn(){
            $host = "localhost";
            $user = "root";
            $passwd = "";
            $bd = "banco_perla";
            $con = mysqli_connect($host,$user,$passwd,$bd);
            if(!$con){
                die("!MISTAKE! - The connection has not been established");
            }
            return $con;
        }
    }
