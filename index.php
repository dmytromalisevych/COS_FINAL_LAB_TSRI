<?php

require_once 'assets/phpqrcode/qrlib.php';
require_once 'src/QRCodeGenerator.php';
require_once 'src/QRCodeStorage.php';
require_once 'src/QRCodeFormHandler.php';
require_once 'config.php';

use Src\QRCodeGenerator;
use Src\QRCodeStorage;
use Src\QRCodeFormHandler;

$formHandler = new QRCodeFormHandler($_POST);

if ($formHandler->isValid()) {
    $storage = new QRCodeStorage(CONFIG_QRCODE_DIR);
    $filePath = $storage->saveQRCode($formHandler->getData());

    $generator = new QRCodeGenerator();
    $generator->generate($formHandler->getData(), $formHandler->getSize(), $filePath);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Code Generator</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
        /* Додаткові стилі */
        body {
            background: linear-gradient(135deg, #6E7FCA, #B100FF);
            color: #333;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            animation: fadeIn 1s ease-out;
        }

        h1 {
            font-size: 28px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 16px;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #B100FF;
            box-shadow: 0 0 8px rgba(177, 0, 255, 0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #B100FF;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background: #5200FF;
        }

        .qr {
            text-align: center;
            margin-top: 30px;
            animation: fadeInUp 1s ease-out;
        }

        .qr img {
            max-width: 100%;
            border: 5px solid #B100FF;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .qr img:hover {
            transform: scale(1.1);
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<div class="container">
    <form action="" method="post">
        <h1>QR Code Generator</h1>
        <label>Enter The Text or URL</label>
        <input type="text" name="data" value="<?= htmlspecialchars($formHandler->getData()) ?>" placeholder="Enter your data">
        <label>Select QR Code Size</label>
        <select name="size">
            <option value="500">Small (500x500)</option>
            <option value="750">Medium (750x750)</option>
            <option value="1000">Large (1000x1000)</option>
        </select>
        <button type="submit">GENERATE</button>
    </form>
    <div class="qr">
        <?php if ($formHandler->isValid()): ?>
            <h2>Here is your QR code:</h2>
            <img src="<?= $filePath ?>" alt="QR Code"><br>
            <a href="<?= $filePath ?>" download>Download this QR Code</a>
        <?php else: ?>
            <br>No data received!
        <?php endif; ?>
    </div>
</div>
</body>
</html>
