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

$storage = new QRCodeStorage(QR_CODES_DIR);
$generator = new QRCodeGenerator($storage);

$qrCodeUrl = null;
$errorMessage = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $formData = $formHandler->validateFormData($_POST);
        $qrCodeUrl = $generator->generateQRCode(
            $formData['text'],
            $formData['size'],
            $formData['foreground_color'],
            $formData['background_color']
        );
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Code Generator</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
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
        <h1>QR Code Generator</h1>
        
        <?php if ($errorMessage): ?>
            <div class="error"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>
        
        <form method="post">
            <div class="form-group">
                <label for="text">Enter Text or URL:</label>
                <textarea id="text" name="text" rows="4" required><?php echo isset($_POST['text']) ? htmlspecialchars($_POST['text']) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="size">Select Size:</label>
                <select id="size" name="size">
                    <option value="small" <?php echo (isset($_POST['size']) && $_POST['size'] === 'small') ? 'selected' : ''; ?>>Small (500x500)</option>
                    <option value="medium" <?php echo (isset($_POST['size']) && $_POST['size'] === 'medium') ? 'selected' : ''; ?>>Medium (750x750)</option>
                    <option value="large" <?php echo (isset($_POST['size']) && $_POST['size'] === 'large') ? 'selected' : ''; ?>>Large (1000x1000)</option>
                </select>
            </div>
        
            <div class="form-group color-selectors">
                <div class="color-field">
                    <label for="foreground_color">QR Code Color:</label>
                    <input type="color" id="foreground_color" name="foreground_color" value="<?php echo isset($_POST['foreground_color']) ? htmlspecialchars($_POST['foreground_color']) : '#000000'; ?>">
                </div>
                
                <div class="color-field">
                    <label for="background_color">Background Color:</label>
                    <input type="color" id="background_color" name="background_color" value="<?php echo isset($_POST['background_color']) ? htmlspecialchars($_POST['background_color']) : '#FFFFFF'; ?>">
                </div>
            </div>
            
            <button type="submit" class="generate-btn">Generate QR Code</button>
        </form>
        
        <?php if ($qrCodeUrl): ?>
            <div class="result">
                <h2>Your QR Code</h2>
                <img src="<?php echo htmlspecialchars($qrCodeUrl); ?>" alt="Generated QR Code">
                <a href="<?php echo htmlspecialchars($qrCodeUrl); ?>" download class="download-btn">Download QR Code</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
