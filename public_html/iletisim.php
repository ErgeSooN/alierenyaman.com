<?php
$pageSlug = 'iletisim';
require __DIR__ . '/includes/data.php';

// ---------------------------------------------------------------- Form işleme
$formStatus = null; // 'success' | 'error' | 'mail_fail'
$old = ['name' => '', 'email' => '', 'message' => ''];

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    // Honeypot: botlar doldurur, insanlar görmez.
    if (!empty($_POST['website'])) {
        $formStatus = 'success'; // bota başarı göster, maili gönderme
    } else {
        $old['name']    = trim($_POST['name'] ?? '');
        $old['email']   = trim($_POST['email'] ?? '');
        $old['message'] = trim($_POST['message'] ?? '');

        $emailValid = filter_var($old['email'], FILTER_VALIDATE_EMAIL);

        if ($old['name'] === '' || !$emailValid || $old['message'] === '' || mb_strlen($old['message']) > 5000) {
            $formStatus = 'error';
        } else {
            $to      = $site['email'];
            $subject = '=?UTF-8?B?' . base64_encode('[alierenyaman.com] ' . $old['name']) . '?=';
            $body    = "İsim: {$old['name']}\nE-posta: {$old['email']}\n\n{$old['message']}\n";

            require_once __DIR__ . '/includes/mailer.php';
            $smtpConfig = @include __DIR__ . '/includes/smtp-config.php';

            if (is_array($smtpConfig) && smtp_send_mail($smtpConfig, $to, $subject, $body, $emailValid)) {
                $formStatus = 'success';
                $old = ['name' => '', 'email' => '', 'message' => ''];
            } else {
                $formStatus = 'mail_fail';
            }
        }
    }
}

$pageTitle = t($ui['nav']['iletisim']);
require __DIR__ . '/includes/header.php';
?>

<section class="section" data-commit>
    <p class="page-label mono">~/<?= $lang === 'tr' ? 'iletisim' : 'contact' ?> · branch: <span class="page-label__branch">main</span></p>
    <h1 class="page-title"><?= e($ui['nav']['iletisim']) ?></h1>
    <p class="page-lead"><?= e($ui['contact_lead']) ?></p>
</section>

<section class="section split split--contact" data-commit>
    <div>
        <?php if ($formStatus === 'success'): ?>
            <p class="form-note form-note--ok" role="status">✓ <?= e($ui['form_success']) ?></p>
        <?php elseif ($formStatus === 'error'): ?>
            <p class="form-note form-note--err" role="alert">✕ <?= e($ui['form_error']) ?></p>
        <?php elseif ($formStatus === 'mail_fail'): ?>
            <p class="form-note form-note--err" role="alert">✕ <?= e($ui['form_mail_fail']) ?> → <a href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a></p>
        <?php endif; ?>

        <form class="contact-form" method="post" action="iletisim.php" novalidate>
            <!-- Honeypot — insanlar için görünmez -->
            <p class="hp" aria-hidden="true">
                <label for="website">Website</label>
                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </p>

            <p class="field">
                <label for="f-name"><?= e($ui['form_name']) ?></label>
                <input type="text" id="f-name" name="name" required maxlength="120" autocomplete="name" value="<?= htmlspecialchars($old['name'], ENT_QUOTES, 'UTF-8') ?>">
            </p>

            <p class="field">
                <label for="f-email"><?= e($ui['form_email']) ?></label>
                <input type="email" id="f-email" name="email" required maxlength="254" autocomplete="email" value="<?= htmlspecialchars($old['email'], ENT_QUOTES, 'UTF-8') ?>">
            </p>

            <p class="field">
                <label for="f-message"><?= e($ui['form_message']) ?></label>
                <textarea id="f-message" name="message" rows="6" required maxlength="5000"><?= htmlspecialchars($old['message'], ENT_QUOTES, 'UTF-8') ?></textarea>
            </p>

            <button class="btn btn--primary" type="submit" data-magnetic><?= e($ui['form_send']) ?></button>
        </form>
    </div>

    <aside class="contact-aside">
        <h2 class="split__subtitle mono"><?= $lang === 'tr' ? 'Diğer kanallar' : 'Other channels' ?></h2>
        <ul class="contact-links">
            <li><span class="mono mono-dim">github</span><a href="<?= e($site['github']) ?>" target="_blank" rel="me noopener">github.com/ergesoon</a></li>
            <li><span class="mono mono-dim">linkedin</span><a href="<?= e($site['linkedin']) ?>" target="_blank" rel="me noopener">linkedin.com/in/alierenyaman</a></li>
            <li><span class="mono mono-dim">mail</span><a href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a></li>
            <li><span class="mono mono-dim"><?= $lang === 'tr' ? 'konum' : 'location' ?></span><span><?= e($site['location']) ?></span></li>
        </ul>
    </aside>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
