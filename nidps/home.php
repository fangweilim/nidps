<?php
include('config.php');
$per = 0;
if(isset($_POST['signup'])){
        $per = 1;
        $md = hash('md5', $_POST['psw']);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = '';
        $localIP = gethostbyname(trim(exec("hostname")));
        function getBrowser() {
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $bname = 'Unknown';
            $platform = 'Unknown';
            $version= "";

            if (preg_match('/linux/i', $u_agent)) {
                $platform = 'linux';
            }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                $platform = 'mac';
            }elseif (preg_match('/windows|win32/i', $u_agent)) {
                $platform = 'windows';
            }

            if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }elseif(preg_match('/Firefox/i',$u_agent)){
                $bname = 'Mozilla Firefox';
                $ub = "Firefox";
            }elseif(preg_match('/OPR/i',$u_agent)){
                $bname = 'Opera';
                $ub = "Opera";
            }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
                $bname = 'Google Chrome';
                $ub = "Chrome";
            }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
                $bname = 'Apple Safari';
                $ub = "Safari";
            }elseif(preg_match('/Netscape/i',$u_agent)){
                $bname = 'Netscape';
                $ub = "Netscape";
            }elseif(preg_match('/Edge/i',$u_agent)){
                $bname = 'Edge';
                $ub = "Edge";
            }elseif(preg_match('/Trident/i',$u_agent)){
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }

            $known = array('Version', $ub, 'other');
            $pattern = '#(?<browser>' . join('|', $known) .')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $u_agent, $matches)) {

            }

            $i = count($matches['browser']);
            if ($i != 1) {
                if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                    $version= $matches['version'][0];
                }else {
                    $version= $matches['version'][1];
                }
            }else {
                $version= $matches['version'][0];
            }

            if ($version==null || $version=="") {$version="?";}

            return array(
                'userAgent' => $u_agent,
                'name'      => $bname,
                'version'   => $version,
                'platform'  => $platform,
                'pattern'    => $pattern
            );
        }

        $browser = getBrowser(null, true);
        $browswername=$browser['name'];
        $browswerversion= $browser['version'];
        $os= $browser['platform'];

        $sql = 'insert into login values("'.$name.'","'.$md.'","'.$email.'","'.$localIP.'","'.$browswername.'","'.$browswerversion.'","'.$os.'")';
        $result = mysqli_query($con, $sql);
        if($result){
            $message = "Account successfully created";
        }else{
            $message = "Registration failed, please try it again";
        }
}elseif (isset($_POST['login'])) {
    $per = 1;
    $md = hash('md5', $_POST['psw']);
    $name = $_POST['uname'];
    $message = '';
    $localIP = gethostbyname(trim(exec("hostname")));
    function getBrowser() {
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $bname = 'Unknown';
            $platform = 'Unknown';
            $version= "";

            if (preg_match('/linux/i', $u_agent)) {
                $platform = 'linux';
            }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                $platform = 'mac';
            }elseif (preg_match('/windows|win32/i', $u_agent)) {
                $platform = 'windows';
            }

            if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }elseif(preg_match('/Firefox/i',$u_agent)){
                $bname = 'Mozilla Firefox';
                $ub = "Firefox";
            }elseif(preg_match('/OPR/i',$u_agent)){
                $bname = 'Opera';
                $ub = "Opera";
            }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
                $bname = 'Google Chrome';
                $ub = "Chrome";
            }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
                $bname = 'Apple Safari';
                $ub = "Safari";
            }elseif(preg_match('/Netscape/i',$u_agent)){
                $bname = 'Netscape';
                $ub = "Netscape";
            }elseif(preg_match('/Edge/i',$u_agent)){
                $bname = 'Edge';
                $ub = "Edge";
            }elseif(preg_match('/Trident/i',$u_agent)){
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }

            $known = array('Version', $ub, 'other');
            $pattern = '#(?<browser>' . join('|', $known) .')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $u_agent, $matches)) {

            }

            $i = count($matches['browser']);
            if ($i != 1) {
                if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                    $version= $matches['version'][0];
                }else {
                    $version= $matches['version'][1];
                }
            }else {
                $version= $matches['version'][0];
            }

            if ($version==null || $version=="") {$version="?";}

            return array(
                'userAgent' => $u_agent,
                'name'      => $bname,
                'version'   => $version,
                'platform'  => $platform,
                'pattern'    => $pattern
            );
        }
    $browser = getBrowser(null, true);
    $browswername=$browser['name'];
    $browswerversion= $browser['version'];
    $os= $browser['platform'];

    $sql = 'select * from login where name="'.$name.'"';
    $login_results = mysqli_query($con, $sql);
    while($result = mysqli_fetch_array($login_results)){
        //track event history
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $time = date('Y-m-d H:i:s');
        $eventtype = "login";
        $localIP = gethostbyname(trim(exec("hostname")));
        if ($result['name']==$name){
            if ($result['md']==$md) {
                $status = "success";
                header("Location: menu.php");
                $sql = 'insert into eventhistory values("'.$result['name'].'","'.$time.'","'.$eventtype.'","'.$status.'","'.$localIP.'")';
                mysqli_query($con, $sql);
            } else {
                $status = 'failed';
                $message = "Invalid password, please try it again";
                $sql = 'insert into eventhistory values("'.$result['name'].'","'.$time.'","'.$eventtype.'","'.$status.'","'.$localIP.'")';
                mysqli_query($con, $sql);
                $sql = 'select * from eventhistory where name="'.$name.'" AND time BETWEEN DATE_SUB(NOW(), INTERVAL 1 MINUTE) AND NOW() AND status = "failed"';
                $times = array();
                $history_results = mysqli_query($con, $sql);
                while($row = mysqli_fetch_array($history_results)) {
                    array_push($times,  strtotime($row['time']));
                    if (mysqli_num_rows($history_results) >= 4) {
                     echo "You are attacker";
                     date_default_timezone_set("Asia/Kuala_Lumpur");
                     $time = date('Y-m-d H:i:s');
                     $sql = 'insert into attack values("'.$localIP.'","'.$browswername.'","'.$browswerversion.'","'.$os.'","'.$time.'")';
                     mysqli_query($con, $sql);
                     $to =$result['email'];
                     $subject ="Account security alert";
                     $from = 'fangweilim123@gmail.com';
                     $headers  = 'MIME-Version: 1.0' . "\r\n";
                     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                     $headers .= 'From: '.$from."\r\n".  
                         'Reply-To: '.$from."\r\n" .
                         'X-Mailer: PHP/' . phpversion();
                     $msg = '<html><body>';
                     $msg .= '<h3 style="color:#000;">Dear '.$name.' ,</h3>';
                     $msg .= '<h3 style="color:#000;">Failed sign-in attempt was detected, your account may be breached.</h3>';
                     $msg .= '<p style="color:#080;font-size:15px;">IP Address: '.$localIP.'</p>';
                     $msg .= '<p style="color:#080;font-size:15px;">Browser Name: '.$browswername.'</p>';
                     $msg .= '<p style="color:#080;font-size:15px;">Browser Version: '.$browswerversion.'</p>';
                     $msg .= '<p style="color:#080;font-size:15px;">Operating System: '.$os.'</p>';
                     $msg .= '</body></html>';
                     mail($to, $subject, $msg, $headers);
                     break;
                     }
                }
            }
        }else{
            $message = "Invalid username, please try it again";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home</title>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background-image: url('img/aa.jpg');
    background-size: cover;
}
footer {
  text-align: center;
  padding: 25px;
}
* {box-sizing: border-box}
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    font-size: 20px;
    opacity: 0.8;
}

button:hover {
    opacity: 1;
}

.button1, .button2 {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 16px 32px;
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
    border: 2px solid #008CBA;
}

.button1:hover {
    background-color: #008CBA;
    color: white;
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}

.button2 {
    background-color: white;
    color: black;
    border: 2px solid #f44336;
}

.button2:hover {
    background-color: #f44336;
    color: white;
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}

.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}
.container {
    padding: 16px;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: #474e5d;
    padding-top: 50px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto;
    border: 1px solid #888;
    width: 80%;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

.close {
    position: absolute;
    right: 35px;
    top: 15px;
    font-size: 40px;
    font-weight: bold;
    color: #f1f1f1;
}

.close:hover,
.close:focus {
    color: #f44336;
    cursor: pointer;
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)}
    to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
    from {transform: scale(0)}
    to {transform: scale(1)}
}

@media screen and (max-width: 300px) {
    .cancelbtn,signupbtn {
       width: 100%;
    }
}
table{
    margin-top: 10%;
}
.newtable{
    margin-top: 2%;
}
</style>
</head>
<body>

<table align="center">
    <tr>
        <th colspan="2"><h1>Home</h1></th>
    </tr>
    <tr>
        <td><button onclick="document.getElementById('id01').style.display='block'" class="button1">Login</button></td>
    </tr>
    <tr>
        <td><button onclick="document.getElementById('id02').style.display='block'" class="button2">Sign Up</button></td>
    </tr>
    <table align="center" class="newtable">
        <tr>
            <td colspan="2" style="color:red;">
                <?php
                    if($per==1){
                        echo $message;
                    }
                ?>
            </td>
        </tr>
    </table>
</table>


<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content" action="home.php" method="post">
    <div class="container">
      <h1>Login</h1>
      <hr>
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <div class="clearfix">
            <button type="submit" class="signupbtn" name="login">Log In</button>
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
    </div>
  </form>
</div>

<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content" action="home.php" method="post">
    <div class="container">
      <h1>Register</h1>
      <hr>
      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter Username" name="name" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <div class="clearfix">
          <button type="submit" class="signupbtn" name="signup">Sign Up</button>
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
    </div>
  </form>
</div>


<script>
var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }else if (event.target == modal2) {
        modal2.style.display = "none";
    }
}
</script>

</body>
<footer>
  <p><a href="s1.php">SQL Injection Demo</a></p>
  <p><a href="bf.php">Brute Force Demo</a></p>
</footer>
</html>
