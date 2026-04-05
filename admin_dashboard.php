<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Security Check: Ensure user is logged in AND is an admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include 'db_connect.php';

$success_msg = "";
if (isset($_GET['success'])) {
    if ($_GET['success'] == 'deleted') {
        $success_msg = "Appointment deleted successfully.";
    } else {
        $success_msg = "Appointment status updated successfully.";
    }
}

// Fetch all appointments
$sql = "
    SELECT a.*, 
           u.full_name AS patient_name, u.email AS patient_email,
           d.name AS doctor_name, d.specialty 
    FROM appointments a 
    JOIN users u ON a.user_id = u.id 
    JOIN doctors d ON a.doctor_id = d.id 
    ORDER BY a.created_at DESC
";
$result = $conn->query($sql);

include 'header.php';
?>

<div class="pt-32 min-h-screen px-6 pb-20 bg-surface-soft">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex items-center gap-4 mb-8">
            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg">
                <i data-lucide="shield-check" size="24"></i>
            </div>
            <div class="flex-1">
                <h1 class="text-4xl font-display font-bold text-secondary">Hospital Administration</h1>
                <p class="text-secondary/70">Manage incoming patient appointments and portal access.</p>
            </div>
            <a href="admin_messages.php" class="btn-secondary px-6 flex items-center gap-2"><i data-lucide="message-square" size="18"></i> Inbox</a>
        </div>

        <?php if($success_msg): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-2xl mb-8 shadow-sm flex items-center gap-3 font-bold">
                <i data-lucide="check-circle-2" size="24"></i>
                <?php echo $success_msg; ?>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-[2rem] shadow-xl overflow-hidden border border-secondary/5">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-accent/50 text-secondary text-sm uppercase tracking-widest border-b border-secondary/10">
                            <th class="p-6 font-bold">Patient</th>
                            <th class="p-6 font-bold">Doctor</th>
                            <th class="p-6 font-bold">Requested Date & Time</th>
                            <th class="p-6 font-bold text-center">Status</th>
                            <th class="p-6 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-secondary/5">
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): 
                                $dateObj = new DateTime($row['appointment_date']);
                                $timeObj = new DateTime($row['appointment_time']);
                                
                                $statusColor = "bg-yellow-100 text-yellow-800";
                                if ($row['status'] == 'Confirmed') $statusColor = "bg-green-100 text-green-800";
                                if ($row['status'] == 'Cancelled') $statusColor = "bg-red-100 text-red-800";
                                if ($row['status'] == 'Completed') $statusColor = "bg-blue-100 text-blue-800";
                            ?>
                            <tr class="hover:bg-surface-soft/50 transition-colors">
                                <td class="p-6">
                                    <div class="font-bold text-secondary"><?php echo htmlspecialchars($row['patient_name']); ?></div>
                                    <div class="text-sm text-secondary/60"><?php echo htmlspecialchars($row['patient_email']); ?></div>
                                </td>
                                <td class="p-6">
                                    <div class="font-bold text-secondary"><?php echo htmlspecialchars($row['doctor_name']); ?></div>
                                    <div class="text-sm text-primary font-medium"><?php echo htmlspecialchars($row['specialty']); ?></div>
                                </td>
                                <td class="p-6 font-medium text-secondary/80">
                                    <div class="flex items-center gap-2 mb-1">
                                        <i data-lucide="calendar" size="14" class="text-primary"></i> <?php echo $dateObj->format('M j, Y'); ?>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="clock" size="14" class="text-primary"></i> <?php echo $timeObj->format('g:i A'); ?>
                                    </div>
                                    <div class="mt-2 mb-1">
                                        <span class="inline-flex text-[10px] uppercase font-bold tracking-widest bg-primary/10 text-primary px-2 py-1 rounded">
                                            <?php echo isset($row['meeting_type']) ? $row['meeting_type'] : 'In-Person'; ?>
                                        </span>
                                    </div>
                                    <?php if($row['notes']): ?>
                                        <div class="mt-2 text-xs bg-accent/50 p-2 rounded truncate max-w-xs" title="<?php echo htmlspecialchars($row['notes']); ?>">
                                            "<?php echo htmlspecialchars($row['notes']); ?>"
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="p-6 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold <?php echo $statusColor; ?>">
                                        <?php echo htmlspecialchars($row['status']); ?>
                                    </span>
                                </td>
                                <td class="p-6 text-right space-x-2">
                                    <div class="flex justify-end items-center gap-2">
                                        <?php if($row['status'] == 'Pending'): ?>
                                            <?php if(isset($row['meeting_type']) && $row['meeting_type'] == 'Online Meeting'): ?>
                                                <a href="admin_confirm_meeting.php?id=<?php echo $row['id']; ?>" class="inline-flex py-2 px-4 rounded-xl bg-green-500 hover:bg-green-600 text-white text-sm font-bold transition-all shadow-sm">
                                                    Link & Confirm
                                                </a>
                                            <?php else: ?>
                                                <a href="admin_action.php?id=<?php echo $row['id']; ?>&action=confirm" class="inline-flex py-2 px-4 rounded-xl bg-green-500 hover:bg-green-600 text-white text-sm font-bold transition-all shadow-sm">
                                                    Confirm
                                                </a>
                                            <?php endif; ?>
                                            <a href="admin_action.php?id=<?php echo $row['id']; ?>&action=cancel" class="inline-flex py-2 px-4 rounded-xl bg-yellow-100 text-yellow-600 hover:bg-yellow-200 text-sm font-bold transition-all shadow-sm">
                                                Cancel
                                            </a>
                                        <?php else: ?>
                                            <span class="text-xs text-secondary/40 font-bold uppercase tracking-widest mr-2">No Actions</span>
                                        <?php endif; ?>
                                        <a href="admin_action.php?id=<?php echo $row['id']; ?>&action=delete" onclick="return confirm('Are you sure you want to completely delete this appointment? This action cannot be undone.');" class="inline-flex p-2 rounded-xl bg-red-100 text-red-600 hover:bg-red-200 transition-all font-bold group shadow-sm" title="Delete Appointment">
                                            <i data-lucide="trash-2" size="18" class="group-hover:scale-110 transition-transform"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="p-12 text-center text-secondary/60">
                                    <i data-lucide="inbox" size="32" class="mx-auto mb-4 opacity-50"></i>
                                    <p class="text-lg font-medium">No appointments have been booked yet.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
