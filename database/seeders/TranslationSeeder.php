<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranslationSeeder extends Seeder
{
    public function run(): void
    {
        $az = [
            // Meta
            'meta_title'              => ['Azerbaijani title is below', 'meta'],
            'meta_description'        => ['OghuzTech - Azərbaycanda premium IT həlləri. Proqram inkişafı, bulud, kibertəhlükəsizlik, mobil tətbiqlər.', 'meta'],
            'brand_name'              => ['OghuzTech', 'general'],
            'admin_panel'             => ['Admin Panel', 'nav'],

            // Nav
            'nav_home'                => ['Ana Səhifə', 'nav'],
            'nav_services'            => ['Xidmətlər', 'nav'],
            'nav_portfolio'           => ['Portfolio', 'nav'],
            'nav_blog'                => ['Blog', 'nav'],
            'nav_contact'             => ['Əlaqə', 'nav'],
            'start_project'           => ['Layihə Başlat', 'nav'],
            'language'                => ['Dil', 'nav'],
            'menu'                    => ['Menyu', 'nav'],

            // Loader and social labels
            'loader_label'            => ['Yüklənir', 'general'],
            'loader_loading_content'  => ['LOADING CONTENT', 'general'],
            'loader_loaded'           => ['100% LOADED', 'general'],
            'loader_ready'            => ['READY TO EXPLORE', 'general'],
            'social_facebook'         => ['Facebook', 'footer'],
            'social_linkedin'         => ['LinkedIn', 'footer'],
            'social_instagram'        => ['Instagram', 'footer'],
            'social_twitter'          => ['Twitter', 'footer'],
            'social_github'           => ['GitHub', 'footer'],

            // Footer
            'footer_about'            => ['Azərbaycanda innovativ IT həlləri ilə biznesinizi gələcəyə daşıyırıq. 2016-dan bəri güvənilir texnologiya tərəfdaşınız.', 'footer'],
            'footer_services'         => ['Xidmətlər', 'footer'],
            'footer_company'          => ['Şirkət', 'footer'],
            'footer_contact'          => ['Əlaqə', 'footer'],
            'footer_software'         => ['Proqram Təminatı', 'footer'],
            'footer_cloud'            => ['Bulud Həlləri', 'footer'],
            'footer_security'         => ['Kibertəhlükəsizlik', 'footer'],
            'footer_mobile'           => ['Mobil Tətbiqlər', 'footer'],
            'footer_ai'               => ['AI Həlləri', 'footer'],
            'footer_consulting'       => ['IT Konsaltinq', 'footer'],
            'footer_about_link'       => ['Haqqımızda', 'footer'],
            'footer_address'          => ['Bakı, Azərbaycan', 'footer'],
            'footer_hours'            => ['B.e - Cümə: 09:00-18:00', 'footer'],
            'footer_rights'           => ['Bütün hüquqlar qorunur.', 'footer'],
            'footer_online'           => ['nəfər onlayndır', 'footer'],
            'scroll_top'              => ['Yuxarı qayıt', 'footer'],

            // Home
            'home_badge'              => ['Gələcəyin Texnologiyaları', 'home'],
            'site_tagline'            => ['Biznesiniz üçün müasir və etibarlı texnologiya həlləri.', 'home'],
            'about_text'              => ['OghuzTech şirkəti proqram təminatı, veb sayt, mobil tətbiq və rəqəmsal transformasiya sahələrində bizneslər üçün etibarlı texnologiya tərəfdaşıdır.', 'home'],
            'home_title_1'            => ['Biznesinizi', 'home'],
            'home_title_gradient'     => ['İnnovasiya İlə', 'home'],
            'home_title_2'            => ['Gələcəyə Daşıyırıq', 'home'],
            'home_desc_suffix'        => ['Sürətli, təhlükəsiz və mükəmməl IT həlləri ilə rəqabətdə öndə olun.', 'home'],
            'view_work'               => ['İşlərimizə Bax', 'home'],
            'stats_projects'          => ['Tamamlanmış Layihə', 'home'],
            'stats_clients'           => ['Məmnun Müştəri', 'home'],
            'stats_years'             => ['İllik Təcrübə', 'home'],
            'what_we_do'              => ['Nə Edirik?', 'home'],
            'premium_services_title'  => ['Biznesiniz Üçün <span>Premium</span> IT Xidmətlər', 'home'],
            'premium_services_desc'   => ['Ən müasir texnologiyaları istifadə edərək ehtiyaclarınıza uyğun xüsusi həllər yaradırıq.', 'home'],
            'all_services'            => ['Bütün Xidmətlər', 'home'],
            'about'                   => ['Haqqımızda', 'home'],
            'why_title'               => ['Niyə <span>OghuzTech</span> Seçməlisiniz?', 'home'],
            'about_text_2'            => ['Biz sadəcə kod yazmırıq, biznes problemlərinizi həll edən, böyümənizi təmin edən dəyər yaradırıq.', 'home'],
            'feature_security'        => ['Yüksək Təhlükəsizlik', 'home'],
            'feature_delivery'        => ['Sürətli Təhvil Təslim', 'home'],
            'feature_support'         => ['7/24 Texniki Dəstək', 'home'],
            'feature_design'          => ['Müasir UI/UX Dizayn', 'home'],
            'our_work'                => ['İşlərimiz', 'home'],
            'latest_projects'         => ['Son <span>Layihələrimiz</span>', 'home'],
            'all_projects'            => ['Bütün Layihələr', 'home'],
            'testimonials'            => ['Müştəri Rəyləri', 'home'],
            'testimonials_title'      => ['Bizim Haqqımızda <span>Nə Deyirlər?</span>', 'home'],
            'latest_articles'         => ['Son <span>Məqalələr</span>', 'home'],
            'read_minutes'            => ['dəq oxuma', 'home'],

            // Services
            'services_title'          => ['Xidmətlərimiz', 'services'],
            'services_subtitle'       => ['Biznesinizin rəqəmsal transformasiyası üçün təklif etdiyimiz həllər', 'services'],
            'services_cta_title'      => ['Layihənizi <span>Bizimlə</span> Başlayın', 'services'],
            'services_cta_desc'       => ['Peşəkar komandamız sizin ideyalarınızı reallığa çevirməyə hazırdır.', 'services'],
            'contact_us'              => ['Bizimlə Əlaqə', 'services'],

            // Portfolio
            'portfolio_subtitle'      => ['Son tamamladığımız layihələr və həllər', 'portfolio'],
            'all'                     => ['Hamısı', 'portfolio'],
            'view_project'            => ['Layihəyə Bax', 'portfolio'],

            // Blog
            'blog_subtitle'           => ['IT, texnologiya və biznes haqqında son məqalələr', 'blog'],
            'no_posts'                => ['Hələ heç bir məqalə yoxdur', 'blog'],
            'views'                   => ['baxış', 'blog'],
            'back_to_blog'            => ['Bloga Qayıt', 'blog'],
            'related_articles'        => ['Oxşar <span>Məqalələr</span>', 'blog'],

            // Contact
            'contact_title'           => ['Əlaqə', 'contact'],
            'contact_subtitle'        => ['Layihəniz var? Bizimlə müzakirə edin.', 'contact'],
            'contact_heading'         => ['Gəlin <span>Biznesinizi</span> Birlikdə İnkişaf Etdirək', 'contact'],
            'contact_intro'           => ['İstənilən İT layihəsi, veb sayt, proqram təminatı və ya məsləhət üçün bizə yaza bilərsiniz. Komandamız ən qısa zamanda sizə geri dönüş edəcək.', 'contact'],
            'phone'                   => ['Telefon', 'contact'],
            'email'                   => ['Email', 'contact'],
            'address'                 => ['Ünvan', 'contact'],
            'work_hours'              => ['İş Saatları', 'contact'],
            'work_hours_value'        => ['Bazar ertəsi - Cümə, 09:00 - 18:00', 'contact'],
            'social_networks'         => ['Sosial Şəbəkələr', 'contact'],
            'write_us'                => ['Bizə Yazın', 'contact'],
            'full_name'               => ['Ad Soyad *', 'contact'],
            'full_name_placeholder'   => ['Adınız və soyadınız', 'contact'],
            'email_address'           => ['Email Ünvanı *', 'contact'],
            'email_placeholder'       => ['E-poçt ünvanınız', 'contact'],
            'phone_number'            => ['Telefon Nömrəsi', 'contact'],
            'subject'                 => ['Mövzu', 'contact'],
            'subject_placeholder'     => ['Mesajınızın mövzusu', 'contact'],
            'interested_service'      => ['Maraqlandığınız Xidmət (İstəyə bağlı)', 'contact'],
            'select_service'          => ['Xidmət seçin...', 'contact'],
            'message'                 => ['Mesajınız *', 'contact'],
            'message_placeholder'     => ['Layihəniz və ya sualınız haqqında ətraflı məlumat yazın...', 'contact'],
            'send_message'            => ['Mesajı Göndər', 'contact'],
            'privacy_note'            => ['Göndər düyməsini sıxmaqla gizlilik siyasətimizi qəbul etmiş olursunuz.', 'contact'],
            'sending'                 => ['Göndərilir...', 'contact'],
            'error'                   => ['Xəta baş verdi!', 'contact'],
            'contact_success'         => ['Mesajınız uğurla göndərildi! Qısa zamanda sizinlə əlaqə saxlayacağıq.', 'contact'],
        ];

        // Override meta_title for AZ
        $az['meta_title'] = ['OghuzTech - IT həlləri şirkəti', 'meta'];

        $en = [
            'meta_title'              => ['OghuzTech - IT solutions company', 'meta'],
            'meta_description'        => ['OghuzTech - premium IT solutions in Azerbaijan. Software development, cloud, cybersecurity and mobile applications.', 'meta'],
            'brand_name'              => ['OghuzTech', 'general'],
            'admin_panel'             => ['Admin Panel', 'nav'],
            'nav_home'                => ['Home', 'nav'],
            'nav_services'            => ['Services', 'nav'],
            'nav_portfolio'           => ['Portfolio', 'nav'],
            'nav_blog'                => ['Blog', 'nav'],
            'nav_contact'             => ['Contact', 'nav'],
            'start_project'           => ['Start Project', 'nav'],
            'language'                => ['Language', 'nav'],
            'menu'                    => ['Menu', 'nav'],
            'loader_label'            => ['Loading', 'general'],
            'loader_loading_content'  => ['LOADING CONTENT', 'general'],
            'loader_loaded'           => ['100% LOADED', 'general'],
            'loader_ready'            => ['READY TO EXPLORE', 'general'],
            'social_facebook'         => ['Facebook', 'footer'],
            'social_linkedin'         => ['LinkedIn', 'footer'],
            'social_instagram'        => ['Instagram', 'footer'],
            'social_twitter'          => ['Twitter', 'footer'],
            'social_github'           => ['GitHub', 'footer'],
            'footer_about'            => ['We help businesses move into the future with innovative IT solutions in Azerbaijan. Your trusted technology partner since 2016.', 'footer'],
            'footer_services'         => ['Services', 'footer'],
            'footer_company'          => ['Company', 'footer'],
            'footer_contact'          => ['Contact', 'footer'],
            'footer_software'         => ['Software Development', 'footer'],
            'footer_cloud'            => ['Cloud Solutions', 'footer'],
            'footer_security'         => ['Cybersecurity', 'footer'],
            'footer_mobile'           => ['Mobile Apps', 'footer'],
            'footer_ai'               => ['AI Solutions', 'footer'],
            'footer_consulting'       => ['IT Consulting', 'footer'],
            'footer_about_link'       => ['About Us', 'footer'],
            'footer_address'          => ['Baku, Azerbaijan', 'footer'],
            'footer_hours'            => ['Mon - Fri: 09:00-18:00', 'footer'],
            'footer_rights'           => ['All rights reserved.', 'footer'],
            'footer_online'           => ['people online', 'footer'],
            'scroll_top'              => ['Back to top', 'footer'],
            'home_badge'              => ['Technologies of the Future', 'home'],
            'site_tagline'            => ['Modern and reliable technology solutions for your business.', 'home'],
            'about_text'              => ['OghuzTech is a trusted technology partner for businesses in software development, websites, mobile applications and digital transformation.', 'home'],
            'home_title_1'            => ['We Move Your Business', 'home'],
            'home_title_gradient'     => ['Forward With', 'home'],
            'home_title_2'            => ['Innovation', 'home'],
            'home_desc_suffix'        => ['Stay ahead with fast, secure and polished IT solutions.', 'home'],
            'view_work'               => ['View Our Work', 'home'],
            'stats_projects'          => ['Completed Projects', 'home'],
            'stats_clients'           => ['Happy Clients', 'home'],
            'stats_years'             => ['Years of Experience', 'home'],
            'what_we_do'              => ['What We Do', 'home'],
            'premium_services_title'  => ['<span>Premium</span> IT Services For Your Business', 'home'],
            'premium_services_desc'   => ['We build tailored solutions for your needs using modern technologies.', 'home'],
            'all_services'            => ['All Services', 'home'],
            'about'                   => ['About Us', 'home'],
            'why_title'               => ['Why Choose <span>OghuzTech</span>?', 'home'],
            'about_text_2'            => ['We do not just write code. We create value that solves business problems and supports growth.', 'home'],
            'feature_security'        => ['High Security', 'home'],
            'feature_delivery'        => ['Fast Delivery', 'home'],
            'feature_support'         => ['24/7 Technical Support', 'home'],
            'feature_design'          => ['Modern UI/UX Design', 'home'],
            'our_work'                => ['Our Work', 'home'],
            'latest_projects'         => ['Latest <span>Projects</span>', 'home'],
            'all_projects'            => ['All Projects', 'home'],
            'testimonials'            => ['Client Testimonials', 'home'],
            'testimonials_title'      => ['What <span>Clients Say</span> About Us', 'home'],
            'latest_articles'         => ['Latest <span>Articles</span>', 'home'],
            'read_minutes'            => ['min read', 'home'],
            'services_title'          => ['Our Services', 'services'],
            'services_subtitle'       => ['Solutions we offer for your business digital transformation', 'services'],
            'services_cta_title'      => ['Start Your Project <span>With Us</span>', 'services'],
            'services_cta_desc'       => ['Our professional team is ready to turn your ideas into reality.', 'services'],
            'contact_us'              => ['Contact Us', 'services'],
            'portfolio_subtitle'      => ['Recently completed projects and solutions', 'portfolio'],
            'all'                     => ['All', 'portfolio'],
            'view_project'            => ['View Project', 'portfolio'],
            'blog_subtitle'           => ['Latest articles about IT, technology and business', 'blog'],
            'no_posts'                => ['No articles yet', 'blog'],
            'views'                   => ['views', 'blog'],
            'back_to_blog'            => ['Back to Blog', 'blog'],
            'related_articles'        => ['Related <span>Articles</span>', 'blog'],
            'contact_title'           => ['Contact', 'contact'],
            'contact_subtitle'        => ['Have a project? Discuss it with us.', 'contact'],
            'contact_heading'         => ['Let Us Grow <span>Your Business</span> Together', 'contact'],
            'contact_intro'           => ['You can write to us about any IT project, website, software product or consultation. Our team will get back to you as soon as possible.', 'contact'],
            'phone'                   => ['Phone', 'contact'],
            'email'                   => ['Email', 'contact'],
            'address'                 => ['Address', 'contact'],
            'work_hours'              => ['Working Hours', 'contact'],
            'work_hours_value'        => ['Monday - Friday, 09:00 - 18:00', 'contact'],
            'social_networks'         => ['Social Networks', 'contact'],
            'write_us'                => ['Write to Us', 'contact'],
            'full_name'               => ['Full Name *', 'contact'],
            'full_name_placeholder'   => ['Your full name', 'contact'],
            'email_address'           => ['Email Address *', 'contact'],
            'email_placeholder'       => ['Your email address', 'contact'],
            'phone_number'            => ['Phone Number', 'contact'],
            'subject'                 => ['Subject', 'contact'],
            'subject_placeholder'     => ['Message subject', 'contact'],
            'interested_service'      => ['Service You Are Interested In (Optional)', 'contact'],
            'select_service'          => ['Select service...', 'contact'],
            'message'                 => ['Message *', 'contact'],
            'message_placeholder'     => ['Write details about your project or question...', 'contact'],
            'send_message'            => ['Send Message', 'contact'],
            'privacy_note'            => ['By pressing send, you accept our privacy policy.', 'contact'],
            'sending'                 => ['Sending...', 'contact'],
            'error'                   => ['Something went wrong!', 'contact'],
            'contact_success'         => ['Your message was sent successfully! We will contact you soon.', 'contact'],
        ];

        $rows = [];
        $now  = now();

        foreach ($az as $key => [$value, $group]) {
            $rows[] = [
                'key'        => $key,
                'locale'     => 'az',
                'value'      => $value,
                'group'      => $group,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        foreach ($en as $key => [$value, $group]) {
            $rows[] = [
                'key'        => $key,
                'locale'     => 'en',
                'value'      => $value,
                'group'      => $group,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Insert in chunks, skip duplicates
        foreach (array_chunk($rows, 50) as $chunk) {
            DB::table('translations')->upsert(
                $chunk,
                ['key', 'locale'],
                ['value', 'group', 'updated_at']
            );
        }
    }
}
