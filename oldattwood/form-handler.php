<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "info@attwoodtravelagency.co.ke";
    $subject = "New Travel Inquiry Submission";

    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["contactno"]);
    $nationality = htmlspecialchars($_POST["nationality"]);
    $arrival = htmlspecialchars($_POST["arrival_date"]);
    $days = htmlspecialchars($_POST["days"]);
    $travelers = htmlspecialchars($_POST["travelers"]);
    $activities = isset($_POST["activities"]) ? implode(", ", $_POST["activities"]) : "None";
    $accommodation = htmlspecialchars($_POST["accommodation"]);
    $requirements = htmlspecialchars($_POST["special_requirements"]);
    $privacy = isset($_POST["privacy_policy"]) ? "Agreed" : "Not Agreed";

    $message = "
    Name: $name\n
    Email: $email\n
    Phone: $phone\n
    Nationality: $nationality\n
    Arrival Date: $arrival\n
    Number of Days: $days\n
    Number of Travelers: $travelers\n
    Activities: $activities\n
    Accommodation: $accommodation\n
    Special Requirements:\n$requirements\n
    Privacy Policy: $privacy
    ";

    $headers = "From: $email\r\nReply-To: $email\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Sorry, there was a problem sending your message.";
    }
} else {
    echo "Invalid request.";
}
?>
