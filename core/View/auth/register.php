<div class="container-sm">
    <form method="post" action="/registration">
        <input type="hidden" value="<?= $_SESSION['csrf_token']; ?>" name="csrf_token">
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="login" name="login">
        </div>
        <?php
        if (isset($errors['login'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($errors['login']); ?>
            </div>
        <?php
        endif; ?>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="true">
        </div>
        <?php
        if (isset($errors['register'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($errors['register']); ?>
            </div>
        <?php
        endif; ?>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>
</div>