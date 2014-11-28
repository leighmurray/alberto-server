<?php
session_start();

// If you've used composer to include the library, remove the following line
// and make sure to follow the standard composer autoloading.
// https://getcomposer.org/doc/01-basic-usage.md#autoloading
require_once 'gapi/autoload.php';

CONST CLIENT_ID = '673750547036-6n2of96lkmk0njkr0rjkc8ibllpu5nlk.apps.googleusercontent.com';
CONST CLIENT_SECRET = 'zbNucbJDeogfW754xCf1etU9';

class AuthService
{
    public function get() {
        $client = new Google_Client();
        // OAuth2 client ID and secret can be found in the Google Developers Console.
        $client->setClientId(CLIENT_ID);
        $client->setClientSecret(CLIENT_SECRET);
        $client->setRedirectUri('http://percentage.leighmurray.com/settings.htm');
        $client->addScope('https://www.googleapis.com/auth/calendar');
        $client->setAccessType('offline');

        if (isset($_GET['code'])) {
            $accessToken = $client->authenticate($_GET['code']);
            $_SESSION['token'] = $accessToken;
            $client->setAccessToken($accessToken);
        } else if (isset($_SESSION['token'])) {
            $client->setAccessToken($_SESSION['token']);
        }

        return $client;
    }

    public function logout () {
        unset($_SESSION['token']);
    }

}