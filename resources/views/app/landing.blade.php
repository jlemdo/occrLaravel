<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabores de Origen - Del Campo a tu Mesa | Rancho Cuatro Granas</title>
    <meta name="description"
        content="Descarga la app de Sabores de Origen y disfruta productos frescos del Rancho Cuatro Granas. Lácteos artesanales, verduras orgánicas y más, directo del campo a tu hogar.">
    <meta name="keywords"
        content="productos orgánicos, lácteos artesanales, verduras frescas, delivery, sustentable, México">

    <!-- Open Graph para redes sociales -->
    <meta property="og:title" content="Sabores de Origen - Del Campo a tu Mesa">
    <meta property="og:description"
        content="Productos frescos y sustentables directo del Rancho Cuatro Granas a tu hogar">
    <meta property="og:image" content="./assets/logo.png">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://occr.pixelcrafters.digital/app">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Sabores de Origen - Del Campo a tu Mesa">
    <meta name="twitter:description" content="Productos frescos y sustentables directo del rancho">
    <meta name="twitter:image" content="./assets/logo.png">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="./assets/logo.png">
    <link rel="apple-touch-icon" href="./assets/logo.png">

    <style>
        /* Fuentes profesionales */
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Inter:wght@300;400;500;600;700&family=Raleway:wght@400;500;600;700;800&display=swap');

        /* Variables CSS */
        :root {
            --color-primary: #D27F27;
            --color-secondary: #8B5E3C;
            --color-success: #33A744;
            --color-background: #F8F6F1;
            --color-white: #FFFFFF;
            --color-text: #2F2F2F;
            --color-text-light: #6B7280;
            --color-border: rgba(139, 94, 60, 0.15);
            --color-shadow: rgba(47, 47, 47, 0.1);

            --font-heading: 'Great Vibes', cursive;
            --font-body: 'Inter', sans-serif;
            --font-brand: 'Raleway', sans-serif;

            --border-radius: 16px;
            --shadow-soft: 0 8px 32px var(--color-shadow);
            --shadow-medium: 0 12px 48px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Reset moderno */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            line-height: 1.7;
            color: var(--color-text);
            background: var(--color-background);
            overflow-x: hidden;
        }

        /* Scroll suave */
        html {
            scroll-behavior: smooth;
        }

        /* Header moderno */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--color-border);
            z-index: 1000;
            transition: var(--transition);
        }

        .header.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: var(--shadow-soft);
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
        }

        .logo-img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            transition: var(--transition);
            object-fit: cover;
            border: 2px solid var(--color-secondary);
        }

        .logo:hover .logo-img {
            transform: scale(1.05);
            border-color: var(--color-primary);
        }

        .logo-text {
            font-family: var(--font-heading);
            font-size: 1.8rem;
            color: var(--color-primary);
            font-weight: 400;
        }

        .nav-menu {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .burger-menu {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 0.5rem;
            z-index: 1001;
        }

        .burger-menu span {
            width: 25px;
            height: 3px;
            background: var(--color-text);
            margin: 3px 0;
            transition: 0.3s;
            border-radius: 2px;
        }

        .burger-menu.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .burger-menu.active span:nth-child(2) {
            opacity: 0;
        }

        .burger-menu.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        .nav-link {
            color: var(--color-text);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: var(--transition);
        }

        .nav-link:hover {
            color: var(--color-primary);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--color-primary);
            transition: var(--transition);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Hero section espectacular */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, var(--color-background) 0%, rgba(210, 127, 39, 0.08) 100%);
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23D27F27' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-text {
            animation: fadeInUp 1s ease-out;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(51, 167, 68, 0.1);
            color: var(--color-success);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(51, 167, 68, 0.2);
        }

        .hero h1 {
            font-family: var(--font-heading);
            font-size: clamp(3rem, 6vw, 5rem);
            color: var(--color-primary);
            margin-bottom: 1rem;
            line-height: 1.1;
        }

        .hero-subtitle {
            font-family: var(--font-brand);
            font-size: 1.3rem;
            color: var(--color-secondary);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .hero-description {
            font-size: 1.1rem;
            color: var(--color-text-light);
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        /* Botones modernos */
        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            color: var(--color-white);
            box-shadow: var(--shadow-soft);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        .btn-icon {
            width: 20px;
            height: 20px;
            transition: var(--transition);
        }

        .btn:hover .btn-icon {
            transform: scale(1.1);
        }

        /* Hero visual */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeInRight 1s ease-out 0.3s both;
        }

        .phone-mockup {
            position: relative;
            max-width: 320px;
            transform: perspective(1000px) rotateY(-15deg);
            transition: var(--transition);
        }

        .phone-mockup:hover {
            transform: perspective(1000px) rotateY(-10deg) translateY(-10px);
        }

        .phone-frame {
            background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
            padding: 2rem 1.5rem;
            border-radius: 3rem;
            box-shadow:
                0 0 0 8px rgba(255, 255, 255, 0.1),
                0 0 0 12px rgba(0, 0, 0, 0.1),
                var(--shadow-medium);
            position: relative;
        }

        .phone-screen {
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            border-radius: 2rem;
            aspect-ratio: 9/19.5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0;
            color: var(--color-white);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .phone-screen::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white' fill-opacity='0.1'%3E%3Cpath d='M12 2L2 7v10c0 5.55 3.84 9.74 9 11 5.16-1.26 9-5.45 9-11V7l-10-5z'/%3E%3C/svg%3E");
            background-size: 40px;
        }

        .welcome-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .app-logo {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .app-title {
            font-family: var(--font-heading);
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
        }

        .app-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .swipe-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            opacity: 0.8;
            animation: pulse 2s infinite;
        }

        .swipe-arrow {
            font-size: 1.2rem;
            animation: slideRight 1.5s ease-in-out infinite;
        }

        .swipe-text {
            font-size: 0.8rem;
            font-weight: 500;
        }

        @keyframes slideRight {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(5px);
            }
        }

        /* Floating icons */
        .floating-icon {
            position: absolute;
            font-size: 3rem;
            animation: float 6s ease-in-out infinite;
            z-index: 50;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
            opacity: 0.9;
        }

        .floating-icon-1 {
            top: 15%;
            left: 8%;
            animation-delay: 0s;
        }

        .floating-icon-2 {
            top: 45%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-icon-3 {
            bottom: 25%;
            left: 15%;
            animation-delay: 4s;
        }

        .floating-icon-4 {
            top: 70%;
            right: 20%;
            animation-delay: 1s;
        }

        /* App Features Section */
        .app-features {
            padding: 6rem 2rem;
            background: var(--color-white);
            position: relative;
        }

        .features-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .features-title {
            font-size: clamp(2.5rem, 4vw, 3.5rem);
            color: var(--color-primary);
            margin-bottom: 1rem;
            font-family: var(--font-heading);
        }

        .features-subtitle {
            font-size: 1.2rem;
            color: var(--color-text-light);
            margin-bottom: 4rem;
        }

        /* Carrusel de mockups estilizado */
        .mockups-carousel {
            position: relative;
            overflow: hidden;
            margin-bottom: 4rem;
            padding: 2rem 0;
            background: transparent;
            width: 100%;
        }

        .mockups-container {
            display: flex;
            transition: transform 0.6s ease-out;
            cursor: grab;
            align-items: center;
            width: max-content;
            touch-action: pan-x;
        }

        .mockups-container:active {
            cursor: grabbing;
        }

        .mockup-item {
            width: 160px;
            margin: 0 15px;
            background: transparent;
            transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            text-align: center;
            opacity: 0.6;
            transform: scale(0.8);
            filter: blur(2px);
            flex-shrink: 0;
        }

        .mockup-item.center {
            transform: scale(1.2);
            opacity: 1;
            filter: blur(0);
            z-index: 10;
            position: relative;
        }

        .mockup-item.side {
            transform: scale(0.9);
            opacity: 0.8;
            filter: blur(1px);
        }

        .mockup-phone {
            background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
            padding: 1rem 0.8rem;
            border-radius: 1.5rem;
            margin-bottom: 1.2rem;
            position: relative;
            aspect-ratio: 9/18;
            max-width: 160px;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .mockup-screen {
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            border-radius: 1rem;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            position: relative;
            overflow: hidden;
        }

        .mockup-screen::before {
            content: attr(data-icon);
            font-size: 2.2rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .mockup-screen img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* cubre sin deformarse */
        }

        .mockup-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 0.5rem;
        }

        .mockup-description {
            font-size: 0.9rem;
            color: var(--color-text-light);
            line-height: 1.5;
        }

        /* Descripción dinámica del carrusel */
        .carousel-description {
            text-align: center;
            margin-top: 3rem;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .carousel-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 1rem;
            transition: all 0.5s ease;
        }

        .carousel-text {
            font-size: 1rem;
            color: var(--color-text-light);
            max-width: 600px;
            line-height: 1.6;
            transition: all 0.5s ease;
        }

        /* Controles del carrusel mejorados */
        .carousel-controls {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .carousel-btn {
            background: rgba(210, 127, 39, 0.1);
            color: var(--color-primary);
            border: 2px solid var(--color-primary);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            font-size: 1.2rem;
            backdrop-filter: blur(10px);
        }

        .carousel-btn:hover {
            background: var(--color-primary);
            color: white;
            transform: scale(1.1);
        }

        /* Dots indicadores minimalistas */
        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .carousel-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(210, 127, 39, 0.3);
            cursor: pointer;
            transition: var(--transition);
        }

        .carousel-dot.active {
            background: var(--color-primary);
            transform: scale(1.5);
        }

        /* Sección de Características Destacadas */
        .features-highlights {
            padding: 6rem 2rem;
            background: var(--color-background);
            position: relative;
        }

        .highlights-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .highlights-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            margin-top: 4rem;
        }

        .highlight-card {
            background: var(--color-white);
            padding: 3rem 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-soft);
            transition: var(--transition);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .highlight-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
        }

        .highlight-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-medium);
        }

        .highlight-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .highlight-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 1rem;
        }

        .highlight-description {
            color: var(--color-text-light);
            line-height: 1.6;
        }

        /* Sección de Testimonios */
        .testimonials {
            padding: 6rem 2rem;
            background: var(--color-white);
            position: relative;
        }

        .testimonials-content {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        .testimonials-carousel {
            position: relative;
            margin-top: 4rem;
        }

        .testimonials-container {
            display: flex;
            gap: 2rem;
            transition: transform 0.6s ease;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }

        .testimonials-controls {
            display: none;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .testimonial-btn {
            background: var(--color-primary);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .testimonial-btn:hover {
            background: var(--color-secondary);
            transform: scale(1.1);
        }

        .testimonials-dots {
            display: flex;
            gap: 0.5rem;
        }

        .testimonial-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #ccc;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .testimonial-dot.active {
            background: var(--color-primary);
            transform: scale(1.2);
        }

        .testimonial-card {
            background: var(--color-background);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            position: relative;
            transition: var(--transition);
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-soft);
        }

        .testimonial-quote {
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--color-text);
            margin-bottom: 2rem;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .testimonial-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .testimonial-info h4 {
            color: var(--color-text);
            margin-bottom: 0.25rem;
            font-weight: 600;
        }

        .testimonial-info p {
            color: var(--color-text-light);
            font-size: 0.9rem;
        }

        .testimonial-rating {
            color: #fbbf24;
            margin-bottom: 1rem;
        }

        /* CTA Section */
        .cta {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, var(--color-secondary), var(--color-primary));
            color: var(--color-white);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            z-index: 1;
        }

        .cta-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
        }

        .cta h2 {
            font-size: clamp(2.5rem, 4vw, 3.5rem);
            margin-bottom: 1.5rem;
            font-family: var(--font-brand);
            font-weight: 700;
        }

        .cta p {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
        }

        .download-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 3rem;
        }

        .download-btn {
            background: var(--color-white);
            color: var(--color-secondary);
            padding: 1rem 2rem;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: var(--transition);
            box-shadow: var(--shadow-soft);
            min-width: 200px;
            justify-content: center;
        }

        .download-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
            background: var(--color-background);
        }

        /* Update badge */
        .update-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(51, 167, 68, 0.1);
            color: var(--color-success);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(51, 167, 68, 0.2);
            margin-bottom: 1rem;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        /* Footer */
        .footer {
            background: var(--color-text);
            color: var(--color-white);
            padding: 3rem 2rem 1rem;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-info {
            margin-bottom: 2rem;
        }

        .footer-info h3 {
            font-family: var(--font-heading);
            font-size: 1.5rem;
            color: var(--color-primary);
            margin-bottom: 1rem;
        }

        .footer-info p {
            opacity: 0.8;
            line-height: 1.6;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .footer-link {
            color: var(--color-white);
            text-decoration: none;
            opacity: 0.8;
            transition: var(--transition);
        }

        .footer-link:hover {
            opacity: 1;
            color: var(--color-primary);
        }

        .footer-social {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: var(--color-white);
            text-decoration: none;
            transition: var(--transition);
        }

        .social-link:hover {
            background: var(--color-primary);
            transform: translateY(-2px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1rem;
            opacity: 0.6;
            font-size: 0.9rem;
        }

        /* Efectos de entrada con Intersection Observer */
        .fade-in {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.6s ease;
        }

        .fade-in:not(.visible) {
            opacity: 1;
            transform: translateY(0);
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .scale-in {
            opacity: 1;
            transform: scale(1);
            transition: all 0.6s ease;
        }

        .scale-in:not(.visible) {
            opacity: 0;
            transform: scale(0.8);
        }

        .scale-in.visible {
            opacity: 1;
            transform: scale(1);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero {
                padding-top: 6rem;
                min-height: calc(100vh + 2rem);
            }

            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 3rem;
                padding: 0 1rem;
            }

            .phone-mockup {
                transform: none;
                max-width: 280px;
            }

            .nav-menu {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 2rem;
                z-index: 1000;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .nav-menu.active {
                display: flex;
                transform: translateX(0);
            }

            .nav-menu .nav-link {
                font-size: 1.5rem;
                font-weight: 600;
                color: var(--color-text);
                padding: 1rem 2rem;
                border-radius: 12px;
                transition: all 0.3s ease;
            }

            .nav-menu .nav-link:hover {
                background: var(--color-primary);
                color: white;
            }

            .burger-menu {
                display: flex;
            }

            /* Reposicionar iconos flotantes en móvil para que estén fuera del mockup */
            .floating-icon {
                font-size: 2.5rem;
                z-index: 100;
            }

            .floating-icon-1 {
                top: 10%;
                left: 5%;
            }

            .floating-icon-2 {
                top: 20%;
                right: 5%;
            }

            .floating-icon-3 {
                bottom: 35%;
                left: 10%;
            }

            .floating-icon-4 {
                bottom: 20%;
                right: 15%;
            }
        }

        @media (max-width: 768px) {
            .nav {
                padding: 1rem;
            }

            .hero-buttons {
                justify-content: center;
            }

            .download-buttons {
                flex-direction: column;
                align-items: center;
            }

            .download-btn {
                width: 100%;
                max-width: 300px;
            }

            .mockup-item {
                width: 140px;
                margin: 0 10px;
            }

            .highlights-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            /* Activar carrusel de testimonios en móvil */
            .testimonials-carousel {
                overflow: hidden;
                width: 100%;
                position: relative;
            }

            .testimonials-container {
                display: flex;
                flex-wrap: nowrap;
                transition: transform 0.6s ease;
            }

            .testimonial-card {
                width: 100vw;
                min-width: 100vw;
                max-width: 100vw;
                flex-shrink: 0;
                flex-grow: 0;
                box-sizing: border-box;
                padding: 1rem 2rem;
                margin: 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .testimonials-controls {
                display: flex;
            }

            .testimonials-grid {
                display: none;
            }

            .floating-element {
                font-size: 2rem;
            }
        }

        /* Animaciones */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header" id="header">
        <nav class="nav">
            <a href="#inicio" class="logo">
                <img src="./assets/logo.png" alt="Sabores de Origen" class="logo-img">
                <span class="logo-text">Sabores de Origen</span>
            </a>
            <ul class="nav-menu" id="navMenu">
                <li><a href="#inicio" class="nav-link">Inicio</a></li>
                <li><a href="#caracteristicas" class="nav-link">Características</a></li>
                <li><a href="#descargar" class="nav-link">Descargar</a></li>
            </ul>
            <div class="burger-menu" id="burgerMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="inicio">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <span>🌱</span>
                    <span>100% Productos Sustentables</span>
                </div>
                <h1>Sabores de Origen</h1>
                <p class="hero-subtitle">Lácteos Artesanales • Por un mundo sustentable</p>
                <p class="hero-description">
                    Descubre la frescura auténtica de nuestros lácteos artesanales. Quesos finos,
                    leches naturales, yogurts espesos y productos únicos, elaborados con amor y
                    tradición, directo de nuestro taller quesero a tu mesa.
                </p>

                <div class="delivery-info"
                    style="margin-bottom: 1.5rem; padding: 1rem; background: rgba(51, 167, 68, 0.1); border-radius: 12px; border-left: 4px solid var(--color-success);">
                    <p style="margin: 0; color: var(--color-success); font-weight: 600; font-size: 0.95rem;">
                        📍 Realizamos entregas en <strong>Ciudad de México y Estado de México</strong>
                    </p>
                </div>
                <div class="hero-buttons">
                    <a href="#descargar" class="btn btn-primary">
                        <svg class="btn-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" />
                        </svg>
                        Descargar App
                    </a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="phone-mockup">
                    <div class="phone-frame">
                        <div class="phone-screen">
                            <video autoplay muted loop playsinline
                                style="
                                    width: 100%;
                                    height: 100%;
                                    object-fit: cover;
                                    border-radius: 2rem;
                                ">
                                <source src="./assets/welcome.mp4" type="video/mp4">
                            </video>

                            <!-- Overlay con texto blanco encima del video -->
                            <div
                                style="
                                position: absolute;
                                top: 0;
                                left: 0;
                                right: 0;
                                bottom: 0;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: center;
                                background: rgba(0, 0, 0, 0.5);
                                border-radius: 2rem;
                                z-index: 100;
                            ">
                                <!-- Logo blanco arriba -->
                                <img src="./assets/logo-white.png" alt="Logo"
                                    style="
                                    width: 70px;
                                    height: 70px;
                                    border-radius: 50%;
                                    margin-bottom: 1rem;
                                    box-shadow: 0 4px 20px rgba(0,0,0,0.5);
                                ">

                                <!-- Sabores de Origen en el medio -->
                                <h3
                                    style="
                                    font-family: var(--font-heading);
                                    font-size: 1.6rem;
                                    color: white !important;
                                    margin-bottom: 1rem;
                                    font-weight: 600;
                                    text-align: center;
                                    text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
                                ">
                                    Sabores de Origen</h3>

                                <!-- App disponible abajo -->
                                <p
                                    style="
                                    font-size: 0.9rem;
                                    color: white !important;
                                    font-weight: 500;
                                    text-align: center;
                                    text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
                                ">
                                    App disponible para Android e iOS</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Iconos flotantes distribuidos alrededor -->
                <div class="floating-icon floating-icon-1">🥛</div>
                <div class="floating-icon floating-icon-2">🧀</div>
                <div class="floating-icon floating-icon-3">🥛</div>
                <div class="floating-icon floating-icon-4">🧀</div>
            </div>
        </div>
    </section>

    <!-- App Features Section -->
    <section class="app-features" id="caracteristicas">
        <div class="features-content">
            <h2 class="features-title fade-in visible">Explora la App</h2>
            <p class="features-subtitle fade-in visible">Descubre todas las funciones que hacen única nuestra experiencia</p>

            <div class="mockups-carousel">
                <div class="mockups-container" id="mockupsContainer">
                    <!-- Mockup 1: Productos -->
                    <div class="mockup-item" data-title="Catálogo de Productos"
                        data-description="Explora nuestra amplia variedad de lácteos artesanales, quesos finos y productos frescos directos del rancho.">
                        <div class="mockup-phone">
                            <div class="mockup-screen" data-icon="">
                                <img src="./assets/carrusel/1.jpg" alt="Imagen de mockup">
                            </div>
                        </div>
                    </div>

                    <!-- Mockup 2: Carrito -->
                    <div class="mockup-item" data-title="Carrito Inteligente"
                        data-description="Gestiona tus compras fácilmente, guarda favoritos y calcula automáticamente el envío a tu ubicación.">
                        <div class="mockup-phone">
                            <div class="mockup-screen" data-icon="">
                                <img src="./assets/carrusel/2.jpg" alt="Imagen de mockup">
                            </div>
                        </div>
                    </div>

                    <!-- Mockup 3: Ubicación -->
                    <div class="mockup-item" data-title="Entrega a Domicilio"
                        data-description="Recibe tus productos frescos directamente en tu hogar en CDMX y Estado de México con seguimiento en tiempo real.">
                        <div class="mockup-phone">
                            <div class="mockup-screen" data-icon="">
                                <img src="./assets/carrusel/3.jpg" alt="Imagen de mockup">
                            </div>
                        </div>
                    </div>

                    <!-- Mockup 4: Pedidos -->
                    <div class="mockup-item" data-title="Historial de Pedidos"
                        data-description="Consulta el estado de tus pedidos, repite compras anteriores y mantén un registro completo de tus compras.">
                        <div class="mockup-phone">
                           <div class="mockup-screen" data-icon="">
                                <img src="./assets/carrusel/4.jpg" alt="Imagen de mockup">
                            </div>
                        </div>
                    </div>

                    <!-- Mockup 5: Perfil -->
                    <div class="mockup-item" data-title="Perfil Personal"
                        data-description="Gestiona tu información, direcciones de entrega, métodos de pago y preferencias de productos.">
                        <div class="mockup-phone">
                            <div class="mockup-screen" data-icon="">
                                <img src="./assets/carrusel/5.jpg" alt="Imagen de mockup">
                            </div>
                        </div>
                    </div>

                    <!-- Mockup 6: Pagos -->
                    <div class="mockup-item" data-title="Pagos Seguros"
                        data-description="Realiza pagos de forma segura con tarjeta, transferencia o efectivo contra entrega. 100% protegido.">
                        <div class="mockup-phone">
                            <div class="mockup-screen" data-icon="">
                                <img src="./assets/carrusel/6.jpg" alt="Imagen de mockup">
                            </div>
                        </div>
                    </div>

                    <!-- Mockup 7: Notificaciones -->
                    <div class="mockup-item" data-title="Notificaciones"
                        data-description="Recibe alertas de ofertas especiales, nuevos productos y actualizaciones de tus pedidos en tiempo real.">
                        <div class="mockup-phone">
                            <div class="mockup-screen" data-icon="">
                                <img src="./assets/carrusel/7.jpg" alt="Imagen de mockup">
                            </div>
                        </div>
                    </div>

                    <!-- Mockup 8: Calidad -->
                    <div class="mockup-item" data-title="Garantía de Calidad"
                        data-description="Productos con certificación de frescura, trazabilidad completa y garantía de satisfacción al 100%.">
                        <div class="mockup-phone">
                            <div class="mockup-screen" data-icon="">
                                <img src="./assets/carrusel/8.jpg" alt="Imagen de mockup">
                            </div>
                        </div>
                    </div>

                    <!-- Mockup 9: Soporte -->
                    <div class="mockup-item" data-title="Soporte 24/7"
                        data-description="Chat en vivo, WhatsApp y soporte telefónico para resolver cualquier duda o problema de manera inmediata.">
                        <div class="mockup-phone">
                           <div class="mockup-screen" data-icon="">
                                <img src="./assets/carrusel/9.jpg" alt="Imagen de mockup">
                            </div>
                        </div>
                    </div>

                    <!-- Mockup 10: Sustentabilidad -->
                    <div class="mockup-item" data-title="Impacto Sustentable"
                        data-description="Conoce el origen de cada producto, nuestras prácticas sustentables y el impacto positivo de tu compra.">
                        <div class="mockup-phone">
                            <div class="mockup-screen" data-icon="">
                                <img src="./assets/carrusel/10.jpg" alt="Imagen de mockup">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Descripción dinámica -->
                <div class="carousel-description">
                    <h3 class="carousel-title" id="carouselTitle">Catálogo de Productos</h3>
                    <p class="carousel-text" id="carouselText">Explora nuestra amplia variedad de lácteos artesanales,
                        quesos finos y productos frescos directos del rancho.</p>
                </div>

                <!-- Controles del carrusel -->
                <div class="carousel-controls">
                    <button class="carousel-btn" id="prevBtn" onclick="moveCarousel(-1)">‹</button>
                    <button class="carousel-btn" id="nextBtn" onclick="moveCarousel(1)">›</button>
                </div>

                <!-- Indicadores de puntos -->
                <div class="carousel-dots" id="carouselDots"></div>
            </div>
        </div>
    </section>

    <!-- Features Highlights Section -->
    <section class="features-highlights">
        <div class="highlights-content">
            <h2 class="features-title fade-in">¿Por qué elegir Sabores de Origen?</h2>
            <p class="features-subtitle fade-in">La mejor experiencia en productos lácteos artesanales</p>

            <div class="highlights-grid">
                <div class="highlight-card scale-in">
                    <span class="highlight-icon">🌱</span>
                    <h3 class="highlight-title">100% Sustentable</h3>
                    <p class="highlight-description">Productos eco-amigables con prácticas sostenibles que cuidan el
                        medio ambiente y apoyan a productores locales.</p>
                </div>

                <div class="highlight-card scale-in">
                    <span class="highlight-icon">🚚</span>
                    <h3 class="highlight-title">Entrega Rápida</h3>
                    <p class="highlight-description">Delivery en CDMX y Estado de México en menos de 24 horas.
                        Productos frescos directo a tu puerta.</p>
                </div>

                <div class="highlight-card scale-in">
                    <span class="highlight-icon">🏆</span>
                    <h3 class="highlight-title">Calidad Premium</h3>
                    <p class="highlight-description">Lácteos artesanales con certificación de calidad, elaborados con
                        técnicas tradicionales y los mejores ingredientes.</p>
                </div>

                <div class="highlight-card scale-in">
                    <span class="highlight-icon">💰</span>
                    <h3 class="highlight-title">Precios Justos</h3>
                    <p class="highlight-description">Precios competitivos sin intermediarios. Apoya directamente a los
                        productores locales.</p>
                </div>

                <div class="highlight-card scale-in">
                    <span class="highlight-icon">📱</span>
                    <h3 class="highlight-title">App Intuitiva</h3>
                    <p class="highlight-description">Interfaz fácil de usar, diseñada para una experiencia de compra
                        fluida y agradable.</p>
                </div>

                <div class="highlight-card scale-in">
                    <span class="highlight-icon">🔒</span>
                    <h3 class="highlight-title">Pagos Seguros</h3>
                    <p class="highlight-description">Transacciones 100% seguras con múltiples métodos de pago y
                        protección de datos.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="testimonials-content">
            <h2 class="features-title">Lo que dicen nuestros clientes</h2>
            <p class="features-subtitle">Miles de familias confían en nosotros</p>

            <div class="testimonials-carousel">
                <div class="testimonials-container" id="testimonialsContainer">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">★★★★★</div>
                        <p class="testimonial-quote">"Los mejores lácteos que he probado. La frescura se nota desde el
                            primer sorbo. Mi familia está encantada con la calidad."</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">M</div>
                            <div class="testimonial-info">
                                <h4>María González</h4>
                                <p>Madre de familia - Coyoacán</p>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-rating">★★★★★</div>
                        <p class="testimonial-quote">"La app es súper fácil de usar y el delivery siempre llega a tiempo.
                            Los quesos artesanales son espectaculares."</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">C</div>
                            <div class="testimonial-info">
                                <h4>Carlos Ramírez</h4>
                                <p>Chef - Polanco</p>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-rating">★★★★★</div>
                        <p class="testimonial-quote">"Excelente servicio y productos de primera calidad. Es genial saber
                            que apoyo directamente a los productores locales."</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">A</div>
                            <div class="testimonial-info">
                                <h4>Ana Martínez</h4>
                                <p>Nutrióloga - Roma Norte</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controles para móvil -->
                <div class="testimonials-controls">
                    <button class="testimonial-btn" id="prevTestimonial" onclick="moveTestimonials(-1)">‹</button>
                    <div class="testimonials-dots" id="testimonialsDots"></div>
                    <button class="testimonial-btn" id="nextTestimonial" onclick="moveTestimonials(1)">›</button>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta" id="descargar">
        <div class="cta-content">
            {{-- <div class="update-badge pulse">
                <span>🔄</span>
                <span>Actualizaciones automáticas incluidas</span>
            </div> --}}
            <h2>¡Descarga ya la App!</h2>
            <p>
                Únete a las miles de familias que ya disfrutan de productos frescos
                y sustentables directo del campo a su mesa.
            </p>

            <div class="download-buttons">
                <a href="#android-download" class="download-btn" onclick="handleAndroidDownload()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M17.523 15.3414c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4486.9993.9993s-.4482.9997-.9993.9997zm-11.046 0c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4486.9993.9993s-.4482.9997-.9993.9997zm11.4045-6.02l1.9973-3.4592c.2539-.44.1034-.9995-.3366-1.2534-.44-.2539-.9995-.1034-1.2534.3366l-2.0552 3.5651c-1.5667-.6653-3.3308-.9956-5.1926-.9956s-3.6259.3303-5.1926.9956l-2.0552-3.5651c-.2539-.44-.8134-.5905-1.2534-.3366-.44.2539-.5905.8134-.3366 1.2534l1.9973 3.4592c-2.9621 1.6025-4.9484 4.3547-4.9484 7.4798h20c0-3.1251-1.9863-5.8773-4.9484-7.4798z" />
                    </svg>
                    Descargar para Android
                </a>

                <a href="https://apps.apple.com/mx/app/sabores-de-origen/id123456789" class="download-btn"
                    target="_blank">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z" />
                    </svg>
                    Descargar en App Store
                </a>
            </div>

            <p style="opacity: 0.8; font-size: 0.9rem; margin-top: 1rem;">
                ✅ Instalación directa • ✅ Actualizaciones automáticas
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-info">
                <h3>Sabores de Origen</h3>
                <p>Lácteos artesanales del campo a tu mesa. Productos frescos, sustentables y de la más alta calidad.
                </p>
            </div>

            <div class="footer-links">
                <a href="#inicio" class="footer-link">Inicio</a>
                <a href="#caracteristicas" class="footer-link">Características</a>
                <a href="#descargar" class="footer-link">Descargar</a>
                {{-- <a href="#" class="footer-link">Privacidad</a>
                <a href="#" class="footer-link">Términos</a>
                <a href="#" class="footer-link">Soporte</a> --}}
            </div>

            {{-- <div class="footer-social">
                <a href="#" class="social-link" title="Facebook">📘</a>
                <a href="#" class="social-link" title="Instagram">📷</a>
                <a href="#" class="social-link" title="WhatsApp">💬</a>
                <a href="#" class="social-link" title="Twitter">🐦</a>
            </div> --}}

            <div class="footer-bottom">
                <p>&copy; 2025 Sabores de Origen. Todos los derechos reservados.</p>
                <p>Hecho con 💚 para apoyar productores locales</p>
            </div>
        </div>
    </footer>

    <script>
        // Header scroll effect
        window.addEventListener("scroll", () => {
            const header = document.getElementById("header");
            if (window.scrollY > 100) {
                header.classList.add("scrolled");
            } else {
                header.classList.remove("scrolled");
            }
        });

        // Detección de plataforma y descarga
        function detectPlatform() {
            const userAgent = navigator.userAgent || navigator.vendor || window.opera;

            if (/android/i.test(userAgent)) {
                return "android";
            }
            if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                return "ios";
            }
            return "desktop";
        }

        function handleAndroidDownload() {
            const platform = detectPlatform();

            if (platform === "android") {
                showAndroidOnlyModal();
            } else {
                showPlatformInfo();
            }
        }

        function showAndroidOnlyModal() {
            const modal = document.createElement("div");
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.7);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10000;
                backdrop-filter: blur(10px);
            `;

            modal.innerHTML = `
                <div style="
                    background: white;
                    padding: 2.5rem;
                    border-radius: 20px;
                    max-width: 400px;
                    margin: 1rem;
                    text-align: center;
                    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                ">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🤖</div>
                    <h3 style="color: #D27F27; margin-bottom: 1rem;">Descarga para Android</h3>
                    <p style="margin-bottom: 2rem; color: #6B7280;">
                        ¡Descarga directamente la app de Sabores de Origen para Android!
                    </p>
                    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                        <button onclick="downloadAPK()"
                                style="
                                    padding: 0.8rem 1.5rem;
                                    background: linear-gradient(135deg, #34D399, #10B981);
                                    color: white;
                                    border: none;
                                    border-radius: 12px;
                                    cursor: pointer;
                                    font-weight: 600;
                                    display: flex;
                                    align-items: center;
                                    gap: 0.5rem;
                                ">
                            📥 Descargar APK
                        </button>
                        <button onclick="this.closest('div').parentElement.remove()"
                                style="
                                    padding: 0.8rem 1.5rem;
                                    background: #E5E7EB;
                                    color: #6B7280;
                                    border: none;
                                    border-radius: 12px;
                                    cursor: pointer;
                                    font-weight: 600;
                                ">
                            Cancelar
                        </button>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);
        }

        function showDownloadModal() {
            const modal = document.createElement("div");
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.7);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10000;
                backdrop-filter: blur(10px);
            `;

            modal.innerHTML = `
                <div style="
                    background: white;
                    padding: 2.5rem;
                    border-radius: 20px;
                    max-width: 500px;
                    margin: 1rem;
                    text-align: center;
                    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                ">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">📱</div>
                    <h3 style="color: #D27F27; margin-bottom: 1rem; font-size: 1.5rem;">¡Descarga Disponible!</h3>
                    <p style="margin-bottom: 2rem; color: #6B7280; line-height: 1.6;">
                        Tu app está lista para descargar. Sistema de actualización automática incluido
                        para mantenerte siempre al día con las últimas funciones.
                    </p>
                    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                        <button onclick="this.closest('div').parentElement.remove()"
                                style="
                                    padding: 0.8rem 1.5rem;
                                    background: #f3f4f6;
                                    color: #6B7280;
                                    border: none;
                                    border-radius: 12px;
                                    cursor: pointer;
                                    font-weight: 600;
                                    transition: all 0.3s ease;
                                "
                                onmouseover="this.style.background='#e5e7eb'"
                                onmouseout="this.style.background='#f3f4f6'">
                            Más tarde
                        </button>
                        <button onclick="downloadAPK()"
                                style="
                                    padding: 0.8rem 1.5rem;
                                    background: linear-gradient(135deg, #D27F27, #8B5E3C);
                                    color: white;
                                    border: none;
                                    border-radius: 12px;
                                    cursor: pointer;
                                    font-weight: 600;
                                    transition: all 0.3s ease;
                                "
                                onmouseover="this.style.transform='translateY(-2px)'"
                                onmouseout="this.style.transform='translateY(0)'">
                            📥 Descargar APK
                        </button>
                        <button onclick="contactSupport()"
                                style="
                                    padding: 0.8rem 1.5rem;
                                    background: #33A744;
                                    color: white;
                                    border: none;
                                    border-radius: 12px;
                                    cursor: pointer;
                                    font-weight: 600;
                                    transition: all 0.3s ease;
                                "
                                onmouseover="this.style.transform='translateY(-2px)'"
                                onmouseout="this.style.transform='translateY(0)'">
                            💬 Soporte WhatsApp
                        </button>
                    </div>
                    <p style="margin-top: 1.5rem; font-size: 0.85rem; color: #9CA3AF;">
                        ✅ Descarga segura • ✅ Sin virus • ✅ Actualizaciones automáticas
                    </p>
                </div>
            `;

            document.body.appendChild(modal);
        }

        function showPlatformInfo() {
            const modal = document.createElement("div");
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.7);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10000;
                backdrop-filter: blur(10px);
            `;

            modal.innerHTML = `
                <div style="
                    background: white;
                    padding: 2.5rem;
                    border-radius: 20px;
                    max-width: 400px;
                    margin: 1rem;
                    text-align: center;
                    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                ">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🤖</div>
                    <h3 style="color: #D27F27; margin-bottom: 1rem;">Solo disponible para Android</h3>
                    <p style="margin-bottom: 2rem; color: #6B7280;">
                        Para descargar la app, accede a esta página desde tu dispositivo Android.
                    </p>
                    <button onclick="this.closest('div').parentElement.remove()"
                            style="
                                padding: 0.8rem 2rem;
                                background: linear-gradient(135deg, #D27F27, #8B5E3C);
                                color: white;
                                border: none;
                                border-radius: 12px;
                                cursor: pointer;
                                font-weight: 600;
                            ">
                        Entendido
                    </button>
                </div>
            `;

            document.body.appendChild(modal);
        }

        function downloadAPK() {
            // URL de descarga real configurada
            const currentDomain = window.location.origin;
            window.open(currentDomain + "/downloads/sabores-de-origen-latest.apk", "_blank");

            // Cerrar modal y mostrar instrucciones
            const modals = document.querySelectorAll("[style*=\"z-index: 10000\"]");
            modals.forEach(modal => modal.remove());

            setTimeout(() => {
                alert(
                    "📥 Descarga iniciada\n\n✅ Ve a tus notificaciones\n✅ Toca el archivo descargado\n✅ Permite 'Instalar apps desconocidas' si se solicita\n✅ Sigue las instrucciones de instalación");
            }, 1000);
        }

        function contactSupport() {
            window.open(
                "https://wa.me/5215512345678?text=Hola,%20necesito%20ayuda%20para%20descargar%20la%20app%20Sabores%20de%20Origen",
                "_blank");
        }

        // Carrusel avanzado con drag y infinite scroll
        let currentSlide = 0;
        let totalSlides = 0;
        let isAnimating = false;
        let startX = 0;
        let currentX = 0;
        let isDragging = false;

        function initCarousel() {
            const container = document.getElementById('mockupsContainer');
            const items = container.querySelectorAll('.mockup-item');
            totalSlides = items.length;

            // Duplicar elementos para infinite scroll
            items.forEach(item => {
                const clone = item.cloneNode(true);
                container.appendChild(clone);
            });

            // Crear indicadores
            const dotsContainer = document.getElementById('carouselDots');
            dotsContainer.innerHTML = '';
            for (let i = 0; i < totalSlides; i++) {
                const dot = document.createElement('div');
                dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
                dot.onclick = () => goToSlide(i);
                dotsContainer.appendChild(dot);
            }

            // Configurar eventos de drag
            setupDragEvents(container);

            // Posicionar inicialmente
            updateCarousel();
        }

        function setupDragEvents(container) {
            // Mouse events
            container.addEventListener('mousedown', startDrag);
            container.addEventListener('mousemove', drag);
            container.addEventListener('mouseup', endDrag);
            container.addEventListener('mouseleave', endDrag);

            // Touch events
            container.addEventListener('touchstart', startDrag, {
                passive: false
            });
            container.addEventListener('touchmove', drag, {
                passive: false
            });
            container.addEventListener('touchend', endDrag);
        }

        function startDrag(e) {
            if (isAnimating) return;
            const container = document.getElementById('mockupsContainer');
            isDragging = true;
            startX = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
            container.style.cursor = 'grabbing';
        }

        function drag(e) {
            if (!isDragging || isAnimating) return;
            e.preventDefault();
            currentX = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
            const diffX = currentX - startX;

            if (Math.abs(diffX) > 50) {
                if (diffX > 0) {
                    moveCarousel(-1);
                } else {
                    moveCarousel(1);
                }
                isDragging = false;
            }
        }

        function endDrag() {
            isDragging = false;
            const container = document.getElementById('mockupsContainer');
            container.style.cursor = 'grab';
        }

        function moveCarousel(direction) {
            if (isAnimating) return;
            isAnimating = true;

            currentSlide += direction;

            if (currentSlide < 0) {
                currentSlide = totalSlides - 1;
            } else if (currentSlide >= totalSlides) {
                currentSlide = 0;
            }

            updateCarousel();
            setTimeout(() => {
                isAnimating = false;
            }, 800);
        }

        function goToSlide(slideIndex) {
            if (isAnimating) return;
            currentSlide = slideIndex;
            updateCarousel();
        }

        function updateCarousel() {
            const container = document.getElementById('mockupsContainer');
            const items = container.querySelectorAll('.mockup-item');
            const wrapper = container.parentElement;

            if (items.length === 0) return;

            // Obtener dimensiones responsivas
            const wrapperWidth = wrapper.offsetWidth;
            const itemWidth = window.innerWidth <= 768 ? 140 : 160;
            const margin = window.innerWidth <= 768 ? 10 : 15;
            const totalItemWidth = itemWidth + (margin * 2);

            // Calcular el desplazamiento para centrar el elemento actual
            const centerOffset = (wrapperWidth / 2) - (itemWidth / 2);
            const translateX = centerOffset - (currentSlide * totalItemWidth);

            container.style.transform = `translateX(${translateX}px)`;

            // Actualizar clases de los elementos
            items.forEach((item, index) => {
                const actualIndex = index % totalSlides;
                item.classList.remove('center', 'side');

                if (actualIndex === currentSlide) {
                    item.classList.add('center');
                } else if (
                    actualIndex === (currentSlide - 1 + totalSlides) % totalSlides ||
                    actualIndex === (currentSlide + 1) % totalSlides
                ) {
                    item.classList.add('side');
                }
            });

            // Actualizar texto dinámico
            updateCarouselText();

            // Actualizar indicadores
            const dots = document.querySelectorAll('.carousel-dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        function updateCarouselText() {
            const container = document.getElementById('mockupsContainer');
            const titleElement = document.getElementById('carouselTitle');
            const textElement = document.getElementById('carouselText');

            if (!container || !titleElement || !textElement) return;

            // Buscar el elemento actual considerando que hay elementos duplicados
            const allItems = container.querySelectorAll('.mockup-item');
            const currentItem = allItems[currentSlide];

            if (!currentItem) return;

            const title = currentItem.getAttribute('data-title');
            const description = currentItem.getAttribute('data-description');

            if (!title || !description) return;

            // Añadir transiciones suaves si no las tiene
            if (!titleElement.style.transition) {
                titleElement.style.transition = 'opacity 0.3s ease';
                textElement.style.transition = 'opacity 0.3s ease';
            }

            // Animación de fade out
            titleElement.style.opacity = '0';
            textElement.style.opacity = '0';

            setTimeout(() => {
                titleElement.textContent = title;
                textElement.textContent = description;

                // Animación de fade in
                titleElement.style.opacity = '1';
                textElement.style.opacity = '1';
            }, 300);
        }

        // Auto-slide cada 5 segundos
        function startAutoSlide() {
            setInterval(() => {
                if (!isDragging && !isAnimating) {
                    moveCarousel(1);
                }
            }, 5000);
        }

        // Navegación suave mejorada
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerHeight = document.querySelector('.header').offsetHeight;
                    const targetPosition = target.offsetTop - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Intersection Observer para animaciones de entrada
        function initScrollAnimations() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            // Observar elementos con animaciones
            document.querySelectorAll('.fade-in, .scale-in').forEach(el => {
                observer.observe(el);
            });
        }

        // Funciones de utilidad mejoradas
        function addScrollToTopButton() {
            const scrollBtn = document.createElement('button');
            scrollBtn.innerHTML = '↑';
            scrollBtn.style.cssText = `
                position: fixed;
                bottom: 2rem;
                right: 2rem;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
                color: white;
                border: none;
                cursor: pointer;
                font-size: 1.2rem;
                z-index: 1000;
                opacity: 0;
                transform: translateY(100px);
                transition: all 0.3s ease;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            `;

            scrollBtn.onclick = () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            };

            document.body.appendChild(scrollBtn);

            // Mostrar/ocultar botón según scroll
            window.addEventListener('scroll', () => {
                if (window.scrollY > 500) {
                    scrollBtn.style.opacity = '1';
                    scrollBtn.style.transform = 'translateY(0)';
                } else {
                    scrollBtn.style.opacity = '0';
                    scrollBtn.style.transform = 'translateY(100px)';
                }
            });
        }

        // Performance y lazy loading mejorado
        function optimizeImages() {
            const images = document.querySelectorAll('img');
            if ('loading' in HTMLImageElement.prototype) {
                images.forEach(img => {
                    img.loading = 'lazy';
                });
            }
        }

        // Analytics básico
        function trackUserInteraction(action, element) {
            console.log(`User action: ${action} on ${element}`);
            // Aquí puedes agregar tracking real (Google Analytics, etc.)
        }

        // Mejorar accesibilidad
        function enhanceAccessibility() {

            // Agregar aria-labels para mejor accesibilidad
            document.querySelectorAll('.carousel-btn').forEach(btn => {
                btn.setAttribute('aria-label', btn.id === 'prevBtn' ? 'Anterior' : 'Siguiente');
            });
        }

        // Inicialización
        document.addEventListener("DOMContentLoaded", function() {
            console.log("🌾 Sabores de Origen Landing Page cargada en /app");

            // Inicializar todos los componentes
            initCarousel();
            startAutoSlide();
            initScrollAnimations();
            addScrollToTopButton();
            optimizeImages();
            enhanceAccessibility();

            // Track page load
            trackUserInteraction('page_load', 'landing_page');

            // Recalcular carousel al redimensionar ventana
            window.addEventListener('resize', () => {
                updateCarousel();
            });

            // Inicializar menú hamburguesa
            initBurgerMenu();

            // Inicializar carrusel de testimonios en móvil
            if (window.innerWidth <= 1024) {
                initTestimonialsCarousel();
            }
        });

        // Función para el menú hamburguesa
        function initBurgerMenu() {
            const burgerMenu = document.getElementById('burgerMenu');
            const navMenu = document.getElementById('navMenu');

            burgerMenu.addEventListener('click', () => {
                burgerMenu.classList.toggle('active');
                navMenu.classList.toggle('active');
            });

            // Cerrar menú al hacer click en un enlace
            const navLinks = navMenu.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    burgerMenu.classList.remove('active');
                    navMenu.classList.remove('active');
                });
            });

            // Cerrar menú al hacer click fuera
            document.addEventListener('click', (e) => {
                if (!burgerMenu.contains(e.target) && !navMenu.contains(e.target)) {
                    burgerMenu.classList.remove('active');
                    navMenu.classList.remove('active');
                }
            });
        }

        // Carrusel de testimonios
        let currentTestimonial = 0;
        let totalTestimonials = 0;

        function initTestimonialsCarousel() {
            const container = document.getElementById('testimonialsContainer');
            const dotsContainer = document.getElementById('testimonialsDots');
            const cards = container.querySelectorAll('.testimonial-card');

            totalTestimonials = cards.length;

            // Crear indicadores
            dotsContainer.innerHTML = '';
            for (let i = 0; i < totalTestimonials; i++) {
                const dot = document.createElement('div');
                dot.className = 'testimonial-dot' + (i === 0 ? ' active' : '');
                dot.onclick = () => goToTestimonial(i);
                dotsContainer.appendChild(dot);
            }

            updateTestimonials();
        }

        function moveTestimonials(direction) {
            currentTestimonial += direction;

            if (currentTestimonial < 0) {
                currentTestimonial = totalTestimonials - 1;
            } else if (currentTestimonial >= totalTestimonials) {
                currentTestimonial = 0;
            }

            updateTestimonials();
        }

        function goToTestimonial(index) {
            currentTestimonial = index;
            updateTestimonials();
        }

        function updateTestimonials() {
            const container = document.getElementById('testimonialsContainer');
            const dots = document.querySelectorAll('.testimonial-dot');

            if (container) {
                // Cada card ocupa 100vw, entonces movemos 100vw por cada card
                const translateX = -currentTestimonial * 100;
                container.style.transform = `translateX(${translateX}vw)`;
            }

            // Actualizar indicadores
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentTestimonial);
            });
        }
    </script>
</body>

</html>
