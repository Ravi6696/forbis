<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Forget Password Email</h1>

    You can reset password from bellow link:
    <a href="{{ url('/reset-password/'.$token) }}">Reset Password</a>
</body>

</html>