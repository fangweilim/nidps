<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Main Menu</title>
        <style media="screen">
            body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: url('img/aa.jpg');
            background-size: cover;
            }
            table{
                margin-top: 10%;
            }
            button{
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
            .button1 {
               background-color: white;
               border: none;
               color: black;
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
        <table align="center">
            <tr>
                <th colspan="2"><h1>Main Menu</h1></th>
            </tr>
            <tr>
                <td><a href="uploadfile.php"><button type="button" class="button1" name="Upload File" >Upload File</button></a></td>
            </tr>
            <tr>
                <td><a href="view.php"><button type="button" class="button1" name="View Files">View Files</button></a></td>
            </tr>
            <tr>
                <td><a href="attack.php"><button type="button" class="button1" name="View attacks">View attacks</button></a></td>
            </tr>
            <tr>
                <td><a href="home.php"><button type="button" class="button1" name="Log Out">Log Out</button></a></td>
            </tr>
        </table>
    </body>
</html>
