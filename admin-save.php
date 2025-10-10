<?php
/**
 * STANDARDIZED ADMIN SAVE HANDLER
 * Drop-in component for all PHP websites
 * Saves edited content from admin mode
 *
 * USAGE: Copy this file to your project root
 * REQUIRES: includes/admin-config.php with isAdminMode(), loadContent(), saveContent(), validateCSRFToken()
 */

// Start session FIRST before any output buffering
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Prevent any HTML output
error_reporting(0);
ini_set('display_errors', 0);

// Start output buffering to catch any unwanted output
ob_start();

require_once 'includes/admin-config.php';

// Clear any output that might have been generated
ob_clean();

// Set JSON response header
header('Content-Type: application/json');

// Check if admin mode is active
if (!isAdminMode()) {
    // Debug: Let's see what's happening
    $debug = [
        'session_id' => session_id(),
        'session_status' => session_status(),
        'admin_mode' => $_SESSION['admin_mode'] ?? 'not set',
        'IS_ADMIN' => IS_ADMIN,
        'session_data' => $_SESSION
    ];

    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Unauthorized', 'debug' => $debug]);
    exit;
}

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Parse JSON input
$input = json_decode(file_get_contents('php://input'), true);

// Validate CSRF token
if (!isset($input['csrf_token']) || !verifyCSRFToken($input['csrf_token'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid security token']);
    exit;
}

// Validate required fields
if (!isset($input['page']) || !isset($input['fields'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

$page = $input['page'];
$fields = $input['fields'];

// Load existing content
$content = loadContent($page);

// Update content with new values
foreach ($fields as $path => $value) {
    updateNestedValue($content, $path, $value); // Function modifies by reference, don't assign return value
}

// Save updated content
if (saveContent($page, $content)) {
    echo json_encode(['success' => true, 'message' => 'Content saved successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save content']);
}

// Note: updateNestedValue function is already defined in admin-config.php
?>