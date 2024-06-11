<div class="container-sm">
    <form method="post" action="/login">
        <input type="hidden" value="<?= $_SESSION['csrf_token']; ?>" name="csrf_token">
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="login" value="<?= htmlspecialchars($_POST['login'] ?? '') ?>"
                   name="login">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="true">
        </div>
        <?php
        if (isset($errors['login'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($errors['login']); ?>
            </div>
        <?php
        endif; ?>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>