<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }

        .message {
            font-size: 18px;
            color: #555;
            margin: 20px 0;
            text-align: center;
        }

        .footer {
            font-size: 14px;
            color: #777;
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }

        .button {
            display: inline-block;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">Повідомлення від Laravel</div>
    <div class="message">
        {{ $text }}
    </div>
    <div class="footer">
        Дякуємо, що користуєтесь нашим сервісом!<br>
        <a href="{{ url('/') }}" class="button">Перейти на сайт</a>
    </div>
</div>
</body>
</html>
