<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include 'db_connect.php';

$admin_id = $_SESSION['user_id'];

// Get all patients who have interacted via messages
$patients_sql = "
    SELECT u.id, u.full_name, u.email, MAX(m.created_at) as last_msg_time
    FROM users u 
    JOIN messages m ON (u.id = m.sender_id OR u.id = m.receiver_id)
    WHERE u.role != 'admin'
    GROUP BY u.id 
    ORDER BY last_msg_time DESC
";
$patients_result = $conn->query($patients_sql);
$patients = [];
while ($row = $patients_result->fetch_assoc()) {
    $patients[] = $row;
}

$active_patient_id = isset($_GET['patient_id']) ? (int)$_GET['patient_id'] : ($patients[0]['id'] ?? 0);

// Handle message submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && $active_patient_id > 0) {
    $message = trim($_POST['message']);
    if (!empty($message)) {
        // Send to patient (receiver_id is patient id)
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $admin_id, $active_patient_id, $message);
        $stmt->execute();
        header("Location: admin_messages.php?patient_id=" . $active_patient_id);
        exit();
    }
}

// Fetch messages for active patient
$messages = [];
$active_patient = null;
if ($active_patient_id > 0) {
    // Get patient details
    $stmt = $conn->prepare("SELECT full_name, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $active_patient_id);
    $stmt->execute();
    $active_patient = $stmt->get_result()->fetch_assoc();

    // Get messages
    $stmt = $conn->prepare("
        SELECT m.*, u.role AS sender_role 
        FROM messages m 
        JOIN users u ON m.sender_id = u.id 
        WHERE (m.sender_id = ? AND (m.receiver_id IS NULL OR m.receiver_id IN (SELECT id FROM users WHERE role='admin')))
           OR (m.receiver_id = ? AND m.sender_id IN (SELECT id FROM users WHERE role='admin'))
        ORDER BY m.created_at ASC
    ");
    $stmt->bind_param("ii", $active_patient_id, $active_patient_id);
    $stmt->execute();
    $msg_result = $stmt->get_result();
    while ($row = $msg_result->fetch_assoc()) {
        $messages[] = $row;
    }
}

include 'header.php';
?>

<div class="pt-32 min-h-screen px-6 pb-20 bg-surface-soft">
    <div class="max-w-7xl mx-auto flex flex-col h-[80vh]">
        
        <div class="flex items-center gap-4 mb-8">
            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg">
                <i data-lucide="message-square-dashed" size="24"></i>
            </div>
            <div>
                <h1 class="text-3xl font-display font-bold text-secondary">Patient Messages</h1>
                <p class="text-secondary/70">Respond to inquiries and coordinate with patients.</p>
            </div>
        </div>

        <div class="flex-1 flex gap-6 overflow-hidden">
            <!-- Sidebar: Patients List -->
            <div class="w-1/3 bg-white rounded-[2rem] shadow-xl border border-secondary/5 hidden md:flex flex-col overflow-hidden">
                <div class="p-6 border-b border-secondary/10 bg-surface-soft">
                    <h3 class="font-bold text-secondary uppercase tracking-widest text-sm">Conversations</h3>
                </div>
                <div class="flex-1 overflow-y-auto">
                    <?php if(empty($patients)): ?>
                        <div class="p-8 text-center text-secondary/50">
                            <i data-lucide="users" size="32" class="mx-auto mb-3 opacity-50"></i>
                            <p>No active conversations.</p>
                        </div>
                    <?php else: ?>
                        <ul class="divide-y divide-secondary/5">
                            <?php foreach($patients as $p): ?>
                                <li>
                                    <a href="admin_messages.php?patient_id=<?php echo $p['id']; ?>" class="block p-6 hover:bg-surface-soft transition-colors <?php echo ($p['id'] == $active_patient_id) ? 'bg-accent/30 border-l-4 border-primary' : ''; ?>">
                                        <div class="font-bold text-secondary mb-1"><?php echo htmlspecialchars($p['full_name']); ?></div>
                                        <div class="text-xs text-secondary/60"><?php echo date('M j, g:i A', strtotime($p['last_msg_time'])); ?></div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Main Chat Area -->
            <div class="flex-1 bg-white rounded-[2rem] shadow-xl border border-secondary/5 flex flex-col overflow-hidden">
                <?php if($active_patient_id == 0): ?>
                    <div class="flex-1 flex flex-col items-center justify-center text-secondary/50 p-8 text-center">
                        <i data-lucide="message-circle" size="64" class="mb-4 opacity-50"></i>
                        <h2 class="text-2xl font-bold font-display text-secondary mb-2">No Conversation Selected</h2>
                        <p>Select a patient from the list, or wait for someone to message the hospital.</p>
                    </div>
                <?php else: ?>
                    <div class="p-6 border-b border-secondary/10 bg-surface-soft flex items-center justify-between">
                        <div>
                            <h3 class="font-bold text-secondary text-lg"><?php echo htmlspecialchars($active_patient['full_name']); ?></h3>
                            <p class="text-xs text-secondary/60"><?php echo htmlspecialchars($active_patient['email']); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex-1 p-8 overflow-y-auto space-y-6" id="chatbox">
                        <?php if (empty($messages)): ?>
                            <div class="text-center text-secondary/50 mt-10">No messages found.</div>
                        <?php else: ?>
                            <?php foreach ($messages as $msg): 
                                $is_admin = ($msg['sender_role'] == 'admin');
                            ?>
                                <div class="flex flex-col <?php echo $is_admin ? 'items-end' : 'items-start'; ?>">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-xs font-bold text-secondary/60 uppercase tracking-widest">
                                            <?php echo $is_admin ? 'Me (Admin)' : htmlspecialchars($active_patient['full_name']); ?>
                                        </span>
                                        <span class="text-[10px] text-secondary/40">
                                            <?php echo date('M j, g:i A', strtotime($msg['created_at'])); ?>
                                        </span>
                                    </div>
                                    <div class="<?php echo $is_admin ? 'bg-secondary text-white rounded-tl-2xl rounded-tr-2xl rounded-bl-2xl' : 'bg-surface-soft text-secondary rounded-tl-2xl rounded-tr-2xl rounded-br-2xl'; ?> px-6 py-4 max-w-[80%] shadow-sm">
                                        <?php echo nl2br(htmlspecialchars($msg['message'])); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="p-6 bg-surface-soft border-t border-secondary/10">
                        <form method="POST" action="admin_messages.php?patient_id=<?php echo $active_patient_id; ?>" class="relative">
                            <input 
                                type="text" 
                                name="message" 
                                required 
                                autocomplete="off"
                                class="w-full bg-white border border-secondary/10 rounded-full pl-6 pr-16 py-4 outline-none focus:ring-2 ring-primary/20 transition-all font-medium text-secondary shadow-sm"
                                placeholder="Type your reply to <?php echo htmlspecialchars($active_patient['full_name']); ?>..."
                            >
                            <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center hover:scale-105 transition-transform shadow-md">
                                <i data-lucide="send" size="18"></i>
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    const chatbox = document.getElementById('chatbox');
    if (chatbox) {
        chatbox.scrollTop = chatbox.scrollHeight;
    }
</script>

<?php include 'footer.php'; ?>
