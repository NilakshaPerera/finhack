$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#txtquestion').summernote({
        height: 200,
        followingToolbar :false
    });

    init_DataTables();
    function init_DataTables() {
        if (typeof ($.fn.DataTable) === 'undefined') {
            return;
        }
        var handleDataTableButtons = function () {
            if ($("#jstable").length) {
                $("#jstable").DataTable({
                    dom: "Blfrtip",
                    keys: true,
                    "order": [[0, "desc"]],
                    buttons: [
                        {
                            extend: "copy",
                            className: "btn-sm"
                        },
                        {
                            extend: "csv",
                            className: "btn-sm"
                        },
                        {
                            extend: "excel",
                            className: "btn-sm"
                        },
                        {
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },
                        {
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons = function () {
            "use strict";
            return {
                init: function () {
                    handleDataTableButtons();
                }
            };
        }();
        TableManageButtons.init();
    }
    ;


    $('#formuserupdate').submit(function (e) {
        e.preventDefault();
        var data = $('#formuserupdate').serialize();
        $.ajax({
            url: base + "admin/user-update",
            type: 'post',
            data: data,
            success: function (respond) {
                if (respond.success) {
                    alertMessage(1);
                } else {
                    alert('An error occured! Please contact the venodr or try again in a few minutes');
                }
            },
            complete: function () {
            }
        });
    });
    
        $('#formSettings').submit(function (e) {
        e.preventDefault();
        var data = $('#formSettings').serialize();
        $.ajax({
            url: base + "admin/save-settings",
            type: 'post',
            data: data,
            success: function (respond) {
                if (respond.success) {
                    alertMessage(1);
                } else {
                    alert('An error occured! Please contact the venodr or try again in a few minutes');
                }
            },
            complete: function () {
            }
        });
    });

    function alertMessage(type, message = "", sustainPeriod = 1000) {

        switch (type) {
            case 1:
                $('#alertSuccess').fadeIn(sustainPeriod, function () {});
                $('#alertSuccess').fadeOut(sustainPeriod, function () {});
                break;
            case 2:
                $('#alertWarningMessage').text(message);
                $('#alertWarning').fadeIn(sustainPeriod, function () {});
                break;
            case 2:
                $('#alertErrorMessage').text(message);
                $('#alertError').fadeIn(sustainPeriod, function () {});
                break;
    }
    }

});

function clone (object , length = 5 , itemClass , containerId){
    if( $('.'+itemClass).length == length ){
        return;
    }
    $( $(object).parent().parent()).clone().appendTo( "#"+containerId );
}

function remove (object , itemClass){   
    if( $('.'+itemClass).length == 1 ){
        return;
    }
    $( $(object).parent().parent()).remove();
}
