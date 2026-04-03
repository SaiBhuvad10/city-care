<?php include 'header.php'; ?>

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

        <form class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest ml-1">First Name</label>
                    <div class="relative group">
                        <i data-lucide="user" class="absolute left-5 top-1/2 -translate-y-1/2 text-secondary/40 group-focus-within:text-primary transition-colors" size="20"></i>
                        <input
                            type="text"
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
                        class="w-full bg-surface-soft border-none rounded-2xl pl-14 pr-6 py-4 outline-none focus:ring-2 ring-primary/20 transition-all"
                        placeholder="••••••••"
                    />
                </div>
            </div>

            <div class="flex items-start gap-3 ml-1">
                <input type="checkbox" class="mt-1 w-5 h-5 rounded-lg border-none bg-surface-soft text-primary focus:ring-primary/20" />
                <p class="text-sm text-secondary/60 leading-relaxed">
                    I agree to the <a href="#" class="text-primary font-bold hover:underline">Terms of Service</a> and <a href="#" class="text-primary font-bold hover:underline">Privacy Policy</a>.
                </p>
            </div>

            <button class="btn-primary w-full py-5 text-lg flex items-center justify-center gap-2">
                Create Account <i data-lucide="arrow-right" size="20"></i>
            </button>
        </form>

        <p class="mt-10 text-center text-secondary/60 font-medium">
            Already have an account? <a href="login.php" class="text-primary font-bold hover:underline">Log In</a>
        </p>
    </div>
</div>

<?php include 'footer.php'; ?>
