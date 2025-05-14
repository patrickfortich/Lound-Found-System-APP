<?php
// Define constants for encryption if they are not already defined
if (!defined('ENCRYPTION_KEY')) {
    define('ENCRYPTION_KEY', 'your-secret-key'); // Use a strong key (32 characters for AES-256)
}

/**
 * Encrypts the given data using AES-256-CBC encryption.
 *
 * @param string $data The data to encrypt.
 * @return string The encrypted data, base64 encoded, along with the IV.
 */
function encrypt($data) {
    $key = ENCRYPTION_KEY;
    $iv = openssl_random_pseudo_bytes(16); // Generate a 16-byte IV
    $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
    
    // Combine the IV and the encrypted data for storage
    return base64_encode($iv . $encrypted); // Store IV with the encrypted data
}

/**
 * Decrypts the given data using AES-256-CBC decryption.
 *
 * @param string $data The data to decrypt.
 * @return string The decrypted data.
 */
function decrypt($data) {
    $key = ENCRYPTION_KEY;
    $decoded = base64_decode($data); // Decode before decrypting

    // Check if the decoded data is long enough to contain an IV
    if (strlen($decoded) < 16) {
        throw new Exception("Invalid data: IV is missing or too short.");
    }

    // Extract the IV and the encrypted data
    $iv = substr($decoded, 0, 16); // First 16 bytes are the IV
    $encryptedData = substr($decoded, 16); // The rest is the encrypted data

    // Decrypt the data
    return openssl_decrypt($encryptedData, 'AES-256-CBC', $key, 0, $iv);
}
?>
