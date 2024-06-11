<section class="note-detail">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">
                <a href="/view/<?= htmlspecialchars($post->id) ?>"><?= htmlspecialchars($post->title); ?></a>
                <span><?= date('H:i:s d.m.Y', strtotime($post->date_created)); ?></span>
            </h5>
            <p class="card-text">
                <?= htmlspecialchars($post->note); ?>
            </p>
            <div class="note-menu">
                <a class="btn btn-primary" href="/update/<?= htmlspecialchars($post->id) ?>">Обновить</a>
                <a class="btn btn-danger" href="/delete/<?= htmlspecialchars($post->id) ?>">Удалить</a>
            </div>
        </div>
    </div>
</section>
