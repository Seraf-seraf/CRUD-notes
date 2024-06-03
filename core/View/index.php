<section class="notes">
    <?php foreach ($posts as $post): ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="/view/<?=$post->id?>"><?=$post->title;?></a>
                    <span><?=date('H:i:s d.m.Y', strtotime($post->date_created));?></span>
                </h5>
                <p class="card-text">
                    <?= $post->note; ?>
                </p>
                <div class="note-menu">
                    <a class="btn btn-primary" href="/update/<?=$post->id?>">Обновить</a>
                    <a class="btn btn-danger" href="/delete/<?=$post->id?>">Удалить</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>
