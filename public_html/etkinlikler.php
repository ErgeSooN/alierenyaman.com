<?php
$pageSlug  = 'etkinlikler';
require __DIR__ . '/includes/data.php';
$pageTitle = t($ui['nav']['etkinlikler']);
require __DIR__ . '/includes/header.php';
?>

<section class="section" data-commit>
  <p class="page-label mono">~/<?= $lang === 'tr' ? 'etkinlikler' : 'events' ?> · branch: <span class="page-label__branch">main</span> · <?= count($events) ?> commits</p>
  <h1 class="page-title"><?= e($ui['nav']['etkinlikler']) ?></h1>
  <p class="page-lead">
    <?= $lang === 'tr'
      ? 'Sahnede olmaktan çok sahneyi kuran taraftayım: organizasyon, mentorluk ve topluluk yönetimi.'
      : 'I\'m usually the one building the stage rather than standing on it: organizing, mentoring and community management.' ?>
  </p>
</section>

<section class="section" data-commit>
  <ul class="event-list">
    <?php foreach ($events as $ev): ?>
    <li class="event reveal">
      <div class="event__head">
        <h2 class="event__name"><?= e($ev['name']) ?></h2>
        <span class="event__date mono"><?= e($ev['date']) ?></span>
      </div>
      <p class="event__role mono"><?= e($ev['role']) ?></p>
      <p class="event__desc"><?= e($ev['desc']) ?></p>
    </li>
    <?php endforeach; ?>
  </ul>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
