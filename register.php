<?php 
include 'header.php'; 
include 'db_connect.php';

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $full_name = $first_name . " " . $last_name;

    $checkEmail = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        $error = "Email already exists!";
    } else {
        $sql = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            $message = "Registration successful! <a href='login.php' class='underline font-bold'>Login here</a>";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<div class="min-h-screen pt-24 flex items-center justify-center px-6 pb-20">
    <div class="max-w-xl w-full bg-white rounded-[3rem] p-12 shadow-2xl">
        <div class="text-center mb-10">
            <a href="index.php" class="inline-flex items-center gap-2 mb-6 group">
                <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white transition-transform group-hover:rotate-12">
                    <i data-lucide="heart-pulse" size="28"></i>
                </div>
                <span class="font-display font-bold text-2xl tracking-tight text-primary">City Care</span>
            </a>
            <h1 class="text-3xl font-display font-bold text-secondary mb-2">Create Account</h1>
            <p class="text-secondary/60">Join the City Care patient community</p>
        </div>

        <?php if($message): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-2xl mb-6 text-center">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl mb-6 text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form class="space-y-6" method="POST" action="register.php">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest ml-1">First Name</label>
                    <div class="relative group">
                        <i data-lucide="user" class="absolute left-5 top-1/2 -translate-y-1/2 text-secondary/40 group-focus-within:text-primary transition-colors" size="20"></i>
                        <input
                            type="text"
                            name="first_name"
                            required
                            class="w-full bg-surface-soft border-none rounded-2xl pl-14 pr-6 py-4 outline-none focus:ring-2 ring-primary/20 transition-all"
                            placeholder="John"
                        />
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest ml-1">Last Name</label>
                    <div class="relative group">
                        <i data-lucide="user" class="absolute left-5 top-1/2 -translate-y-1/2 text-secondary/40 group-focus-within:text-primary transition-colors" size="20"></i>
                        <input
                            type="text"
                            name="last_name"
                            required
                            class="w-full bg-surface-soft border-none rounded-2xl pl-14 pr-6 py-4 outline-none focus:ring-2 ring-primary/20 transition-all"
                            placeholder="Doe"
                        />
                    </div>
                </div>
            </div>

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
                <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest ml-1">Phone Number</label>
                <div class="relative group">
                    <i data-lucide="phone" class="absolute left-5 top-1/2 -translate-y-1/2 text-secondary/40 group-focus-within:text-primary transition-colors" size="20"></i>
                    <input
                        type="tel"
                        name="phone"
                        class="w-full bg-surface-soft border-none rounded-2xl pl-14 pr-6 py-4 outline-none focus:ring-2 ring-primary/20 transition-all"
                        placeholder="+1 (555) 000-0000"
                    />
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest ml-1">Password</label>
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

            <div class="flex items-start gap-3 ml-1">
                <input type="checkbox" required class="mt-1 w-5 h-5 rounded-lg border-none bg-surface-soft text-primary focus:ring-primary/20" />
                <p class="text-sm text-secondary/60 leading-relaxed">
                    I agree to the <a href="#" class="text-primary font-bold hover:underline">Terms of Service</a> and <a href="#" class="text-primary font-bold hover:underline">Privacy Policy</a>.
                </p>
            </div>

            <button type="submit" class="btn-primary w-full py-5 text-lg flex items-center justify-center gap-2">
                Create Account <i data-lucide="arrow-right" size="20"></i>
            </button>
        </form>

        <p class="mt-10 text-center text-secondary/60 font-medium">
            Already have an account? <a href="login.php" class="text-primary font-bold hover:underline">Log In</a>
        </p>
    </div>
</div>

<?php include 'footer.php'; ?>
