<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $name }} - {{ $title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(-45deg, #0A192F 0%, #1a2a4a 25%, #0f3a5f 50%, #1a2a4a 75%, #0A192F 100%);
            background-size: 400% 400%;
            animation: meshGradient 15s ease infinite;
            color: #FFFFFF;
            overflow-x: hidden;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        @keyframes meshGradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(10, 25, 47, 0.5);
            padding: 20px 0;
            z-index: 1000;
            backdrop-filter: blur(8px);
            box-shadow: none;
            transition: all 0.3s ease;
        }

        nav.scrolled {
            background: rgba(10, 25, 47, 0.95);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
        }

        nav .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        nav .logo {
            display: none;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 40px;
        }

        nav ul li a {
            color: #8892B0;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        nav ul li a:hover {
            color: #64FFDA;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        section {
            padding: 100px 0;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: transparent;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 50%;
            right: 10%;
            transform: translate(0, -50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(100, 255, 218, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        /* Two-column hero layout */
        .hero-inner {
            display: flex;
            align-items: center;
            gap: 40px;
            justify-content: space-between;
            max-width: 1100px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* Decorative circle element top-left */
        .hero-inner::before {
            content: '';
            position: absolute;
            top: -40px;
            left: -40px;
            width: 150px;
            height: 150px;
            border: 2px solid #64FFDA;
            opacity: 0.15;
            border-radius: 50%;
            animation: floatDecoration 6s ease-in-out infinite;
            z-index: -1;
        }

        /* Decorative line element bottom-right */
        .hero-inner::after {
            content: '';
            position: absolute;
            bottom: -60px;
            right: -60px;
            width: 200px;
            height: 2px;
            background: linear-gradient(90deg, #64FFDA 0%, transparent 100%);
            opacity: 0.3;
            animation: slideRight 4s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes floatDecoration {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes slideRight {
            0%, 100% {
                transform: translateX(0);
            }
            50% {
                transform: translateX(30px);
            }
        }

        .hero-left {
            flex: 1 1 60%;
            color: #FFFFFF;
            text-align: left;
        }

        .hero-right {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            max-width: 450px;
            max-height: 450px;
            position: relative;
        }

        /* Decorative circle behind photo */
        .hero-right::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(100, 255, 218, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .profile-photo {
            display: block;
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 450px;
            object-fit: contain;
            border-radius: 0;
            border: none;
            box-shadow: none;
            background: transparent;
            transform: translateY(12px) scale(1);
            transition: transform 700ms cubic-bezier(.2, .9, .2, 1);
        }

        .profile-photo-link {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            border-radius: 0;
        }

        .profile-photo-link:hover .profile-photo {
            filter: brightness(1.1);
            transform: scale(1.02);
        }

        .profile-photo.is-visible {
            transform: translateY(0) scale(1);
        }

        /* gentle floating animation while visible */
        .profile-photo.float {
            animation: floatPhoto 6s ease-in-out infinite;
        }

        @keyframes floatPhoto {
            0% {
                transform: translateY(0) scale(1)
            }

            50% {
                transform: translateY(-12px) scale(1)
            }

            100% {
                transform: translateY(0) scale(1)
            }
        }

        .hero h1 {
            font-size: 72px;
            font-weight: 800;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #64FFDA 0%, #FFFFFF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
            letter-spacing: -1px;
            filter: drop-shadow(0 0 20px rgba(100, 255, 218, 0.3)) drop-shadow(0 0 40px rgba(100, 255, 218, 0.1));
            animation: glow 3s ease-in-out infinite;
        }

        @keyframes glow {
            0%, 100% {
                filter: drop-shadow(0 0 20px rgba(100, 255, 218, 0.3)) drop-shadow(0 0 40px rgba(100, 255, 218, 0.1));
            }
            50% {
                filter: drop-shadow(0 0 30px rgba(100, 255, 218, 0.5)) drop-shadow(0 0 60px rgba(100, 255, 218, 0.2));
            }
        }

        .hero h2 {
            font-size: 24px;
            color: #8892B0;
            font-weight: 500;
            margin-bottom: 25px;
            line-height: 1.5;
            letter-spacing: 0.5px;
            opacity: 0;
            animation: subtitleSlide 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.15s forwards;
            position: relative;
            padding-bottom: 15px;
        }

        .hero h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #64FFDA 0%, transparent 100%);
            border-radius: 1px;
        }

        @keyframes subtitleSlide {
            0% {
                opacity: 0;
                transform: translateY(25px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero .tagline {
            font-size: 18px;
            background: linear-gradient(135deg, #CCD6F6 0%, #64FFDA 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 40px;
            font-style: italic;
            font-weight: 400;
            line-height: 1.6;
            letter-spacing: 0.5px;
            opacity: 0;
            animation: subtitleSlide 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.25s forwards;
            padding-left: 15px;
            border-left: 3px solid #64FFDA;
        }

        .hero-badges {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-bottom: 40px;
        }

        /* Animated name gradient with typing effect */
        .name-animated {
            display: inline-block;
            /* Subtle, clean gradient — no shadow or stroke per request */
            background: linear-gradient(90deg, #64FFDA 0%, #E6F9F2 60%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 900;
            line-height: 1.05;
            letter-spacing: -0.5px;
        }

        @keyframes typewriter {
            0% {
                width: 0;
            }
            100% {
                width: 100%;
            }
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        /* Generic entrance animation for many elements */
        [data-animate] {
            opacity: 0;
            transform: translateY(18px) scale(0.99);
            transition: opacity 450ms cubic-bezier(.2, .9, .2, 1), transform 450ms cubic-bezier(.2, .9, .2, 1);
        }

        [data-animate].is-visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Staggered animation for hero elements */
        [data-animate="title"] {
            animation: heroTitleSlide 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            opacity: 0;
        }

        @keyframes heroTitleSlide {
            0% {
                opacity: 0;
                transform: translateY(30px) scale(0.9);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        [data-animate="cta"] {
            animation: ctaSlideUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            animation-delay: 0.4s;
            opacity: 0;
        }

        @keyframes ctaSlideUp {
            0% {
                opacity: 0;
                transform: translateY(40px) scale(0.9);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        [data-animate="badge"] {
            animation: badgePopIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            opacity: 0;
        }

        [data-animate="badge"]:nth-child(1) {
            animation-delay: 0.2s;
        }

        [data-animate="badge"]:nth-child(2) {
            animation-delay: 0.3s;
        }

        @keyframes badgePopIn {
            0% {
                opacity: 0;
                transform: scale(0.5);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Floating badges */
        .badge[data-animate] {
            animation: floatBadge 4s ease-in-out infinite, badgePulse 2s ease-in-out infinite;
        }

        @keyframes floatBadge {
            0% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-8px)
            }

            100% {
                transform: translateY(0)
            }
        }

        @keyframes badgePulse {
            0%, 100% {
                box-shadow: 0 4px 20px rgba(100, 255, 218, 0.1);
            }
            50% {
                box-shadow: 0 8px 30px rgba(100, 255, 218, 0.25);
            }
        }

        /* Button micro-interactions */
        .btn[data-animate] {
            transform-origin: center;
        }

        .btn:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 18px 50px rgba(2, 6, 23, 0.5);
        }

        /* Profile photo elegant reveal */
        .hero-right {
            opacity: 0;
            animation: photoReveal 1s cubic-bezier(0.34, 1.56, 0.64, 1) 0.3s forwards;
        }

        @keyframes photoReveal {
            0% {
                opacity: 0;
                transform: scale(0.8) translateY(40px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Cards and icons subtle hover */
        .skill-card[data-animate],
        .tool-card[data-animate],
        .download-card[data-animate],
        .client-logo[data-animate] {
            transition: transform 350ms ease, box-shadow 350ms ease, border-color 350ms ease;
        }

        .skill-card[data-animate]:hover,
        .tool-card[data-animate]:hover,
        .download-card[data-animate]:hover,
        .client-logo[data-animate]:hover {
            transform: translateY(-12px) rotate(-0.5deg);
            box-shadow: 0 30px 80px rgba(2, 6, 23, 0.6);
            border-color: #64FFDA;
        }

        .badge {
            background: linear-gradient(135deg, rgba(100, 255, 218, 0.15) 0%, rgba(100, 255, 218, 0.05) 100%);
            padding: 10px 24px;
            border-radius: 25px;
            font-size: 14px;
            color: #64FFDA;
            border: 1.5px solid #64FFDA;
            font-weight: 500;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(100, 255, 218, 0.1);
        }

        .badge:hover {
            background: linear-gradient(135deg, rgba(100, 255, 218, 0.25) 0%, rgba(100, 255, 218, 0.15) 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(100, 255, 218, 0.2);
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: flex-start;
        }

        .btn {
            padding: 14px 36px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
            cursor: pointer;
            border: none;
            font-size: 15px;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #64FFDA 0%, #52E8C7 100%);
            color: #0A192F;
            box-shadow: 0 4px 15px rgba(100, 255, 218, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #52E8C7 0%, #40D5B4 100%);
            transform: translateY(-4px);
            box-shadow: 0 15px 40px rgba(100, 255, 218, 0.4);
            animation: buttonPulse 0.5s ease-out;
        }

        @keyframes buttonPulse {
            0% {
                box-shadow: 0 15px 40px rgba(100, 255, 218, 0.4);
            }
            100% {
                box-shadow: 0 15px 40px rgba(100, 255, 218, 0);
            }
        }

        .btn-secondary {
            background: transparent;
            color: #64FFDA;
            border: 2px solid #64FFDA;
            position: relative;
        }

        .btn-secondary::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(100, 255, 218, 0.15) 0%, rgba(100, 255, 218, 0.05) 100%);
            border-radius: 6px;
            z-index: -1;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(100, 255, 218, 0.15);
            transform: translateY(-4px);
            border-color: #64FFDA;
            box-shadow: 0 10px 30px rgba(100, 255, 218, 0.2);
        }

        /* Section Title */
        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 48px;
            font-weight: 700;
            color: #CCD6F6;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
            line-height: 1.3;
            letter-spacing: -0.5px;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: #64FFDA;
            border-radius: 2px;
        }

        /* About Section */
        .about {
            background: linear-gradient(135deg, rgba(10, 25, 47, 0.8) 0%, rgba(17, 34, 64, 0.8) 50%, rgba(15, 58, 95, 0.8) 100%);
        }

        .about-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .about-content p {
            font-size: 17px;
            line-height: 1.9;
            color: #8892B0;
            margin-bottom: 25px;
            letter-spacing: 0.3px;
        }

        .about-content p:last-child {
            margin-bottom: 40px;
        }

        .specialization {
            background: rgba(100, 255, 218, 0.05);
            padding: 30px;
            border-radius: 10px;
            border-left: 4px solid #64FFDA;
        }

        .specialization h3 {
            color: #64FFDA;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .specialization ul {
            list-style: none;
            text-align: left;
            display: inline-block;
        }

        .specialization ul li {
            color: #8892B0;
            margin-bottom: 10px;
            padding-left: 25px;
            position: relative;
        }

        .specialization ul li::before {
            content: '▹';
            position: absolute;
            left: 0;
            color: #64FFDA;
            font-size: 20px;
        }

        /* Skills Section */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .skill-card {
            background: #112240;
            padding: 35px 28px;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .skill-card:hover {
            transform: translateY(-10px);
            border-color: #64FFDA;
            box-shadow: 0 10px 40px rgba(100, 255, 218, 0.2);
        }

        .skill-card i {
            font-size: 48px;
            color: #64FFDA;
            margin-bottom: 20px;
        }

        .skill-icon::before {
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 48px;
            color: #64FFDA;
            display: block;
            margin-bottom: 20px;
        }

        .skill-icon[data-skill*="brand"]::before {
            content: "\f53e";
        }

        .skill-icon[data-skill*="visual"]::before {
            content: "\f40e";
        }

        .skill-icon[data-skill*="logo"]::before {
            content: "\f031";
        }

        .skill-icon[data-skill*="poster"]::before {
            content: "\f40a";
        }

        .skill-icon[data-skill*="color"]::before {
            content: "\f576";
        }

        .skill-icon[data-skill*="typography"]::before {
            content: "\f034";
        }

        .skill-icon[data-skill*="layout"]::before {
            content: "\f009";
        }

        .skill-icon[data-skill*="content"]::before {
            content: "\f0c1";
        }

        .skill-icon[data-skill*="design"]::before {
            content: "\f044";
        }

        .skill-icon[data-skill*="social"]::before {
            content: "\f1e6";
        }

        .skill-card h3 {
            font-size: 19px;
            color: #CCD6F6;
            margin-bottom: 15px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .skill-card p {
            color: #8892B0;
            font-size: 14px;
            line-height: 1.7;
            letter-spacing: 0.2px;
        }

        /* Tools Section */
        .tools {
            background: linear-gradient(135deg, rgba(10, 25, 47, 0.8) 0%, rgba(17, 34, 64, 0.8) 50%, rgba(15, 58, 95, 0.8) 100%);
        }

        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .tool-card {
            background: transparent;
            padding: 25px 15px;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s;
            border: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .tool-card:hover {
            transform: translateY(-6px);
        }

        .tool-card i {
            display: none;
        }

        .tool-card .tool-logo {
            width: 70px;
            height: 70px;
            margin-bottom: 12px;
            object-fit: contain;
            filter: brightness(1.1);
        }

        .tool-card h3 {
            font-size: 16px;
            color: #CCD6F6;
            margin-bottom: 0;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .tool-card p {
            display: none;
        }

        /* Portfolio Section */
        .portfolio {
            background: linear-gradient(135deg, rgba(10, 25, 47, 0.7) 0%, rgba(17, 34, 64, 0.7) 50%, rgba(15, 58, 95, 0.7) 100%);
        }

        .portfolio-filters {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 50px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 25px;
            background: #112240;
            color: #8892B0;
            border: 1px solid #1E3A5F;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            font-weight: 500;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #64FFDA;
            color: #0A192F;
            border-color: #64FFDA;
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .portfolio-view-all {
            text-align: center;
            margin-top: 50px;
        }

        .portfolio-view-all .btn {
            display: inline-block;
            font-size: 16px;
            padding: 16px 42px;
        }

        .portfolio-item {
            background: #112240;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .portfolio-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 50px rgba(100, 255, 218, 0.2);
        }

        .portfolio-image {
            width: 100%;
            aspect-ratio: auto;
            max-height: 400px;
            background: linear-gradient(135deg, #1E3A5F 0%, #112240 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64FFDA;
            font-size: 48px;
            position: relative;
            overflow: hidden;
            flex: 0 0 auto;
        }

        .portfolio-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(100, 255, 218, 0.1);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .portfolio-item:hover .portfolio-image::before {
            opacity: 1;
        }

        .portfolio-thumb {
            display: block;
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 400px;
            margin: 0 auto;
            object-fit: contain;
            object-position: center;
            background: rgba(17, 34, 64, 0.5);
        }

        .portfolio-info {
            display: none;
        }

        .portfolio-info h3 {
            display: none;
        }

        .portfolio-meta {
            display: none;
        }

        .portfolio-category {
            display: none;
        }

        .portfolio-year {
            display: none;
        }

        /* Clients Section */
        .clients {
            background: linear-gradient(135deg, rgba(10, 25, 47, 0.8) 0%, rgba(17, 34, 64, 0.8) 50%, rgba(15, 58, 95, 0.8) 100%);
            overflow: hidden;
            padding: 80px 0;
        }

        .clients-intro {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 50px;
            color: #8892B0;
            font-size: 18px;
        }

        .clients-grid {
            display: flex;
            gap: 10px;
            align-items: center;
            animation: marquee 40s linear infinite;
            width: fit-content;
        }

        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .clients-grid:hover {
            animation-play-state: paused;
        }

        .client-logo {
            background: transparent;
            padding: 8px 14px;
            border-radius: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: auto;
            border: none;
            transition: transform 0.25s ease;
            color: #64FFDA;
            font-size: 16px;
            text-align: center;
            flex-shrink: 0;
            white-space: nowrap;
        }

        .client-logo:hover {
            transform: scale(3.03);
        }

        .client-logo img {
            height: 60px;
            max-width: 140px;
            object-fit: contain;
            filter: none;
            display: block;
            margin: 0 auto;
        }

        /* Download Section */
        .download {
            text-align: center;
        }

        .download-intro {
            max-width: 700px;
            margin: 0 auto 40px;
            color: #8892B0;
            font-size: 18px;
        }

        .download-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 800px;
            margin: 0 auto;
        }

        .download-card {
            background: #112240;
            padding: 38px;
            border-radius: 8px;
            border: 2px solid #1E3A5F;
            transition: all 0.3s;
        }

        .download-card:hover {
            border-color: #64FFDA;
            transform: translateY(-5px);
        }

        .download-card i {
            font-size: 48px;
            color: #F59E0B;
            margin-bottom: 20px;
        }

        .download-card h3 {
            font-size: 22px;
            color: #CCD6F6;
            margin-bottom: 12px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .download-card .file-info {
            color: #8892B0;
            font-size: 13px;
            margin-bottom: 20px;
            letter-spacing: 0.2px;
        }

        /* Contact Section */
        .contact {
            background: linear-gradient(135deg, rgba(10, 25, 47, 0.8) 0%, rgba(17, 34, 64, 0.8) 50%, rgba(15, 58, 95, 0.8) 100%);
        }

        .contact-intro {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 50px;
            color: #8892B0;
            font-size: 18px;
        }

        .contact-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            max-width: 900px;
            margin: 0 auto 50px;
        }

        .contact-info {
            background: #0A192F;
            padding: 30px;
            border-radius: 8px;
            border-left: 4px solid #64FFDA;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .contact-item i {
            font-size: 24px;
            color: #64FFDA;
            width: 40px;
        }

        .contact-item-content h4 {
            color: #CCD6F6;
            font-size: 15px;
            margin-bottom: 5px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .contact-item-content p {
            color: #8892B0;
            font-size: 14px;
            line-height: 1.6;
            letter-spacing: 0.2px;
        }

        .social-links {
            text-align: center;
        }

        .social-links h3 {
            color: #CCD6F6;
            margin-bottom: 25px;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .social-icon {
            width: 55px;
            height: 55px;
            background: #0A192F;
            border: 2px solid #1E3A5F;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64FFDA;
            font-size: 22px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .social-icon:hover {
            background: #64FFDA;
            color: #0A192F;
            border-color: #64FFDA;
            transform: translateY(-5px);
        }

        .contact-cta {
            text-align: center;
            margin-top: 50px;
        }

        /* Footer */
        footer {
            background: #0A192F;
            padding: 40px 0;
            text-align: center;
            border-top: 1px solid #1E3A5F;
        }

        footer p {
            color: #8892B0;
            margin-bottom: 20px;
        }

        .footer-nav {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .footer-nav a {
            color: #8892B0;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-nav a:hover {
            color: #64FFDA;
        }

        /* Responsive - Tablet */
        @media (max-width: 1024px) {
            .hero-inner {
                gap: 30px;
            }

            .hero-right {
                flex: 0 0 340px;
                height: auto;
                max-height: 340px;
            }

            .hero h1 {
                font-size: 56px;
            }

            .section-title h2 {
                font-size: 40px;
            }

            .skills-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .tools-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Responsive - Mobile Landscape */
        @media (max-width: 768px) {
            section {
                padding: 60px 0;
            }

            nav ul {
                gap: 20px;
            }

            nav ul li a {
                font-size: 13px;
            }

            .hero-buttons {
                flex-direction: row;
                gap: 10px;
                flex-wrap: wrap;
                justify-content: flex-start;
            }

            .btn {
                width: auto;
                padding: 12px 28px;
                font-size: 14px;
            }

            .section-title h2 {
                font-size: 32px;
            }

            .portfolio-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .portfolio-image {
                max-height: 300px;
            }

            .portfolio-thumb {
                max-height: 300px;
                width: auto;
                height: auto;
            }

            .portfolio-view-all {
                margin-top: 40px;
            }

            .skills-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .skill-card {
                padding: 28px 20px;
            }

            .tools-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .tool-card {
                padding: 18px 12px;
            }

            .tool-card h3 {
                font-size: 14px;
            }

            .tool-card .tool-logo {
                width: 55px;
                height: 55px;
                margin-bottom: 8px;
            }

            /* Make hero stack on mobile */
            .hero-inner {
                flex-direction: column-reverse;
                text-align: center;
                gap: 20px;
            }

            .hero::before {
                width: 350px;
                height: 350px;
                right: 0%;
            }

            .hero-left {
                width: 100%;
            }
                .hero-inner {
                    flex-direction: column-reverse;
                    text-align: center;
                    gap: 20px;
                    max-width: 100%;
                    margin: 0 auto;
                    padding: 0 16px;
                }

                .hero::before {
                    width: 280px;
                    height: 280px;
                    right: -80px;
                    display: none;
                }

                .hero-left {
                    width: 100%;
                    padding: 0;
                }
            .hero-right {
                flex: 0 0 300px;
                width: 300px;
                height: auto;
                max-width: 300px;
                max-height: 300px;
            }

            .profile-photo-link::after {
                font-size: 11px;
                padding: 8px 16px;
                bottom: 15px;
            }

            .profile-photo {
                width: 100%;
                height: 100%;
            }

            .hero h1 {
                font-size: 42px;
            }

            .hero h2 {
                font-size: 16px;
            }

            .hero .tagline {
                font-size: 15px;
            }

            .download-card {
                padding: 30px 20px;
            }

            .whatsapp-btn {
                width: auto;
                height: 60px;
                padding: 0 14px;
                bottom: 30px;
                right: 20px;
                font-size: 12px;
                gap: 6px;
            }
            
            .whatsapp-btn i {
                font-size: 24px;
            }
        }

        /* Responsive - Small Phones */
        @media (max-width: 480px) {
            .portfolio-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            .portfolio-image {
                max-height: 200px;
            }

            .portfolio-thumb {
                max-height: 200px;
                width: auto;
                height: auto;
            }
            .portfolio-view-all {
                margin-top: 30px;
            }
            .portfolio-view-all .btn {
                font-size: 14px;
                padding: 12px 28px;
            }
            .skills-grid, .tools-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Responsive - Mobile Small */
        @media (max-width: 480px) {
            section {
                padding: 50px 0;
            }

            .container {
                padding: 0 16px;
            }

            nav {
                padding: 16px 0;
            }

            nav .logo {
                font-size: 20px;
            }

            nav ul {
                gap: 12px;
            }

            nav ul li a {
                font-size: 12px;
            }

            .hero {
                min-height: 85vh;
            }

            .hero::before {
                width: 280px;
                height: 280px;
                right: 10px;
            }

            .hero-right {
                flex: 0 0 220px;
                width: 220px;
                height: auto;
                max-width: 220px;
                max-height: 220px;
            }

            .profile-photo-link::after {
                font-size: 10px;
                padding: 6px 12px;
                bottom: 12px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero h2 {
                font-size: 14px;
            }

            .hero .tagline {
                font-size: 13px;
                margin-bottom: 25px;
            }

            .hero-badges {
                flex-direction: column;
                gap: 8px;
            }

            .badge {
                font-size: 12px;
                padding: 6px 16px;
            }

            .hero-buttons {
                flex-direction: row;
                gap: 6px;
            }

            .btn {
                width: auto;
                padding: 10px 20px;
                font-size: 12px;
            }

            .portfolio-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .skills-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .tools-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .tool-card {
                padding: 15px 10px;
            }

            .tool-card h3 {
                font-size: 13px;
            }

            .tool-card .tool-logo {
                width: 50px;
                height: 50px;
                margin-bottom: 6px;
            }

            .section-title h2 {
                font-size: 24px;
            }

            .social-icon {
                width: 48px;
                height: 48px;
                font-size: 20px;
            }

            .whatsapp-btn {
                width: auto;
                height: 55px;
                padding: 0 12px;
                bottom: 25px;
                right: 15px;
                font-size: 11px;
                gap: 5px;
            }
            
            .whatsapp-btn i {
                font-size: 22px;
            }
        }

        .badge {
            width: 100%;
            text-align: center;
        }

        .section-title h2::after {
            width: 60px;
        }

        .download-card {
            padding: 24px 16px;
        }

        .contact-content {
            gap: 30px;
        }

        .social-icons {
            gap: 12px;
        }

        .social-icon {
            width: 48px;
            height: 48px;
            font-size: 20px;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* WhatsApp Floating Button */
        .whatsapp-btn {
            position: fixed;
            bottom: 40px;
            right: 30px;
            width: auto;
            height: 65px;
            padding: 0 18px;
            background: #25D366;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: white;
            text-decoration: none;
            box-shadow: 0 8px 30px rgba(37, 211, 102, 0.4);
            z-index: 999;
            transition: all 0.3s ease;
            animation: whatsappFloat 3s ease-in-out infinite;
            font-weight: 600;
            font-size: 14px;
        }

        .whatsapp-btn i {
            font-size: 32px;
        }

        @keyframes whatsappFloat {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-10px) scale(1.05);
            }
        }

        .whatsapp-btn:hover {
            background: #20BA5A;
            transform: scale(1.15);
            box-shadow: 0 12px 40px rgba(37, 211, 102, 0.6);
            animation: none;
        }

        .whatsapp-btn::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: rgba(37, 211, 102, 0.2);
            animation: whatsappPulse 2s infinite;
        }

        @keyframes whatsappPulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(1.3);
                opacity: 0;
            }
        }

        .whatsapp-btn i {
            position: relative;
            z-index: 1;
        }

        /* Animations */
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

        .hero-content {
            animation: fadeInUp 1s ease-out;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <div class="logo">Syaddad Ibrohim</div>
            <ul>
                <li><a href="#home">Beranda</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#skills">Keahlian</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home" data-animate="section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-inner">
                    <div class="hero-left">
                        <h1><span class="name-animated" data-animate="title">{{ $name ?? 'Moh Syaddad Ibrohim' }}</span></h1>
                        <h2 data-animate="title">{{ $title ?? 'Graphic Designer Specialist' }} | {{ $company ?? 'Founder Philo Design' }}</h2>
                        <p class="tagline" data-animate="title">"{{ $tagline ?? 'Wujudkan ide anda' }}"</p>

                        <div class="hero-badges" style="justify-content:flex-start;">
                            <span class="badge" data-animate="badge">Available for Freelance</span>
                            <span class="badge" data-animate="badge">3+ Years Experience</span>
                        </div>

                        <div class="hero-buttons" style="justify-content:flex-start; margin-top:30px;">
                            <a href="#portfolio" class="btn btn-primary" data-animate="cta">PORTOFOLIO</a>
                            <a href="https://www.behance.net/gallery/216540101/PORTOFOLIO-2024-MOH-SYADDAD-IBROHIM/modules/1233014729" target="_blank" class="btn btn-secondary" data-animate="cta">DOWNLOAD CV</a>
                        </div>
                    </div>

                    <div class="hero-right">
                        <a href="{{ route('portfolio.all') }}" class="profile-photo-link" title="Lihat semua karya">
                            <img src="{{ $photo ?? asset('images/ps.png') }}" alt="{{ $name ?? 'Profile' }}" class="profile-photo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

            <!-- Scroll Indicator -->
            <style>
                .scroll-indicator {
                    position: absolute;
                    bottom: 30px;
                    left: 50%;
                    transform: translateX(-50%);
                    z-index: 10;
                    animation: bounce 2s infinite;
                }

                .scroll-indicator svg {
                    width: 30px;
                    height: 50px;
                    stroke: #64FFDA;
                    fill: none;
                    stroke-width: 2;
                }

                .scroll-indicator circle {
                    animation: scrollCircle 1.5s infinite;
                }

                @keyframes bounce {
                    0%, 100% {
                        opacity: 0.7;
                    }
                    50% {
                        opacity: 1;
                    }
                }

                @keyframes scrollCircle {
                    0% {
                        cy: 15px;
                        opacity: 1;
                    }
                    100% {
                        cy: 30px;
                        opacity: 0;
                    }
                }
            </style>
            <div class="scroll-indicator">
                <svg viewBox="0 0 30 50" preserveAspectRatio="xMidYMid meet">
                    <rect x="5" y="5" width="20" height="35" rx="10" ry="10" />
                    <circle cx="15" cy="20" r="3" />
                </svg>
            </div>

    <!-- About Section -->
    <section class="about" id="about" data-animate="section">
        <div class="container">
            <div class="section-title">
                <h2>Tentang Saya</h2>
            </div>
            <div class="about-content">
                <p>{{ $about }}</p>
                
                <p>Sebagai seorang mahasiswa Teknik Informatika yang juga bergelut di dunia desain grafis, saya percaya bahwa kreativitas dan teknologi dapat berjalan beriringan. Saya aktif membuat konten edukasi dan proses desain di TikTok, yang membuka kesempatan mendapatkan klien dari berbagai daerah di seluruh Nusantara.</p>

                <p>Berpengalaman dalam branding event, pembuatan poster, logo, hingga konten sosial media, saya selalu menciptakan desain yang tidak hanya estetis, tetapi juga memiliki tujuan yang jelas dan mampu mengkomunikasikan pesan secara efektif.</p>

                <p>Saya merupakan sosok yang aktif berorganisasi, sehingga terbiasa bekerja dalam tim, beradaptasi, dan berkolaborasi dalam berbagai proyek kreatif.</p>

                <div class="specialization">
                    <h3>Spesialisasi</h3>
                    <ul>
                        <li>Branding & Visual Identity</li>
                        <li>Poster & Print Design</li>
                        <li>Logo Design</li>
                        <li>Social Media Content Strategy</li>
                        <li>Layout Design</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="skills" id="skills" data-animate="section">
        <div class="container">
            <div class="section-title">
                <h2>Keahlian</h2>
            </div>
            <div class="skills-grid">
                @foreach($skills as $skill)
                <div class="skill-card" data-animate="skill">
                    <i class="skill-icon" data-skill="{{ strtolower($skill['title']) }}"></i>
                    <h3>{{ $skill['title'] }}</h3>
                    <p>{{ $skill['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Tools Section -->
    <section class="tools" data-animate="section">
        <div class="container">
            <div class="section-title">
                <h2>Tools yang di Kuasai</h2>
            </div>
            <div class="tools-grid">
                @foreach($tools as $tool)
                <div class="tool-card" data-animate="tool">
                    @if(isset($tool['logo']))
                    <img src="{{ $tool['logo'] }}" alt="{{ $tool['name'] }}" class="tool-logo">
                    @else
                    <i class="fas fa-layer-group"></i>
                    @endif
                    <h3>{{ $tool['name'] }}</h3>
                    <p>{{ $tool['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>



    <!-- Clients Section -->
    <section class="clients" data-animate="section">
        <div class="container">
            <div class="section-title">
                <h2>Klien Saya</h2>
            </div>
            <div style="overflow-x: hidden; width: 100%;">
                <div class="clients-grid">
                    @php $logos = range(1,14); @endphp
                    @foreach(array_merge($logos, $logos) as $i)
                        <div class="client-logo">
                            <img loading="lazy" decoding="async" fetchpriority="low" src="{{ asset('assets/logo'.$i.'.svg') }}" alt="Logo {{ $i }}" class="client-img" width="120" height="60" style="width:120px; height:60px; object-fit:contain;" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section class="download" data-animate="section">
        <div class="container">
            <div class="section-title">
                <h2>Ingin Tahu Lebih Lanjut?</h2>
            </div>
            <p class="download-intro">Download CV dan portfolio lengkap saya untuk melihat detail pengalaman dan karya-karya terbaik.</p>

            <div class="download-cards">
                <div class="download-card" data-animate="download">
                    <i class="fas fa-file-pdf"></i>
                    <h3>Download CV</h3>
                    <p class="file-info">Format: PDF | Size: 2MB</p>
                    <a href="https://www.behance.net/gallery/216540101/PORTOFOLIO-2024-MOH-SYADDAD-IBROHIM/modules/1233014729" target="_blank" class="btn btn-primary">
                        <i class="fas fa-download"></i> DOWNLOAD CV
                    </a>
                </div>

                <div class="download-card" data-animate="download">
                    <i class="fas fa-folder-open"></i>
                    <h3>Download Portfolio</h3>
                    <p class="file-info">Format: PDF | Size: 15MB</p>
                    <a href="https://www.behance.net/gallery/216540101/PORTOFOLIO-2024-MOH-SYADDAD-IBROHIM/modules/1233014729" target="_blank" class="btn btn-primary">
                        <i class="fas fa-download"></i> DOWNLOAD PORTOFOLIO
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact" data-animate="section">
        <div class="container">
            <div class="section-title">
                <h2>Mari Berkolaborasi!</h2>
            </div>
            <p class="contact-intro">Punya project atau ide yang ingin diwujudkan? Saya siap membantu Anda menciptakan visual yang powerful dan memorable.</p>

            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div class="contact-item-content">
                            <h4>Email</h4>
                            <p>{{ $email }}</p>
                            <p>philodesign10@gmail.com</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div class="contact-item-content">
                            <h4>Phone/WhatsApp</h4>
                            <p>{{ $phone }}</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="contact-item-content">
                            <h4>Location</h4>
                            <p>{{ $location }}</p>
                        </div>
                    </div>
                </div>

                <div class="social-links">
                    <h3>Follow Me</h3>
                    <div class="social-icons">
                        <a href="{{ $social['facebook'] ?? '#' }}" class="social-icon" target="_blank" data-animate="social">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="{{ $social['instagram'] }}" class="social-icon" target="_blank" data-animate="social">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{ $social['behance'] }}" class="social-icon" target="_blank" data-animate="social">
                            <i class="fab fa-behance"></i>
                        </a>
                        <a href="{{ $social['pinterest'] ?? '#' }}" class="social-icon" target="_blank" data-animate="social">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="contact-cta">
                <a href="https://wa.me/6281233181095" target="_blank" class="btn btn-primary btn-lg">HUBUNGI SAYA</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>© 2024 {{ $name }} | {{ $company }}</p>

            <div class="footer-nav">
                <a href="#home">Beranda</a>
                <a href="#about">Tentang</a>
                <a href="#portfolio">Portfolio</a>
                <a href="#contact">Kontak</a>
            </div>

            <div class="social-icons" style="margin-top: 20px;">
                <a href="{{ $social['facebook'] ?? '#' }}" class="social-icon" target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="{{ $social['instagram'] }}" class="social-icon" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="{{ $social['behance'] }}" class="social-icon" target="_blank">
                    <i class="fab fa-behance"></i>
                </a>
                <a href="{{ $social['pinterest'] ?? '#' }}" class="social-icon" target="_blank">
                    <i class="fab fa-pinterest"></i>
                </a>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        const navbar = document.querySelector('nav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Portfolio Filter
        const filterBtns = document.querySelectorAll('.filter-btn');
        const portfolioItems = document.querySelectorAll('.portfolio-item');

        // Ensure all items visible on initial load
        portfolioItems.forEach(item => {
            item.style.display = 'block';
            item.style.opacity = '1';
            item.style.transform = 'scale(1)';
        });

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class from all buttons
                filterBtns.forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                btn.classList.add('active');

                const filterValue = btn.getAttribute('data-filter').trim();

                portfolioItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category').trim();
                    if (filterValue === 'all' || itemCategory === filterValue) {
                        item.style.display = 'block';
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                        item.style.pointerEvents = 'auto';
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        item.style.pointerEvents = 'none';
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Client image fallback handler
        document.addEventListener('error', (e) => {
            if (e.target.classList && e.target.classList.contains('client-img') && e.target.dataset.fallback) {
                e.target.src = e.target.dataset.fallback;
            }
        }, true);

        // Staggered entrance animations for elements with data-animate (initial small reveal)
        document.addEventListener('DOMContentLoaded', () => {
            const animated = Array.from(document.querySelectorAll('[data-animate]'));
            animated.forEach((el, i) => {
                // small initial stagger for above-the-fold
                const delay = Math.min((i * 60) + (Math.random() * 100), 400);
                el.style.transitionDelay = `${delay}ms`;
                // do not force show here — we'll use IntersectionObserver for scroll reveal
            });

            // Use IntersectionObserver to reveal elements when they enter the viewport
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -10% 0px',
                threshold: 0.08
            };

            const io = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        el.classList.add('is-visible');
                        // Special: if it's the profile photo, also add float class
                        if (el.classList && el.classList.contains('profile-photo')) {
                            el.classList.add('float');
                        }
                        obs.unobserve(el);
                    }
                });
            }, observerOptions);

            animated.forEach(el => io.observe(el));

            // Simple parallax for hero photo: subtle translate based on scroll (performant)
            const heroPhoto = document.querySelector('.profile-photo');
            if (heroPhoto) {
                let ticking = false;
                window.addEventListener('scroll', () => {
                    if (!ticking) {
                        window.requestAnimationFrame(() => {
                            const rect = heroPhoto.getBoundingClientRect();
                            const windowH = window.innerHeight;
                            // compute progress of photo into view
                            const progress = Math.max(0, Math.min(1, (windowH - rect.top) / (windowH + rect.height)));
                            const translateY = (progress - 0.5) * 18; // small movement
                            heroPhoto.style.transform = `translateY(${translateY}px) scale(1)`;
                            ticking = false;
                        });
                        ticking = true;
                    }
                }, {
                    passive: true
                });
            }

            // WhatsApp Button Scroll Animation
            const whatsappBtn = document.querySelector('.whatsapp-btn');
            if (whatsappBtn) {
                window.addEventListener('scroll', () => {
                    const scrollY = window.scrollY;
                    const moveY = Math.sin(scrollY / 100) * 5;
                    whatsappBtn.style.transform = `translateY(${moveY}px)`;
                }, { passive: true });
            }
        });
    </script>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/6281233181095" class="whatsapp-btn" target="_blank" title="Chat dengan kami di WhatsApp">
        <i class="fab fa-whatsapp"></i>
        <span>Order Now</span>
    </a>
</body>

</html>