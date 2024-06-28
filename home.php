<?php
require_once __DIR__.'/src/helpers.php';
checkAuth();
$user = currentUser();
?>
<!DOCTYPE html>
<html lang="ru" data-theme="light">
<?php include_once __DIR__.'/components/head.php' ?>
<body>

<div class="card home">
    <?php if($user['avatar'] != null): ?>
        <img
            class="avatar"
            src="<?php echo $user['avatar'] ?>"
            alt = "<?php echo $user['name'] ?>"
        >
    <?php endif; ?>

    <h1>Вітаємо, <?= htmlspecialchars($user['name']) ?></h1>
    <form action="src/actions/logout.php" method="post">
        <button role="button">Вихід</button>
    </form>

    <a href="edit_profile.php" class="btn btn-primary">Редагувати профіль</a>
</div>

<script src="assets/app.js"></script>
</body>
</html>
