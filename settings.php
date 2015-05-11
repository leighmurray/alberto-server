<!DOCTYPE html>
<html>
  <head>
    <title>Percentage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/settings.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

  </head>
  <body>
    <div data-role="page" id="main">
        <div data-role="header" data-add-back-btn="true" >
            <a id="back" class="ui-btn-left ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left ui-icon-carat-l">Back</a>
            <h1>Percentage</h1>
            <form id="sign-out" data-ajax="false" action="/settings.php" method="post">
                <input type="hidden" name="logout" value="true">
                <button class="ui-btn-right ui-btn ui-btn-b ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-calendar">Sign out</button>
            </form>
        </div>
        <div data-role="content">
          <?php require_once "gcal.php"; ?>
              <form id="time-settings">
                  <div class="ui-body">
                      <div id="times">

                      </div>
                      <fieldset class="ui-grid-a">
                        <div class="ui-block-a"><button type="submit" data-theme="d" id="b-cancel">Cancel</button></div>
                        <div class="ui-block-b"><button type="submit" data-theme="a" id="b-submit">Submit</button></div>
                      </fieldset>
                  </div>
              </form>
        </div>
    </div>
    <script src="mustache.js"></script>
    <script src="jquery.serialise-object.js"></script>
    <script src="settings.js"></script>
  </body>
</html>
