<?php
$pageSlug  = 'projeler';
require __DIR__ . '/includes/data.php';
$pageTitle = t($ui['nav']['projeler']);
require __DIR__ . '/includes/header.php';
?>

<section class="section" data-commit>
  <p class="page-label mono">~/<?= $lang === 'tr' ? 'projeler' : 'projects' ?> · branch: <span class="page-label__branch">main</span> · <?= count($projects) ?> commits</p>
  <h1 class="page-title"><?= e($ui['nav']['projeler']) ?></h1>
  <p class="page-lead">
    <?= $lang === 'tr'
      ? 'Bir kısmı 42 müfredatından, bir kısmı sahadan. Hepsinin ortak noktası: hazır çözüm yerine temelden kurmak.'
      : 'Some from the 42 curriculum, some from the field. What they share: built from the ground up, not from a boilerplate.' ?>
  </p>
</section>

<section class="section" data-commit>
  <div class="card-grid card-grid--full">
    <?php foreach ($projects as $p): ?>
    <article class="card reveal">
      <h2 class="card__title"><?= e($p['title']) ?></h2>
      <p class="card__desc"><?= e($p['desc']) ?></p>
      <ul class="tags" aria-label="<?= $lang === 'tr' ? 'Kullanılan teknolojiler' : 'Technologies used' ?>">
        <?php foreach ($p['tags'] as $tag): ?>
        <li class="tag mono"><?= e($tag) ?></li>
        <?php endforeach; ?>
      </ul>
      <div class="card__foot">
        <?php if ($p['repo']): ?>
        <a class="arrow-link mono" href="<?= e($p['repo']) ?>" target="_blank" rel="noopener"><?= e($ui['view_repo']) ?> ↗</a>
        <?php else: ?>
        <span class="mono mono-dim"><?= e($ui['private_repo']) ?></span>
        <?php endif; ?>
      </div>
      <div class="card__diff mono" aria-hidden="true">
        <div class="card__diff-in">
          <span class="diff-head"><?= e($ui['diff_head']) ?></span>
          <span class="diff-add">+ <?= e($p['diff']['add']) ?></span>
          <span class="diff-del">− <?= e($p['diff']['del']) ?></span>
        </div>
      </div>
    </article>
    <?php endforeach; ?>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
