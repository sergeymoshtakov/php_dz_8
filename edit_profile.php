<?php
require_once __DIR__.'/src/helpers.php';
checkAuth();
$user = currentUser();
?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<?php include_once __DIR__.'/components/head.php' ?>
<body>

<form class="card" action="src/actions/update_profile.php" method="post" enctype="multipart/form-data">
    <h2>Редагування профілю</h2>

    <label for="name">
        Ім'я
        <input
            type="text"
            id="name"
            name="name"
            placeholder="введіть ім'я"
            value="<?php echo htmlspecialchars($user['name']) ?>"
            <?php echo validationErrorAttr('name'); ?>
        >
        <?php if(hasValidationError('name')) : ?>
            <small><?php echo validationErrorMessage('name') ?></small>
        <?php endif; ?>
    </label>

    <label for="email">
        E-mail
        <input
            type="text"
            id="email"
            name="email"
            placeholder="email@com.com"
            value="<?php echo htmlspecialchars($user['email']) ?>"
            <?php echo validationErrorAttr('email'); ?>
        >
        <?php if(hasValidationError('email')) : ?>
            <small><?php echo validationErrorMessage('email') ?></small>
        <?php endif; ?>
    </label>

    <label for="avatar">Зображення профілю
        <input
            type="file"
            id="avatar"
            name="avatar"
            <?php echo validationErrorAttr('avatar'); ?>
        >
        <?php if(hasValidationError('avatar')) : ?>
            <small><?php echo validationErrorMessage('avatar') ?></small>
        <?php endif; ?>
    </label>

    <button
        type="submit"
        id="submit"
    >Зберегти</button>
</form>

<script src="assets/app.js"></script>
</body>
</html>
