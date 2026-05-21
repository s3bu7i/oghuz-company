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
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Göndərilir...';
        btn.disabled = true;
        try {
            const res = await fetch(contactForm.action, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                body: new FormData(contactForm)
            });
            const data = await res.json();
            if (data.success) { showToast(data.message); contactForm.reset(); }
            else { showToast('Xəta baş verdi!', 'error'); }
        } catch { showToast('Xəta baş verdi!', 'error'); }
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
