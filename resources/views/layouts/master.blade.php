<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Logistica - Shipping Company Website Template')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <script>
        (() => {
            try {
                const theme = localStorage.getItem('logistica-theme');
                const allowedThemes = ['light', 'dark', 'ocean', 'forest', 'sunset'];

                if (allowedThemes.includes(theme)) {
                    document.documentElement.dataset.theme = theme;
                }
            } catch (error) {
                document.documentElement.dataset.theme = 'light';
            }
        })();
    </script>

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        :root,
        [data-theme="light"] {
            --primary: #ff3e41;
            --secondary: #51cfed;
            --light: #f8f2f0;
            --dark: #060315;
            --theme-primary: #ff3e41;
            --theme-secondary: #00a9ff;
            --theme-accent: #ff8a3d;
            --theme-bg: #ffffff;
            --theme-shell: #f7fbff;
            --theme-surface: #ffffff;
            --theme-surface-soft: #f8fbff;
            --theme-text: #182033;
            --theme-heading: #060315;
            --theme-muted: #667085;
            --theme-border: rgba(6, 3, 21, .1);
            --theme-shadow: rgba(6, 3, 21, .1);
            --theme-nav-bg: #ffffff;
            --theme-nav-text: #060315;
            --theme-sidebar-start: rgba(6, 3, 21, .96);
            --theme-sidebar-end: rgba(19, 28, 55, .94);
        }

        [data-theme="dark"] {
            --primary: #ff6b7a;
            --secondary: #58d7ff;
            --light: #d7deea;
            --dark: #050816;
            --theme-primary: #ff6b7a;
            --theme-secondary: #58d7ff;
            --theme-accent: #ffc857;
            --theme-bg: #070a14;
            --theme-shell: #0c1222;
            --theme-surface: #121827;
            --theme-surface-soft: #182235;
            --theme-text: #e7edf7;
            --theme-heading: #ffffff;
            --theme-muted: #a9b4c6;
            --theme-border: rgba(226, 232, 240, .14);
            --theme-shadow: rgba(0, 0, 0, .34);
            --theme-nav-bg: #0b1020;
            --theme-nav-text: #e7edf7;
            --theme-sidebar-start: rgba(3, 7, 18, .98);
            --theme-sidebar-end: rgba(17, 24, 39, .96);
        }

        [data-theme="ocean"] {
            --primary: #0077b6;
            --secondary: #00b4d8;
            --light: #e7f8fb;
            --dark: #04233a;
            --theme-primary: #0077b6;
            --theme-secondary: #00b4d8;
            --theme-accent: #38bdf8;
            --theme-bg: #f7fcff;
            --theme-shell: #eefaff;
            --theme-surface: #ffffff;
            --theme-surface-soft: #eaf8fc;
            --theme-text: #123047;
            --theme-heading: #06243a;
            --theme-muted: #527083;
            --theme-border: rgba(0, 119, 182, .16);
            --theme-shadow: rgba(0, 74, 117, .12);
            --theme-nav-bg: #ffffff;
            --theme-nav-text: #06243a;
            --theme-sidebar-start: rgba(3, 48, 75, .97);
            --theme-sidebar-end: rgba(0, 95, 135, .92);
        }

        [data-theme="forest"] {
            --primary: #16803c;
            --secondary: #68b984;
            --light: #eef8f0;
            --dark: #082314;
            --theme-primary: #16803c;
            --theme-secondary: #68b984;
            --theme-accent: #f59e0b;
            --theme-bg: #fbfefb;
            --theme-shell: #f1faf3;
            --theme-surface: #ffffff;
            --theme-surface-soft: #edf8ef;
            --theme-text: #173521;
            --theme-heading: #092314;
            --theme-muted: #5d7464;
            --theme-border: rgba(22, 128, 60, .16);
            --theme-shadow: rgba(7, 66, 31, .11);
            --theme-nav-bg: #ffffff;
            --theme-nav-text: #092314;
            --theme-sidebar-start: rgba(6, 43, 24, .97);
            --theme-sidebar-end: rgba(20, 83, 45, .94);
        }

        [data-theme="sunset"] {
            --primary: #e85d04;
            --secondary: #ffb703;
            --light: #fff5e8;
            --dark: #35160a;
            --theme-primary: #e85d04;
            --theme-secondary: #ffb703;
            --theme-accent: #d0006f;
            --theme-bg: #fffaf4;
            --theme-shell: #fff4e6;
            --theme-surface: #ffffff;
            --theme-surface-soft: #fff1df;
            --theme-text: #3c281a;
            --theme-heading: #35160a;
            --theme-muted: #7a604a;
            --theme-border: rgba(232, 93, 4, .18);
            --theme-shadow: rgba(125, 58, 8, .13);
            --theme-nav-bg: #ffffff;
            --theme-nav-text: #35160a;
            --theme-sidebar-start: rgba(53, 22, 10, .97);
            --theme-sidebar-end: rgba(124, 45, 18, .94);
        }

        html,
        body {
            background: var(--theme-bg);
            color: var(--theme-text);
        }

        body,
        .service-item,
        .dropdown-menu,
        .form-control,
        .form-select,
        textarea,
        .table {
            color: var(--theme-text);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        label,
        strong {
            color: var(--theme-heading);
        }

        .text-muted {
            color: var(--theme-muted) !important;
        }

        .text-primary,
        .text-secondary,
        .auth-soft-link {
            color: var(--theme-primary) !important;
        }

        .auth-soft-link {
            font-weight: 800;
        }

        .bg-white,
        #spinner,
        .dropdown-menu {
            background-color: var(--theme-surface) !important;
        }

        .bg-light {
            background-color: var(--theme-surface-soft) !important;
        }

        .bg-primary,
        .btn-primary {
            background-color: var(--theme-primary) !important;
            border-color: var(--theme-primary) !important;
        }

        .border-primary {
            border-color: var(--theme-primary) !important;
        }

        .border,
        .border-bottom,
        .border-top {
            border-color: var(--theme-border) !important;
        }

        .navbar {
            background-color: var(--theme-nav-bg) !important;
        }

        .navbar-light .navbar-nav .nav-link,
        .dropdown-item {
            color: var(--theme-nav-text);
        }

        .dropdown-item:hover,
        .dropdown-item:focus,
        .theme-option.is-active {
            color: var(--theme-heading);
            background: var(--theme-surface-soft);
        }

        .service-item {
            background: var(--theme-surface);
            border: 1px solid var(--theme-border);
            box-shadow: 0 18px 45px var(--theme-shadow);
        }

        .form-control,
        .form-select,
        textarea {
            background-color: var(--theme-surface-soft);
            border-color: var(--theme-border);
        }

        .form-control:focus,
        .form-select:focus,
        textarea:focus {
            color: var(--theme-text);
            background-color: var(--theme-surface);
            border-color: var(--theme-primary);
            box-shadow: 0 0 0 .25rem color-mix(in srgb, var(--theme-primary) 16%, transparent);
        }

        .form-control::placeholder,
        textarea::placeholder {
            color: color-mix(in srgb, var(--theme-muted) 76%, transparent);
        }

        .table > :not(caption) > * > * {
            color: var(--theme-text);
            background-color: var(--theme-surface);
            border-bottom-color: var(--theme-border);
        }

        .btn-outline-primary {
            color: var(--theme-primary);
            border-color: var(--theme-primary);
        }

        .btn-outline-primary:hover {
            color: #fff;
            background: var(--theme-primary);
            border-color: var(--theme-primary);
        }

        .btn-outline-secondary {
            color: var(--theme-muted);
            border-color: var(--theme-border);
        }

        .btn-outline-secondary:hover {
            color: #fff;
            background: var(--theme-muted);
            border-color: var(--theme-muted);
        }

        .theme-picker .dropdown-menu {
            min-width: 13rem;
            border: 1px solid var(--theme-border);
            box-shadow: 0 18px 44px var(--theme-shadow);
        }

        .theme-option {
            display: flex;
            align-items: center;
            gap: .75rem;
            width: 100%;
            font-weight: 700;
        }

        .theme-swatch {
            width: 1rem;
            height: 1rem;
            flex: 0 0 1rem;
            border-radius: 999px;
            border: 2px solid rgba(255, 255, 255, .72);
            box-shadow: 0 0 0 1px var(--theme-border);
        }

        .theme-swatch-light {
            background: linear-gradient(135deg, #ff3e41 0 50%, #51cfed 50% 100%);
        }

        .theme-swatch-dark {
            background: linear-gradient(135deg, #070a14 0 50%, #ff6b7a 50% 100%);
        }

        .theme-swatch-ocean {
            background: linear-gradient(135deg, #0077b6 0 50%, #00b4d8 50% 100%);
        }

        .theme-swatch-forest {
            background: linear-gradient(135deg, #16803c 0 50%, #f59e0b 50% 100%);
        }

        .theme-swatch-sunset {
            background: linear-gradient(135deg, #e85d04 0 50%, #ffb703 50% 100%);
        }

        .auth-radiant-shell {
            min-height: calc(100vh - 85px);
            display: flex;
            align-items: center;
            padding: 5rem 0;
            background:
                linear-gradient(120deg, color-mix(in srgb, var(--theme-primary) 13%, transparent), color-mix(in srgb, var(--theme-accent) 14%, transparent), color-mix(in srgb, var(--theme-secondary) 12%, transparent)),
                linear-gradient(180deg, var(--theme-bg) 0%, var(--theme-shell) 100%);
            overflow: hidden;
        }

        .auth-radiant-panel {
            position: relative;
            overflow: hidden;
            border: 1px solid var(--theme-border);
            border-radius: 8px;
            background: color-mix(in srgb, var(--theme-surface) 92%, transparent);
            box-shadow: 0 24px 70px var(--theme-shadow);
        }

        .auth-radiant-panel::before {
            content: "";
            position: absolute;
            inset: 0 0 auto 0;
            height: 8px;
            background: linear-gradient(90deg, var(--theme-primary), var(--theme-accent), var(--theme-secondary));
        }

        .auth-visual {
            height: 100%;
            min-height: 520px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #fff;
            background:
                linear-gradient(145deg, rgba(6, 3, 21, .72), rgba(6, 3, 21, .28)),
                url("{{ asset('img/carousel-1.jpg') }}") center/cover;
            padding: 3rem;
        }

        .auth-visual.admin {
            background:
                linear-gradient(145deg, rgba(6, 3, 21, .78), rgba(255, 63, 108, .42)),
                url("{{ asset('img/carousel-2.jpg') }}") center/cover;
        }

        .auth-pill {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            border: 1px solid rgba(255, 255, 255, .36);
            border-radius: 999px;
            padding: .45rem .9rem;
            background: rgba(255, 255, 255, .14);
            backdrop-filter: blur(10px);
            font-size: .85rem;
            font-weight: 700;
        }

        .auth-form-panel {
            padding: 3rem;
            background: var(--theme-surface);
        }

        .auth-title {
            font-size: clamp(2rem, 4vw, 3.35rem);
            line-height: 1.05;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .auth-input {
            height: 56px;
            border: 1px solid var(--theme-border);
            border-radius: 8px;
            background: var(--theme-surface-soft);
            padding-left: 1rem;
        }

        .auth-input:focus {
            color: var(--theme-text);
            border-color: var(--theme-primary);
            box-shadow: 0 0 0 .25rem color-mix(in srgb, var(--theme-primary) 16%, transparent);
            background: var(--theme-surface);
        }

        .auth-gradient-btn {
            min-height: 56px;
            border: 0;
            border-radius: 8px;
            background: linear-gradient(90deg, var(--theme-primary), var(--theme-accent), var(--theme-secondary));
            color: #fff;
            font-weight: 800;
            box-shadow: 0 16px 32px color-mix(in srgb, var(--theme-primary) 28%, transparent);
        }

        .auth-gradient-btn:hover {
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 20px 38px color-mix(in srgb, var(--theme-secondary) 26%, transparent);
        }

        .auth-stat-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: .75rem;
        }

        .auth-stat {
            border: 1px solid rgba(255, 255, 255, .22);
            border-radius: 8px;
            padding: 1rem;
            background: rgba(255, 255, 255, .12);
            backdrop-filter: blur(10px);
        }

        .dashboard-shell,
        .admin-dashboard-shell {
            min-height: 70vh;
            padding: 2rem 0 5rem;
            background:
                linear-gradient(115deg, color-mix(in srgb, var(--theme-primary) 12%, transparent), color-mix(in srgb, var(--theme-secondary) 12%, transparent)),
                var(--theme-shell);
        }

        .dashboard-layout {
            display: grid;
            grid-template-columns: 280px minmax(0, 1fr);
            gap: 1.5rem;
            align-items: start;
        }

        .dashboard-sidebar {
            position: sticky;
            top: 98px;
            overflow: hidden;
            border: 1px solid var(--theme-border);
            border-radius: 8px;
            background:
                linear-gradient(180deg, var(--theme-sidebar-start), var(--theme-sidebar-end)),
                linear-gradient(135deg, color-mix(in srgb, var(--theme-primary) 30%, transparent), color-mix(in srgb, var(--theme-secondary) 25%, transparent));
            color: #fff;
            box-shadow: 0 22px 58px var(--theme-shadow);
        }

        .dashboard-sidebar-head {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, .12);
            background: linear-gradient(135deg, color-mix(in srgb, var(--theme-primary) 24%, transparent), color-mix(in srgb, var(--theme-secondary) 18%, transparent));
        }

        .dashboard-sidebar-title {
            margin: 0;
            color: #fff;
            font-size: 1.15rem;
            font-weight: 800;
        }

        .dashboard-sidebar-subtitle {
            margin: .35rem 0 0;
            color: rgba(255, 255, 255, .72);
            font-size: .85rem;
        }

        .dashboard-menu {
            display: grid;
            gap: .35rem;
            padding: 1rem;
        }

        .dashboard-menu-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            min-height: 46px;
            border: 1px solid transparent;
            border-radius: 8px;
            padding: .75rem .9rem;
            color: rgba(255, 255, 255, .82);
            font-weight: 700;
        }

        .dashboard-menu-link:hover,
        .dashboard-menu-link.active {
            color: #fff;
            border-color: rgba(255, 255, 255, .18);
            background: linear-gradient(90deg, color-mix(in srgb, var(--theme-primary) 30%, transparent), color-mix(in srgb, var(--theme-secondary) 20%, transparent));
        }

        .dashboard-main {
            display: grid;
            gap: 1.5rem;
        }

        .dashboard-card,
        .admin-dashboard-card {
            border: 1px solid var(--theme-border);
            border-radius: 8px;
            background: var(--theme-surface);
            box-shadow: 0 18px 48px var(--theme-shadow);
        }

        .dashboard-panel {
            scroll-margin-top: 110px;
        }

        .dashboard-metric {
            border: 1px solid var(--theme-border);
            border-radius: 8px;
            padding: 1.25rem;
            background:
                linear-gradient(135deg, color-mix(in srgb, var(--theme-primary) 10%, transparent), color-mix(in srgb, var(--theme-secondary) 8%, transparent)),
                var(--theme-surface);
            min-height: 126px;
        }

        .analytics-bar {
            height: 10px;
            overflow: hidden;
            border-radius: 999px;
            background: var(--theme-surface-soft);
        }

        .analytics-bar-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--theme-primary), var(--theme-accent), var(--theme-secondary));
        }

        .dashboard-section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: .35rem .75rem;
            font-size: .78rem;
            font-weight: 800;
            text-transform: uppercase;
        }

        .status-pending {
            color: #9a5c00;
            background: #fff3cd;
        }

        .status-accepted {
            color: #0f6b3d;
            background: #d9f7e8;
        }

        .status-rejected {
            color: #9b1c31;
            background: #ffe1e7;
        }

        .dashboard-table {
            vertical-align: middle;
        }

        .dashboard-table th {
            color: var(--theme-muted);
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .dashboard-service-icon {
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            color: #fff;
            background: linear-gradient(135deg, var(--theme-primary), var(--theme-secondary));
        }

        .logistica-swal-popup {
            overflow: hidden;
            border-radius: 8px;
            border: 1px solid rgba(255, 63, 108, .16);
            box-shadow: 0 28px 90px rgba(6, 3, 21, .26);
        }

        .logistica-swal-popup::before {
            content: "";
            position: absolute;
            inset: 0 0 auto 0;
            height: 7px;
            background: linear-gradient(90deg, var(--logistica-alert-accent, #ff3f6c), #ff8a3d, #00a9ff, #6c63ff);
        }

        .logistica-swal-title {
            font-weight: 800;
            letter-spacing: 0;
        }

        .logistica-swal-html {
            color: #586174;
            font-weight: 600;
        }

        .logistica-swal-button {
            border-radius: 8px;
            background: linear-gradient(90deg, #ff3f6c, #ff8a3d, #00a9ff) !important;
            font-weight: 800;
            box-shadow: 0 12px 28px rgba(255, 63, 108, .2);
        }

        @media (max-width: 991.98px) {
            .auth-radiant-shell {
                padding: 2rem 0;
            }

            .auth-visual {
                min-height: 360px;
                padding: 2rem;
            }

            .auth-form-panel {
                padding: 2rem;
            }

            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .dashboard-sidebar {
                position: relative;
                top: 0;
            }

            .dashboard-menu {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 575.98px) {
            .auth-stat-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-menu {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow border-top border-5 border-primary sticky-top p-0">
        <a href="{{ route('home') }}" class="navbar-brand bg-primary d-flex align-items-center px-4 px-lg-5">
            <h2 class="mb-2 text-white">Logistica</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('service') }}" class="nav-item nav-link {{ request()->routeIs('service') ? 'active' : '' }}">Services</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('feature', 'bookings') ? 'active' : '' }}" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="{{ route('feature') }}" class="dropdown-item {{ request()->routeIs('feature') ? 'active' : '' }}">Features</a>
                        <a href="{{ route('bookings') }}" class="dropdown-item {{ request()->routeIs('bookings') ? 'active' : '' }}">Bookings</a>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                <div class="nav-item dropdown theme-picker">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-adjust me-1"></i><span data-theme-label>Theme</span>
                    </a>
                    <div class="dropdown-menu fade-up m-0">
                        <button type="button" class="dropdown-item theme-option" data-theme-value="light" aria-pressed="false">
                            <span class="theme-swatch theme-swatch-light" aria-hidden="true"></span>
                            Light
                        </button>
                        <button type="button" class="dropdown-item theme-option" data-theme-value="dark" aria-pressed="false">
                            <span class="theme-swatch theme-swatch-dark" aria-hidden="true"></span>
                            Dark
                        </button>
                        <button type="button" class="dropdown-item theme-option" data-theme-value="ocean" aria-pressed="false">
                            <span class="theme-swatch theme-swatch-ocean" aria-hidden="true"></span>
                            Ocean
                        </button>
                        <button type="button" class="dropdown-item theme-option" data-theme-value="forest" aria-pressed="false">
                            <span class="theme-swatch theme-swatch-forest" aria-hidden="true"></span>
                            Forest
                        </button>
                        <button type="button" class="dropdown-item theme-option" data-theme-value="sunset" aria-pressed="false">
                            <span class="theme-swatch theme-swatch-sunset" aria-hidden="true"></span>
                            Sunset
                        </button>
                    </div>
                </div>
                @guest
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('login', 'register') ? 'active' : '' }}" data-bs-toggle="dropdown">Account</a>
                        <div class="dropdown-menu fade-up m-0">
                            <a href="{{ route('login') }}" class="dropdown-item {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                            <a href="{{ route('register') }}" class="dropdown-item {{ request()->routeIs('register') ? 'active' : '' }}">Create Account</a>
                        </div>
                    </div>
                @else
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('admin.*', 'user.*', 'dashboard') ? 'active' : '' }}" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu fade-up m-0">
                            @if (auth()->user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Admin Panel</a>
                            @else
                                <a href="{{ route('user.dashboard') }}" class="dropdown-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">My Dashboard</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
            <h4 class="m-0 pe-lg-5 d-none d-lg-block"><i class="fa fa-headphones text-primary me-3"></i>+012 345 6789</h4>
        </div>
    </nav>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 6rem;">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Address</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Services</h4>
                    <a class="btn btn-link" href="{{ route('service') }}">Air Freight</a>
                    <a class="btn btn-link" href="{{ route('service') }}">Sea Freight</a>
                    <a class="btn btn-link" href="{{ route('service') }}">Road Freight</a>
                    <a class="btn btn-link" href="{{ route('service') }}">Logistic Solutions</a>
                    <a class="btn btn-link" href="{{ route('service') }}">Industry solutions</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="{{ route('about') }}">About Us</a>
                    <a class="btn btn-link" href="{{ route('contact') }}">Contact Us</a>
                    <a class="btn btn-link" href="{{ route('service') }}">Our Services</a>
                    <a class="btn btn-link" href="{{ route('feature') }}">Features</a>
                    <a class="btn btn-link" href="{{ route('bookings') }}">Bookings</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="{{ route('home') }}">Logistica</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        const logisticaAlertTheme = {
            success: {
                iconColor: '#12b76a',
                title: 'Done beautifully',
                accent: '#12b76a'
            },
            error: {
                iconColor: '#f04438',
                title: 'Needs attention',
                accent: '#f04438'
            },
            warning: {
                iconColor: '#f79009',
                title: 'Please check',
                accent: '#f79009'
            }
        };

        const logisticaAlert = Swal.mixin({
            background: 'linear-gradient(145deg, #ffffff 0%, #fff9fc 42%, #f0f8ff 100%)',
            color: '#182033',
            confirmButtonColor: '#ff3f6c',
            buttonsStyling: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown animate__faster'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp animate__faster'
            },
            backdrop: 'rgba(6, 3, 21, .42)',
            customClass: {
                popup: 'logistica-swal-popup',
                title: 'logistica-swal-title',
                htmlContainer: 'logistica-swal-html',
                confirmButton: 'logistica-swal-button'
            }
        });

        function showLogisticaAlert(type, message, title = null) {
            const theme = logisticaAlertTheme[type] || logisticaAlertTheme.success;

            logisticaAlert.fire({
                icon: type,
                iconColor: theme.iconColor,
                title: title || theme.title,
                text: message,
                timer: type === 'success' ? 2600 : undefined,
                timerProgressBar: type === 'success',
                didOpen: (popup) => {
                    popup.style.setProperty('--logistica-alert-accent', theme.accent);
                }
            });
        }

        const logisticaSiteThemes = {
            light: 'Light',
            dark: 'Dark',
            ocean: 'Ocean',
            forest: 'Forest',
            sunset: 'Sunset'
        };

        function applyLogisticaTheme(theme) {
            const selectedTheme = Object.keys(logisticaSiteThemes).includes(theme) ? theme : 'light';

            document.documentElement.dataset.theme = selectedTheme;

            try {
                localStorage.setItem('logistica-theme', selectedTheme);
            } catch (error) {
                //
            }

            document.querySelectorAll('[data-theme-value]').forEach((option) => {
                const isActive = option.dataset.themeValue === selectedTheme;

                option.classList.toggle('is-active', isActive);
                option.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            });

            document.querySelectorAll('[data-theme-label]').forEach((label) => {
                label.textContent = logisticaSiteThemes[selectedTheme];
            });
        }

        document.querySelectorAll('[data-theme-value]').forEach((option) => {
            option.addEventListener('click', () => applyLogisticaTheme(option.dataset.themeValue));
        });

        applyLogisticaTheme(document.documentElement.dataset.theme);

        @if (session('success'))
            showLogisticaAlert('success', @json(session('success')));
        @endif

        @if (session('error'))
            showLogisticaAlert('error', @json(session('error')));
        @endif

        @if (session('warning'))
            showLogisticaAlert('warning', @json(session('warning')));
        @endif

        @if ($errors->any())
            const validationMessages = @json($errors->all());
            showLogisticaAlert('error', validationMessages.join('\n'), 'Form needs a quick fix');
        @endif

        document.querySelectorAll('.dashboard-menu-link').forEach((link) => {
            link.addEventListener('click', () => {
                document.querySelectorAll('.dashboard-menu-link').forEach((item) => item.classList.remove('active'));
                link.classList.add('active');
            });
        });

        document.querySelectorAll('form[data-confirm-delete]').forEach((form) => {
            form.addEventListener('submit', (event) => {
                event.preventDefault();

                const serviceName = form.dataset.serviceName || 'this service';

                logisticaAlert.fire({
                    icon: 'warning',
                    iconColor: logisticaAlertTheme.warning.iconColor,
                    title: 'Delete service?',
                    text: `${serviceName} will be removed from service lists. Existing bookings stay in records.`,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Keep it',
                    didOpen: (popup) => {
                        popup.style.setProperty('--logistica-alert-accent', logisticaAlertTheme.warning.accent);
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
