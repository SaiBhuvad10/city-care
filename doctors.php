<?php 
include 'header.php'; 
include 'db_connect.php';
$conn->query("UPDATE doctors SET image_url = 'https://images.pexels.com/photos/5215024/pexels-photo-5215024.jpeg?auto=compress&cs=tinysrgb&w=400' WHERE name LIKE '%Sarah Johnson%'");
$conn->query("UPDATE doctors SET image_url = 'https://images.pexels.com/photos/4173239/pexels-photo-4173239.jpeg?auto=compress&cs=tinysrgb&w=400' WHERE name LIKE '%James Wilson%'");

$search = isset($_GET['search']) ? $_GET['search'] : '';
$specialty = isset($_GET['specialty']) ? $_GET['specialty'] : 'All Specialties';

$sql = "SELECT * FROM doctors WHERE 1=1";
if ($search != '') {
    $sql .= " AND (name LIKE '%$search%' OR specialty LIKE '%$search%')";
}
if ($specialty != 'All Specialties') {
    $sql .= " AND specialty = '$specialty'";
}

$result = $conn->query($sql);
?>

<div class="pt-24 min-h-screen">
    <!-- Header Section -->
    <section class="px-6 py-20 bg-surface-soft">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl md:text-7xl font-display font-extrabold text-secondary leading-tight mb-8">
                World-class specialists <br /> <span class="text-primary italic">dedicated</span> to your care.
            </h1>
            <p class="text-xl text-secondary/70 leading-relaxed max-w-3xl mx-auto mb-12">
                Our team of highly skilled and compassionate doctors is here to provide you with the best medical care and support.
            </p>
            
            <!-- Search and Filter Bar -->
            <form action="doctors.php" method="GET" class="max-w-4xl mx-auto glass-bar rounded-full p-2 flex flex-col md:flex-row items-center gap-2 shadow-xl">
                <div class="flex-1 flex items-center justify-center gap-4 px-6 py-3 w-full">
                    <i data-lucide="search" class="text-secondary/40" size="20"></i>
                    <input
                        type="text"
                        name="search"
                        value="<?php echo htmlspecialchars($search); ?>"
                        placeholder="Search by name or specialty..."
                        class="bg-transparent border-none outline-none w-full text-secondary font-medium placeholder:text-secondary/40 text-center"
                    />
                </div>
                <div class="h-8 w-px bg-secondary/10 hidden md:block"></div>
                <div class="flex items-center gap-4 px-6 py-3 w-full md:w-auto">
                    <i data-lucide="filter" class="text-secondary/40" size="20"></i>
                    <select name="specialty" class="bg-transparent border-none outline-none text-secondary font-medium cursor-pointer">
                        <option <?php echo $specialty == 'All Specialties' ? 'selected' : ''; ?>>All Specialties</option>
                        <option <?php echo $specialty == 'Cardiology' ? 'selected' : ''; ?>>Cardiology</option>
                        <option <?php echo $specialty == 'Neurology' ? 'selected' : ''; ?>>Neurology</option>
                        <option <?php echo $specialty == 'Pediatrics' ? 'selected' : ''; ?>>Pediatrics</option>
                        <option <?php echo $specialty == 'Orthopedic Surgeon' ? 'selected' : ''; ?>>Orthopedic Surgeon</option>
                        <option <?php echo $specialty == 'Oncologist' ? 'selected' : ''; ?>>Oncologist</option>
                        <option <?php echo $specialty == 'Dermatologist' ? 'selected' : ''; ?>>Dermatologist</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary w-full md:w-auto px-10">Search</button>
            </form>
        </div>
    </section>

    <!-- Doctors Grid -->
    <section class="py-24 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            <?php
            if ($result->num_rows > 0):
                while($doctor = $result->fetch_assoc()):
            ?>
            <div class="bg-white rounded-[3rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group">
                <div class="aspect-[4/5] overflow-hidden relative">
                    <img
                        src="<?php echo $doctor['image_url']; ?>"
                        alt="<?php echo $doctor['name']; ?>"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        referrerPolicy="no-referrer"
                    />
                    <div class="absolute top-6 right-6 glass-bar px-4 py-2 rounded-full flex items-center gap-2 text-secondary font-bold">
                        <i data-lucide="star" size="16" class="text-yellow-500 fill-yellow-500"></i>
                        <?php echo $doctor['rating']; ?>
                    </div>
                </div>
                <div class="p-10">
                    <div class="text-primary font-bold text-sm uppercase tracking-widest mb-2"><?php echo $doctor['specialty']; ?></div>
                    <h3 class="text-2xl font-display font-bold text-secondary mb-4"><?php echo $doctor['name']; ?></h3>
                    <div class="flex items-center gap-6 text-secondary/60 mb-8 font-medium">
                        <div class="flex items-center gap-2">
                            <i data-lucide="calendar" size="18"></i>
                            <?php echo $doctor['experience']; ?>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="message-square" size="18"></i>
                            100+ Reviews
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <a href="book_appointment.php?doctor_id=<?php echo $doctor['id']; ?>" class="btn-primary flex-1 py-3 text-sm text-center font-bold">Book Appointment</a>
                        <button class="w-12 h-12 rounded-full bg-surface-soft flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors">
                            <i data-lucide="arrow-right" size="20"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php 
                endwhile;
            else:
            ?>
                <div class="col-span-full text-center py-20">
                    <h3 class="text-2xl font-display font-bold text-secondary">No doctors found matching your criteria.</h3>
                    <p class="text-secondary/60 mt-4">Try adjusting your search or filters.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>


</div>

<?php include 'footer.php'; ?>
