<?php
session_start();

$filename = isset($_GET['file']) ? basename($_GET['file']) : '';
if (empty($filename)) {
    die('No file specified');
}
$root_dir = $_SERVER['DOCUMENT_ROOT'] . '/tomprj';
$file_path = $root_dir . '/uploads/cv/' . $filename;
if (!file_exists($file_path)) {
    die('File not found');
}
$file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

switch ($file_ext) {
    case 'pdf':
        $content_type = 'application/pdf';
        break;
    case 'doc':
        $content_type = 'application/msword';
        break;
    case 'docx':
        $content_type = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
        break;
    default:
        $content_type = 'application/octet-stream';
}
header('Content-Type: ' . $content_type);
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Length: ' . filesize($file_path));
readfile($file_path);
exit; 