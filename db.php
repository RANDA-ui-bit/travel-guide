<?php
function get_pdo() {
    $host = "dpg-d7n4ck1j2pic738llkug-a";
    $port = "5432";
    $db   = "travel_db_gu65";
    $user = "travel_db_gu65_user";
    $pass = "gqVPgAQrVGk9rpBheQUrTpqqwBKkIHJ5"; // من Render

    $dsn = "pgsql:host=$host;port=$port;dbname=$db";

    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}
?>