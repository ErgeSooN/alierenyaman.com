</main>

<footer class="site-footer">
  <div class="wrap site-footer__in">
    <p class="site-footer__note mono"><?= e($ui['footer_note']) ?></p>
    <ul class="site-footer__links">
      <li><a href="<?= e($site['github']) ?>" rel="me noopener" target="_blank">GitHub</a></li>
      <li><a href="<?= e($site['linkedin']) ?>" rel="me noopener" target="_blank">LinkedIn</a></li>
      <li><a href="mailto:<?= e($site['email']) ?>"><?= $lang === 'tr' ? 'E-posta' : 'Email' ?></a></li>
    </ul>
    <p class="site-footer__copy mono">© <?= date('Y') ?> <?= e($site['name']) ?> · <span class="mono-dim">git checkout -b <?= $lang === 'tr' ? 'yeni-fikirler' : 'new-ideas' ?></span></p>
  </div>
</footer>

<script src="assets/js/script.js"></script>
</body>
</html>
