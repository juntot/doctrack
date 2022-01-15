<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body{
            font-size: 2em;
            color: #333;
            /* background: #e9ebee; */
        }
        .white-text{
            color: white;
        }
        .container{
            max-width: 600px;
        }
        .dark-purple-bg{
            background: #303F9F;
        }
        .glyphicon{
            color:#E3F2FD;
            font-size: xx-large;
        }
        .intro-text{
            padding:10px;

        }
    </style>
</head>
<body style="background: #e9ebee;">
    <center>
    <table style="margin: 0 auto; text-align: center; color: white; width: 800px;" >
        <thead style="background: #303F9F; padding: 60px 0px; display: block;">
            <tr>
                <!-- <td style="width: 1366px;">
                    <img src="http://dev.northtrend.com/public/images/mailer/mail-info-01.png"
                    style="width: 90px; height: auto;"
                    alt="information">
                </td> -->
            </tr>
            <tr>
                <td style="padding: 10px; width: 1366px;">
                    <h1 style="text-align:center">
                            DOCTRACK SYSTEM
                    </h1>
                </td>
            </tr>
            <tr>
                <td style="padding: 5px 20 20 20x; font-size: 14px; text-align:center">
                    {{date("l\, jS \of F Y")}}
                </td>
            </tr>
        </thead>
        <tbody style="background: white; padding: 80px 15px; display: block; color: #333; text-align: center;">
            <tr>
                <td style="
                    width: 1366px;
                    font-size: 14px;
                ">

                <div>
                    <!-- <h1 style="text-align: center; color: #303f9f; margin-top: 0;"><center>DOCTRACK SYSTEM</center></h1> -->
                    <h1 style="text-align: center;"><?php
                        echo htmlspecialchars_decode($emailBody);
                    ?>
                    </h1>
                </div>
            </td>
            </tr>
            <tr>
                <td style="padding-top: 50px;">
                    
                </td>
            </tr>
        </tbody>
    </table>
    </center>
</body>
</html>