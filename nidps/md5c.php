<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Md5</title>
        <style media="screen">
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: url('img/aa.jpg');
            background-size: cover;
        }
        h2, p, .output, .md5f{
            text-align: center;
        }

        button {
               background-color: #4CAF50;
               color: white;
               padding: 14px 20px;
               margin: 8px 0;
               border: none;
               cursor: pointer;
               font-size: 20px;
               opacity: 0.8;
            }
        .button1 {
           background-color: white;
           border: none;
           color: black;
           padding: 8px 16px;
           text-align: center;
           text-decoration: none;
           display: inline-block;
           font-size: 20px;
           margin: 4px 2px;
           -webkit-transition-duration: 0.4s;
           transition-duration: 0.4s;
           cursor: pointer;
           border-radius: 12px;
        }
        .button1 {
           background-color: white;
           color: black;
           border: 2px solid #4CAF50;
        }

        .button1:hover {
            background-color: #4CAF50;
            color: white;
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
        }
        </style>
    </head>
    <body>
        <h2>MD5</h2>
        <p>Brute Force Demo</p>
        <div class="output">
            <?php
                $answer = "Not Found";
                if(isset($_GET['submit'])){
                    $md5 = $_GET['md5'];

                    $count = 0;
                    $n = 0;
                    echo "<table align=center>";
                    $pre_time = microtime(true);
                    echo "<tr><th>Hash</th><th>Value</th></tr>";
                    while ($count <= 10000) {
                        $holder = str_pad( "$count", 4, "0", STR_PAD_LEFT );
                        $copymd5 = hash('md5',"$holder");
                        if($md5 === $copymd5){
                            $answer = $holder;
                            if ($n <= 15) {
                                echo "<tr><td>$copymd5</td><td>$holder</td></tr>";
                            }
                        break;
                        }
                        if ($n <= 15) {
                            echo "<tr><td>$copymd5</td><td>$holder</td></tr>";
                        }
                        $n++;
                        $count++;
                    }
                    $post_time = microtime(true);

                    echo "</table>";
                    echo "Total checks: $count<br>";
                    echo "Time taken: ";
                    echo $post_time-$pre_time."<br>";
                }
                echo "<p><b>Password: $answer</b></p>";
            ?>
        </div>
        <form class="md5f" action="md5c.php" method="get">
            <input type="text" name="md5" size="40" value="<?php
            if(!isset($_GET['submit'])){
                echo "";
            }else{
                echo $_GET['md5'];
            }
            ?>" >
            <input type="submit" name="submit" value="MD5 to Digit">
        </form>

        <div class="button" style="text-align:center;">
            <a href="md5c.php"><button type="button" name="button" class="button1" >Reset</button></a>
            <a href="home.php"><button type="button" class="button1">Home</button>
        </div>
    </body>
</html>
