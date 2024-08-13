<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $test = $_POST['test'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $nicno = $_POST['nicno'];
    $contactno1 = $_POST['contactno1'];
    $contactno2 = $_POST['contactno2'];
    $address = $_POST['address'];
    $comment = $_POST['comment'];


    $test = htmlspecialchars($test);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $fullname = htmlspecialchars($fullname);
    $nicno = htmlspecialchars($nicno);
    $contactno1 = htmlspecialchars($contactno1);
    $contactno2 = htmlspecialchars($contactno2);
    $address = htmlspecialchars($address);
    $comment = htmlspecialchars($comment);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }


    $to = $email;
    $subject = "Test Registration Confirmation";
    $message = "Hello $fullname,\n\nThank you for registering for the tests. Here are the details you provided:\n\n"
             . "Tests: $test\n"
             . "Email: $email\n"
             . "Full Name: $fullname\n"
             . "NIC No: $nicno\n"
             . "Contact No 1: $contactno1\n"
             . "Contact No 2: $contactno2\n"
             . "Address: $address\n"
             . "Comment: $comment\n\n"
             . "We will contact you shortly with the appointment details.\n\n"
             . "Best regards,\nSithsetha Laboratory";

    $headers = "From: no-reply@sithsethalab.com";
    if (mail($to, $subject, $message, $headers)) {
        echo "A confirmation email has been sent to $email.";
    } else {
        echo "There was a problem sending the confirmation email.";
    }


    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "myDB";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO registrations (test, email, fullname, nicno, contactno1, contactno2, address, comment)
            VALUES ('$test', '$email', '$fullname', '$nicno', '$contactno1', '$contactno2', '$address', '$comment')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();


} else {
    // Redirect back to the form if the request method is not POST
    header("Location: Registration.html");
    exit;
}
?>