<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
        }

        h2 {
            color: #02225A;
        }

        p {
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            font-size: 16px;
            color: #02225A;
            background-color: #FDC700;
            text-decoration: none;
            border-radius: 4px;
        }

        .button:hover {
            background-color: #02225A;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Hello, {{ $user->name }}!</h2>
        <p>To verify your email address, please, click the following link:</p>
        <a href="{{ route('verification.verify', $user->token) }}" class="button">Click Here</a>
    </div>
</body>

</html>
