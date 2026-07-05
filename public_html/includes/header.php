<?php
require_once __DIR__ . '/data.php';

// Sayfalar bu değişkenleri header'dan önce tanımlar:
$pageSlug  = $pageSlug  ?? 'index';
$pageTitle = $pageTitle ?? t($site['name']);
$pageDesc  = $pageDesc  ?? t($site['tagline']);

// Dil değiştirici mevcut sayfayı korur.
$self = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?> · <?= e($site['name']) ?></title>
<meta name="description" content="<?= e($pageDesc) ?>">
<meta name="author" content="<?= e($site['name']) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body data-page="<?= e($pageSlug) ?>">

<a class="skip-link" href="#icerik"><?= $lang === 'tr' ? 'İçeriğe atla' : 'Skip to content' ?></a>

<!-- git izi: sol kenardaki branch çizgisi; düğümleri JS bölümlerden üretir -->
<div class="git-rail" aria-hidden="true"><span class="git-rail__line"></span></div>

<header class="site-header">
  <div class="wrap site-header__in">
    <a class="brand" href="index.php" aria-label="<?= e($site['name']) ?> — <?= $lang === 'tr' ? 'ana sayfa' : 'home' ?>">
      <span class="brand__prompt">ali@yaman</span><span class="brand__path">:~$</span><span class="brand__caret" aria-hidden="true"></span>
    </a>

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
      <span class="nav-toggle__bar" aria-hidden="true"></span>
      <span class="visually-hidden"><?= $lang === 'tr' ? 'Menüyü aç/kapat' : 'Toggle menu' ?></span>
    </button>

    <nav id="site-nav" class="site-nav" aria-label="<?= $lang === 'tr' ? 'Ana menü' : 'Main menu' ?>">
      <ul>
        <?php foreach ($ui['nav'] as $slug => $label): ?>
        <li>
          <a href="<?= $slug ?>.php"<?= $slug === $pageSlug ? ' aria-current="page"' : '' ?>><?= e($label) ?></a>
        </li>
        <?php endforeach; ?>
      </ul>
      <div class="lang-switch" role="group" aria-label="<?= $lang === 'tr' ? 'Dil seçimi' : 'Language' ?>">
        <a href="<?= $self ?>?lang=tr"<?= $lang === 'tr' ? ' aria-current="true"' : '' ?> lang="tr">TR</a><span aria-hidden="true">/</span><a href="<?= $self ?>?lang=en"<?= $lang === 'en' ? ' aria-current="true"' : '' ?> lang="en">EN</a>
      </div>
    </nav>
  </div>
</header>

<main id="icerik" class="wrap">
