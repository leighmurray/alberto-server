<?php

require_once 'google_client.php';

$authService = new AuthService();

$client = $authService->get();

$service = new Google_Service_Calendar($client);

//$startMax = new DateTime("+1 day"); //Upper bound (exclusive) for an event's start time to filter by. Optional. The default is not to filter by start time. (string)
$endMin = new DateTime(); //Lower bound (inclusive) for an event's end time to filter by. Optional. The default is not to filter by end time.

$params =  array(
    'timeMin'       =>  date(DATE_ATOM, $endMin->getTimestamp()),
    //'timeMax'       =>  date(DATE_ATOM, $startMax->getTimestamp()),
    'maxResults'    =>  1,
    'singleEvents'  =>  true,
    'orderBy'       =>  'startTime'
);

try {
    $events = $service->events->listEvents('primary',$params);
    $items = $events->getItems();

    if (count($items)) {
        date_default_timezone_set('UTC');

        $item = array_pop($items);

        $startTime = $item["start"]["dateTime"];
        $endTime = $item["end"]["dateTime"];

        $startDateTime = new DateTime($startTime);
        $endDateTime = new DateTime($endTime);
        $ATOMWOTZ = "Y-m-d\TH:i:s";

            //Y-m-d\TH:i:sP
        $returnArray = array(
            's' => strtotime ($startDateTime->format($ATOMWOTZ)),
            'e' => strtotime ($endDateTime->format($ATOMWOTZ)),
            't' => $item["summary"]
        );
        echo json_encode($returnArray);
    } else {
        echo json_encode(array('success'=> true));
    }

} catch (Google_Service_Exception $e) {
    echo json_encode(array('success'=> false));
} catch (Exception $e) {
    echo json_encode(array('success'=> false));
}

function pr ($object) {
    echo '<pre>';print_r($object);echo'</pre>';
}