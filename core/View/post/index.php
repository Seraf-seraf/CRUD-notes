<section class="notes">
    <?php
    foreach ($posts as $post): ?>
        <div class="card" style="w_idth: 18rem;">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="/view/<?= htmlspecialchars($post['_id']) ?>"><?= htmlspecialchars($post['title']); ?></a>
                    <span><?= date('H:i:s d.m.Y', $post['date_created']); ?></span>
                </h5>
                <p class="card-text">
                    <?= htmlspecialchars($post['note']); ?>
                </p>
                <div class="note-menu">
                    <a class="btn btn-primary" href="/update/<?= htmlspecialchars($post['_id']) ?>">Обновить</a>
                    <a class="btn btn-danger" href="/delete/<?= htmlspecialchars($post['_id']) ?>">Удалить</a>
                </div>
            </div>
        </div>
    <?php
    endforeach; ?>
</section>
