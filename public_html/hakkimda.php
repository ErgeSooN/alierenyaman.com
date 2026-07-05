<?php
$pageSlug  = 'hakkimda';
require __DIR__ . '/includes/data.php';
$pageTitle = t($ui['nav']['hakkimda']);
require __DIR__ . '/includes/header.php';
?>

<section class="section" data-commit>
  <p class="page-label mono">~/<?= $lang === 'tr' ? 'hakkimda' : 'about' ?> · branch: <span class="page-label__branch">main</span></p>
  <h1 class="page-title"><?= e($ui['nav']['hakkimda']) ?></h1>

  <div class="prose reveal">
    <?php if ($lang === 'tr'): ?>
    <p>Merhaba, ben Ali Eren. Gebze'de yaşıyorum ve yazılımla uğraşmadığım günüm neredeyse yok. Kocaeli Üniversitesi'nde Bilgisayar Programcılığı okurken Bilişim Vadisi'ndeki 42 Kocaeli'ye girdim — eğitmensiz, proje tabanlı bu okulun <strong>ilk mezunlarından biri</strong> oldum. C ile başlayan yolculuk; C++, Docker ve sistem programlamayla devam etti.</p>
    <p>Bugün 42 Kocaeli'de <strong>Pedago Solutions Developer</strong> olarak pedagoji ekibinin ihtiyaç duyduğu araçları geliştiriyorum ve bir ekip arkadaşımla 42 Türkiye okullarının web sitesini yapıyoruz. İşin mutfağında PHP/Laravel ve Bagisto e-ticaret ekosistemi var; sunucu tarafında VPN kurulumları, cron job'lar ve API entegrasyonlarıyla uğraşmayı seviyorum.</p>
    <p>Toplulukçu tarafım da güçlü: Türkiye Açık Kaynak Platformu'nda staj yaptım, <strong>Linux Türkiye Topluluğu</strong>'nun yönetiminde aktif rol alıyorum ve Google Developer Group organizasyonlarında 3 yılı aşkın süredir etkinlik düzenliyorum. İyi yazılımın iyi toplulukla büyüdüğüne inanıyorum.</p>
    <?php else: ?>
    <p>Hi, I'm Ali Eren. I live in Gebze, and there's hardly a day I don't write code. While studying Computer Programming at Kocaeli University, I joined 42 Kocaeli at Bilişim Vadisi — and became <strong>one of the first graduates</strong> of this teacherless, project-based school. A journey that started with C continued through C++, Docker and systems programming.</p>
    <p>Today I work at 42 Kocaeli as a <strong>Pedago Solutions Developer</strong>, building the tools the pedagogy team needs, and co-developing the 42 Türkiye schools website with a teammate. Under the hood there's PHP/Laravel and the Bagisto e-commerce ecosystem; on the server side I enjoy VPN setups, cron jobs and API integrations.</p>
    <p>The community side of me is strong too: I interned at the Türkiye Open Source Platform, I'm an admin of the <strong>Linux Türkiye Community</strong>, and I've been organizing events with Google Developer Groups for over 3 years. I believe good software grows with good communities.</p>
    <?php endif; ?>
  </div>
</section>

<section class="section" data-commit>
  <h2 class="section__title"><span class="section__hash mono" aria-hidden="true">#</span><?= e($ui['skills_title']) ?></h2>
  <ul class="skills skills--wide" data-compile>
    <?php foreach ($skills as $s): ?>
    <li class="skill">
      <span class="skill__name mono"><?= e($s['name']) ?></span>
      <span class="skill__dots" aria-label="<?= (int) $s['level'] ?>/5">
        <?php for ($i = 1; $i <= 5; $i++): ?><i class="dot<?= $i <= $s['level'] ? ' dot--on' : '' ?>" aria-hidden="true"></i><?php endfor; ?>
      </span>
    </li>
    <?php endforeach; ?>
  </ul>
</section>

<section class="section" data-commit>
  <h2 class="section__title"><span class="section__hash mono" aria-hidden="true">#</span><?= e($ui['timeline_title']) ?></h2>
  <p class="mono mono-dim timeline-cmd" aria-hidden="true">$ git log --oneline --reverse</p>
  <ol class="timeline">
    <?php foreach ($timeline as $item): ?>
    <li class="timeline__item reveal">
      <span class="timeline__node" aria-hidden="true"></span>
      <div class="timeline__head">
        <span class="timeline__date mono"><?= e($item['date']) ?></span>
        <span class="timeline__type mono type--<?= e($item['type']) ?>"><?= e($ui['role_labels'][$item['type']]) ?></span>
      </div>
      <h3 class="timeline__title"><?= e($item['title']) ?></h3>
      <p class="timeline__org mono-dim"><?= e($item['org']) ?></p>
      <p class="timeline__desc"><?= e($item['desc']) ?></p>
    </li>
    <?php endforeach; ?>
  </ol>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
