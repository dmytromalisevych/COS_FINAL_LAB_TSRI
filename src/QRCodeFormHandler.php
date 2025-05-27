<?php

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

public function validateFormData($formData) {
        if (empty($formData['text'])) {
            throw new Exception('Please enter text or URL for the QR code.');
        }
        
        $validSizes = ['small', 'medium', 'large'];
        if (!isset($formData['size']) || !in_array($formData['size'], $validSizes)) {
            throw new Exception('Please select a valid size for the QR code.');
        }
        
        if (!isset($formData['foreground_color']) || !$this->isValidHexColor($formData['foreground_color'])) {
            $formData['foreground_color'] = '#000000'; 
        }
        
        if (!isset($formData['background_color']) || !$this->isValidHexColor($formData['background_color'])) {
            $formData['background_color'] = '#FFFFFF'; 
        }
        
        if ($formData['foreground_color'] === $formData['background_color']) {
            throw new Exception('Foreground and background colors must be different.');
        }
        
        return [
            'text' => trim($formData['text']),
            'size' => $formData['size'],
            'foreground_color' => $formData['foreground_color'],
            'background_color' => $formData['background_color']
        ];
    }

    private function isValidHexColor($color) {
        return preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $color);
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
