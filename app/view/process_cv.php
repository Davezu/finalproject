<?php
session_start();
$pdo = require_once '../model/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['cv_error'] = 'Invalid request method.';
    header('Location: client.php');
    exit;
}

$job_id = isset($_POST['job_id']) ? intval($_POST['job_id']) : 0;
$email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : '';
$cover_letter = isset($_POST['cover_letter']) ? trim($_POST['cover_letter']) : '';

if ($job_id <= 0) {
    $_SESSION['cv_error'] = 'Invalid job ID.';
    header('Location: client.php');
    exit;
}

if (!$email) {
    $_SESSION['cv_error'] = 'Invalid email address.';
    header('Location: client.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT job_info FROM js_tbl WHERE job_id = ?");
    $stmt->execute([$job_id]);
    $job = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$job) {
        $_SESSION['cv_error'] = 'Job not found.';
        header('Location: client.php');
        exit;
    }
} catch (PDOException $e) {
    $_SESSION['cv_error'] = 'Database error.';
    header('Location: client.php');
    exit;
}

$filename = 'cv_placeholder_' . time() . '.pdf';

try {
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
    $stmt = $pdo->prepare("INSERT INTO job_applications (job_id, user_id, email, cv_path, cover_letter) 
                          VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$job_id, $user_id, $email, $filename, $cover_letter]);
    
    $_SESSION['cv_success'] = 'Your application for "' . htmlspecialchars($job['job_info']) . '" has been submitted successfully!';
} catch (PDOException $e) {
    $_SESSION['cv_error'] = 'Failed to save application.';
}

header('Location: client.php');
exit; 