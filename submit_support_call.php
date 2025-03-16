<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_name = $_POST['employee_name'];
    $department = $_POST['department'];
    $room_number = $_POST['room_number'];
    $issue_type = $_POST['issue_type'];
    $priority = $_POST['priority'];
    $description = $_POST['description'];

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com'; // Replace with your email
        $mail->Password = 'your_password'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email settings
        $mail->setFrom('your_email@example.com', 'Support Form');
        $mail->addAddress('technical@clrchs.co.uk'); // Target email
        $mail->Subject = "New Support Call Logged - $issue_type";
        
        $mail->Body = "
            Employee Name: $employee_name\n
            Department: $department\n
            Room Number: $room_number\n
            Issue Type: $issue_type\n
            Priority: $priority\n
            Description: $description\n
        ";

        $mail->send();
        echo "Support call logged successfully.";
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
