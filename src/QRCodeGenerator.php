<?php
require_once 'assets/phpqrcode/qrlib.php';


class QRCodeGenerator {

    private $storage;
    
    public function __construct(QRCodeStorage $storage) {
        $this->storage = $storage;
    }

    public function generateQRCode($text, $size = 'medium', $foregroundColor = '#000000', $backgroundColor = '#FFFFFF') {
        $pixelSize = $this->getPixelSize($size);
        
        $filename = 'qr_' . md5($text . time() . rand(1000, 9999)) . '.png';
        $filePath = $this->storage->getStoragePath() . $filename;
        
        $fgColor = $this->hexToRgb($foregroundColor);
        $bgColor = $this->hexToRgb($backgroundColor);
        
        QRcode::png($text, $filePath, QR_ECLEVEL_M, $pixelSize, 2, false, $bgColor, $fgColor);

        return $this->storage->getFileUrl($filename);
    }

    private function getPixelSize($size) {
        switch ($size) {
            case 'small':
                return 5; 
            case 'large':
                return 10; 
            case 'medium':
            default:
                return 7.5; 
        }
    }

    private function hexToRgb($hexColor) {
        $hex = ltrim($hexColor, '#');
        
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        
        return [$r, $g, $b];
    }
}
