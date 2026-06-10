// ── Creative Loader ─────────────────────────────────────────────────────────
const siteLoader = document.getElementById('siteLoader');
const loaderCount = document.getElementById('loaderCount');
const loaderBlocks = document.querySelectorAll('#loaderBlocks span');
const loaderStatus = document.getElementById('loaderStatus');
const loaderSessionKey = 'oghuztech_loader_seen';
let shouldShowLoader = true;

try {
    shouldShowLoader = sessionStorage.getItem(loaderSessionKey) !== '1';
    if (shouldShowLoader) sessionStorage.setItem(loaderSessionKey, '1');
} catch {
    shouldShowLoader = true;
}

if (siteLoader && !shouldShowLoader) {
    siteLoader.remove();
}

if (siteLoader && shouldShowLoader) {
    document.body.classList.add('loading');
    let progress = 0;
    let loaderDone = false;
    let stepIndex = 0;
    const steps = [3, 8, 13, 21, 27, 34, 42, 48, 57, 63, 71, 78, 84, 89, 94];

    const updateLoader = () => {
        const activeBlocks = Math.ceil((progress / 100) * loaderBlocks.length);
        loaderBlocks.forEach((block, index) => block.classList.toggle('is-active', index < activeBlocks));
        if (loaderCount) loaderCount.textContent = `${progress}%`;
    };

    updateLoader();
    const loaderTimer = setInterval(() => {
        const target = steps[stepIndex] ?? Math.min(progress + 1, 96);
        progress += Math.max(1, Math.ceil((target - progress) * 0.45));
        if (progress >= target) stepIndex += 1;
        progress = Math.min(progress, 96);
        updateLoader();
    }, 140);

    const finishLoader = () => {
        if (loaderDone) return;
        loaderDone = true;
        clearInterval(loaderTimer);
        const finishTimer = setInterval(() => {
            progress = Math.min(progress + 2, 100);
            updateLoader();
            if (progress >= 100) {
                clearInterval(finishTimer);
                if (loaderStatus?.dataset.loaded) loaderStatus.textContent = loaderStatus.dataset.loaded;
                siteLoader.classList.add('is-complete');
            }
        }, 35);
        setTimeout(() => {
            siteLoader.classList.add('is-hidden');
            document.body.classList.remove('loading');
        }, 2700);
    };

    window.addEventListener('load', () => setTimeout(finishLoader, 450), { once: true });
    setTimeout(finishLoader, 2600);
}

// ── Cursor glow ─────────────────────────────────────────────────────────────
const cursorGlow = document.getElementById('cursorGlow');
if (cursorGlow && window.matchMedia('(pointer:fine)').matches) {
    window.addEventListener('pointermove', (e) => {
        document.body.classList.add('cursor-active');
        cursorGlow.style.transform = `translate3d(${e.clientX - 130}px, ${e.clientY - 130}px, 0)`;
    });
    window.addEventListener('pointerleave', () => document.body.classList.remove('cursor-active'));
}

// ── Particle Canvas ─────────────────────────────────────────────────────────
const canvas = document.getElementById('particleCanvas');
if (canvas) {
    const ctx = canvas.getContext('2d');
    let particles = [];
    function resize() { canvas.width = window.innerWidth; canvas.height = window.innerHeight; }
    resize();
    window.addEventListener('resize', resize);
    class Particle {
        constructor() { this.reset(); }
        reset() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.vx = (Math.random() - 0.5) * 0.3;
            this.vy = (Math.random() - 0.5) * 0.3;
            this.size = Math.random() * 2 + 0.5;
            this.alpha = Math.random() * 0.5 + 0.1;
        }
        update() {
            this.x += this.vx; this.y += this.vy;
            if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) this.reset();
        }
        draw() {
            ctx.save(); ctx.globalAlpha = this.alpha;
            ctx.fillStyle = '#00D4FF';
            ctx.beginPath(); ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill(); ctx.restore();
        }
    }
    for (let i = 0; i < 80; i++) particles.push(new Particle());
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => { p.update(); p.draw(); });
        requestAnimationFrame(animate);
    }
    animate();
}

// ── Scroll reveal ───────────────────────────────────────────────────────────
const revealTargets = document.querySelectorAll('.section-header,.card,.portfolio-card,.blog-card-wrap,.contact-item,.contact-form,.about-section,.hero-badge,.hero-title,.hero-desc,.hero-actions,.hero-stats');
revealTargets.forEach((el, index) => {
    el.classList.add('reveal');
    el.style.transitionDelay = `${Math.min(index % 6, 5) * 70}ms`;
});
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            revealObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.16, rootMargin: '0px 0px -8% 0px' });
revealTargets.forEach(el => revealObserver.observe(el));

// ── Interactive light on cards ──────────────────────────────────────────────
document.querySelectorAll('.card,.blog-card-wrap,.contact-form').forEach((el) => {
    el.addEventListener('pointermove', (e) => {
        const rect = el.getBoundingClientRect();
        el.style.setProperty('--mx', `${e.clientX - rect.left}px`);
        el.style.setProperty('--my', `${e.clientY - rect.top}px`);
    });
});

// ── Navbar scroll ────────────────────────────────────────────────────────────
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    if (navbar) navbar.classList.toggle('scrolled', window.scrollY > 50);
    const st = document.getElementById('scrollTop');
    if (st) st.classList.toggle('show', window.scrollY > 400);
});

// ── Hamburger ────────────────────────────────────────────────────────────────
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');
if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', () => mobileMenu.classList.toggle('open'));
}

// ── Scroll top ───────────────────────────────────────────────────────────────
const scrollTopBtn = document.getElementById('scrollTop');
if (scrollTopBtn) scrollTopBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

// ── Toast ────────────────────────────────────────────────────────────────────
function showToast(msg, type = 'success') {
    const toast = document.getElementById('toast');
    if (!toast) return;
    toast.textContent = msg;
    toast.style.background = type === 'success' ? '#0F172A' : '#1A0A0A';
    toast.style.borderColor = type === 'success' ? 'rgba(34,197,94,.3)' : 'rgba(239,68,68,.3)';
    toast.style.color = type === 'success' ? '#22C55E' : '#EF4444';
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3500);
}
window.showToast = showToast;

// ── Contact Form AJAX ────────────────────────────────────────────────────────
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = contactForm.querySelector('[type="submit"]');
        const orig = btn.innerHTML;
        const sendingText = contactForm.dataset.sending || 'Göndərilir...';
        const errorText = contactForm.dataset.error || 'Xəta baş verdi!';
        btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> ${sendingText}`;
        btn.disabled = true;
        try {
            const res = await fetch(contactForm.action, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                body: new FormData(contactForm)
            });
            const data = await res.json();
            if (data.success) { showToast(data.message); contactForm.reset(); }
            else { showToast(errorText, 'error'); }
        } catch { showToast(errorText, 'error'); }
        finally { btn.innerHTML = orig; btn.disabled = false; }
    });
}

// ── Portfolio filter ─────────────────────────────────────────────────────────
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const cat = btn.dataset.cat;
        document.querySelectorAll('.portfolio-item').forEach(item => {
            item.style.display = (cat === 'all' || item.dataset.cat === cat) ? '' : 'none';
        });
    });
});

// ── Counter animation ─────────────────────────────────────────────────────────
function animateCounter(el) {
    const target = parseInt(el.dataset.target);
    const duration = 2000;
    const step = target / (duration / 16);
    let current = 0;
    const timer = setInterval(() => {
        current += step;
        if (current >= target) { el.textContent = target + (el.dataset.suffix || ''); clearInterval(timer); }
        else { el.textContent = Math.floor(current) + (el.dataset.suffix || ''); }
    }, 16);
}
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => { if (entry.isIntersecting) { animateCounter(entry.target); observer.unobserve(entry.target); } });
}, { threshold: 0.5 });
document.querySelectorAll('.counter').forEach(el => observer.observe(el));

// ── Online count ─────────────────────────────────────────────────────────────
const onlineEl = document.getElementById('onlineCount');
if (onlineEl) {
    setInterval(async () => {
        try {
            const r = await fetch('/api/stats');
            const d = await r.json();
            onlineEl.textContent = d.online;
        } catch {}
    }, 30000);
}
