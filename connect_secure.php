<?php
/**
 * connect_secure.php
 *
 * Example secure database connection and prepared-insert for the `farmer` table.
 * - Uses PDO with exceptions enabled
 * - Reads DB connection info from environment variables (or falls back to sensible defaults)
 * - Demonstrates a prepared statement to avoid SQL injection
 *
 * Usage:
 * 1. Copy `.env.example` to `.env` (if not using Docker) and set values.
 * 2. If you run under Docker Compose, the DB host is `db` and credentials are in docker-compose.yml.
 * 3. Include this file where you need a secure DB connection, or require it and call insertFarmer().
 */

// Helper: read env var with fallback
function env($key, $default = null) {
    $val = getenv($key);
    if ($val === false) return $default;
    return $val;
}

$DB_HOST = env('DB_HOST', 'localhost');
$DB_NAME = env('DB_DATABASE', 'dry');
$DB_USER = env('DB_USERNAME', 'root');
$DB_PASS = env('DB_PASSWORD', '');

// DSN for PDO
$dsn = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    // In production, avoid echoing full error messages.
    die('Database connection failed: ' . $e->getMessage());
}

/**
 * Insert a farmer record using prepared statements.
 * Expects an associative array with keys: firstname, ph, vid, milk_type, min_litre, animalID
 */
function insertFarmer(PDO $pdo, array $data) {
    $sql = "INSERT INTO farmer (fname, ph, f_vid, milk_type, min_litre, animalID)
            VALUES (:fname, :ph, :f_vid, :milk_type, :min_litre, :animalID)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':fname' => $data['firstname'] ?? null,
        ':ph' => $data['ph'] ?? null,
        ':f_vid' => $data['vid'] ?? null,
        ':milk_type' => $data['milk_type'] ?? null,
        ':min_litre' => $data['min_litre'] ?? null,
        ':animalID' => $data['animalID'] ?? null,
    ]);

    return $pdo->lastInsertId();
}

// Example usage when called from a form (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['savedata'])) {
    $data = [
        'firstname' => $_POST['firstname'] ?? null,
        'ph' => $_POST['ph'] ?? null,
        'vid' => $_POST['vid'] ?? null,
        'milk_type' => $_POST['milk_type'] ?? null,
        'min_litre' => $_POST['min_litre'] ?? null,
        'animalID' => $_POST['animalID'] ?? null,
    ];

    try {
        $id = insertFarmer($pdo, $data);
        // Redirect on success
        header('Location: farmer.php');
        exit;
    } catch (Exception $e) {
        // Handle error (log it, show friendly message)
        echo "Could not save farmer: " . htmlspecialchars($e->getMessage());
    }
}

?>
