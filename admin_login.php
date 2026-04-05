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
            if ($user['role'] != 'admin') {
                $error = "Access denied: Not an Administrator account.";
            } else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['full_name'];
                $_SESSION['user_role'] = $user['role'];
                header("Location: admin_dashboard.php");
                exit();
            }
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
                    <i data-lucide="shield-check" size="28"></i>
                </div>
                <span class="font-display font-bold text-2xl tracking-tight text-primary">City Care</span>
            </a>
            <h1 class="text-3xl font-display font-bold text-secondary mb-2">Admin Portal</h1>
            <p class="text-secondary/60">Log in to manage hospital operations</p>
        </div>

        <?php if($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl mb-6 text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form class="space-y-6" method="POST" action="admin_login.php">
            <div class="space-y-2">
                <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest ml-1">Admin Email</label>
                <div class="relative group">
                    <i data-lucide="mail" class="absolute left-5 top-1/2 -translate-y-1/2 text-secondary/40 group-focus-within:text-primary transition-colors" size="20"></i>
                    <input
                        type="email"
                        name="email"
                        required
                        class="w-full bg-surface-soft border-none rounded-2xl pl-14 pr-6 py-4 outline-none focus:ring-2 ring-primary/20 transition-all"
                        placeholder="admin@hospital.com"
                    />
                </div>
            </div>

            <div class="space-y-2">
                <div class="flex justify-between items-center ml-1">
                    <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest">Password</label>
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

        <p class="mt-10 text-center text-secondary/60 font-medium">
            Are you a patient? <a href="login.php" class="text-primary font-bold hover:underline">Patient Login</a>
        </p>
    </div>
</div>

<?php include 'footer.php'; ?>
