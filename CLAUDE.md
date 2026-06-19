Prompt: Car Dealership Ecosystem (Laravel 11, Livewire 3, Filament v3)
Role: Senior Full-stack Developer / System Architect.
Task: Build a high-performance car dealership website "Haval Volgograd" using the latest stable versions of the PHP ecosystem.
🛠 Tech Stack (Strictly latest):
Framework: Laravel 11 (using new application structure)
Frontend: Livewire 3 (SPA-like navigation with wire:navigate)
Admin Panel: Filament v3
Database: MySQL/PostgreSQL
Styling: Tailwind CSS (Integration with the attached HTML/CSS layout)
📂 Layout Integration:
IMPORTANT: I have attached a file with the frontend layout. You must:
Decompose this HTML into reusable Blade Components (resources/views/components).
Use the layout's CSS/JS assets within the Laravel Vite pipeline.
Convert static sections into dynamic Livewire Components.
🏗 1. Database & Models Schema:
Generate migrations and models with proper relationships for:
CarModels: brand, name, slug, category (SUV, sedan, etc.), price_from, specs (jsonb), is_active, is_popular.
CarGallery: Images/Videos for 360 view and sliders (use Spatie Media Library or Filament's native storage).
Trims/Equipments: Specific versions of a model with price and features.
Leads: Name, phone, email, type (test-drive, callback, credit, trade-in), status, car_id link.
Services & Parts: Catalog of services and parts (VIN search capability).
Promotions: Linked to models, with countdown timers and banners.
Content: Blog posts, Team members, Reviews (with ratings), Certificates.
⚡ 2. Frontend Features (Livewire 3):
Implement the following logic based on the attached layout:
Dynamic Catalog: Real-time filtering by price, body type, and drive (without page reload).
Interactive Car Page:
Gallery slider.
Dynamic Loan Calculator (Livewire property binding for down_payment, term, rate).
Trade-in valuation form.
Booking System: "Test-drive" form with date/time picker and validation.
Personal Account: User dashboard to track service history and "favorite" models using wire:model.
🖥 3. Admin Panel (Filament v3):
Create a robust backend:
Resources: Manage Cars, Leads, Services, and Content.
Dashboard: Custom widgets showing "New Leads Today", "Total Sales", and "Popular Models" (charts).
Forms: Use Filament\Forms\Components\Repeater for technical specs and FileUpload for galleries.
Notifications: Send real-time database/mail notifications to admins when a new lead is submitted.
🛠 4. Business Logic Requirements:
SEO: Implement a Spatie/Laravel-Sitemap and dynamic Meta tags for each model.
Calculators:
Credit: Monthly payment formula: [P * I * (1 + I)^N] / [(1 + I)^N – 1].
Maintenance (TO): Logic to calculate price based on car model and current mileage.
Forms: All lead forms must have Honeypot protection and Rate Limiting.
🚀 Execution Steps:
Step 1: Analyze the attached layout and propose a file structure for Blade components.
Step 2: Provide Laravel 11 Migrations and Models for the entire ecosystem.
Step 3: Generate the Filament v3 Resource for "Car Models" (the most complex part).
Step 4: Create the Livewire 3 component for the "Car Catalog" with filtering.
Step 5: Implement the "Loan Calculator" component.
Please start by confirming you have analyzed the attached layout and provide the database schema first.

<!DOCTYPE html>

<html class="light" lang="ru"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Haval - Управляй своей мечтой</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary": "#5d5f5f",
                        "on-background": "#1a1c1d",
                        "on-primary": "#ffffff",
                        "error-container": "#ffdad6",
                        "primary-container": "#1c1b1b",
                        "tertiary": "#000000",
                        "on-surface-variant": "#444748",
                        "on-secondary-fixed-variant": "#454747",
                        "on-surface": "#1a1c1d",
                        "secondary-container": "#dfe0e0",
                        "primary": "#000000",
                        "on-tertiary-fixed-variant": "#46464e",
                        "primary-fixed": "#e5e2e1",
                        "outline-variant": "#c4c7c7",
                        "on-secondary-container": "#616363",
                        "on-tertiary-fixed": "#1a1b22",
                        "surface-container-low": "#f3f3f4",
                        "surface-container-highest": "#e2e2e3",
                        "on-secondary": "#ffffff",
                        "on-primary-fixed": "#1c1b1b",
                        "inverse-surface": "#2f3132",
                        "tertiary-fixed": "#e3e1ec",
                        "inverse-on-surface": "#f0f1f2",
                        "outline": "#747878",
                        "on-primary-fixed-variant": "#474646",
                        "surface-dim": "#dadadb",
                        "secondary-fixed": "#e2e2e2",
                        "on-secondary-fixed": "#1a1c1c",
                        "inverse-primary": "#c8c6c5",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed-dim": "#c8c6c5",
                        "on-primary-container": "#858383",
                        "secondary-fixed-dim": "#c6c6c7",
                        "on-error-container": "#93000a",
                        "tertiary-container": "#1a1b22",
                        "surface": "#f9f9fa",
                        "tertiary-fixed-dim": "#c6c5cf",
                        "surface-container-high": "#e8e8e9",
                        "surface-bright": "#f9f9fa",
                        "surface-variant": "#e2e2e3",
                        "surface-container": "#eeeeef",
                        "on-tertiary-container": "#83838c",
                        "on-error": "#ffffff",
                        "error": "#ba1a1a",
                        "on-tertiary": "#ffffff",
                        "surface-tint": "#5f5e5e",
                        "background": "#f9f9fa"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "stack-md": "16px",
                        "stack-lg": "32px",
                        "gutter": "24px",
                        "margin-tablet": "40px",
                        "margin-desktop": "80px",
                        "container-max": "1280px",
                        "margin-mobile": "20px",
                        "section-gap": "120px",
                        "stack-sm": "8px"
                    },
                    "fontFamily": {
                        "label-xs": ["Inter"],
                        "label-sm": ["Inter"],
                        "headline-md": ["Inter"],
                        "display-lg": ["Inter"],
                        "body-lg": ["Inter"],
                        "headline-lg": ["Inter"],
                        "display-lg-mobile": ["Inter"],
                        "body-md": ["Inter"]
                    },
                    "fontSize": {
                        "label-xs": ["12px", { "lineHeight": "1.0", "fontWeight": "600" }],
                        "label-sm": ["14px", { "lineHeight": "1.2", "letterSpacing": "0.01em", "fontWeight": "500" }],
                        "headline-md": ["24px", { "lineHeight": "1.4", "fontWeight": "600" }],
                        "display-lg": ["64px", { "lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "headline-lg": ["32px", { "lineHeight": "1.3", "fontWeight": "600" }],
                        "display-lg-mobile": ["40px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-md": ["16px", { "lineHeight": "1.6", "fontWeight": "400" }]
                    }
                }
            }
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined[data-weight="fill"] {
            font-variation-settings: 'FILL' 1;
        }
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-background text-on-background font-body-md antialiased selection:bg-primary selection:text-on-primary">
<!-- Navigation -->
<nav class="bg-surface/80 dark:bg-surface/80 backdrop-blur-md docked full-width top-0 border-b border-outline-variant dark:border-outline flat no shadows fixed top-0 left-0 w-full z-50 flex justify-between items-center px-margin-mobile md:px-margin-desktop py-4 mx-auto">
<a class="text-headline-md font-headline-md font-bold text-primary dark:text-on-primary tracking-tight" href="#">Haval</a>
<div class="hidden lg:flex items-center gap-6">
<a class="font-label-sm text-label-sm text-primary dark:text-on-primary border-b-2 border-primary dark:border-on-primary pb-1 opacity-80 scale-95 transition-all" href="#">Главная</a>
<a class="font-label-sm text-label-sm text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-on-primary transition-colors duration-300" href="#">О нас</a>
<a class="font-label-sm text-label-sm text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-on-primary transition-colors duration-300" href="#">Автопарк</a>
<a class="font-label-sm text-label-sm text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-on-primary transition-colors duration-300 flex items-center gap-1" href="#">Бренды <span class="material-symbols-outlined text-[16px]" data-icon="expand_more">expand_more</span></a>
<a class="font-label-sm text-label-sm text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-on-primary transition-colors duration-300" href="#">Услуги</a>
<a class="font-label-sm text-label-sm text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-on-primary transition-colors duration-300" href="#">Лизинг</a>
</div>
<div class="hidden lg:flex items-center gap-4">
<button class="p-2 text-primary hover:bg-surface-container rounded-full transition-colors">
<span class="material-symbols-outlined" data-icon="search">search</span>
</button>
<a class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-sm text-label-sm hover:bg-primary/90 transition-colors" href="#">Связаться с нами</a>
</div>
<button class="lg:hidden p-2 text-primary">
<span class="material-symbols-outlined" data-icon="menu">menu</span>
</button>
</nav>
<main class="pt-[80px]">
<!-- Hero Section -->
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap flex flex-col items-center text-center">
<h1 class="font-display-lg-mobile text-display-lg-mobile md:font-display-lg md:text-display-lg text-primary max-w-[800px] mb-stack-lg leading-tight">
            Управляй своей мечтой, в любое время, в любом месте
        </h1>
<p class="font-body-lg text-body-lg text-secondary max-w-[600px] mb-stack-lg">
            Haval предлагает тщательно отобранные автомобили премиум-класса, быстрое бронирование и безупречную доставку для незабываемой поездки
        </p>
<div class="flex flex-col sm:flex-row gap-4 mb-section-gap">
<a class="bg-primary text-on-primary px-8 py-4 rounded-full font-label-sm text-label-sm hover:bg-primary/90 transition-colors shadow-sm" href="#">
                Забронировать поездку
            </a>
<a class="bg-surface text-primary border border-outline-variant px-8 py-4 rounded-full font-label-sm text-label-sm hover:bg-surface-container-low transition-colors" href="#">
                Смотреть автопарк
            </a>
</div>
<div class="w-full max-w-[1000px] relative mt-[-60px] md:mt-[-80px] z-[-1]">
<img alt="Luxury Car" class="w-full h-auto object-contain drop-shadow-2xl opacity-90 hover:opacity-100 transition-opacity duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDVcWRs8ZLMNwuYZnd7cinK9OPJdIlvFVkv3Ow1aAw601n4HB3d5PP0_eWdtXWd-BUtvDpgWhaYKdFRU3AHei1kEd_7zuGs_Yf47fktasaL0iCabbQXkpilhltcVsZ-StSyJwNgeBZCsb7F6BoejaPhaqQxLbdTH-nEbkGjasE96POPr80hx_Foc0cRQDCWYU7-toC7jwaXBQUG2ho2_5qDpXqdk7FxrEnf2kc-JOBdDM1ZxZLfNMvpNEtV4SNSvV-EY2SBe93LaQo"/>
</div>
</section>
<!-- Brands Logo Strip -->
<section class="border-y border-outline-variant py-stack-lg bg-surface-container-lowest">
<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-wrap justify-center md:justify-between items-center gap-8 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
<img alt="AMG" class="h-6 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA9NBCByYgwlYlnTa0wJxP_wWx2m5w8a6bk0f2GXbM_-mIC63oEjYWPoa4_2T-Dkb3YRFtveSU0pcvteUvQtoFESnPTazi3QboQAFp26mkEZg47lIt64rWto2xxnHkG4qXbwcEMyjJbl7klbLHTN9FrUZyzB-io45oP8vsD732eUu6wHX_3_FZbijDPrbUx2glnhSOasQKX5spxAru78q1dIC9llQ-ihTAqrdj5IjICMgH2GQqY-2CRiom6TgtercKOYL2J58saQZk"/>
<img alt="BMW" class="h-8 md:h-12 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBdWSuTY09NvsRSjB4HonZSaAbGaqLXphKfTXSLiBq22V8ygcKnuExREvtJtesyyOaUDO63suROAibo6XEjMIxXwXPcJIMwJjOddiWlYNjYS1sIwQzM4KDxKgXaccGt-vzOL3q1FN_f9IXmGIepkzBHAoIwyjaZI-4355j5ILBVe90mp03x04KIaxxI-ZLFbkevYN7eHlUyI15nHaLbmNk7OI_2CrfOubrKxSmEeWBYiGmIIX3DFOxjl01-te8nJBiTr-g1T6n3PtM"/>
<img alt="Cadillac" class="h-8 md:h-12 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuARfUwA_gdyK5eKY4_z6BHAMz8c67UDDjx6imcvChXhqpSR1PU2OIYUCsyIE7GXFe7-KdRezmvvtQwrgSdJAlbur_Dd_waGKU7zUTykOGMyEV_ag0OGUrV06-iqRTyn0J-PiMeXOdw5uiQjCGBgu2npUhjTzD40Qd3IFf-ThrcKrkwP_pBDS7MExGS6ItJ0G_obftRruIxWHtJuVLDTqIFR252U40P22TX0vUyTsB4mwHxn1zCJRXClFZtVmT4twB5Dxpu217UmAaU"/>
<img alt="GMC" class="h-6 md:h-8 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAKDxV4_DMQAvB_5uBLK7JjXOhudZ4pAxfmv1QOZxAa3eIvaKyFu-s5y22VrFWEZ0pQ9DZ3V6HfcDZohmX1etUzs_BK49nLUrZYhWQKOue4F8wwQqeColqTg4fv6l10ltTildr3B_1oDPfd8Lqh4Wnl6TfoMT25eZWVpXundLY9rKlKQby9ubTffUG15-r3h0jZhd66qTauxoDKBncgmp0mJcOWG5B6szWoZRydCDyl2uHCtqNoo7M6X8ELtFhYD9a_EaQ2z-Tjimw"/>
<img alt="Mercedes-Benz" class="h-8 md:h-12 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDd7k0Zn0jw-UypdwM--X1lC4AjwMvJjgRwbnH3fYsiY4E9I0uMtvpE_aClY534fF37P0HFU9-nVF4iaqiQxX-zZiVFyn2VjXnlFXtmceyxsdtGPlzv34oM3P-hlaO30_obAgt8Ye6nfsyl9cLAxKc2fKNmtbI-EzNx3q26YvV6EPYagKaTnmaalcvj5RtizxL6EglasBVKKxWlaWC3XZ9_ROy40ii8wjpjdR_8NZb44LgIKLLfkbqPuqu02URZgmvXM0Li9IzL9Ss"/>
<img alt="Nissan" class="h-8 md:h-12 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBrQDdqFp6cm5q5g4HvKr0Q5jm_IaIpCeKAXru6mQ6QJByNCZ_gEWWOtWzrtkIHAaLpsmkdmvTopk1dg5M4A04vXP6c1_xaAEiV83kebz9rcU3hhlH_FJFrEE7q4Wo-RqHjqluABTuT6aFyGORCr-6UQuaW5fZlI0BW3HZwQRFhCWp2CTt6q3gmSPc7OodSrF9pqVO4r5QBQxA_qmxWN8Xg6gCJj42GOhGJzUNthVPC8kP6FhEAN12uhvvmZ837ucm_z9A8lNCBkCc"/>
<img alt="Hummer" class="h-6 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAcM-ZDamdT9Df2F6lUdruBfyowwJW_sx_X7Mozl4TD524k4LlHftQuGDYjWE-oWClz5pnMGrK_G0WBCyCzMuJ3ODRjElLOSTVIgFvNPOxOx0W7-oNbvwATPM5_gTY4hQ1p4J1s3k5CN49RC2HoNTc7wgApVBnkfNbQLQTimNm2rtTwwB66_EtKyllcs9aDgMZ71SKJiE5SO3weTRbKqdxSqhwyVQ5o838bJOPqkrFF1wOS7A3U4bRdPh40B7xZ6krsN2nca-buXM"/>
</div>
</section>
<!-- Drive Luxury Section -->
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap grid grid-cols-1 lg:grid-cols-2 gap-gutter items-center">
<div>
<h2 class="font-headline-lg text-headline-lg font-semibold text-primary mb-stack-md leading-tight">
                Управляй роскошью,<br/>живи свободой
            </h2>
</div>
<div>
<p class="font-body-lg text-body-lg text-secondary mb-stack-lg">
                Ощутите преимущества аренды автомобилей премиум-класса, созданных для комфорта, скорости и стиля. Будь то короткая деловая поездка или длительный отдых на выходных, наш автопарк призван поднять ваше путешествие на новый уровень.
            </p>
<div class="grid grid-cols-2 sm:grid-cols-4 gap-6 border-t border-outline-variant pt-8">
<div>
<div class="font-headline-md text-headline-md font-bold text-primary mb-1">500+</div>
<div class="font-label-sm text-label-sm text-secondary">Роскошных авто</div>
</div>
<div>
<div class="font-headline-md text-headline-md font-bold text-primary mb-1">24/7</div>
<div class="font-label-sm text-label-sm text-secondary">Помощь на дороге</div>
</div>
<div>
<div class="font-headline-md text-headline-md font-bold text-primary mb-1">100%</div>
<div class="font-label-sm text-label-sm text-secondary">Гарантия сервиса</div>
</div>
<div>
<div class="font-headline-md text-headline-md font-bold text-primary mb-1">60+</div>
<div class="font-label-sm text-label-sm text-secondary">Точек выдачи</div>
</div>
</div>
</div>
</section>
<!-- Find Your Perfect Ride -->
<section class="bg-surface-container-low py-section-gap">
<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
<div class="flex flex-col md:flex-row justify-between items-end mb-stack-lg gap-4">
<div class="max-w-[600px]">
<h2 class="font-headline-lg text-headline-lg font-semibold text-primary mb-stack-md">Найдите свой идеальный автомобиль</h2>
<p class="font-body-md text-body-md text-secondary">
                        Изучите отобранную коллекцию роскошных автомобилей, созданных для любых поездок. От элегантных седанов до смелых внедорожников и электромобилей.
                    </p>
</div>
<a class="bg-primary text-on-primary px-6 py-3 rounded-full font-label-sm text-label-sm hover:bg-primary/90 transition-colors whitespace-nowrap" href="#">
                    Весь автопарк
                </a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<!-- Card 1 -->
<div class="bg-surface rounded-2xl p-6 shadow-sm border border-outline-variant flex flex-col">
<img alt="Porsche 911" class="w-full h-[200px] object-cover rounded-lg mb-6" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBigk9DKsgCBWcZPy-zELIDaXbRudeeCyz6JvQjyQWJubQawPqxp8jD-BZ8Y0cFgC7_VGKdGWoBF9dF8b5CDARRlzeybKfOYfCIeIk_jDVxrD6vNN8GGJh_l9ejojW15UcIKJ1bO8fZ28pBb5psGYYN6okeRJCfUeBKGI0-rkllHUL2-195KdfUCoAcMyAuc5o8bhprU6rrZ_oqQVNs12_-A56MRMxVzZiglSwoDWJWtscr46KNE3uohuXeHfFrnlYUpkj0gSm9Uqw"/>
<h3 class="font-headline-md text-headline-md font-semibold text-primary mb-4">Porsche 911 Carrera 2025</h3>
<div class="grid grid-cols-2 gap-4 mb-6">
<div class="flex items-center gap-2 text-secondary font-label-sm">
<span class="material-symbols-outlined text-[18px]">directions_car</span> Спорткар
                        </div>
<div class="flex items-center gap-2 text-secondary font-label-sm">
<span class="material-symbols-outlined text-[18px]">person</span> 2 Места
                        </div>
<div class="flex items-center gap-2 text-secondary font-label-sm">
<span class="material-symbols-outlined text-[18px]">door_front</span> 2 Двери
                        </div>
<div class="flex items-center gap-2 text-secondary font-label-sm">
<span class="material-symbols-outlined text-[18px]">settings</span> Автомат
                        </div>
</div>
<div class="mt-auto flex flex-col gap-3">
<a class="w-full text-center bg-surface text-primary border border-outline-variant py-3 rounded-full font-label-sm hover:bg-surface-container-low transition-colors" href="#">Подробнее</a>
<a class="w-full text-center bg-primary text-on-primary py-3 rounded-full font-label-sm hover:bg-primary/90 transition-colors" href="#">Забронировать</a>
</div>
</div>
<!-- Card 2 -->
<div class="bg-surface rounded-2xl p-6 shadow-sm border border-outline-variant flex flex-col">
<img alt="Audi R8" class="w-full h-[200px] object-cover rounded-lg mb-6" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC7c2F-zhqJLlvx7FAWBUmRZ_0WNVxD2d4f6s7fG-2V9sLsdeO2sBGNGTfRxsmvwjGqUVYJ_Dax_dlz2xR1GF0C5Va-FQaHyb31BBQ_fYD3963fKhqoiDH-APbAXShYGZ0A4mzgmEdFZuXkVVyO6rmQD-MRd_-maHi37Gw1Q0wk2NhBHtcU1WdBSSTFNurOu9rPszc3TTXqp_AOUb-CPMDzeLOSMw2B8QehZvQqgizkilR91v5PrP1k3FMa2Fx-2-iBH5IyPieKT9s"/>
<h3 class="font-headline-md text-headline-md font-semibold text-primary mb-4">Audi R8 V10 Performance</h3>
<div class="grid grid-cols-2 gap-4 mb-6">
<div class="flex items-center gap-2 text-secondary font-label-sm">
<span class="material-symbols-outlined text-[18px]">directions_car</span> Спорткар
                        </div>
<div class="flex items-center gap-2 text-secondary font-label-sm">
<span class="material-symbols-outlined text-[18px]">person</span> 2 Места
                        </div>
<div class="flex items-center gap-2 text-secondary font-label-sm">
<span class="material-symbols-outlined text-[18px]">door_front</span> 2 Двери
                        </div>
<div class="flex items-center gap-2 text-secondary font-label-sm">
<span class="material-symbols-outlined text-[18px]">settings</span> Автомат
                        </div>
</div>
<div class="mt-auto flex flex-col gap-3">
<a class="w-full text-center bg-surface text-primary border border-outline-variant py-3 rounded-full font-label-sm hover:bg-surface-container-low transition-colors" href="#">Подробнее</a>
<a class="w-full text-center bg-primary text-on-primary py-3 rounded-full font-label-sm hover:bg-primary/90 transition-colors" href="#">Забронировать</a>
</div>
</div>
<!-- Card 3 -->
<div class="bg-surface rounded-2xl p-6 shadow-sm border border-outline-variant flex flex-col">
<img alt="Ferrari Portofino" class="w-full h-[200px] object-cover rounded-lg mb-6" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCP21Xf2dp9svHxMQVUA9MXY1EcUN2zCpq5_MlUV9NA-22VHj8Jz69fBcyIAI4Y4Q0nZugRfmZsTBJSBertYNMQAOZ2naP01OE5CWxvB9qGEl9ICku898Rogm1MUauAiiiVf_g3APRG0QQXEm5pyFSqz9wCX0BzbEH-WdUsbfCZhfsSO5chyVJwIHjYCeqFWHv3IoP39lN5J2aw9sYA5gc9ehNCZ74a1iCVH7IihgYuVBdyPQYvgv3EVhxHOSTJr3ib4Tkt-8_9GEg"/>
<h3 class="font-headline-md text-headline-md font-semibold text-primary mb-4">Ferrari Portofino M 2025</h3>
<div class="grid grid-cols-2 gap-4 mb-6">
<div class="flex items-center gap-2 text-secondary font-label-sm">
<span class="material-symbols-outlined text-[18px]">directions_car</span> Спорткар
                        </div>
<div class="flex items-center gap-2 text-secondary font-label-sm">
<span class="material-symbols-outlined text-[18px]">person</span> 4 Места
                        </div>
<div class="flex items-center gap-2 text-secondary font-label-sm">
<span class="material-symbols-outlined text-[18px]">door_front</span> 2 Двери
                        </div>
<div class="flex items-center gap-2 text-secondary font-label-sm">
<span class="material-symbols-outlined text-[18px]">settings</span> Автомат
                        </div>
</div>
<div class="mt-auto flex flex-col gap-3">
<a class="w-full text-center bg-surface text-primary border border-outline-variant py-3 rounded-full font-label-sm hover:bg-surface-container-low transition-colors" href="#">Подробнее</a>
<a class="w-full text-center bg-primary text-on-primary py-3 rounded-full font-label-sm hover:bg-primary/90 transition-colors" href="#">Забронировать</a>
</div>
</div>
</div>
</div>
</section>
<!-- Luxury Meets Reliability -->
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-16 gap-6">
<div class="max-w-[500px]">
<h2 class="font-headline-lg text-headline-lg font-semibold text-primary mb-2">Роскошь и надежность</h2>
<p class="font-body-md text-body-md text-secondary">Мы сочетаем элегантность премиальных авто с безупречным опытом аренды.</p>
</div>
<div class="flex flex-wrap gap-2">
<button class="bg-primary text-on-primary px-5 py-2 rounded-full font-label-sm text-sm">Экспертность</button>
<button class="bg-surface border border-outline-variant text-primary px-5 py-2 rounded-full font-label-sm text-sm hover:bg-surface-container">Гибкость</button>
<button class="bg-surface border border-outline-variant text-primary px-5 py-2 rounded-full font-label-sm text-sm hover:bg-surface-container">Безопасность</button>
<button class="bg-surface border border-outline-variant text-primary px-5 py-2 rounded-full font-label-sm text-sm hover:bg-surface-container">Бронирование</button>
<button class="bg-surface border border-outline-variant text-primary px-5 py-2 rounded-full font-label-sm text-sm hover:bg-surface-container">Клуб</button>
</div>
</div>
<div class="relative w-full aspect-[2/1] overflow-hidden rounded-t-[300px] border-t-2 border-x-2 border-outline-variant/30 flex items-end justify-center pb-8 pt-24 bg-gradient-to-b from-surface-container-low to-background">
<!-- Decorative concentric circles -->
<div class="absolute w-[80%] h-[160%] rounded-full border border-outline-variant/20 top-[20%]"></div>
<div class="absolute w-[60%] h-[120%] rounded-full border border-outline-variant/30 top-[40%]"></div>
<div class="absolute w-[40%] h-[80%] rounded-full border border-outline-variant/40 top-[60%]"></div>
<!-- Pin -->
<div class="absolute top-[10%] left-1/2 -translate-x-1/2 flex flex-col items-center">
<span class="text-sm font-semibold mb-1">01</span>
<div class="w-4 h-4 rounded-full bg-primary border-4 border-background ring-2 ring-primary"></div>
<div class="w-px h-16 bg-primary"></div>
</div>
<!-- Content Card -->
<div class="relative z-10 bg-surface rounded-2xl p-8 shadow-xl border border-outline-variant max-w-[400px] text-center mb-8">
<h3 class="font-headline-md text-headline-md font-semibold text-primary mb-4">Экспертный сервис</h3>
<img alt="Car" class="w-full h-[120px] object-cover rounded-lg mb-4" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAa0ZxD-4MnJQ2yZjxvcJ1WXGPc_K08nH6-Zq4AwWluB2NkWQ5tAtlFT_eAbAdnyMLHpyCD9qc8OukEbHVv46mVYE5qw7dQ1G87Dn29L3k8a6M-SEjrj_5NI02rEgZscwgVPqnT8BQDZPV5ifIHGSoIbAbuqfvKH9qxQATV1DaqNxSuog9OuuhKiIjbA4GCNgIsuYlYcKt9Hf12iBYBFUgT3TgODF2zw_QQfGrNEwfarxb9pnYh-uLETvD3fvDhuNUhPcAQH6KkrWM"/>
<p class="font-body-sm text-secondary mb-6">Профессиональная помощь в выборе идеального автомобиля для вас.</p>
<a class="inline-block bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-sm hover:bg-primary/90 transition-colors" href="#">Узнать больше</a>
</div>
</div>
</section>
<!-- Top Picks This Week -->
<section class="bg-surface-container-low py-section-gap">
<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
<div class="flex justify-between items-end mb-stack-lg">
<div>
<h2 class="font-headline-lg text-headline-lg font-semibold text-primary mb-2">Лучший выбор недели</h2>
<p class="font-body-md text-secondary">Изучите наши самые арендуемые и любимые автомобили.</p>
</div>
<a class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-sm hover:bg-primary/90 transition-colors hidden sm:block" href="#">Все автомобили</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
<div class="bg-surface rounded-xl p-6 border border-outline-variant flex flex-col items-center text-center hover:shadow-md transition-shadow">
<img alt="Mercedes" class="w-full h-[150px] object-cover rounded mb-4" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQ1bY3K9CxvTkp2c6naB9ZBCyOWTuU51ExAC8JmeisDbeyt7Qwl_fz9cKvXqWd5q8IFeEQBkzUQNWYboIAZP5rn2gOIJNwCbXaUDJ4kVhBPSocFTPkue8-BnjUWsPFtmbDw-kdI8cnuRiSqAg8nM_rXBnui3hPDlMLN1uFi2PuDaJ6sSSbbjsFAApjvSpQ5qdu-XklndrfF9cY_Ezuyugc8zupjV-X60Jae4zuHFbRRS4KnFUwNDSbZAvjfF0yeRjk0IZr80hHtB4"/>
<h4 class="font-label-sm font-semibold text-primary">Benz E-Class</h4>
</div>
<div class="bg-surface rounded-xl p-6 border border-outline-variant flex flex-col items-center text-center hover:shadow-md transition-shadow">
<img alt="BMW" class="w-full h-[150px] object-cover rounded mb-4" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCgKk9Zdh4XZoD_oizdeOed9dJzniVSHH1ojT3H0Hi7aHyyASrta5qRZjkwNGzaWL1kwD-o3fDt3Cia1YDmpW4SdgBfT640KYVYS12GwiwnQXjtt6yOIqoREOFX-n8xbkDMYxgyZ4_MdfENd4ePG8ua3jzrASMo7oNlH4xxPIwntQ5b3boJqcJ6PfSo1GYouITf_lFgkmTF9lTbN6rpXOSssOdjYaAULrZPEg4AF4LWOOw0W5D3JPt0mOJrQqhk64xrhush3yi3iyk"/>
<h4 class="font-label-sm font-semibold text-primary">BMW i8 Coupe</h4>
</div>
<div class="bg-surface rounded-xl p-6 border border-outline-variant flex flex-col items-center text-center hover:shadow-md transition-shadow">
<img alt="Audi" class="w-full h-[150px] object-cover rounded mb-4" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDsERvXjRr3fDNojh39iiJMyRWyAXEznFA_wEajeNIi_cytsacSrqE7ojCFRkFooi8XZssEYj5wucuh_jD0Pe4kjg8I8S8jXMqrh6ArPmb51cw1ztaVFvnb-yWcGtmKSlfS_hQHtqxRDfGH1oSjnHprCv764FKn4ZwhpK5aQfZwrfX0TeGDx40u-GtaQKvnx_94v17BOBoyTnwXuudQ1wA6VP-noiYxzLiPzvKh9jQFreyAFmKSqyOjxJKzILVx4mUnB6J738lGs2A"/>
<h4 class="font-label-sm font-semibold text-primary">Audi A6</h4>
</div>
</div>
<div class="flex justify-center gap-4">
<button class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center text-secondary hover:bg-surface hover:text-primary transition-colors"><span class="material-symbols-outlined">chevron_left</span></button>
<button class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center hover:bg-primary/90 transition-colors"><span class="material-symbols-outlined">chevron_right</span></button>
</div>
</div>
</section>
<!-- Simple Fast Hassle-Free -->
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
<div class="flex flex-col lg:flex-row justify-between items-start gap-12">
<div class="lg:w-1/3">
<h2 class="font-headline-lg text-headline-lg font-semibold text-primary mb-4 leading-tight">Просто. Быстро.<br/>Без забот.</h2>
<p class="font-body-md text-secondary mb-8">Ощутите плавный процесс аренды, созданный для того, чтобы вы оказались на дороге за минуты. От выбора авто до подтверждения брони.</p>
<a class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-sm hover:bg-primary/90 transition-colors inline-block" href="#">Начать бронирование</a>
</div>
<div class="lg:w-2/3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
<div class="bg-surface-container-low p-6 rounded-xl">
<h4 class="font-label-sm font-semibold text-primary mb-2">Выбрать авто</h4>
<p class="text-xs text-secondary">Выберите из нашей коллекции.</p>
</div>
<div class="bg-surface-container-low p-6 rounded-xl">
<h4 class="font-label-sm font-semibold text-primary mb-2">Настроить поездку</h4>
<p class="text-xs text-secondary">Подберите идеальный вариант.</p>
</div>
<div class="bg-surface-container-low p-6 rounded-xl">
<h4 class="font-label-sm font-semibold text-primary mb-2">Выбрать даты</h4>
<p class="text-xs text-secondary">Укажите срок и место.</p>
</div>
<div class="bg-surface-container-low p-6 rounded-xl">
<h4 class="font-label-sm font-semibold text-primary mb-2">Добавить опции</h4>
<p class="text-xs text-secondary">Например, личного водителя.</p>
</div>
<div class="bg-surface-container-low p-6 rounded-xl">
<h4 class="font-label-sm font-semibold text-primary mb-2">Подтвердить</h4>
<p class="text-xs text-secondary">Безопасная оплата.</p>
</div>
<div class="bg-surface-container-low p-6 rounded-xl relative overflow-hidden group">
<img alt="Drive" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDSeWpmrqE9VtxV3VT0TLODbf6gGcJiHW2l13Vcs5m0-bdv23CUXTpmzESc1pVX2g8FJb5LtBt0M-MXHKUTDx95z7jxy6ja-UVsmBXXSKH03pJimGrg3vOGtEM_cGyigzSa8DFgFrlv_n-6JXdfwo-MSpcE-DyUbepOc2SEP2a5hCg8YDBHLN5ByC7GwB-6mqNUuwAxDwXGfW_Jeu5-SU8iNNrN0AHNXEutks9WI43KotBBcXfC3MyX0Wu7nXMhDIQAP-859CSJ9ME"/>
<div class="relative z-10 bg-gradient-to-t from-black/70 to-transparent p-6 h-full flex flex-col justify-end">
<h4 class="font-label-sm font-semibold text-white mb-2">Забрать и ехать</h4>
<p class="text-xs text-white/80">Наслаждайтесь дорогой.</p>
</div>
</div>
</div>
</div>
</section>
<!-- Trusted By Thousands -->
<section class="bg-surface-container-lowest py-section-gap border-y border-outline-variant">
<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
<div class="flex justify-between items-end mb-12">
<div>
<h2 class="font-headline-lg text-headline-lg font-semibold text-primary mb-2">Доверяют тысячи</h2>
<p class="font-body-md text-secondary">Реальный опыт от реальных водителей.</p>
</div>
<div class="flex gap-4">
<button class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center text-secondary hover:bg-surface hover:text-primary transition-colors"><span class="material-symbols-outlined">chevron_left</span></button>
<button class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center hover:bg-primary/90 transition-colors"><span class="material-symbols-outlined">chevron_right</span></button>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<!-- Testimonial 1 -->
<div class="bg-surface rounded-2xl p-8 border border-outline-variant">
<span class="material-symbols-outlined text-4xl text-outline-variant/40 mb-4 block" data-icon="format_quote">format_quote</span>
<p class="font-body-md text-secondary mb-8">Весь процесс бронирования был безупречным. Я взял BMW X7 на выходные, и машина была как новая. От чистоты до процесса выдачи все было идеально организовано. Определенно лучший опыт аренды в моей жизни.</p>
<div class="flex items-center gap-4">
<img alt="Daniel" class="w-12 h-12 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAoL29B32torEk_0eys5x5f5HSImHsGSGOpJ7Kzud9r3nBncbonzRxA6CgTjFq3h-uURpZ4lAoQ5emFBv22LccDXg7NJf6ESIcjpnTP7bWTZadMWta_dSSXYjcNW0PYQKwvflGA_DWPUbqFc5daxhSJcHVvB85f_obsQ7ZRQ5xPW4TKFyoI-Fz-fvfqVcai3PQxplqFSl3rwY3QMUPCgFfDuQrlwwYuKhWAhxP9DgQYoimpsGDckO_Gi9g1COQRz38pkohqnHL_gVk"/>
<div>
<div class="font-label-sm font-semibold text-primary">Даниэль Робертс</div>
<div class="text-xs text-secondary">Лондон</div>
</div>
</div>
</div>
<!-- Testimonial 2 -->
<div class="bg-surface rounded-2xl p-8 border border-outline-variant">
<span class="material-symbols-outlined text-4xl text-outline-variant/40 mb-4 block" data-icon="format_quote">format_quote</span>
<p class="font-body-md text-secondary mb-8">Весь процесс бронирования был безупречным. Я взял BMW X7 на выходные, и машина была как новая. От чистоты до процесса выдачи все было идеально организовано. Определенно лучший опыт аренды в моей жизни.</p>
<div class="flex items-center gap-4">
<img alt="Daniel" class="w-12 h-12 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCdw_ijdBmM8yrCebn1ITEH5k7T0KjeayjDJJDtEy73AFeupfvRS_scnK9OP-KpfoZh9rKNhrE8TmDnI8j5Vix80KJg5IsUJawqQ0vtYFHE87wWedth8LcYiag0qew4jIppXBRaPP0oMtTw5k4SawnHgO2Az3xWGxxXEQvz1x60a2fMmQ0yffbuq4vRzW2kzswCQW2cKFdY7C8K0l4N6NIApDAtG_M4XYzCkl2ztpUXXbYe3IYCsJVq-cLsmRAClXPNU0-KtU8B2c8"/>
<div>
<div class="font-label-sm font-semibold text-primary">Даниэль Робертс</div>
<div class="text-xs text-secondary">Лондон</div>
</div>
</div>
</div>
<!-- Testimonial 3 -->
<div class="bg-surface rounded-2xl p-8 border border-outline-variant">
<span class="material-symbols-outlined text-4xl text-outline-variant/40 mb-4 block" data-icon="format_quote">format_quote</span>
<p class="font-body-md text-secondary mb-8">Весь процесс бронирования был безупречным. Я взял BMW X7 на выходные, и машина была как новая. От чистоты до процесса выдачи все было идеально организовано. Определенно лучший опыт аренды в моей жизни.</p>
<div class="flex items-center gap-4">
<img alt="Daniel" class="w-12 h-12 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA715nlxKsoGJZrwMubURKHosGXPeeUgcOXYos_sIUXLZC7Wqhbiag7EWqyqnFhgb4liL2xGciG_v1qANNxe6nUjTR2Iu7WpsgYfErn2XMRUe4FMchMeCe6wEviVYgmHgSCAeKfEuDnF383zaeClN3bvXTSYvRAwR3oOgfX-3b_Ky28Xp0OzYZV2jdODAAZDIf4gl_2MFCENP3Cc3VWXvODeflrXUPPhPxFvZTdbYqHhE7Mj6Ia554gdUQqVy1hqhe7zZXdxwezlBk"/>
<div>
<div class="font-label-sm font-semibold text-primary">Даниэль Робертс</div>
<div class="text-xs text-secondary">Лондон</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- FAQ -->
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap grid grid-cols-1 lg:grid-cols-2 gap-12">
<div>
<h2 class="font-headline-lg text-headline-lg font-semibold text-primary mb-4">Есть вопросы?<br/>У нас есть ответы!</h2>
<p class="font-body-md text-secondary">Вот некоторые из самых частых вопросов о нашем сервисе аренды премиальных автомобилей.</p>
</div>
<div class="flex flex-col gap-4">
<div class="bg-primary text-on-primary rounded-xl p-6">
<div class="flex justify-between items-center mb-4 cursor-pointer">
<h4 class="font-label-sm font-semibold">Как забронировать автомобиль?</h4>
<span class="material-symbols-outlined">expand_less</span>
</div>
<p class="text-sm text-on-primary/80">Бронирование простое и быстрое. Выберите автомобиль онлайн, укажите даты и завершите резервирование безопасным платежом. Также можно связаться через WhatsApp.</p>
</div>
<div class="bg-surface-container-low rounded-xl p-6 flex justify-between items-center cursor-pointer hover:bg-surface-container transition-colors">
<h4 class="font-label-sm font-semibold text-primary">Можно ли доставить авто по моему адресу?</h4>
<span class="material-symbols-outlined text-secondary">expand_more</span>
</div>
<div class="bg-surface-container-low rounded-xl p-6 flex justify-between items-center cursor-pointer hover:bg-surface-container transition-colors">
<h4 class="font-label-sm font-semibold text-primary">Каков минимальный срок аренды?</h4>
<span class="material-symbols-outlined text-secondary">expand_more</span>
</div>
<div class="bg-surface-container-low rounded-xl p-6 flex justify-between items-center cursor-pointer hover:bg-surface-container transition-colors">
<h4 class="font-label-sm font-semibold text-primary">Включена ли страховка в стоимость?</h4>
<span class="material-symbols-outlined text-secondary">expand_more</span>
</div>
<div class="bg-surface-container-low rounded-xl p-6 flex justify-between items-center cursor-pointer hover:bg-surface-container transition-colors">
<h4 class="font-label-sm font-semibold text-primary">Какие документы нужны для аренды?</h4>
<span class="material-symbols-outlined text-secondary">expand_more</span>
</div>
<div class="bg-surface-container-low rounded-xl p-6 flex justify-between items-center cursor-pointer hover:bg-surface-container transition-colors">
<h4 class="font-label-sm font-semibold text-primary">Требуется ли гарантийный депозит?</h4>
<span class="material-symbols-outlined text-secondary">expand_more</span>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-surface-container-low dark:bg-tertiary-container text-on-surface dark:text-on-tertiary-container full-width border-t border-outline-variant dark:border-outline flat no shadows w-full py-section-gap px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between gap-gutter mt-section-gap">
<div class="flex flex-col gap-stack-lg max-w-[300px]">
<a class="font-headline-md text-headline-md font-bold text-primary dark:text-on-primary" href="#">Haval</a>
<p class="font-body-md text-body-md text-on-surface-variant">Ваш надежный партнер по аренде автомобилей премиум-класса с 2020 года. Делаем ваше путешествие комфортным и незабываемым.</p>
<div class="flex gap-4">
<a class="p-2 bg-primary text-on-primary rounded-full hover:bg-primary/80 transition-colors" href="#"><span class="material-symbols-outlined text-[20px]" data-icon="share">share</span></a>
<a class="p-2 bg-primary text-on-primary rounded-full hover:bg-primary/80 transition-colors" href="#"><span class="material-symbols-outlined text-[20px]" data-icon="language">language</span></a>
<a class="p-2 bg-primary text-on-primary rounded-full hover:bg-primary/80 transition-colors" href="#"><span class="material-symbols-outlined text-[20px]" data-icon="work">work</span></a>
</div>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-gutter flex-1 max-w-[900px]">
<!-- Quick Links -->
<div class="flex flex-col gap-stack-sm">
<h4 class="font-headline-md text-body-lg font-bold mb-2">Быстрые ссылки</h4>
<a class="font-body-md text-label-sm text-on-surface-variant dark:text-on-tertiary-container hover:text-primary dark:hover:text-inverse-primary transition-all" href="#">Главная</a>
<a class="font-body-md text-label-sm text-on-surface-variant dark:text-on-tertiary-container hover:text-primary dark:hover:text-inverse-primary transition-all" href="#">О нас</a>
<a class="font-body-md text-label-sm text-on-surface-variant dark:text-on-tertiary-container hover:text-primary dark:hover:text-inverse-primary transition-all" href="#">Автопарк</a>
<a class="font-body-md text-label-sm text-on-surface-variant dark:text-on-tertiary-container hover:text-primary dark:hover:text-inverse-primary transition-all" href="#">Бренды</a>
<a class="font-body-md text-label-sm text-on-surface-variant dark:text-on-tertiary-container hover:text-primary dark:hover:text-inverse-primary transition-all" href="#">Услуги</a>
<a class="font-body-md text-label-sm text-on-surface-variant dark:text-on-tertiary-container hover:text-primary dark:hover:text-inverse-primary transition-all" href="#">Блог</a>
<a class="font-body-md text-label-sm text-on-surface-variant dark:text-on-tertiary-container hover:text-primary dark:hover:text-inverse-primary transition-all" href="#">Контакты</a>
</div>
<!-- Contact -->
<div class="flex flex-col gap-stack-sm col-span-2 md:col-span-1">
<h4 class="font-headline-md text-body-lg font-bold mb-2">Контакты</h4>
<p class="font-body-md text-label-sm text-on-surface-variant">123 Rental Street, Dubai<br/>Abu dhabi</p>
<p class="font-body-md text-label-sm text-on-surface-variant">+44 7788888275</p>
<p class="font-body-md text-label-sm text-on-surface-variant">info@Dream Drive.com</p>
</div>
<!-- Newsletter -->
<div class="flex flex-col gap-stack-sm col-span-2">
<div class="w-full">
<input class="w-full bg-surface border border-outline-variant rounded-full px-4 py-3 text-sm focus:outline-none focus:border-primary mb-3" placeholder="Введите ваш Email" type="email"/>
<button class="w-full bg-primary text-on-primary rounded-full px-4 py-3 text-sm font-semibold hover:bg-primary/90 transition-colors">Подписаться</button>
</div>
</div>
</div>
</footer>
<div class="bg-surface-container-low border-t border-outline-variant py-6 px-margin-mobile md:px-margin-desktop text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
<p class="font-body-md text-label-sm text-on-surface-variant">© 2025 Haval. Все права защищены.</p>
<div class="flex gap-4">
<a class="font-body-md text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Политика конфиденциальности</a>
<a class="font-body-md text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Условия использования</a>
<a class="font-body-md text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Политика Cookie</a>
</div>
</div>
</body></html>

===

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.4
- filament/filament (FILAMENT) - v5
- laravel/framework (LARAVEL) - v13
- laravel/prompts (PROMPTS) - v0
- livewire/livewire (LIVEWIRE) - v4
- laravel/boost (BOOST) - v2
- laravel/mcp (MCP) - v0
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- pestphp/pest (PEST) - v4
- phpunit/phpunit (PHPUNIT) - v12
- tailwindcss (TAILWINDCSS) - v4

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Always use `search-docs` before making code changes. Do not skip this step. It returns version-specific docs based on installed packages automatically.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== livewire/core rules ===

# Livewire

- Livewire allow to build dynamic, reactive interfaces in PHP without writing JavaScript.
- You can use Alpine.js for client-side interactions instead of JavaScript frameworks.
- Keep state server-side so the UI reflects it. Validate and authorize in actions as you would in HTTP requests.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

## Pest

- This project uses Pest for testing. Create tests: `php artisan make:test --pest {name}`.
- The `{name}` argument should not include the test suite directory. Use `php artisan make:test --pest SomeFeatureTest` instead of `php artisan make:test --pest Feature/SomeFeatureTest`.
- Run tests: `php artisan test --compact` or filter: `php artisan test --compact --filter=testName`.
- Do NOT delete tests without approval.

</laravel-boost-guidelines>
