<form action="/update/<?= htmlspecialchars($post['_id']) ?>" method="post">
    <input type="hidden" value="<?= $_SESSION['csrf_token']; ?>" name="csrf_token">
    <div class="form-field mb-3">
        <label for="title" class="form-label">Заголовок</label>
        <input id="title" class="form-control" type="text" name="title" value="<?= htmlspecialchars($post['title']); ?>"
               placeholder="Заголовок">
    </div>
    <div class="form-field mb-3">
        <label for="note" class="form-label">Заметка</label>
        <input id="note" class="form-control" type="text" name="note" value="<?= htmlspecialchars($post['note']); ?>"
               placeholder="Заметка">
    </div>

    <input class="btn btn-primary rounded-pill px-3" type="submit" value="Сохранить">
</form>