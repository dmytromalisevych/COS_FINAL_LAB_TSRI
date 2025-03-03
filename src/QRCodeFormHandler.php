<?php
/*
 * Логіка обробки форм та їх валідація
 */

namespace Src;

class QRCodeFormHandler
{
    private $data;
    private $size;

    public function __construct(array $postData)
    {
        $this->data = $postData['data'] ?? '';
        $this->size = (int)($postData['size'] ?? 500);
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function isValid(): bool
    {
        return !empty($this->data);
    }
}
