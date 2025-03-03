<?php

namespace Src;

use QRcode;
/*
 * Логіка генерації QR-кодів
 */
class QRCodeGenerator
{
    public function generate(string $data, int $size, string $filePath): void
    {
        QRcode::png($data, $filePath, QR_ECLEVEL_L, $size / 150);
    }
}
