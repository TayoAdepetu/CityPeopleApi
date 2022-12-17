<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
    <div>
        Hi {{ $name }},
        <br>
            Here is your verification code: {{$verification_code}}
        <br>
            Please, copy the above verification code and click on the link below to change your password.
        <br>            
            <a href='http://localhost:3000/passwordchange'>Confirm my email address</a>
            
        <br/>
    </div>
    </body>
</html>