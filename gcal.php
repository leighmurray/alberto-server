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
    $service = new Google_Service_Calendar($client);
    $calendarList = $service->calendarList->listCalendarList();
    if (!isset($_SESSION['calendar_id'])) {
         foreach ($calendarList->getItems() as $calendarItem) {
             if ($calendarItem['primary']) {
                 $_SESSION['calendar_id'] = $calendarItem['id'];
                 break;
             }
         }
    }

    ?>
        <!--<pre><?php /*print_r($calendarList); */?></pre>-->
        <select id="calendar-select" name="calendar_id" onchange="updateCalendarId(this);">
            <?php foreach ($calendarList->getItems() as $calendarItem) : ?>
                <option value="<?php echo $calendarItem['id']; ?>" <?php echo ($calendarItem['id'] == $_SESSION['calendar_id']) ? "selected" : ""; ?> ><?php echo $calendarItem['summary'];?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <div id="popup-placeholder"></div>
        <div data-role="popup" id="update-message" data-position-to="#popup-placeholder" data-transition="slidedown" class="ui-btn ui-corner-all ui-shadow ui-btn-inline">Calendar Updated</div>

        <style>
            #time-settings {
                display: none;
            }

            #sign-out {
                display: inline;
            }

        </style>
    <?
}

