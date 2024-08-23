<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password reset</title>

    <style>
        body,
        h2,
        p,
        a {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 100%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            border-radius: 8px;
            justify-content: start;
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            color: #02225A;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            color: #555555;
            font-size: 16px;
            line-height: 1.5;
            text-align: center;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            width: 200px;
            padding: 10px;
            text-align: center;
            color: #02225A;
            background-color: #FDC700;
            text-decoration: none;
            border-radius: 4px;
            font-size: 18px;
            margin: 0 auto;
            text-align: center;
            display: block;
            margin-bottom: 20px;
        }

        a:hover {
            background-color: #02225A;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Hello, {{ $user->name }}!</h2>
        <p>To restore your password, click the link below:</p>
        <a href="{{ route('password.link', $user->token) }}">Restore password</a>
        <p>If you did not request this change, please ignore this message.</p>
        <div>
            <p>Need help? Contact us!</p>
        </div>
    </div>
</body>

</html>
