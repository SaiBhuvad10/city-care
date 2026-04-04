<?php 
session_start();
include 'db_connect.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, full_name, password, role FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_role'] = $user['role'];
            
            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: my_appointments.php");
            }
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No account found with that email!";
    }
}

include 'header.php'; 
?>

<div class="min-h-screen pt-24 flex items-center justify-center px-6 pb-20">
    <div class="max-w-md w-full bg-white rounded-[3rem] p-12 shadow-2xl">
        <div class="text-center mb-10">
            <a href="index.php" class="inline-flex items-center gap-2 mb-6 group">
                <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white transition-transform group-hover:rotate-12">
                    <i data-lucide="heart-pulse" size="28"></i>
                </div>
                <span class="font-display font-bold text-2xl tracking-tight text-primary">City Care</span>
            </a>
            <h1 class="text-3xl font-display font-bold text-secondary mb-2">Welcome Back</h1>
            <p class="text-secondary/60">Log in to your patient portal account</p>
        </div>

        <?php if($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl mb-6 text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form class="space-y-6" method="POST" action="login.php">
            <div class="space-y-2">
                <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest ml-1">Email Address</label>
                <div class="relative group">
                    <i data-lucide="mail" class="absolute left-5 top-1/2 -translate-y-1/2 text-secondary/40 group-focus-within:text-primary transition-colors" size="20"></i>
                    <input
                        type="email"
                        name="email"
                        required
                        class="w-full bg-surface-soft border-none rounded-2xl pl-14 pr-6 py-4 outline-none focus:ring-2 ring-primary/20 transition-all"
                        placeholder="john@example.com"
                    />
                </div>
            </div>

            <div class="space-y-2">
                <div class="flex justify-between items-center ml-1">
                    <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest">Password</label>
                    <a href="#" class="text-sm font-bold text-primary hover:underline">Forgot?</a>
                </div>
                <div class="relative group">
                    <i data-lucide="lock" class="absolute left-5 top-1/2 -translate-y-1/2 text-secondary/40 group-focus-within:text-primary transition-colors" size="20"></i>
                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full bg-surface-soft border-none rounded-2xl pl-14 pr-6 py-4 outline-none focus:ring-2 ring-primary/20 transition-all"
                        placeholder="••••••••"
                    />
                </div>
            </div>

            <button type="submit" class="btn-primary w-full py-5 text-lg flex items-center justify-center gap-2">
                Log In <i data-lucide="arrow-right" size="20"></i>
            </button>
        </form>

        <div class="mt-10">
            <div class="relative flex items-center gap-4 mb-8">
                <div class="flex-1 h-px bg-secondary/10"></div>
                <span class="text-sm text-secondary/40 font-bold uppercase tracking-widest">Or continue with</span>
                <div class="flex-1 h-px bg-secondary/10"></div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <a href="google_login.php" class="flex items-center justify-center gap-3 bg-surface-soft hover:bg-accent transition-colors py-4 rounded-2xl text-secondary font-bold">
                    <svg viewBox="0 0 24 24" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg> Google
                </a>
                <a href="facebook_login.php" class="flex items-center justify-center gap-3 bg-[#1877F2]/10 hover:bg-[#1877F2]/20 transition-colors py-4 rounded-2xl text-[#1877F2] font-bold">
                    <svg viewBox="0 0 24 24" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23.998 12c0-6.628-5.372-12-11.999-12C5.372 0 0 5.372 0 12c0 5.988 4.388 10.954 10.124 11.852v-8.384H7.078v-3.469h3.046V9.356c0-3.008 1.792-4.669 4.532-4.669 1.313 0 2.686.234 2.686.234v2.953H15.83c-1.49 0-1.955.925-1.955 1.874V12h3.328l-.532 3.469h-2.796v8.384c5.736-.898 10.124-5.864 10.124-11.853z" fill="#1877F2"/>
                    </svg> Facebook
                </a>
            </div>
        </div>

        <p class="mt-10 text-center text-secondary/60 font-medium">
            Don't have an account? <a href="register.php" class="text-primary font-bold hover:underline">Create Account</a>
        </p>
    </div>
</div>

<?php include 'footer.php'; ?>
