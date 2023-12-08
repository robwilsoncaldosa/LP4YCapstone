


<!-- resources/views/emails/user-added.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>User Added Email</title>
</head>
<body>
    <p>Hello {{ $user['name'] }},</p>
    <p>Your account has been successfully added. Here are your account details:</p>
    
    <ul>
        <li>Name: {{ $user['name'] }}</li>
        <li>Email: {{ $user['email'] }}</li>
        <!-- Add other user details as needed -->
    </ul>
    
    <p>Thank you for using our service!</p>
</body>
</html>
