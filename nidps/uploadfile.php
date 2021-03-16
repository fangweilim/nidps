<?php
    $con = mysqli_connect("localhost","root","");
    if(!$con){
        die('connection error');
    }else{
        mysqli_select_db($con,"db") or die('unable to connect with the database');
    }
?>
<?php
    $message = '';
    if(isset($_POST['submit'])){
        $localIP = gethostbyname(trim(exec("hostname")));
        $targetdire = "upload/";
        $filename = basename($_FILES['file']['name']);
        $path = $targetdire.$filename;

        $filetype = pathinfo($path,PATHINFO_EXTENSION);

        $filesize = ($_FILES['file']['size'])/1024;

        if (!empty($_FILES['file']['name'])) {

            $allowtype = array('docx', 'pdf', 'doc', 'jpg', 'png', 'jpeg', 'gif');

            if(in_array($filetype, $allowtype)){

                if(move_uploaded_file($_FILES['file']['tmp_name'], $path)){

                    $query = "insert into upload(localIP,file,type,size) values('".$localIP."','".$path."','".$filetype."',".$filesize.")";
                    $result = mysqli_query( $con, $query);
                    if($result){
                        $message = "<p>File Uploaded successfully...<a href='view.php'>click here to view the files</a></p>";
                    }else {
                        $message = "File upload failed, please try it again";
                    }
                }else {
                    $message = "Sorry, there was an error uploading your file";
                }
            }else {
                $message = 'Sorry, only pdf, docx, doc, png, jpg, jpeg, gif files are allowed to upload';
            }
        }else {
            $message = 'Please select a file to upload';
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Upload File</title>
        <style media="screen">
            body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: url('img/aa.jpg');
            background-size: cover;
            }
            table{
                margin-top: 10%;
            }
            button, .upload{
               background-color: #4CAF50;
               border: none;
               color: white;
               padding: 16px 32px;
               text-align: center;
               text-decoration: none;
               display: inline-block;
               font-size: 20px;
               width: 30%;
               margin: 4px 2px;
               -webkit-transition-duration: 0.4s;
               transition-duration: 0.4s;
               cursor: pointer;
               border-radius: 12px;
            }
            button {
                background-color: white;
                color: black;
                border: 2px solid #f44336;
            }

            button:hover {
                background-color: #f44336;
                color: white;
                box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
            }

            .upload {
                background-color: white;
                color: black;
                border: 2px solid #008CBA;
            }

            .upload:hover {
                background-color: #008CBA;
                color: white;
                box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
            }

            #upload {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 50%;

            }

            #upload td, #upload th {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }

            #upload tr:nth-child(even){background-color: #f2f2f2;}

            #upload tr:hover {background-color: #ddd;}

            #upload th {
                padding-top: 12px;
                padding-bottom: 12px;
                background-color: #4CAF50;
                color: white;
            }
        </style>
    </head>
    <body>
        <form action="uploadfile.php" method="post" enctype="multipart/form-data">
            <table id = "upload" align="center">
                <tr>
                    <th><label for="id">Select pdf/docx/doc/png/jpg/jpeg/gif file to upload: </label></th>
                </tr>
                <tr>
                    <td><input type="file" id="file" name="file"></td>
                </tr>
                <tr>
                    <td style="background-color: white;" ><input type="submit" name="submit" class="upload" value="Upload"></td>
                </tr>
                <tr>
                    <td><?=$message?></td>
                </tr>
                <tr>
                    <td style="background-color: white;" ><a href="menu.php"><button type="button">Main Menu</button></a></td>
                </tr>
            </table>
        </form>
    </body>
</html>
