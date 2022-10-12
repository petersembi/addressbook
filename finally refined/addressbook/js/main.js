// Ajax code

$(document).ready(function () {
    $('#export').click(function (e) { 
        e.preventDefault();
        $.ajax({
            method: "post",
            url: "generate_json_xml.php",
            data: "data",
            dataType: "html",
            success: function (response) {
                $('#success-alert').removeClass('d-none');
                
                $("#success-alert").fadeTo(4000, 500).slideUp(1000, function(){
                    $("#success-alert").alert('close');
                });
            }
        });
    });
});

