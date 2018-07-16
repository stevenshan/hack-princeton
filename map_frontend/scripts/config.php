<?php
    define('DB_SERVER', getenv('DATABASE_URL'));
    define('DB_USERNAME', getenv('DATABASE_USER'));
    define('DB_PASSWORD', getenv('DATABASE_PASSWORD'));
    define('DB_DATABASE', getenv('DATABASE_NAME'));
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
