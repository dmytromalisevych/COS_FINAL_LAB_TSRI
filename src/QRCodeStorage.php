<?php
namespace Src;
/*
 * Логіка для збереження QR-кодів
 */
class QRCodeStorage
{
    private $directory;

    public function __construct(string $directory)
    {
        $this->directory = $directory;
        $this->ensureDirectoryExists();
    }

    private function ensureDirectoryExists(): void
    {
        if (!file_exists($this->directory)) {
            mkdir($this->directory, 0777, true);
        }
    }

    public function saveQRCode(string $filePath): string
    {
        return 'assets/qrcodes/' . uniqid() . '.png';
    }
}
