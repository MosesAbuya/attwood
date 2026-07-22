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

    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';

    if (mail($to, $subject, $message, $headers)) {
        // Show popup message with auto-redirect
        echo "
        <html>
        <head>
            <title>Submission Successful</title>
            <style>
                .popup {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background: #fff;
                    padding: 20px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.3);
                    z-index: 9999;
                    text-align: center;
                    border-radius: 10px;
                    font-family: sans-serif;
                }
                .overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0,0,0,0.5);
                    z-index: 9998;
                }
                button {
                    padding: 10px 20px;
                    margin-top: 15px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
            </style>
            <script>
                setTimeout(function() {
                    window.location.href = '$referer';
                }, 8000); // Auto redirect after 8 seconds
            </script>
        </head>
        <body>
            <div class='overlay'></div>
            <div class='popup'>
                <h2>Thank you!</h2>
                <p>Your message has been sent successfully.</p>
                <button onclick=\"window.location.href = '$referer';\">Close</button>
            </div>
        </body>
        </html>";
    } else {
        echo "Sorry, there was a problem sending your message.";
    }
} else {
    echo "Invalid request.";
}
