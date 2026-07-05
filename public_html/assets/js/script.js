/* ============================================================
   alierenyaman.com — script.js
   Vanilla JS · kütüphane yok · her şey progressive enhancement:
   JS kapalıyken site eksiksiz çalışır, açıkken küçük detaylar eklenir.
   ============================================================ */
(function () {
  "use strict";

  // JS varsa işaretle (CSS'teki .js kuralları ancak o zaman devreye girer)
  document.documentElement.classList.add("js");

  var reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var finePointer = window.matchMedia("(pointer: fine)").matches;

  /* ---------------------------------------------------- Mobil menü */
  var toggle = document.querySelector(".nav-toggle");
  var nav = document.getElementById("site-nav");
  if (toggle && nav) {
    toggle.addEventListener("click", function () {
      var open = nav.classList.toggle("open");
      toggle.setAttribute("aria-expanded", String(open));
    });
    // Escape ile kapat
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && nav.classList.contains("open")) {
        nav.classList.remove("open");
        toggle.setAttribute("aria-expanded", "false");
        toggle.focus();
      }
    });
  }

  /* ---------------------------------------------------- Git izi: commit düğümleri
     Sayfadaki her [data-commit] bölümü için ray üzerine bir düğüm koyar;
     bölüm görünür olunca düğüm "commit'lenir". */
  var rail = document.querySelector(".git-rail");
  var sections = Array.prototype.slice.call(document.querySelectorAll("[data-commit]"));

  if (rail && sections.length && "IntersectionObserver" in window) {
    var nodes = sections.map(function () {
      var n = document.createElement("span");
      n.className = "git-node";
      rail.appendChild(n);
      return n;
    });

    var placeNodes = function () {
      sections.forEach(function (sec, i) {
        var top = sec.getBoundingClientRect().top + window.scrollY;
        nodes[i].style.top = top + 40 + "px";
      });
    };
    placeNodes();
    window.addEventListener("resize", placeNodes);

    var commitObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var i = sections.indexOf(entry.target);
          if (i > -1) nodes[i].classList.add("git-node--done");
        }
      });
    }, { threshold: 0.25 });

    sections.forEach(function (sec) { commitObserver.observe(sec); });
  }

  /* ---------------------------------------------------- Scroll ile belirme */
  var revealEls = document.querySelectorAll(".reveal");
  if (revealEls.length && "IntersectionObserver" in window && !reducedMotion) {
    var revealObserver = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-visible");
          obs.unobserve(entry.target); // bir kez yeter — gereksiz iş yok
        }
      });
    }, { threshold: 0.15 });

    revealEls.forEach(function (el, i) {
      el.style.setProperty("--d", (i % 3) * 0.08 + "s"); // kart sıralarında hafif kademe
      revealObserver.observe(el);
    });
  } else {
    revealEls.forEach(function (el) { el.classList.add("is-visible"); });
  }

  /* ---------------------------------------------------- Skill etiketleri: "derleniyor" */
  var compileLists = document.querySelectorAll("[data-compile]");
  if (compileLists.length && "IntersectionObserver" in window && !reducedMotion) {
    var compileObserver = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var items = entry.target.querySelectorAll(".skill");
        items.forEach(function (item, i) {
          item.style.setProperty("--d", i * 0.09 + "s");
        });
        entry.target.classList.add("compile-run");
        obs.unobserve(entry.target);
      });
    }, { threshold: 0.3 });

    compileLists.forEach(function (list) { compileObserver.observe(list); });
  } else {
    compileLists.forEach(function (list) { list.classList.add("compile-run"); });
  }

  /* ---------------------------------------------------- Magnetic butonlar
     Yalnızca hassas imleçte ve hareket azaltma kapalıyken. */
  if (finePointer && !reducedMotion) {
    document.querySelectorAll("[data-magnetic]").forEach(function (btn) {
      var strength = 0.25;
      btn.addEventListener("mousemove", function (e) {
        var r = btn.getBoundingClientRect();
        var x = (e.clientX - r.left - r.width / 2) * strength;
        var y = (e.clientY - r.top - r.height / 2) * strength;
        btn.style.transform = "translate(" + x.toFixed(1) + "px," + y.toFixed(1) + "px)";
      });
      btn.addEventListener("mouseleave", function () {
        btn.style.transform = "";
      });
    });
  }

  /* ---------------------------------------------------- Klavye kısayolları (git aliasları)
     g p → projeler · g h → hakkımda · g e → etkinlikler · g i → iletişim · g g → ana sayfa */
  var shortcuts = {
    p: "projeler.php",
    h: "hakkimda.php",
    e: "etkinlikler.php",
    i: "iletisim.php",
    g: "index.php"
  };
  var pendingG = false;
  var pendingTimer = null;

  document.addEventListener("keydown", function (e) {
    // Form alanlarında veya modifier'la basılınca karışma
    var tag = (e.target.tagName || "").toLowerCase();
    if (tag === "input" || tag === "textarea" || tag === "select" || e.metaKey || e.ctrlKey || e.altKey) return;

    if (pendingG && shortcuts[e.key]) {
      window.location.href = shortcuts[e.key];
      pendingG = false;
      return;
    }
    pendingG = e.key === "g";
    clearTimeout(pendingTimer);
    if (pendingG) pendingTimer = setTimeout(function () { pendingG = false; }, 1200);
  });

  /* ---------------------------------------------------- Konsol: kaynağa bakanlara selam */
  var mono = "font-family:monospace";
  console.log("%c$ git log --oneline", mono + ";color:#94A3B8");
  console.log(
    "%c7c8cf8%c site yayında — framework yok, sadece PHP + CSS + vanilla JS\n" +
    "%c4adeb8%c mikro-etkileşimler eklendi (bu konsol mesajı dahil)\n" +
    "%ce9b4f8%c ipucu: 'g' sonra 'p' → projeler sayfası\n" +
    "%c0e1116%c merhaba, kaynağa bakan geliştirici 👋 — birlikte bir şeyler yapalım mı? https://github.com/ergesoon",
    mono + ";color:#7C8CF8", mono + ";color:#EDF2FA",
    mono + ";color:#4ADEB8", mono + ";color:#EDF2FA",
    mono + ";color:#E8B4F8", mono + ";color:#EDF2FA",
    mono + ";color:#94A3B8", mono + ";color:#EDF2FA"
  );
})();
