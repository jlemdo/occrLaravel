<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'OCCR Productos')</title>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Raleway:wght@400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Reset y Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Raleway', Arial, sans-serif;
            line-height: 1.6;
            color: #2F2F2F;
            background-color: #F2EFE4;
            padding: 20px 0;
        }
        
        /* Container Principal */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #FFFFFF;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(47, 47, 47, 0.12);
        }
        
        /* Header */
        .email-header {
            background: linear-gradient(135deg, #D27F27 0%, #E69A3A 100%);
            padding: 32px 24px;
            text-align: center;
            color: #FFFFFF;
        }
        
        .logo-container {
            margin-bottom: 16px;
        }
        
        .logo-text {
            font-family: 'Great Vibes', cursive;
            font-size: 32px;
            font-weight: normal;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .tagline {
            font-size: 14px;
            opacity: 0.9;
            margin: 0;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        /* Content Area */
        .email-content {
            padding: 40px 32px;
        }
        
        .content-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 600;
            color: #2F2F2F;
            margin-bottom: 16px;
            text-align: center;
        }
        
        .content-subtitle {
            font-size: 16px;
            color: #666666;
            margin-bottom: 24px;
            text-align: center;
        }
        
        .content-text {
            font-size: 15px;
            line-height: 1.7;
            color: #2F2F2F;
            margin-bottom: 16px;
        }
        
        /* OTP Code Styles */
        .otp-container {
            background: linear-gradient(135deg, #F2EFE4 0%, #FFF8F0 100%);
            border: 2px solid #D27F27;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            margin: 24px 0;
        }
        
        .otp-label {
            font-size: 14px;
            color: #666666;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .otp-code {
            font-family: 'SF Pro Display', 'Roboto', monospace;
            font-size: 32px;
            font-weight: 600;
            color: #D27F27;
            letter-spacing: 4px;
            margin: 0;
            text-shadow: 0 1px 2px rgba(210, 127, 39, 0.1);
        }
        
        .otp-timer {
            font-size: 13px;
            color: #666666;
            margin-top: 8px;
        }
        
        /* Buttons */
        .email-button {
            display: inline-block;
            background: linear-gradient(135deg, #D27F27 0%, #E69A3A 100%);
            color: #FFFFFF !important;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            margin: 16px 0;
            box-shadow: 0 4px 12px rgba(210, 127, 39, 0.3);
            transition: all 0.3s ease;
        }
        
        .email-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(210, 127, 39, 0.4);
        }
        
        .button-container {
            text-align: center;
            margin: 24px 0;
        }
        
        /* Info Box */
        .info-box {
            background-color: #F8F9FA;
            border-left: 4px solid #D27F27;
            padding: 16px 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        
        .info-box-title {
            font-weight: 600;
            color: #2F2F2F;
            margin-bottom: 4px;
        }
        
        .info-box-text {
            font-size: 14px;
            color: #666666;
        }
        
        /* Warning Box */
        .warning-box {
            background-color: #FEF7E7;
            border: 1px solid #F4D03F;
            border-radius: 8px;
            padding: 16px 20px;
            margin: 20px 0;
        }
        
        .warning-icon {
            color: #F39C12;
            font-size: 18px;
            margin-right: 8px;
        }
        
        /* Order Details */
        .order-details {
            background-color: #FAFAFA;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #E5E5E5;
        }
        
        .order-item:last-child {
            border-bottom: none;
            font-weight: 600;
            color: #D27F27;
        }
        
        /* Footer */
        .email-footer {
            background-color: #2F2F2F;
            color: #FFFFFF;
            padding: 32px 24px;
            text-align: center;
        }
        
        .footer-text {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 16px;
        }
        
        .footer-contact {
            font-size: 13px;
            opacity: 0.7;
            margin-bottom: 8px;
        }
        
        .footer-social {
            margin-top: 16px;
        }
        
        .social-link {
            color: #D27F27;
            text-decoration: none;
            margin: 0 8px;
            font-size: 14px;
        }
        
        /* Responsive */
        @media only screen and (max-width: 480px) {
            .email-container {
                margin: 0 10px;
                border-radius: 8px;
            }
            
            .email-content {
                padding: 24px 20px;
            }
            
            .email-header {
                padding: 24px 20px;
            }
            
            .logo-text {
                font-size: 28px;
            }
            
            .otp-code {
                font-size: 28px;
                letter-spacing: 2px;
            }
            
            .content-title {
                font-size: 20px;
            }
        }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .email-container {
                background-color: #1A1A1A;
            }
            
            .email-content {
                color: #E5E5E5;
            }
            
            .content-title {
                color: #FFFFFF;
            }
            
            .content-subtitle {
                color: #B0B0B0;
            }
            
            .content-text {
                color: #E5E5E5;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="logo-container">
                <h1 class="logo-text">OCCR Productos</h1>
                <p class="tagline">Lácteos y Más</p>
            </div>
        </div>
        
        <!-- Content -->
        <div class="email-content">
            @yield('content')
        </div>
        
        <!-- Footer -->
        <div class="email-footer">
            <p class="footer-text">
                Gracias por confiar en OCCR Productos
            </p>
            <p class="footer-contact">
                📱 WhatsApp: +52 55 1234 5678 | 📧 occr@pixelcrafters.digital
            </p>
            <p class="footer-contact">
                🏪 Tu tienda de lácteos de confianza
            </p>
            <div class="footer-social">
                <a href="#" class="social-link">Instagram</a>
                <a href="#" class="social-link">Facebook</a>
                <a href="#" class="social-link">WhatsApp</a>
            </div>
        </div>
    </div>
</body>
</html>