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
    <title>City Care Hospital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
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
                <a href="index.php" class="font-medium transition-colors hover:text-primary">Home</a>
                <a href="services.php" class="font-medium transition-colors hover:text-primary">Services</a>
                <a href="doctors.php" class="font-medium transition-colors hover:text-primary">Doctors</a>
                <a href="patient-care.php" class="font-medium transition-colors hover:text-primary">Patient Care</a>
                
                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
                        <a href="admin_dashboard.php" class="font-bold transition-colors hover:text-primary ">Admin Portal</a>
                    <?php else: ?>
                        <a href="my_appointments.php" class="font-bold transition-colors hover:text-primary ">My Appointments</a>
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
                <a href="index.php" class="text-lg font-medium">Home</a>
                <a href="services.php" class="text-lg font-medium">Services</a>
                <a href="doctors.php" class="text-lg font-medium">Doctors</a>
                <a href="patient-care.php" class="text-lg font-medium">Patient Care</a>
                <hr class="border-secondary/10" />
                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
                        <a href="admin_dashboard.php" class="text-lg font-bold text-primary">Admin Portal</a>
                    <?php else: ?>
                        <a href="my_appointments.php" class="text-lg font-bold text-primary">My Appointments</a>
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
