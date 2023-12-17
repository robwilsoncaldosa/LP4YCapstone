<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
</head>
<body style="font-family: 'Arial', sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 20px; text-align: center;">

    <img src="../img/LP4Y_Logo.webp" alt="Logo" style="display: block; margin: 0 auto; margin-top: 20px; margin-bottom: 20px; max-width: 100%; height: auto;width:100px;">

    <div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

        <h1 style="color: #3498db; text-align: center;">New Email Submission</h1>

        <p style="line-height: 1.6; margin-bottom: 10px;"><strong>Name:</strong> {{ $validatedData['name'] }}</p>
        <p style="line-height: 1.6; margin-bottom: 10px;"><strong>Email:</strong> {{ $validatedData['email'] }}</p>
        <p style="line-height: 1.6; margin-bottom: 10px;"><strong>Subject:</strong> {{ $validatedData['subject'] }}</p>

        <hr style="border: 1px solid #ddd; margin-bottom: 10px;">

        <p style="line-height: 1.6; margin-bottom: 20px;"><strong>Message:</strong></p>
        <p style="line-height: 1.6; margin-bottom: 20px;">{{ $validatedData['message'] }}</p>

        <p style="text-align: center; color: #888; margin-top: 20px;">Thank you for contacting us!</p>
    </div>

</body>
</html>
