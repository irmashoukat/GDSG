<?php
$pageTitle = 'Admin Messages';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/admin-header.php';

// Get all messages from files
$messages_dir = __DIR__ . '/../messages';
$messages = [];

if (is_dir($messages_dir)) {
    $files = glob($messages_dir . '/message_*.json');
    
    if ($files) {
        // Sort by newest first
        rsort($files);
        
        foreach ($files as $file) {
            $content = file_get_contents($file);
            $data = json_decode($content, true);
            if ($data) {
                $messages[] = $data;
            }
        }
    }
}
?>
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="display-6 fw-bold">Messages</h1>
                <p class="text-muted">Review incoming contact messages submitted through the website.</p>
            </div>
        </div>
        <div class="table-responsive card card-soft p-4">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th class="text-end">IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($messages) > 0): ?>
                        <?php foreach ($messages as $msg): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($msg['name']); ?></strong></td>
                                <td><?php echo htmlspecialchars($msg['email']); ?></td>
                                <td><?php echo htmlspecialchars(substr($msg['message'], 0, 100)) . (strlen($msg['message']) > 100 ? '...' : ''); ?></td>
                                <td><?php echo htmlspecialchars($msg['timestamp']); ?></td>
                                <td class="text-end text-muted small"><?php echo htmlspecialchars($msg['ip']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No messages yet</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
