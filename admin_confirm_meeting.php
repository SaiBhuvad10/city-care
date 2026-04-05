<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    die("Access Denied.");
}

include 'db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$appointment_id = (int)$_GET['id'];
$error = "";

// Fetch appointment details
$stmt = $conn->prepare("SELECT a.*, u.full_name AS patient_name FROM appointments a JOIN users u ON a.user_id = u.id WHERE a.id = ?");
$stmt->bind_param("i", $appointment_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Appointment not found.");
}
$appointment = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meeting_link = trim($_POST['meeting_link']);
    
    if (empty($meeting_link)) {
        $error = "Meeting link is required.";
    } else {
        $stmt = $conn->prepare("UPDATE appointments SET status = 'Confirmed', meeting_link = ? WHERE id = ?");
        $stmt->bind_param("si", $meeting_link, $appointment_id);
        
        if ($stmt->execute()) {
            header("Location: admin_dashboard.php?success=1");
            exit();
        } else {
            $error = "Failed to update meeting details.";
        }
    }
}

include 'header.php';
?>

<div class="pt-32 min-h-screen px-6 pb-20 bg-surface-soft flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-[3rem] p-12 shadow-2xl">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white mx-auto mb-6 shadow-lg">
                <i data-lucide="video" size="32"></i>
            </div>
            <h1 class="text-3xl font-display font-bold text-secondary mb-2">Online Meeting</h1>
            <p class="text-secondary/70">Provide the meeting link for <?php echo htmlspecialchars($appointment['patient_name']); ?></p>
        </div>

        <?php if($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl mb-6 text-center font-bold">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="admin_confirm_meeting.php?id=<?php echo $appointment_id; ?>" class="space-y-6">
            <div class="space-y-2">
                <label class="text-sm font-bold text-secondary/60 uppercase tracking-widest ml-1">Meeting Link (Zoom / Meet)</label>
                <div class="relative group">
                    <i data-lucide="link" class="absolute left-5 top-1/2 -translate-y-1/2 text-secondary/40 group-focus-within:text-primary transition-colors" size="20"></i>
                    <input
                        type="url"
                        name="meeting_link"
                        required
                        class="w-full bg-surface-soft border-none rounded-2xl pl-14 pr-6 py-4 outline-none focus:ring-2 ring-primary/20 transition-all font-medium"
                        placeholder="https://zoom.us/j/123456789"
                    />
                </div>
            </div>

            <div class="flex gap-4">
                <a href="admin_dashboard.php" class="btn-secondary flex-1 text-center py-4 text-lg">Cancel</a>
                <button type="submit" class="btn-primary flex-1 py-4 text-lg flex items-center justify-center gap-2">
                    Confirm <i data-lucide="check" size="20"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
