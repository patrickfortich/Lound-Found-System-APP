<?php
    define('ENCRYPTION_KEY', 'your-secret-key'); // Use a strong key
    define('ENCRYPTION_IV', 'your-initialization-vector'); // Use a 16-byte IV for AES-256-CBC
   $host = 'localhost';
   $db = 'lost_and_found_db';
   $user = 'root'; // default XAMPP user
   $pass = '12345'; // default XAMPP password
   $conn = new mysqli($host, $user, $pass, $db);
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   ?>