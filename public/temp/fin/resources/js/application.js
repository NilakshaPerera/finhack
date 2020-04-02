$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
  
    if (flag) {
        setAppParams;
    }


});

var setAppParams = function() {
    console.log('This was executed');
        var data = 'session=' + "";
        $.ajax({
            url: base + "session",
            type: 'post',
            data: data,
            success: function (respond) {
                if (respond.success) {

                    window.localStorage.setItem('a76385aca2174c81b2b81c9032033b9b', JSON.stringify(respond.data));
                    window.localStorage.setItem('presentation', JSON.stringify(respond.data['presentation']));
                    
                    /*
                    var d = new Date();
                    d.setTime(d.getTime() + (1*24*60*60*1000));
                    var expires = "expires="+ d.toUTCString();
                    document.cookie = 'a76385aca2174c81b2b81c9032033b9b' + "=" + JSON.stringify(respond.data) + ";" + expires + ";path=/";
                    */
                } else {

                }
            },
            complete: function () {}
        });
    }

const application = {setAppParams } ;
export default application;