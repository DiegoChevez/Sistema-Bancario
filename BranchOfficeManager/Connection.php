<?

$servername = "localhost";
                                                $username = "root";
                                                $password = "";
                                                $database = "banco_perla";

                                                $connection = new mysqli($servername, $username, $password, $database);

                                                if($connection->connect_error){
                                                    die ("Connection failed: " . $connection->connect_error);
                                                }
?>