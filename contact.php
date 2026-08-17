<?php
$pageTitle = 'Contact';
require __DIR__ . '/includes/functions.php';

$message_sent = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if ($name && $email && $message) {
        try {
            // Save message to a file
            $message_data = [
                'name' => htmlspecialchars($name),
                'email' => htmlspecialchars($email),
                'message' => htmlspecialchars($message),
                'timestamp' => date('Y-m-d H:i:s'),
                'ip' => $_SERVER['REMOTE_ADDR'] ?? 'Unknown'
            ];
            
            $messages_dir = __DIR__ . '/messages';
            if (!is_dir($messages_dir)) {
                mkdir($messages_dir, 0755, true);
            }
            
            $file_name = $messages_dir . '/' . 'message_' . time() . '_' . uniqid() . '.json';
            file_put_contents($file_name, json_encode($message_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            
            $message_sent = true;
        } catch (Exception $e) {
            $error_message = 'Message saving failed. Please try again later.';
        }
    } else {
        $error_message = 'Please fill in all fields.';
    }
}

require __DIR__ . '/includes/header.php';
?>
<section class="contact-hero py-5">
    <div class="container">
        <?php if ($message_sent): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your message has been sent successfully. We'll get back to you soon!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> <?php echo htmlspecialchars($error_message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <div class="row gy-4">
            <div class="col-lg-6">
                <h1 class="display-6 fw-bold">Contact</h1>
                <p class="lead text-muted">Get in touch with the Geospatial Data Science Group for research collaboration, publications, and partnerships.</p>
                <div class="card card-soft p-4 mt-4">
                    <h5>Contact Information</h5>
                    <p class="text-muted mb-1"><a href="https://www.linkedin.com/company/geospatial-data-science-group/about/?viewAsMember=true" target="_blank" rel="noopener noreferrer">LinkedIn</a></p>
                    <p class="text-muted mb-1"><a href="https://www.facebook.com/profile.php?viewas=100000686899395&amp;id=61567873319375" target="_blank" rel="noopener noreferrer">Facebook</a></p>
                    <p class="text-dark mb-1">Email: <a href="mailto:info@gdsg.org">info@gdsg.org</a></p>
                    <p class="text-dark mb-1">Phone: <a href="tel:+15551234567">+1 (555) 123-4567</a></p>
                    <p><span class="text-dark">Office hours:</span> <a href="#">Mon - Fri, 9:00 AM - 6:00 PM</a></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-soft p-4 shadow-sm">
                    <h5>Send a message</h5>
                    <form method="post" class="mt-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-primary-custom">Submit Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
