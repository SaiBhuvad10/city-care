<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

$doctor_id = isset($_GET['doctor_id']) ? (int)$_GET['doctor_id'] : 0;
$user_id = $_SESSION['user_id'];
$error = "";

$stmt = $conn->prepare("SELECT * FROM doctors WHERE id = ?");
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$doctor_result = $stmt->get_result();

if ($doctor_result->num_rows == 0) {
    header("Location: doctors.php");
    exit();
}
$doctor = $doctor_result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $notes = htmlspecialchars($_POST['notes']);
    $meeting_type = isset($_POST['meeting_type']) ? $_POST['meeting_type'] : 'In-Person';
    
    $time_hour = (int)date('H', strtotime($appointment_time));
    if ($time_hour < 9 || $time_hour >= 17) {
        $error = "Appointments are only available between 9:00 AM and 5:00 PM.";
    } elseif ($appointment_date < date('Y-m-d')) {
        $error = "Appointment date cannot be in the past.";
    } else {
        $stmt = $conn->prepare("INSERT INTO appointments (user_id, doctor_id, appointment_date, appointment_time, meeting_type, notes, status) VALUES (?, ?, ?, ?, ?, ?, 'Pending')");
        $stmt->bind_param("iissss", $user_id, $doctor_id, $appointment_date, $appointment_time, $meeting_type, $notes);
        
        if ($stmt->execute()) {
            header("Location: my_appointments.php?success=1");
            exit();
        } else {
            $error = "Failed to book appointment. Please try again.";
        }
    }
}

include 'header.php';
?>

<div class="pt-32 min-h-screen px-6 pb-20">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <a href="doctors.php" class="w-10 h-10 rounded-full bg-surface-soft flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors">
                <i data-lucide="arrow-left" size="20"></i>
            </a>
            <h1 class="text-4xl font-display font-bold text-secondary">Book Appointment</h1>
        </div>
        
        <?php if($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl mb-6 text-center font-bold">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-[3rem] shadow-xl overflow-hidden flex flex-col md:flex-row">
            <div class="md:w-1/3 bg-surface-soft p-10 flex flex-col items-center text-center">
                <img src="<?php echo $doctor['image_url']; ?>" alt="<?php echo $doctor['name']; ?>" class="w-40 h-40 object-cover rounded-full shadow-lg mb-6 border-4 border-white">
                <div class="text-primary font-bold text-sm uppercase tracking-widest mb-1"><?php echo $doctor['specialty']; ?></div>
                <h2 class="text-2xl font-display font-bold text-secondary mb-2"><?php echo $doctor['name']; ?></h2>
                <div class="flex items-center gap-2 text-secondary/60 font-medium mb-6">
                    <i data-lucide="star" size="16" class="text-yellow-500 fill-yellow-500"></i>
                    <?php echo $doctor['rating']; ?> | <?php echo $doctor['experience']; ?>
                </div>
                <p class="text-secondary/70 text-sm leading-relaxed">
                    You are scheduling a consultation. Please fill out the details on the right.
                </p>
            </div>
            
            <div class="md:w-2/3 p-10">
                <form method="POST" action="book_appointment.php?doctor_id=<?php echo $doctor_id; ?>" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest">Select Date</label>
                            <input 
                                type="date" 
                                name="appointment_date" 
                                min="<?php echo date('Y-m-d'); ?>" 
                                required 
                                class="w-full bg-surface-soft border-none rounded-2xl px-6 py-4 outline-none focus:ring-2 ring-primary/20 text-secondary font-medium"
                            >
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest">Select Time</label>
                            <input 
                                type="time" 
                                name="appointment_time" 
                                min="09:00" 
                                max="17:00" 
                                required 
                                class="w-full bg-surface-soft border-none rounded-2xl px-6 py-4 outline-none focus:ring-2 ring-primary/20 text-secondary font-medium"
                            >
                            <p class="text-xs text-secondary/50 font-medium mt-1">Available 9:00 AM - 5:00 PM</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest">Meeting Type</label>
                        <div class="relative group">
                            <select name="meeting_type" required class="w-full bg-surface-soft border-none rounded-2xl px-6 py-4 outline-none focus:ring-2 ring-primary/20 text-secondary font-medium appearance-none cursor-pointer">
                                <option value="In-Person">In-Person at Hospital</option>
                                <option value="Online Meeting">Online Video Consultation</option>
                            </select>
                            <i data-lucide="chevron-down" class="absolute right-5 top-1/2 -translate-y-1/2 text-secondary/40 pointer-events-none" size="20"></i>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest">Symptoms / Notes (Optional)</label>
                        <textarea 
                            name="notes" 
                            class="w-full bg-surface-soft border-none rounded-2xl px-6 py-4 outline-none focus:ring-2 ring-primary/20 h-32 resize-none text-secondary" 
                            placeholder="Briefly describe your symptoms or reason for visit..."
                        ></textarea>
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="btn-primary w-full py-5 text-lg flex items-center justify-center gap-2">
                            Confirm Booking <i data-lucide="check-circle" size="20"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
