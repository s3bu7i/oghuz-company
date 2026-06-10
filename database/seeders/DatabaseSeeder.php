<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Post;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Settings ──────────────────────────────────────────────────────────
        $settings = [
            ['key'=>'site_name',       'value'=>'OghuzTech',                          'group'=>'general'],
            ['key'=>'site_tagline',    'value'=>'İnnovasiya ilə Gələcəyi İnşa Edirik','group'=>'general'],
            ['key'=>'site_email',      'value'=>'sabuhi.gasimzada@gmail.com',          'group'=>'contact'],
            ['key'=>'site_phone',      'value'=>'+994 50 881 66 13',                   'group'=>'contact'],
            ['key'=>'site_address',    'value'=>'Bakı, Azərbaycan',                   'group'=>'contact'],
            ['key'=>'facebook',        'value'=>'https://facebook.com/oghuztech',      'group'=>'social'],
            ['key'=>'linkedin',        'value'=>'https://linkedin.com/company/oghuztech','group'=>'social'],
            ['key'=>'instagram',       'value'=>'https://instagram.com/oghuztech',     'group'=>'social'],
            ['key'=>'twitter',         'value'=>'https://twitter.com/oghuztech',       'group'=>'social'],
            ['key'=>'about_text',      'value'=>'OghuzTech 2016-cı ildən bəri Azərbaycanda IT həlləri sahəsində fəaliyyət göstərir. Müştərilərimizə ən müasir texnoloji həllər təklif edirik.', 'group'=>'about'],
        ];
        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }

        // ── Services ──────────────────────────────────────────────────────────
        $services = [
            ['title'=>'Proqram Təminatı İşlənməsi',   'icon'=>'fas fa-code',           'color'=>'#00D4FF', 'short_description'=>'Biznesiniz üçün xüsusi proqram həlləri hazırlayırıq. Masaüstü, veb və mobil tətbiqlər.'],
            ['title'=>'Bulud Həlləri',                 'icon'=>'fas fa-cloud',          'color'=>'#7C3AED', 'short_description'=>'AWS, Azure və Google Cloud platformaları üzərindən skalabel bulud infrastruktur həlləri.'],
            ['title'=>'Kibertəhlükəsizlik',            'icon'=>'fas fa-shield-alt',     'color'=>'#10B981', 'short_description'=>'Sistemlərinizi kiberhücumlardan qoruyuruq. Penetrasiya testləri, audit və monitoring.'],
            ['title'=>'Mobil Tətbiq İnkişafı',        'icon'=>'fas fa-mobile-alt',     'color'=>'#F59E0B', 'short_description'=>'iOS və Android platformaları üçün sürətli, istifadəçi dostu mobil tətbiqlər.'],
            ['title'=>'Veb Sayt & Dizayn',            'icon'=>'fas fa-globe',          'color'=>'#EF4444', 'short_description'=>'Müasir, sürətli və SEO optimallaşdırılmış veb saytlar. UI/UX dizayn xidmətləri.'],
            ['title'=>'Süni İntellekt Həlləri',       'icon'=>'fas fa-robot',          'color'=>'#8B5CF6', 'short_description'=>'Machine learning, data analitika və AI əsaslı biznes həlləri. Avtomatlaşdırma.'],
            ['title'=>'Verilənlər Bazası',            'icon'=>'fas fa-database',       'color'=>'#06B6D4', 'short_description'=>'Verilənlər bazasının dizaynı, optimallaşdırılması, replikasiya və performans artımı.'],
            ['title'=>'IT Konsaltinq & Dəstək',       'icon'=>'fas fa-headset',        'color'=>'#84CC16', 'short_description'=>'7/24 texniki dəstək, IT strategiyası, infrastruktur planlaması və audit xidmətləri.'],
            ['title'=>'Məlumat Analitikası',           'icon'=>'fas fa-chart-line',     'color'=>'#F97316', 'short_description'=>'Biznes verilerinizi analiz edərək dəyərli anlayışlar əldə etmənizə kömək edirik.'],
            ['title'=>'API İnteqrasiya Xidmətləri',   'icon'=>'fas fa-plug',           'color'=>'#EC4899', 'short_description'=>'Üçüncü tərəf sistemlər, ödəniş şlüzləri və platformalar arasında inteqrasiya.'],
        ];
        foreach ($services as $i => $s) {
            Service::updateOrCreate(['title' => $s['title']], array_merge($s, [
                'slug' => \Illuminate\Support\Str::slug($s['title']),
                'description' => $s['short_description'] . ' Peşəkar komandamız sizin layihənizi başdan sona idarə edir.',
                'order' => $i + 1,
                'is_active' => true,
                'is_featured' => $i < 6,
            ]));
        }

        // ── Portfolio ─────────────────────────────────────────────────────────
        $portfolios = [
            ['title'=>'BankEasy Mobile App','category'=>'Mobil Tətbiq','client'=>'BankEasy MMC','technologies'=>'Flutter, Laravel, MySQL','description'=>'Azərbaycanın aparıcı bankı üçün tam funksionallıqlı mobil bank tətbiqi. 100.000+ istifadəçi.','is_featured'=>true],
            ['title'=>'EduPlatform LMS',    'category'=>'Veb Tətbiq',  'client'=>'EduAZ',       'technologies'=>'Next.js, Node.js, PostgreSQL','description'=>'Azərbaycan üçün onlayn təhsil platforması. Video dərslər, imtahanlar, sertifikatlar.','is_featured'=>true],
            ['title'=>'LogiTrack Sistemi',  'category'=>'Proqram Təminatı','client'=>'Logistic Pro','technologies'=>'Laravel, Vue.js, Redis','description'=>'Real-time yük izləmə sistemi. GPS inteqrasiyası, avtomatik hesabatlar.','is_featured'=>true],
            ['title'=>'HealthCare Portal',  'category'=>'Veb Sayt',    'client'=>'MedCenter',   'technologies'=>'React, Django, PostgreSQL','description'=>'Tibb mərkəzi üçün online xəstə idarəetmə sistemi. Randevu, nəticələr, resept.','is_featured'=>true],
            ['title'=>'SmartRetail POS',    'category'=>'Proqram Təminatı','client'=>'RetailChain','technologies'=>'Electron.js, SQLite, Node.js','description'=>'Pərakəndə satış şəbəkəsi üçün offline POS sistemi. 50+ mağaza.','is_featured'=>true],
            ['title'=>'GreenEnergy Dashboard','category'=>'Veb Tətbiq','client'=>'GreenTech',   'technologies'=>'Angular, Laravel, InfluxDB','description'=>'Solar panel idarəetmə dashboardu. Real-time enerji monitorinqi.','is_featured'=>true],
        ];
        foreach ($portfolios as $i => $p) {
            Portfolio::updateOrCreate(['title' => $p['title']], array_merge($p, [
                'slug' => \Illuminate\Support\Str::slug($p['title']),
                'order' => $i + 1,
                'is_active' => true,
                'completed_at' => now()->subMonths(rand(1,12)),
            ]));
        }

        // ── Testimonials ──────────────────────────────────────────────────────
        $testimonials = [
            ['name'=>'Elnur Həsənov',  'position'=>'CEO',            'company'=>'BankEasy MMC',   'rating'=>5, 'content'=>'OghuzTech komandası ilə işləmək olduqca peşəkar bir təcrübə idi. Mobil bank tətbiqimizi 6 ayda tamamladılar. Əla dəstək!'],
            ['name'=>'Aynur Quliyeva', 'position'=>'CTO',            'company'=>'EduAZ Platform', 'rating'=>5, 'content'=>'Texniki biliklər, vaxtında çatdırılma və mükəmməl UX dizayn. OghuzTech-i hər kəsə tövsiyə edirəm!'],
            ['name'=>'Rauf Babayev',   'position'=>'Direktor',       'company'=>'Logistic Pro',   'rating'=>5, 'content'=>'Real-time izləmə sistemimiz iş proseslərimizi kökündən dəyişdirdi. Heyranlıq doğuran nəticə!'],
            ['name'=>'Leyla Əliyeva',  'position'=>'Marketinq rəhbəri','company'=>'RetailChain',  'rating'=>5, 'content'=>'Sayt dizaynımız müştərilərimizi heyran edir. OghuzTech həqiqətən 5 ulduzlu xidmət göstərir.'],
            ['name'=>'Tural Məmmədov', 'position'=>'Baş həkim',      'company'=>'MedCenter',      'rating'=>5, 'content'=>'Xəstə idarəetmə sistemimiz dəyişdirildi, gündəlik işimiz asanlaşdı. Çox razıyam!'],
        ];
        foreach ($testimonials as $i => $t) {
            Testimonial::updateOrCreate(['name' => $t['name']], array_merge($t, [
                'is_active' => true,
                'order' => $i + 1,
            ]));
        }

        // ── Blog Posts ────────────────────────────────────────────────────────
        $posts = [
            ['title'=>'2024-cü ildə Süni İntellektin Biznesə Təsiri','category'=>'AI & Tech','excerpt'=>'AI texnologiyaları müasir bizneslərə necə inqilab edir? Azərbaycanda AI trendlərini araşdırırıq.','content'=>'<p>Süni intellekt (AI) artıq daha yalnız böyük texnologiya şirkətlərinin imtiyazı deyil. 2024-cü ildə kiçik və orta bizneslər də AI həllərindən aktiv istifadə edir.</p><h2>AI-nin Əsas Sahələri</h2><p>Müştəri xidməti, məlumat analizi, marketinq avtomatlaşdırması və proqnozlaşdırma — bunlar AI-nin güclü olduğu sahələrdir.</p><p>OghuzTech olaraq biznesləriniz üçün xüsusi AI həlləri hazırlayır, rəqabət üstünlüyü qazanmağınıza kömək edirik.</p>'],
            ['title'=>'Kibertəhlükəsizlik: 2024 Trendləri','category'=>'Kibertəhlükəsizlik','excerpt'=>'Hər gün yeni kibertəhlükələr yaranır. Şirkətinizi qorumaq üçün nə bilmək lazımdır?','content'=>'<p>Kiberhücumların sayı hər il artmaqdadır. Azərbaycanda şirkətlər bu təhlükəyə nə dərəcədə hazırdır?</p><h2>Əsas Kibertəhlükəsizlik Trendləri</h2><p>Zero-trust arxitekturası, AI dəstəkli monitorinq, bulud təhlükəsizliyi — bu trendlər 2024-cü ilin ən vacib mövzularıdır.</p>'],
            ['title'=>'Laravel vs Node.js: Hansını Seçmək Lazımdır?','category'=>'Proqramlaşdırma','excerpt'=>'Backend inkişaf üçün iki populyar texnologiyanı müqayisə edirik. Hansı layihəniz üçün daha uyğundur?','content'=>'<p>Veb tətbiqlərin backend hissəsi üçün texnologiya seçimi kritik qərardır. Laravel (PHP) və Node.js hər biri öz üstünlükləri ilə gəlir.</p><h2>Laravel Üstünlükləri</h2><p>Sürətli inkişaf, zengin ekosistem, tam-stack framework, MVC arxitekturası.</p><h2>Node.js Üstünlükləri</h2><p>Real-time tətbiqlər, yüksək performans, JavaScript birliyi, microservices.</p>'],
        ];
        foreach ($posts as $p) {
            Post::updateOrCreate(['title' => $p['title']], array_merge($p, [
                'slug' => \Illuminate\Support\Str::slug($p['title']),
                'author' => 'OghuzTech',
                'is_published' => true,
                'is_featured' => true,
                'views' => rand(50, 500),
            ]));
        }

        $this->call(TranslationSeeder::class);
    }
}
