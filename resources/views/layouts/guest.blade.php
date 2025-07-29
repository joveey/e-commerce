<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Verse Beauty') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background: #ffffff;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #ec4899, #a855f7);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #be185d, #9333ea);
        }

        /* Form Styles */
        .form-input {
            appearance: none;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            color: #1f2937;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.15s ease-in-out;
            width: 100%;
        }

        .form-input:focus {
            outline: 2px solid transparent;
            outline-offset: 2px;
            border-color: #ec4899;
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
            background-color: #ffffff;
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #ec4899, #a855f7);
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            border: none;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px -1px rgba(236, 72, 153, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #be185d, #9333ea);
            transform: translateY(-1px);
            box-shadow: 0 8px 15px -3px rgba(236, 72, 153, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: white;
            color: #374151;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            border: 2px solid #e5e7eb;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-secondary:hover {
            background: #f9fafb;
            border-color: #ec4899;
            color: #ec4899;
            transform: translateY(-1px);
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        .slide-up {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(30px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #ec4899, #a855f7, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Link Styles */
        .link-primary {
            color: #ec4899;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.15s ease-in-out;
        }

        .link-primary:hover {
            color: #be185d;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hidden.lg\\:flex {
                display: none !important;
            }
            
            .w-full.lg\\:w-1\\/2 {
                width: 100% !important;
            }
        }

        @media (max-width: 640px) {
            .p-8 { padding: 1.5rem; }
            .p-6 { padding: 1rem; }
            .text-5xl { font-size: 2.5rem; }
            .text-3xl { font-size: 1.875rem; }
            .text-2xl { font-size: 1.5rem; }
        }

        /* Custom Auth Session Status */
        .auth-session-status {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        /* Error Messages */
        .input-error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            font-weight: 500;
        }

        /* Loading States */
        .btn-loading {
            position: relative;
            pointer-events: none;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Focus visible for accessibility */
        .focus-visible:focus {
            outline: 2px solid #ec4899;
            outline-offset: 2px;
        }

        /* Custom checkbox styles */
        input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
            border: 2px solid #d1d5db;
            border-radius: 0.25rem;
            background: white;
            cursor: pointer;
            position: relative;
        }

        input[type="checkbox"]:checked {
            background: #ec4899;
            border-color: #ec4899;
        }

        input[type="checkbox"]:checked::before {
            content: '✓';
            position: absolute;
            top: -2px;
            left: 1px;
            color: white;
            font-size: 0.75rem;
            font-weight: bold;
        }

        /* Enhanced form focus states */
        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-group.focused .form-label {
            color: #ec4899;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            transition: color 0.15s ease-in-out;
        }
    </style>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'display': ['Playfair Display', 'serif'],
                    },
                    colors: {
                        'verse-pink': {
                            50: '#fdf2f8',
                            500: '#ec4899',
                            600: '#db2777',
                            700: '#be185d',
                        },
                        'verse-purple': {
                            50: '#f3e8ff',
                            500: '#a855f7',
                            600: '#9333ea',
                            700: '#7c3aed',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-white">
        {{ $slot }}
    </div>

    <!-- Global JavaScript -->
    <script>
        // Enhanced form interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus classes to form groups
            const formInputs = document.querySelectorAll('.form-input');
            formInputs.forEach(input => {
                const formGroup = input.closest('.form-group');
                
                input.addEventListener('focus', function() {
                    if (formGroup) {
                        formGroup.classList.add('focused');
                    }
                });
                
                input.addEventListener('blur', function() {
                    if (formGroup) {
                        formGroup.classList.remove('focused');
                    }
                });
            });

            // Add loading state to forms
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitButton = form.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.classList.add('btn-loading');
                        submitButton.disabled = true;
                    }
                });
            });

            // Add smooth animations
            const animatedElements = document.querySelectorAll('.card, .btn-primary, .btn-secondary');
            animatedElements.forEach(element => {
                element.classList.add('fade-in');
            });
        });

        // Utility functions
        window.showNotification = function(message, type = 'success') {
            // Implementation for notifications
            console.log(`${type}: ${message}`);
        };

        window.validateEmail = function(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        };
    </script>
</body>
</html>