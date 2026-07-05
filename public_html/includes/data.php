<?php
/**
 * data.php — Sitenin tüm içeriği tek yerde.
 *
 * Yeni proje eklemek için $projects dizisine, yeni etkinlik için $events
 * dizisine bir eleman ekle — HTML'e dokunmana gerek yok.
 *
 * Çok dilli alanlar ['tr' => '...', 'en' => '...'] biçimindedir;
 * t() aktif dildeki değeri döndürür, e() bunu HTML için kaçırır.
 */

// ---------------------------------------------------------------- Dil
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_GET['lang']) && in_array($_GET['lang'], ['tr', 'en'], true)) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'tr';

/** Çok dilli değeri aktif dile çözer. Düz string ise aynen döner. */
function t($value)
{
    global $lang;
    if (is_array($value)) {
        return $value[$lang] ?? reset($value);
    }
    return $value;
}

/** t() + htmlspecialchars — şablonlarda güvenli çıktı için. */
function e($value)
{
    return htmlspecialchars(t($value), ENT_QUOTES, 'UTF-8');
}

// ---------------------------------------------------------------- Site
$site = [
    'name'     => 'Ali Eren Yaman',
    'handle'   => 'ergesoon',
    'location' => ['tr' => 'Gebze, Türkiye', 'en' => 'Gebze, Turkey'],
    'role'     => [
        'tr' => 'Yazılım Geliştirici — PHP/Laravel · Linux · Altyapı',
        'en' => 'Software Developer — PHP/Laravel · Linux · Infrastructure',
    ],
    'tagline'  => [
        'tr' => '42 Kocaeli\'nin ilk mezunlarından. Kod yazıyorum, sunucu ayağa kaldırıyorum, topluluk büyütüyorum.',
        'en' => 'One of the first graduates of 42 Kocaeli. I write code, run servers, and grow communities.',
    ],
    'email'    => 'ay840253@gmail.com',
    'github'   => 'https://github.com/ergesoon',
    'linkedin' => 'https://www.linkedin.com/in/alierenyaman',
];

// ---------------------------------------------------------------- UI metinleri
$ui = [
    'nav' => [
        'index'       => ['tr' => 'Ana Sayfa',   'en' => 'Home'],
        'hakkimda'    => ['tr' => 'Hakkımda',    'en' => 'About'],
        'projeler'    => ['tr' => 'Projeler',    'en' => 'Projects'],
        'etkinlikler' => ['tr' => 'Etkinlikler', 'en' => 'Events'],
        'iletisim'    => ['tr' => 'İletişim',    'en' => 'Contact'],
    ],
    'hero_cta_projects' => ['tr' => 'Projelerime bak', 'en' => 'See my projects'],
    'hero_cta_contact'  => ['tr' => 'İletişime geç',   'en' => 'Get in touch'],
    'featured_title'    => ['tr' => 'Öne çıkan işler', 'en' => 'Featured work'],
    'all_projects'      => ['tr' => 'Tüm projeler',    'en' => 'All projects'],
    'about_short_title' => ['tr' => 'Kısaca ben',      'en' => 'In short'],
    'skills_title'      => ['tr' => 'Teknolojiler',    'en' => 'Technologies'],
    'timeline_title'    => ['tr' => 'Zaman çizelgesi', 'en' => 'Timeline'],
    'diff_head'         => ['tr' => '@@ -önce → +sonra @@', 'en' => '@@ -before → +after @@'],
    'view_repo'         => ['tr' => 'Kaynak kodu',     'en' => 'Source code'],
    'private_repo'      => ['tr' => 'Özel repo',       'en' => 'Private repo'],
    'form_name'         => ['tr' => 'İsim',            'en' => 'Name'],
    'form_email'        => ['tr' => 'E-posta',         'en' => 'Email'],
    'form_message'      => ['tr' => 'Mesaj',           'en' => 'Message'],
    'form_send'         => ['tr' => 'Gönder',          'en' => 'Send'],
    'form_success'      => [
        'tr' => 'Mesajın ulaştı — en kısa sürede dönüş yapacağım. Teşekkürler!',
        'en' => 'Your message is on its way — I\'ll get back to you soon. Thanks!',
    ],
    'form_error'        => [
        'tr' => 'Bir şeyler ters gitti. Lütfen tüm alanları kontrol edip tekrar dene.',
        'en' => 'Something went wrong. Please check all fields and try again.',
    ],
    'form_mail_fail'    => [
        'tr' => 'Mesaj gönderilemedi. Bana doğrudan e-posta atabilirsin.',
        'en' => 'The message could not be sent. You can email me directly instead.',
    ],
    'contact_lead'      => [
        'tr' => 'Bir proje mi var, bir etkinlik mi, yoksa sadece selam mı? Yaz, okuyorum.',
        'en' => 'A project, an event, or just a hello? Write — I read everything.',
    ],
    'footer_note'       => [
        'tr' => 'Bu site framework\'süz yazıldı: PHP + CSS + vanilla JS.',
        'en' => 'This site was built framework-free: PHP + CSS + vanilla JS.',
    ],
    'role_labels' => [
        'work'      => ['tr' => 'İş',          'en' => 'Work'],
        'edu'       => ['tr' => 'Eğitim',      'en' => 'Education'],
        'volunteer' => ['tr' => 'Gönüllülük',  'en' => 'Volunteering'],
        'intern'    => ['tr' => 'Staj',        'en' => 'Internship'],
    ],
];

// ---------------------------------------------------------------- Yetenekler
// level: 1–5 (nokta olarak gösterilir)
$skills = [
    ['name' => 'Linux',         'level' => 5],
    ['name' => 'C / C++',       'level' => 4],
    ['name' => 'PHP · Laravel', 'level' => 4],
    ['name' => 'Docker',        'level' => 4],
    ['name' => 'Python',        'level' => 3],
    ['name' => 'WordPress',     'level' => 3],
];

// ---------------------------------------------------------------- Projeler
// featured: true olanlar ana sayfada görünür (en fazla 3 önerilir).
// diff: kart hover'ında görünen mini "değişiklik" satırları.
$projects = [
    [
        'title'    => ['tr' => '42 Türkiye Okul Web Sitesi', 'en' => '42 Türkiye Schools Website'],
        'desc'     => [
            'tr' => '42 Türkiye okullarının resmi web sitesi. Bir ekip arkadaşımla birlikte geliştiriyoruz; içerik yönetimi, çok okullu yapı ve performans odaklı ön yüz.',
            'en' => 'The official website of 42 Türkiye schools. Built together with a teammate; content management, multi-campus structure and a performance-focused front end.',
        ],
        'tags'     => ['PHP', 'CSS', 'JavaScript'],
        'repo'     => null,
        'featured' => true,
        'diff'     => [
            'add' => ['tr' => 'çok okullu içerik mimarisi', 'en' => 'multi-campus content architecture'],
            'del' => ['tr' => 'dağınık statik sayfalar',    'en' => 'scattered static pages'],
        ],
    ],
    [
        'title'    => 'Minishell',
        'desc'     => [
            'tr' => 'Sıfırdan yazılmış bash benzeri bir kabuk: parsing, pipe, yönlendirme, ortam değişkenleri ve sinyal yönetimi. C ile, hazır kütüphane olmadan.',
            'en' => 'A bash-like shell written from scratch: parsing, pipes, redirections, environment variables and signal handling. In C, no ready-made libraries.',
        ],
        'tags'     => ['C', 'UNIX', 'Parsing'],
        'repo'     => 'https://github.com/ergesoon/MiniShell',
        'featured' => true,
        'diff'     => [
            'add' => ['tr' => 'pipe & yönlendirme desteği', 'en' => 'pipe & redirection support'],
            'del' => ['tr' => 'system() çağrıları',         'en' => 'system() calls'],
        ],
    ],
    [
        'title'    => 'Inception',
        'desc'     => [
            'tr' => 'Docker ile sıfırdan kurulan servis altyapısı: Nginx, WordPress ve MariaDB\'nin her biri kendi imajında, tamamı docker-compose ile ayağa kalkıyor.',
            'en' => 'A service infrastructure built from scratch with Docker: Nginx, WordPress and MariaDB each in their own image, all orchestrated with docker-compose.',
        ],
        'tags'     => ['Docker', 'Nginx', 'MariaDB'],
        'repo'     => 'https://github.com/ergesoon/Inception',
        'featured' => true,
        'diff'     => [
            'add' => ['tr' => 'izole, tekrarlanabilir ortam', 'en' => 'isolated, reproducible environment'],
            'del' => ['tr' => 'elle sunucu kurulumu',          'en' => 'manual server setup'],
        ],
    ],
    [
        'title'    => 'ft_irc',
        'desc'     => [
            'tr' => 'C++ ile yazılmış, RFC uyumlu bir IRC sunucusu. Non-blocking soketler, kanal ve operatör yönetimi, çoklu istemci desteği.',
            'en' => 'An RFC-compliant IRC server written in C++. Non-blocking sockets, channel and operator management, multi-client support.',
        ],
        'tags'     => ['C++', 'Soket', 'Ağ'],
        'repo'     => 'https://github.com/ergesoon/irc',
        'featured' => false,
        'diff'     => [
            'add' => ['tr' => 'non-blocking çoklu istemci', 'en' => 'non-blocking multi-client'],
            'del' => ['tr' => 'istemci başına thread',      'en' => 'one thread per client'],
        ],
    ],
    [
        'title'    => 'Cub3D',
        'desc'     => [
            'tr' => 'Wolfenstein 3D\'den ilhamla, raycasting tekniğiyle yazılmış bir oyun motoru. Trigonometri, doku kaplama ve harita ayrıştırma — hepsi C ile.',
            'en' => 'A game engine inspired by Wolfenstein 3D, built with raycasting. Trigonometry, texture mapping and map parsing — all in C.',
        ],
        'tags'     => ['C', 'Grafik', 'Raycasting'],
        'repo'     => 'https://github.com/ergesoon/Cub3D',
        'featured' => false,
        'diff'     => [
            'add' => ['tr' => 'gerçek zamanlı raycasting', 'en' => 'real-time raycasting'],
            'del' => ['tr' => 'hazır grafik motoru',        'en' => 'off-the-shelf game engine'],
        ],
    ],
    [
        'title'    => ['tr' => 'Plaka Tespit', 'en' => 'Plate Detection'],
        'desc'     => [
            'tr' => 'Görüntü işleme ile araç plakalarını tespit eden Python projesi. OpenCV tabanlı ön işleme, kontur analizi ve karakter ayrıştırma.',
            'en' => 'A Python project detecting vehicle license plates with image processing. OpenCV-based preprocessing, contour analysis and character segmentation.',
        ],
        'tags'     => ['Python', 'OpenCV', 'Görüntü İşleme'],
        'repo'     => null,
        'featured' => false,
        'diff'     => [
            'add' => ['tr' => 'kontur tabanlı plaka tespiti', 'en' => 'contour-based plate detection'],
            'del' => ['tr' => 'elle etiketleme',               'en' => 'manual labeling'],
        ],
    ],
    [
        'title'    => 'Philosophers',
        'desc'     => [
            'tr' => 'Klasik "yemek yiyen filozoflar" problemi: thread\'ler, mutex\'ler ve ölüm zamanlaması. Race condition ve deadlock ile göğüs göğüse bir eşzamanlılık çalışması.',
            'en' => 'The classic dining philosophers problem: threads, mutexes and death timing. A hand-to-hand study of race conditions and deadlocks.',
        ],
        'tags'     => ['C', 'Thread', 'Senkronizasyon'],
        'repo'     => 'https://github.com/ergesoon/philosophers',
        'featured' => false,
        'diff'     => [
            'add' => ['tr' => 'mutex ile güvenli paylaşım', 'en' => 'mutex-guarded shared state'],
            'del' => ['tr' => 'deadlock riski',              'en' => 'deadlock risk'],
        ],
    ],
];

// ---------------------------------------------------------------- Zaman çizelgesi (Hakkımda)
// type: work | edu | volunteer | intern
$timeline = [
    [
        'type'  => 'work',
        'date'  => ['tr' => 'Eyl 2025 — Halen', 'en' => 'Sep 2025 — Present'],
        'title' => 'Pedago Solutions Developer',
        'org'   => '42 Kocaeli',
        'desc'  => [
            'tr' => 'Pedagoji ekibinin ihtiyaç duyduğu araçları geliştiriyorum; ayrıca bir ekip arkadaşımla 42 Türkiye okullarının web sitesini geliştiriyoruz.',
            'en' => 'I build the tools the pedagogy team needs; I also co-develop the 42 Türkiye schools website with a teammate.',
        ],
    ],
    [
        'type'  => 'volunteer',
        'date'  => ['tr' => '2022 — Halen', 'en' => '2022 — Present'],
        'title' => ['tr' => 'Linux Türkiye Topluluğu — Yönetici', 'en' => 'Linux Türkiye Community — Admin'],
        'org'   => 'Linux Türkiye',
        'desc'  => [
            'tr' => 'Türkiye\'nin en büyük Linux topluluklarından birinin yönetiminde aktif rol alıyorum: moderasyon, içerik ve topluluk etkinlikleri.',
            'en' => 'I take an active role in running one of Turkey\'s largest Linux communities: moderation, content and community events.',
        ],
    ],
    [
        'type'  => 'edu',
        'date'  => '2022 — 2024',
        'title' => ['tr' => '42 Kocaeli — Bilgisayar, Seviye 10', 'en' => '42 Kocaeli — Computer Science, Level 10'],
        'org'   => ['tr' => 'Bilişim Vadisi', 'en' => 'Bilişim Vadisi (IT Valley)'],
        'desc'  => [
            'tr' => 'Proje tabanlı, eğitmensiz eğitim modeliyle C, C++, Docker ve sistem programlama. Okulun ilk mezunlarından biriyim.',
            'en' => 'C, C++, Docker and systems programming through a project-based, teacherless model. I\'m one of the school\'s first graduates.',
        ],
    ],
    [
        'type'  => 'intern',
        'date'  => '2022',
        'title' => ['tr' => 'Türkiye Açık Kaynak Platformu — Staj', 'en' => 'Türkiye Open Source Platform — Internship'],
        'org'   => ['tr' => 'Açık Kaynak Platformu', 'en' => 'Open Source Platform'],
        'desc'  => [
            'tr' => 'Açık kaynak ekosisteminde staj: topluluk projeleri ve açık kaynak geliştirme pratikleri.',
            'en' => 'Internship in the open source ecosystem: community projects and open source development practices.',
        ],
    ],
    [
        'type'  => 'edu',
        'date'  => '2021 — 2023',
        'title' => ['tr' => 'Kocaeli Üniversitesi — Bilgisayar Programcılığı', 'en' => 'Kocaeli University — Computer Programming'],
        'org'   => ['tr' => 'Önlisans · 3.11/4', 'en' => 'Associate degree · 3.11/4'],
        'desc'  => [
            'tr' => 'Programlama temelleri, veritabanı ve web teknolojileri ağırlıklı önlisans eğitimi.',
            'en' => 'Associate degree focused on programming fundamentals, databases and web technologies.',
        ],
    ],
];

// ---------------------------------------------------------------- Etkinlikler
$events = [
    [
        'name' => 'DevFest Kocaeli',
        'date' => '2023 — 2025',
        'role' => ['tr' => 'Organizasyon Ekibi', 'en' => 'Organizing Team'],
        'desc' => [
            'tr' => 'GDG Kocaeli\'nin yıllık geliştirici konferansında üç yıldır organizasyon ekibindeyim: program, konuşmacı koordinasyonu ve saha operasyonu.',
            'en' => 'Three years on the organizing team of GDG Kocaeli\'s annual developer conference: program, speaker coordination and on-site operations.',
        ],
    ],
    [
        'name' => 'Google I/O Extended Kocaeli',
        'date' => '2023 — 2025',
        'role' => ['tr' => 'Organizatör', 'en' => 'Organizer'],
        'desc' => [
            'tr' => 'Google I/O duyurularının yerel geliştirici topluluğuyla buluştuğu etkinliklerin organizasyonu.',
            'en' => 'Organizing the local events where Google I/O announcements meet the developer community.',
        ],
    ],
    [
        'name' => ['tr' => 'Linux Türkiye Topluluk Buluşmaları', 'en' => 'Linux Türkiye Community Meetups'],
        'date' => ['tr' => '2022 — Halen', 'en' => '2022 — Present'],
        'role' => ['tr' => 'Yönetici · Moderatör', 'en' => 'Admin · Moderator'],
        'desc' => [
            'tr' => 'Çevrimiçi ve yüz yüze topluluk buluşmalarının planlanması ve moderasyonu; yeni başlayanlar için Linux oturumları.',
            'en' => 'Planning and moderating online and in-person community meetups; Linux sessions for beginners.',
        ],
    ],
    [
        'name' => ['tr' => '42 Kocaeli Piscine Dönemleri', 'en' => '42 Kocaeli Piscine Periods'],
        'date' => ['tr' => '2023 — Halen', 'en' => '2023 — Present'],
        'role' => ['tr' => 'Mentor · Operasyon', 'en' => 'Mentor · Operations'],
        'desc' => [
            'tr' => 'Okulun yoğun seçme dönemlerinde adaylara mentorluk ve dönemin operasyonel yürütülmesine destek.',
            'en' => 'Mentoring candidates during the school\'s intensive selection periods and supporting the operational side.',
        ],
    ],
    [
        'name' => ['tr' => 'GDG Etkinlikleri', 'en' => 'GDG Events'],
        'date' => ['tr' => '2022 — Halen', 'en' => '2022 — Present'],
        'role' => ['tr' => 'Gönüllü · Organizasyon', 'en' => 'Volunteer · Organizing'],
        'desc' => [
            'tr' => 'Google Developer Group organizasyonlarında 3+ yıldır etkinlik düzenliyorum: atölyeler, konuşma günleri ve topluluk kampları.',
            'en' => 'Organizing events with Google Developer Groups for 3+ years: workshops, talk days and community camps.',
        ],
    ],
];
