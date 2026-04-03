<?php include 'header.php'; ?>

<div class="pt-24">
    <!-- Hero Section -->
    <section class="relative px-6 py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-flex items-center gap-2 bg-accent text-primary px-4 py-1.5 rounded-full text-sm font-semibold mb-6">
                    <i data-lucide="activity" size="16"></i>
                    <span>Leading Healthcare in Health City</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-display font-extrabold text-secondary leading-[1.1] mb-8">
                    The future of <span class="text-primary italic">human-centered</span> clinical excellence.
                </h1>
                <p class="text-xl text-secondary/70 leading-relaxed max-w-xl mb-10">
                    Experience world-class healthcare with a personal touch. Our state-of-the-art facilities and dedicated specialists are here for your journey to wellness.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="services.php" class="btn-primary flex items-center gap-2">
                        Explore Services <i data-lucide="arrow-right" size="20"></i>
                    </a>
                    <a href="doctors.php" class="btn-secondary">
                        Meet Our Doctors
                    </a>
                </div>
            </div>

            <div class="relative">
                <div class="aspect-[4/5] rounded-[3rem] overflow-hidden shadow-2xl">
                    <img
                        src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=1000"
                        alt="Modern Hospital Interior"
                        class="w-full h-full object-cover"
                        referrerPolicy="no-referrer"
                    />
                </div>
                <div class="absolute -bottom-10 -left-10 glass-bar p-8 rounded-3xl shadow-xl max-w-xs hidden md:block">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                            <i data-lucide="shield-check" size="24"></i>
                        </div>
                        <span class="font-display font-bold text-lg text-secondary">Certified Excellence</span>
                    </div>
                    <p class="text-sm text-secondary/70 leading-relaxed">
                        Ranked #1 for patient satisfaction and clinical outcomes in the region for 5 consecutive years.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 px-6 bg-surface-soft">
        <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-primary mx-auto mb-4 shadow-sm">
                    <i data-lucide="users" size="24"></i>
                </div>
                <div class="text-3xl font-display font-bold text-secondary mb-1">150+</div>
                <div class="text-secondary/50 font-medium">Specialists</div>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-primary mx-auto mb-4 shadow-sm">
                    <i data-lucide="activity" size="24"></i>
                </div>
                <div class="text-3xl font-display font-bold text-secondary mb-1">500+</div>
                <div class="text-secondary/50 font-medium">Patient Beds</div>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-primary mx-auto mb-4 shadow-sm">
                    <i data-lucide="clock" size="24"></i>
                </div>
                <div class="text-3xl font-display font-bold text-secondary mb-1">25+</div>
                <div class="text-secondary/50 font-medium">Years of Care</div>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-primary mx-auto mb-4 shadow-sm">
                    <i data-lucide="shield-check" size="24"></i>
                </div>
                <div class="text-3xl font-display font-bold text-secondary mb-1">99%</div>
                <div class="text-secondary/50 font-medium">Success Rate</div>
            </div>
        </div>
    </section>

    <!-- Featured Services -->
    <section class="py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end gap-8 mb-16">
                <div class="max-w-2xl">
                    <h2 class="text-4xl md:text-5xl font-display font-bold text-secondary mb-6">
                        Comprehensive care <span class="text-primary">tailored</span> to your needs.
                    </h2>
                    <p class="text-lg text-secondary/70 leading-relaxed">
                        We offer a wide range of medical services, from routine check-ups to complex surgical procedures, all delivered with compassion and expertise.
                    </p>
                </div>
                <a href="services.php" class="text-primary font-bold flex items-center gap-2 group">
                    View All Services <i data-lucide="arrow-right" size="20" class="transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500">
                    <div class="aspect-video overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1628348068343-c6a848d2b6dd?auto=format&fit=crop&q=80&w=600" alt="Cardiology" class="w-full h-full object-cover transition-transform duration-700 hover:scale-110" referrerPolicy="no-referrer">
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-display font-bold text-secondary mb-4">Cardiology</h3>
                        <p class="text-secondary/70 leading-relaxed mb-6">Advanced heart care using the latest diagnostic and treatment technologies.</p>
                        <a href="services.php" class="text-primary font-semibold flex items-center gap-2">Learn More <i data-lucide="arrow-right" size="18"></i></a>
                    </div>
                </div>
                <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500">
                    <div class="aspect-video overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1559757175-5700dde675bc?auto=format&fit=crop&q=80&w=600" alt="Neurology" class="w-full h-full object-cover transition-transform duration-700 hover:scale-110" referrerPolicy="no-referrer">
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-display font-bold text-secondary mb-4">Neurology</h3>
                        <p class="text-secondary/70 leading-relaxed mb-6">Specialized care for disorders of the nervous system and brain health.</p>
                        <a href="services.php" class="text-primary font-semibold flex items-center gap-2">Learn More <i data-lucide="arrow-right" size="18"></i></a>
                    </div>
                </div>
                <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500">
                    <div class="aspect-video overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?auto=format&fit=crop&q=80&w=600" alt="Pediatrics" class="w-full h-full object-cover transition-transform duration-700 hover:scale-110" referrerPolicy="no-referrer">
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-display font-bold text-secondary mb-4">Pediatrics</h3>
                        <p class="text-secondary/70 leading-relaxed mb-6">Compassionate medical care for infants, children, and adolescents.</p>
                        <a href="services.php" class="text-primary font-semibold flex items-center gap-2">Learn More <i data-lucide="arrow-right" size="18"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 px-6">
        <div class="max-w-7xl mx-auto bg-primary rounded-[4rem] p-12 md:p-24 relative overflow-hidden text-center">
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            </div>
            <div class="relative z-10">
                <h2 class="text-4xl md:text-6xl font-display font-bold text-white mb-8">
                    Ready to experience <br /> better healthcare?
                </h2>
                <p class="text-xl text-white/80 max-w-2xl mx-auto mb-12">
                    Book your appointment today and take the first step towards a healthier, happier life with City Care Hospital.
                </p>
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="login.php" class="bg-white text-primary px-10 py-4 rounded-full font-bold text-lg hover:scale-105 transition-transform">
                        Book Appointment
                    </a>
                    <a href="doctors.php" class="bg-primary-dark border border-white/20 text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-white/10 transition-colors">
                        Find a Doctor
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?>
