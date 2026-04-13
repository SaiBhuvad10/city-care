<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="City Care Hospital provides world-class medical care with a human touch. Book appointments easily and manage your healthcare journey with our top specialists.">
    <meta name="keywords" content="hospital, healthcare, medical care, doctors, book appointment, clinic, cardiology, neurology, pediatrics, orthopedics, city care hospital">
    <meta name="author" content="City Care Hospital">
    <?php
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $current_url = $protocol . "://" . $host . $_SERVER['REQUEST_URI'];
    $base_url = $protocol . "://" . $host . "/"; // Adjust if in subdirectory
    if(strpos($host, 'localhost') !== false) {
        $base_url = $protocol . "://" . $host . "/city-care/";
    }
    ?>
    <meta property="og:title" content="City Care Hospital - Your Health is Our Priority">
    <meta property="og:description" content="Providing world-class medical care with a human touch. Book your online or in-person consultation today.">
    <meta property="og:image" content="<?php echo $base_url; ?>icon-512x512.png">
    <meta property="og:url" content="<?php echo $current_url; ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="City Care Hospital">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="City Care Hospital">
    <meta name="twitter:description" content="World-class medical care with a human touch.">
    <meta name="twitter:image" content="<?php echo $base_url; ?>icon-512x512.png">
    <link id="manifest-link" rel="manifest" href="">
    <script>
        const origin = window.location.origin;
        const manifest = {
            "name": "City Care Hospital",
            "short_name": "City Care",
            "description": "City Care Hospital - Your health is our priority.",
            "start_url": origin + "/index.php",
            "display": "standalone",
            "background_color": "#faf8ff",
            "theme_color": "#0052c6",
            "orientation": "portrait-primary",
            "icons": [
                {
                    "src": origin + "/icon-512x512.png",
                    "sizes": "512x512",
                    "type": "image/png"
                },
                {
                    "src": origin + "/icon-512x512.png",
                    "sizes": "192x192",
                    "type": "image/png",
                    "purpose": "any maskable"
                }
            ],
            "scope": origin + "/",
            "lang": "en-US",
            "dir": "ltr"
        };
        const stringManifest = JSON.stringify(manifest);
        const blob = new Blob([stringManifest], {type: 'application/manifest+json'});
        const manifestURL = URL.createObjectURL(blob);
        document.querySelector('#manifest-link').setAttribute('href', manifestURL);
    </script>
<meta name="theme-color" content="#0052c6">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="City Care">

    <title>City Care Hospital</title>
    <link rel="icon" type="image/svg+xml" href="<?php echo $base_url; ?>favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            production: true,
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Manrope', 'sans-serif'],
                    },
                    colors: {
                        primary: '#0052c6',
                        secondary: '#4a5d8e',
                        background: '#faf8ff',
                        surface: '#ffffff',
                        'surface-soft': '#f4f2ff',
                        accent: '#e0e7ff',
                    }
                }
            }
        }
    </script>
    <script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      // One-time hard reset to clear InfinityFree manifest/sw errors
      if (!localStorage.getItem('pwa_reset_v3')) {
        navigator.serviceWorker.getRegistrations().then(registrations => {
          for (let registration of registrations) {
            registration.unregister();
          }
          localStorage.setItem('pwa_reset_v3', 'true');
          window.location.reload();
        });
      }

      // Register sw.php only if NOT on InfinityFree (to avoid security errors)
      if (!window.location.hostname.includes('42web.io')) {
          navigator.serviceWorker.register('sw.php')
            .then(reg => console.log('Service Worker registered'))
            .catch(err => console.log('Service Worker registration failed', err));
      } else {
          console.log('Service Worker disabled on InfinityFree to prevent security errors.');
      }
    });
  }
</script>

    <style>
        body {
            background-color: #faf8ff;
            color: #4a5d8e;
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Manrope', sans-serif;
            font-weight: 600;
            letter-spacing: -0.025em;
        }
        .glass-bar {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        .btn-primary {
            background-color: #0052c6;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            transform: scale(1.05);
        }
        .btn-secondary {
            background-color: #f4f2ff;
            color: #0052c6;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-secondary:hover {
            background-color: #e0e7ff;
        }
    </style>
</head>
<body class="antialiased">
    <nav class="fixed top-0 left-0 right-0 z-50 px-4 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between glass-bar rounded-full px-6 py-3">
            <a href="index.php" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white transition-transform group-hover:rotate-12">
                    <i data-lucide="heart-pulse"></i>
                </div>
                <span class="font-display font-bold text-xl tracking-tight text-primary">City Care</span>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <?php if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'): ?>
                    <a href="index.php" class="font-medium transition-colors hover:text-primary">Home</a>
                    <a href="services.php" class="font-medium transition-colors hover:text-primary">Services</a>
                    <a href="doctors.php" class="font-medium transition-colors hover:text-primary">Doctors</a>
                    <a href="patient-care.php" class="font-medium transition-colors hover:text-primary">Patient Care</a>
                <?php endif; ?>
                
                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
                        <a href="admin_dashboard.php" class="font-bold transition-colors hover:text-primary ">Admin Portal</a>
                        <a href="admin_messages.php" class="font-bold transition-colors hover:text-primary ">Messages</a>
                    <?php else: ?>
                        <a href="my_appointments.php" class="font-bold transition-colors hover:text-primary ">My Appointments</a>
                        <a href="patient_messages.php" class="font-bold transition-colors hover:text-primary ">Messages</a>
                    <?php endif; ?>
                    <div class="flex items-center gap-4 border-l border-secondary/20 pl-6 ml-2">
                        <div class="flex items-center gap-2 bg-surface-soft pl-1 pr-4 py-1 rounded-full border border-secondary/10">
                            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_name']); ?>&background=0052c6&color=fff&rounded=true" alt="User" class="w-8 h-8 rounded-full">
                            <span class="text-sm font-bold text-secondary">Hi, <?php echo explode(' ', $_SESSION['user_name'])[0]; ?></span>
                        </div>
                        <a href="logout.php" class="text-sm font-bold text-primary hover:underline ml-2">Logout</a>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="btn-primary py-2 px-6 text-sm">Login</a>
                <?php endif; ?>
            </div>

            <button class="md:hidden text-secondary p-2" id="mobile-menu-toggle">
                <i data-lucide="menu"></i>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden absolute top-20 left-4 right-4 glass-bar rounded-3xl p-6 shadow-2xl">
            <div class="flex flex-col gap-4">
                <?php if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'): ?>
                    <a href="index.php" class="text-lg font-medium">Home</a>
                    <a href="services.php" class="text-lg font-medium">Services</a>
                    <a href="doctors.php" class="text-lg font-medium">Doctors</a>
                    <a href="patient-care.php" class="text-lg font-medium">Patient Care</a>
                    <hr class="border-secondary/10" />
                <?php endif; ?>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
                        <a href="admin_dashboard.php" class="text-lg font-bold text-primary">Admin Portal</a>
                        <a href="admin_messages.php" class="text-lg font-bold text-primary">Messages</a>
                    <?php else: ?>
                        <a href="my_appointments.php" class="text-lg font-bold text-primary">My Appointments</a>
                        <a href="patient_messages.php" class="text-lg font-bold text-primary">Messages</a>
                    <?php endif; ?>
                    <hr class="border-secondary/10 my-2" />
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_name']); ?>&background=0052c6&color=fff&rounded=true" alt="User" class="w-10 h-10 rounded-full shadow-sm">
                        <span class="text-lg font-medium text-secondary">Hi, <?php echo $_SESSION['user_name']; ?></span>
                    </div>
                    <a href="logout.php" class="btn-secondary text-center mt-4">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn-primary text-center">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
