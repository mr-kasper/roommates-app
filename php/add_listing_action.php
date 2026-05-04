<?php
/**
 * Add Listing Action Handler
 * 
 * Creates a new roommate listing for authenticated user.
 * Validates budget, move-in date, preferences text, status, and expiration days.
 * Optional image upload: Validates MIME type (PNG, JPEG, WebP), stores in uploads/listings/.
 * Calculates expiration date (current + N days, 7-180 day range).
 * Uses PDO prepared statements for secure insertion.
 * On success: Logs activity and redirects to dashboard.
 * Requires user login and POST method.
 */
declare(strict_types=1);

require_once __DIR__ . '/../config.php';
require_login('../pages/login.php');
require_post('../pages/add_listing.php');

$userId = (int)current_user_id();
$budget = (int)($_POST['budget'] ?? 0);
$moveInDate = trim((string)($_POST['move_in_date'] ?? ''));
$preferences = trim((string)($_POST['preferences'] ?? ''));
$status = trim((string)($_POST['status'] ?? 'open'));
$expiresDays = (int)($_POST['expires_days'] ?? 30);
$imagePath = null;

if ($budget < 1 || $moveInDate === '' || strlen($preferences) < 10 || !in_array($status, ['open', 'reserved', 'closed'], true) || $expiresDays < 7 || $expiresDays >
180) { set_flash('danger', 'Please provide valid listing details.'); redirect('../pages/add_listing.php'); } if (!empty($_FILES['listing_image']['name']) && (int)$_FILES['listing_image']['error'] === UPLOAD_ERR_OK) { $tmpPath = (string)$_FILES['listing_image']['tmp_name']; $fileName = (string)$_FILES['listing_image']['name']; $mime = mime_content_type($tmpPath) ?: ''; $allowed = [ 'image/png' => 'png', 'image/jpeg' => 'jpg', 'image/webp' => 'webp', ]; if (isset($allowed[$mime])) { $uploadDir = __DIR__ . '/../uploads/listings'; if (!is_dir($uploadDir)) { mkdir($uploadDir, 0775, true); } $safeName = 'listing_' . $userId . '_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $allowed[$mime]; $target = $uploadDir . '/' . $safeName; if (move_uploaded_file($tmpPath, $target)) { $imagePath = 'uploads/listings/' . $safeName; } } } $expiresAt = (new DateTimeImmutable('now'))->modify('+' . $expiresDays . ' days')->format('Y-m-d H:i:s'); $stmt = $pdo->prepare('INSERT INTO listings (user_id, budget, move_in_date, preferences, status, expires_at, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)'); $stmt->execute([$userId, $budget, $moveInDate, $preferences, $status, $expiresAt, $imagePath]); log_activity($pdo, $userId, 'listing_created', 'Listing #' . (string)$pdo->lastInsertId()); set_flash('success', 'Listing published successfully.'); redirect('../pages/dashboard.php');
