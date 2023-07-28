<?php

class ImageEncryptor 
{
    public function __construct(private $key) 
    {
        $this->key = $key;
    }

    public function encryptImage(string $inputImage, string $outputImage)
    {
        $imageData = file_get_contents($inputImage);
        $ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);
        $encryptedData = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $imageData, MCRYPT_MODE_CBC, $iv);

        file_put_contents($outputImage, $iv . $encryptedData);
    }

    public function decryptImage($encryptedImage, $outputImage)
    {
        $encryptedData = file_get_contents($encryptedImage);
        $ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
        $iv = substr($encryptedData, 0, $ivSize);
        $encryptedData = substr($encryptedData, $ivSize);
        $decryptedData = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, $encryptedData, MCRYPT_MODE_CBC, $iv);

        file_put_contents($outputImage, $decryptedData);
    }
}
