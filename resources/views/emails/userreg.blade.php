<!doctype html>
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
        Thank you for creating an account with us. Don't forget to complete your registration!
    <br>
        Here is your verification code:  {{$verification_code}}
    <br>
        Please, copy the verification code and click on the link below to confirm your email address.
    <br>
    <a href='http://localhost:3000/confirm-email'>Confirm my email address</a>
    <br>

    <b>Thank you,<br/>Team CityPeople</b>

</div>

</body>
</html>

                