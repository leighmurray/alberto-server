<?php

require_once 'google_client.php';

$authService = new AuthService();

if (isset($_POST['logout'])) {
    $authService->logout();
}

$client = $authService->get();

if ($client->isAccessTokenExpired()) {
    echo '<a class="ui-btn" href="' . $client->createAuthUrl() . '">Connect Google Calendar</a>';
} else {
    ?>
        <form action="/settings.htm" method="post">
            <input type="hidden" name="logout" value="true">
            <button type="submit">Sign out of Google Calendar</button>
        </form>
        <style>
            #time-settings {
                display: none;
            }
        </style>
    <?
}

