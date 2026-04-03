<?php include 'header.php'; ?>

<div class="pt-24 min-h-screen">
    <!-- Header Section -->
    <section class="px-6 py-20 bg-surface-soft">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl md:text-7xl font-display font-extrabold text-secondary leading-tight mb-8">
                Comprehensive care <br /> <span class="text-primary italic">tailored</span> to you.
            </h1>
            <p class="text-xl text-secondary/70 leading-relaxed max-w-3xl mx-auto">
                From routine check-ups to advanced surgical procedures, our specialized departments are equipped with the latest technology and world-class expertise.
            </p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-24 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            <?php
            $services = [
                [
                    'title' => 'Cardiology',
                    'icon' => 'heart',
                    'desc' => 'Our cardiology department provides comprehensive heart care, including diagnostics, treatment, and rehabilitation for cardiac conditions.',
                    'features' => ['Heart Surgery', 'Diagnostic Testing', 'Cardiac Rehab'],
                ],
                [
                    'title' => 'Neurology',
                    'icon' => 'brain',
                    'desc' => 'Expert care for neurological disorders, from stroke management to specialized treatments for epilepsy and multiple sclerosis.',
                    'features' => ['Brain Imaging', 'Stroke Care', 'Sleep Studies'],
                ],
                [
                    'title' => 'Pediatrics',
                    'icon' => 'baby',
                    'desc' => 'Dedicated to the health and well-being of children, offering routine check-ups, vaccinations, and specialized pediatric care.',
                    'features' => ['Well-child Visits', 'Immunizations', 'Pediatric Surgery'],
                ],
                [
                    'title' => 'Orthopedics',
                    'icon' => 'activity',
                    'desc' => 'Specialized care for bone and joint health, including joint replacement, sports medicine, and physical therapy.',
                    'features' => ['Joint Replacement', 'Sports Medicine', 'Physical Therapy'],
                ],
                [
                    'title' => 'Diagnostic Labs',
                    'icon' => 'microscope',
                    'desc' => 'State-of-the-art laboratory services providing accurate and timely diagnostic testing for effective treatment planning.',
                    'features' => ['Blood Tests', 'Pathology', 'Molecular Diagnostics'],
                ],
                [
                    'title' => 'Emergency Care',
                    'icon' => 'stethoscope',
                    'desc' => '24/7 emergency medical services with a highly trained team ready to handle critical situations with speed and precision.',
                    'features' => ['Trauma Care', 'Critical Care', 'Ambulance Service'],
                ],
            ];

            foreach ($services as $service):
            ?>
            <div class="bg-white rounded-[3rem] p-10 shadow-sm hover:shadow-2xl transition-all duration-500 group">
                <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-8 group-hover:bg-primary group-hover:text-white transition-colors duration-500">
                    <i data-lucide="<?php echo $service['icon']; ?>" size="32"></i>
                </div>
                <h3 class="text-2xl font-display font-bold text-secondary mb-4"><?php echo $service['title']; ?></h3>
                <p class="text-secondary/70 leading-relaxed mb-8"><?php echo $service['desc']; ?></p>
                <ul class="space-y-3 mb-8">
                    <?php foreach ($service['features'] as $feature): ?>
                    <li class="flex items-center gap-3 text-secondary/60">
                        <div class="w-1.5 h-1.5 bg-primary rounded-full"></div>
                        <?php echo $feature; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <button class="text-primary font-bold flex items-center gap-2 group/btn">
                    Learn More <i data-lucide="activity" size="18" class="transition-transform group-hover/btn:translate-x-1"></i>
                </button>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-24 px-6 bg-secondary text-white rounded-[4rem] mx-6 mb-24 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-1/2 h-full opacity-10 pointer-events-none">
            <div class="absolute top-1/2 right-0 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div>
                <h2 class="text-4xl md:text-5xl font-display font-bold mb-8">
                    Why choose City Care for your medical needs?
                </h2>
                <div class="space-y-8">
                    <div class="flex gap-6">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-primary shrink-0">
                            <i data-lucide="activity" size="24"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold mb-2">Advanced Technology</h4>
                            <p class="text-white/60 leading-relaxed">We invest in the latest medical equipment and diagnostic tools to ensure the highest level of accuracy and care.</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-primary shrink-0">
                            <i data-lucide="users" size="24"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold mb-2">Patient-Centered Care</h4>
                            <p class="text-white/60 leading-relaxed">Your comfort and well-being are our top priorities. We provide personalized care plans tailored to your journey.</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-primary shrink-0">
                            <i data-lucide="shield-check" size="24"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold mb-2">Expert Specialists</h4>
                            <p class="text-white/60 leading-relaxed">Our team consists of world-renowned specialists dedicated to providing the best clinical outcomes.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-square rounded-[3rem] overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&q=80&w=1000" alt="Medical Technology" class="w-full h-full object-cover" referrerPolicy="no-referrer">
                </div>
                <div class="absolute -bottom-10 -right-10 glass-bar p-8 rounded-3xl shadow-xl max-w-xs text-secondary hidden md:block">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                            <i data-lucide="clock" size="24"></i>
                        </div>
                        <span class="font-display font-bold text-lg">24/7 Support</span>
                    </div>
                    <p class="text-sm text-secondary/70 leading-relaxed">
                        Emergency care and patient support are available around the clock for your peace of mind.
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?>
