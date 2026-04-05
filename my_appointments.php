<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

$user_id = $_SESSION['user_id'];
$success_msg = isset($_GET['success']) ? "Your appointment request has been submitted and is currently Pending approval." : "";

// Fetch user's appointments
$stmt = $conn->prepare("
    SELECT a.*, d.name AS doctor_name, d.specialty, d.image_url 
    FROM appointments a 
    JOIN doctors d ON a.doctor_id = d.id 
    WHERE a.user_id = ? 
    ORDER BY a.appointment_date DESC, a.appointment_time DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$appointments = $stmt->get_result();

include 'header.php';
?>

<div class="pt-32 min-h-screen px-6 pb-20 bg-surface-soft">
    <div class="max-w-6xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-12">
            <div>
                <h1 class="text-4xl font-display font-bold text-secondary mb-2">My Appointments</h1>
                <p class="text-secondary/70">Manage and track your scheduled visits with our specialists.</p>
            </div>
            <div class="flex gap-4 mt-6 md:mt-0">
                <a href="patient_messages.php" class="btn-secondary px-8 flex items-center gap-2"><i data-lucide="message-square" size="18"></i> Message Hospital</a>
                <a href="doctors.php" class="btn-primary px-8 flex items-center gap-2">Book New Appointment</a>
            </div>
        </div>

        <?php if($success_msg): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-2xl mb-10 shadow-sm flex items-center gap-3 font-bold">
                <i data-lucide="check-circle-2" size="24"></i>
                <?php echo $success_msg; ?>
            </div>
        <?php endif; ?>

        <?php if ($appointments->num_rows > 0): ?>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <?php while($apt = $appointments->fetch_assoc()): 
                    // Format dates and times
                    $dateObj = new DateTime($apt['appointment_date']);
                    $formattedDate = $dateObj->format('F j, Y');
                    $timeObj = new DateTime($apt['appointment_time']);
                    $formattedTime = $timeObj->format('g:i A');
                    
                    // Status color logic
                    $statusColor = "bg-yellow-100 text-yellow-800";
                    $statusIcon = "clock";
                    if ($apt['status'] == 'Confirmed') {
                        $statusColor = "bg-green-100 text-green-800";
                        $statusIcon = "check-circle";
                    } elseif ($apt['status'] == 'Completed') {
                        $statusColor = "bg-blue-100 text-blue-800";
                        $statusIcon = "check-square";
                    } elseif ($apt['status'] == 'Cancelled') {
                        $statusColor = "bg-red-100 text-red-800";
                        $statusIcon = "x-circle";
                    }
                ?>
                <div class="bg-white rounded-[2rem] p-8 shadow-sm flex flex-col md:flex-row gap-6 border border-secondary/5 hover:shadow-xl transition-shadow">
                    <img src="<?php echo $apt['image_url']; ?>" alt="Dr. <?php echo $apt['doctor_name']; ?>" class="w-24 h-24 rounded-full object-cover shadow-md mx-auto md:mx-0">
                    
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <div class="text-primary font-bold text-xs uppercase tracking-widest mb-1"><?php echo $apt['specialty']; ?></div>
                                <h3 class="text-xl font-display font-bold text-secondary"><?php echo $apt['doctor_name']; ?></h3>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold <?php echo $statusColor; ?>">
                                <i data-lucide="<?php echo $statusIcon; ?>" size="14"></i>
                                <?php echo $apt['status']; ?>
                            </span>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 text-secondary/70 font-medium mb-4 mt-4">
                            <div class="flex items-center gap-2 bg-surface-soft px-4 py-2 rounded-xl">
                                <i data-lucide="calendar" size="18" class="text-primary"></i>
                                <?php echo $formattedDate; ?>
                            </div>
                            <div class="flex items-center gap-2 bg-surface-soft px-4 py-2 rounded-xl">
                                <i data-lucide="clock" size="18" class="text-primary"></i>
                                <?php echo $formattedTime; ?>
                            </div>
                            
                            <div class="flex items-center gap-2 bg-primary/5 text-primary px-4 py-2 rounded-xl font-bold uppercase tracking-widest text-xs">
                                <i data-lucide="<?php echo (isset($apt['meeting_type']) && $apt['meeting_type'] == 'Online Meeting') ? 'video' : 'map-pin'; ?>" size="16"></i>
                                <?php echo isset($apt['meeting_type']) ? $apt['meeting_type'] : 'In-Person'; ?>
                            </div>
                        </div>
                        
                        <?php if(isset($apt['meeting_type']) && $apt['meeting_type'] == 'Online Meeting' && $apt['status'] == 'Confirmed' && !empty($apt['meeting_link'])): ?>
                            <div class="mt-4">
                                <a href="<?php echo htmlspecialchars($apt['meeting_link']); ?>" target="_blank" class="inline-flex items-center gap-2 bg-primary text-white hover:scale-105 px-6 py-3 rounded-xl font-bold transition-all shadow-md">
                                    <i data-lucide="video" size="18"></i> Join Online Meeting
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if($apt['notes']): ?>
                            <div class="bg-accent/50 p-4 rounded-xl text-sm text-secondary/80 mt-4 border border-primary/10">
                                <strong>Your Notes:</strong> <?php echo htmlspecialchars($apt['notes']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-[3rem] p-16 text-center shadow-sm">
                <div class="w-24 h-24 bg-accent text-primary rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="calendar-x" size="40"></i>
                </div>
                <h2 class="text-3xl font-display font-bold text-secondary mb-4">No Appointments Yet</h2>
                <p class="text-secondary/60 text-lg mb-8 max-w-md mx-auto">You haven't scheduled any consultations with our specialists. Book your first appointment today to prioritize your health.</p>
                <a href="doctors.php" class="btn-primary px-10 py-4 text-lg inline-block">Find a Doctor</a>
            </div>
        <?php endif; ?>
        
    </div>
</div>

<?php include 'footer.php'; ?>
