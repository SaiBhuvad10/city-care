<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

$user_id = $_SESSION['user_id'];

// Handle message submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = trim($_POST['message']);
    if (!empty($message)) {
        // Send to hospital (receiver_id is NULL)
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, NULL, ?)");
        $stmt->bind_param("is", $user_id, $message);
        $stmt->execute();
        header("Location: patient_messages.php");
        exit();
    }
}

// Fetch all messages for this user (sent by user or sent to user)
$stmt = $conn->prepare("
    SELECT m.*, u.full_name AS sender_name, u.role AS sender_role 
    FROM messages m 
    JOIN users u ON m.sender_id = u.id 
    WHERE m.sender_id = ? OR m.receiver_id = ? 
    ORDER BY m.created_at ASC
");
$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$messages = $stmt->get_result();

include 'header.php';
?>

<div class="pt-32 min-h-screen px-6 pb-20 bg-surface-soft">
    <div class="max-w-4xl mx-auto flex flex-col h-[80vh]">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i data-lucide="message-square" size="24"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-display font-bold text-secondary">Messages</h1>
                    <p class="text-secondary/70">Communicate with hospital administrators.</p>
                </div>
            </div>
            <a href="my_appointments.php" class="btn-secondary px-6">Back to Dashboard</a>
        </div>

        <!-- Chat Window -->
        <div class="flex-1 bg-white rounded-[2rem] shadow-xl overflow-hidden flex flex-col border border-secondary/5">
            <div class="flex-1 p-8 overflow-y-auto space-y-6" id="chatbox">
                <?php if ($messages->num_rows == 0): ?>
                    <div class="text-center text-secondary/50 mt-20">
                        <i data-lucide="mail-search" size="48" class="mx-auto mb-4 opacity-50"></i>
                        <p>You have no messages yet. Send a message to start a conversation.</p>
                    </div>
                <?php else: ?>
                    <?php while ($msg = $messages->fetch_assoc()): 
                        $is_me = ($msg['sender_id'] == $user_id);
                    ?>
                        <div class="flex flex-col <?php echo $is_me ? 'items-end' : 'items-start'; ?>">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-bold text-secondary/60 uppercase tracking-widest">
                                    <?php echo $is_me ? 'You' : ($msg['sender_role'] == 'admin' ? 'Hospital Admin' : htmlspecialchars($msg['sender_name'])); ?>
                                </span>
                                <span class="text-[10px] text-secondary/40">
                                    <?php echo date('M j, g:i A', strtotime($msg['created_at'])); ?>
                                </span>
                            </div>
                            <div class="<?php echo $is_me ? 'bg-primary text-white rounded-tl-2xl rounded-tr-2xl rounded-bl-2xl' : 'bg-surface-soft text-secondary rounded-tl-2xl rounded-tr-2xl rounded-br-2xl'; ?> px-6 py-4 max-w-[80%] shadow-sm">
                                <?php echo nl2br(htmlspecialchars($msg['message'])); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <!-- Input Area -->
            <div class="p-6 bg-surface-soft border-t border-secondary/10">
                <form method="POST" action="patient_messages.php" class="relative">
                    <input 
                        type="text" 
                        name="message" 
                        required 
                        autocomplete="off"
                        class="w-full bg-white border border-secondary/10 rounded-full pl-6 pr-16 py-4 outline-none focus:ring-2 ring-primary/20 transition-all font-medium text-secondary shadow-sm"
                        placeholder="Type your message here..."
                    >
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center hover:scale-105 transition-transform shadow-md">
                        <i data-lucide="send" size="18"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Scroll to bottom
    const chatbox = document.getElementById('chatbox');
    if (chatbox) {
        chatbox.scrollTop = chatbox.scrollHeight;
    }
</script>

<?php include 'footer.php'; ?>
