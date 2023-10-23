<!DOCTYPE html>
<html>

<head>
    <title>Friend Request Notification</title>
</head>

<body>
    <div
        style="background-color: #ffffff; max-width: 600px; margin: 20px auto; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <img src="https://ehoa.app/public/template/img/logo.png" alt="EHOA App Logo"
            style="height: 100px; display: block; margin: 0 auto;">
        <p style="font-size: 16px; color: #333; margin: 0;">Hello {{ $RecipentName }},</p>

        <p style="font-size: 13px; color: #555; margin-top: 20px;">You have received a friend request on the EHOA app
            from {{ $SenderName }}
            .</p>

        <p style="font-size: 13px; color: #555;">To respond to the friend request, please follow these steps:</p>

        <ol style="font-size: 15px; color: #555; margin-top: 20px;">
            <li>Install the App: If you haven't already, please install the app from the App Store.</li>
            <li>Register Your Account: Once the app is installed, proceed to register your account.</li>
            <li>Access Your Friend's Calendar:
                <ul>
                    <li>Navigate to the "share requests Screen" from the menu.</li>
                    <li>You'll find a prompt to accept or reject the calendar access request. Kindly select "Accept."
                    </li>
                </ul>
            </li>
            <li>View Your Friend's Name: After accepting the request, you will be able to see your friend's name on the
                "Friends and Family" screen. This is where you can manage your connections.</li>
            <li>Access the Calendar: To view your friend's calendar, simply click on the "Calendar" tab, and you will
                have access to their events and appointments.</li>
        </ol>

        <p style="font-size: 15px; color: #555;">Thank you for following these steps. If you encounter any difficulties
            or have any questions, please don't hesitate to reach out to our support team. We are here to assist you. 😊
        </p>
    </div>
</body>

</html>