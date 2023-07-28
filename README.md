# Usage

```
$encryptionKey = "Jakistajnyklucz";
$encryptor = new ImageEncryptor($encryptionKey);

$encryptor->encryptImage("input_image.jpg", "encrypted_image.jpg");

$encryptor->decryptImage("encrypted_image.jpg", "decrypted_image.jpg");
```