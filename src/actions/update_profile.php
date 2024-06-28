<?php
require_once __DIR__.'/../helpers.php';
checkAuth();

$user = currentUser();
$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$avatar = $_FILES['avatar'] ?? null;

if (empty($name)) {
    setValidationError('name', 'Невірне ім\'я користувача');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setValidationError('email', 'Вказана не вірна пошта');
}
if (!empty($avatar['name'])) {
    $types = ['image/jpeg', 'image/png'];
    if (!in_array($avatar['type'], $types)) {
        setValidationError('avatar', 'Аватар має невірний тип тільи jpg та png');
    }
    if (($avatar['size'] / 1000000) >= 1) {
        setValidationError('avatar', 'Аватар має бути не більше 1Мб');
    }
}

if (!empty($_SESSION['validation'])) {
    redirect('/edit_profile.php');
}

$avatarPath = $user['avatar'];
if (!empty($avatar['name'])) {
    if ($avatarPath) {
        // Удаление старого аватара
        $oldAvatarPath = __DIR__.'/../../' . $avatarPath;
        if (file_exists($oldAvatarPath)) {
            unlink($oldAvatarPath);
        }
    }
    $avatarPath = uploadFile($avatar, 'avatar');
}

$pdo = getPDO();
$query = "UPDATE users SET name = :name, email = :email, avatar = :avatar WHERE id = :id";
$params = [
    'name' => $name,
    'email' => $email,
    'avatar' => $avatarPath,
    'id' => $user['id']
];
$stmt = $pdo->prepare($query);
try {
    $stmt->execute($params);
} catch (PDOException $e) {
    die($e->getMessage());
}

$_SESSION['user'] = findUser($email);  // Обновляем данные пользователя в сессии
redirect('/home.php');
