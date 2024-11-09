<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="../src/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="png" href="../img/puncan logo.png">
    <title>Barangay Certificate Issuance System</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to bottom right, #e0f7fa, #ffffff);
            font-family: 'Poppins', sans-serif;
        }

        .content {
            background-color: #034f84;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            text-transform: uppercase;
            font-weight: 600;
            height: 50px;
        }

        h3 {
            color: #073B4C;
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            font-size: 32px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .cards-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: auto;
            padding: 20px;
            flex-wrap: wrap;
        }

        .card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 220px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
            flex: 1 1 200px;
        }

        .card h4 {
            color: #073B4C;
            font-family: 'Roboto', sans-serif;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            background-color: #44799c;
            color: white;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.2s;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #034f84;
            transform: scale(1.05);
        }

        .datetime {
            font-size: 14px;
            font-weight: 600;
            color: #f0f0f0;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 20px;
            margin-right: 10px;
        }

        footer {
            background-color: #034f84;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            h3 {
                font-size: 28px;
            }

            .card {
                max-width: 100%;
            }

            .content {
                flex-direction: column;
                align-items: flex-start;
                height: auto;
            }
        }

        @media (max-width: 480px) {
            .content {
                padding: 10px;
            }

            h3 {
                font-size: 24px;
            }

            .datetime {
                font-size: 12px;
            }
        }
        sup{
            color: red;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="logo">
            <img src="../img/ph-flag.png" alt="Philippine Flag">
            <label>CARRANGLAN, NUEVA ECIJA</label>
        </div>
        <div>
            <label for="datetime" class="datetime" id="datetime"></label>
        </div>
    </div>