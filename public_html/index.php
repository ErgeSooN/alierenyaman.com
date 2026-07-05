<?php
$pageSlug  = 'index';
require __DIR__ . '/includes/data.php';
$pageTitle = t($ui['nav']['index']);
require __DIR__ . '/includes/header.php';

$featured = array_filter($projects, fn ($p) => $p['featured']);
?>

<section class="hero section" data-commit>
  <p class="page-label mono">~/<?= $lang === 'tr' ? 'anasayfa' : 'home' ?> · branch: <span class="page-label__branch">main</span></p>
  <h1 class="hero__title"><?= e($site['name']) ?></h1>
  <p class="hero__role"><?= e($site['role']) ?></p>
  <p class="hero__tagline"><?= e($site['tagline']) ?></p>
  <div class="hero__actions">
    <a class="btn btn--primary" href="projeler.php" data-magnetic><?= e($ui['hero_cta_projects']) ?></a>
    <a class="btn btn--ghost" href="iletisim.php" data-magnetic><?= e($ui['hero_cta_contact']) ?></a>
  </div>
</section>

<section class="section" data-commit>
  <h2 class="section__title"><span class="section__hash mono" aria-hidden="true">#</span><?= e($ui['featured_title']) ?></h2>
  <div class="card-grid">
    <?php foreach ($featured as $p): ?>
    <article class="card reveal">
      <h3 class="card__title"><?= e($p['title']) ?></h3>
      <p class="card__desc"><?= e($p['desc']) ?></p>
      <ul class="tags" aria-label="<?= $lang === 'tr' ? 'Kullanılan teknolojiler' : 'Technologies used' ?>">
        <?php foreach ($p['tags'] as $tag): ?>
        <li class="tag mono"><?= e($tag) ?></li>
        <?php endforeach; ?>
      </ul>
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
  <p class="section__more"><a class="arrow-link" href="projeler.php"><?= e($ui['all_projects']) ?> →</a></p>
</section>

<section class="section" data-commit>
  <h2 class="section__title"><span class="section__hash mono" aria-hidden="true">#</span><?= e($ui['about_short_title']) ?></h2>
  <div class="split">
    <p class="split__text">
      <?= $lang === 'tr'
        ? '42 Kocaeli\'nin ilk mezunlarından biriyim; şimdi aynı okulda pedagoji ekibi için araçlar geliştiriyorum. Laravel ve Bagisto ile e-ticaret, Python ile otomasyon, sunucu tarafında VPN kurulumlarından cron job\'lara uzanan bir altyapı deneyimim var. Boş kalan zamanım da Linux Türkiye ve GDG topluluklarına gidiyor.'
        : 'I\'m one of the first graduates of 42 Kocaeli — and now I build tools for the pedagogy team at the same school. My experience spans e-commerce with Laravel and Bagisto, automation with Python, and infrastructure from VPN setups to cron jobs. Whatever time is left goes to the Linux Türkiye and GDG communities.' ?>
    </p>
    <div>
      <h3 class="split__subtitle mono"><?= e($ui['skills_title']) ?></h3>
      <ul class="skills" data-compile>
        <?php foreach ($skills as $s): ?>
        <li class="skill">
          <span class="skill__name mono"><?= e($s['name']) ?></span>
          <span class="skill__dots" aria-label="<?= (int) $s['level'] ?>/5">
            <?php for ($i = 1; $i <= 5; $i++): ?><i class="dot<?= $i <= $s['level'] ? ' dot--on' : '' ?>" aria-hidden="true"></i><?php endfor; ?>
          </span>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <p class="section__more"><a class="arrow-link" href="hakkimda.php"><?= e($ui['nav']['hakkimda']) ?> →</a></p>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
