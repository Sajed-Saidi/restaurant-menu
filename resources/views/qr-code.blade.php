<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>QR Code</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                color: #333;
            }

            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
                background: #ffffff;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            img {
                width: 300px;
                height: 300px;
                object-fit: contain;
                margin: 10px 0;
                border: 2px solid #333;
                border-radius: 8px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/qrcode.png'))); ?>" alt="QR Code">
        </div>
    </body>

</html>
