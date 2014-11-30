function populate(frm, data) {

    $.each(data, function(key, value){
        var $ctrl = $('[name='+key+']', frm);
        switch($ctrl.attr("type"))
        {
            case "text" :
            case "hidden":
            case "textarea":
                $ctrl.val(value);
                break;
            case "radio" : case "checkbox":
            $ctrl.each(
                function(){
                    if($(this).attr('value') == value) {
                        var radio = $(this);
                        radio.prop("checked",true);
                    }
                });
            break;
        }
    });
}


function updateCalendarId (selectObject) {
    $.post('/update-session.php', { k: 'calendar_id', v: selectObject.value }, onUpdateCalendarId, "json" );
}

var timeout;

function onUpdateCalendarId ($json) {
    console.log($json);

    clearTimeout(timeout);
    $('#update-message').popup("open");

    timeout = setTimeout(function() {$("#update-message").popup("close");}, 2000);
}

function checkHashThenPopulate () {
    if (window.location.hash) {
        var decodedHash = decodeURI(window.location.hash.substr(1));
        console.log(decodedHash);
        populate($('form'), $.parseJSON(decodedHash));
    }
}

function loadTime() {
    $.get('template.mst', function(template) {
        for (var i = 0; i < 3; i++) {
            var rendered = Mustache.render(template, {"index": i});
            var timesDiv = $('#times');
            timesDiv.append($(rendered));
            checkHashThenPopulate();
            timesDiv.trigger('create');
        }
    });
}

$(function() {

    loadTime();

    $("#b-cancel, #back").click(function() {
        document.location = "pebblejs://close";
        return false;
    });

    $("#b-submit").click(function() {
        SubmitIt();
        return false;
    });
    $('#time-settings').submit(function(e) {
        SubmitIt();
        return false;
    });
    
});

function SubmitIt () {
    console.log("Submit");
    var $form = $( "#time-settings" );
    var serialisedObject = $form.serializeObject();
    console.log("Array:" + serialisedObject);
    console.log("stringified:" + JSON.stringify(serialisedObject));
    var location = "pebblejs://close#" + JSON.stringify(serialisedObject);
    document.location = location;
}