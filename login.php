<?php include 'header.php'; ?>

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

        <form class="space-y-6">
            <div class="space-y-2">
                <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest ml-1">Email Address</label>
                <div class="relative group">
                    <i data-lucide="mail" class="absolute left-5 top-1/2 -translate-y-1/2 text-secondary/40 group-focus-within:text-primary transition-colors" size="20"></i>
                    <input
                        type="email"
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
                        class="w-full bg-surface-soft border-none rounded-2xl pl-14 pr-6 py-4 outline-none focus:ring-2 ring-primary/20 transition-all"
                        placeholder="••••••••"
                    />
                </div>
            </div>

            <button class="btn-primary w-full py-5 text-lg flex items-center justify-center gap-2">
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
                <button class="flex items-center justify-center gap-3 bg-surface-soft hover:bg-accent transition-colors py-4 rounded-2xl text-secondary font-bold">
                    <i data-lucide="chrome" size="20"></i> Google
                </button>
                <button class="flex items-center justify-center gap-3 bg-surface-soft hover:bg-accent transition-colors py-4 rounded-2xl text-secondary font-bold">
                    <i data-lucide="github" size="20"></i> GitHub
                </button>
            </div>
        </div>

        <p class="mt-10 text-center text-secondary/60 font-medium">
            Don't have an account? <a href="register.php" class="text-primary font-bold hover:underline">Create Account</a>
        </p>
    </div>
</div>

<?php include 'footer.php'; ?>
