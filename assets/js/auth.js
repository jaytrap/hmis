/**
 * Created by jerome on 04/01/2018.
 */
$(function () {
    var $btns = $("#loginBtn");

    $btns.click(function (e) {

        e.preventDefault();
        $("#unerror").empty();
        $("#perror").empty();
        $("#ack").empty();
        $("#lgwait").css("display", "block");
        $("#loginBtn").attr("disabled", "disabled");
        var uname = $.trim($("#username").val());
        var pss = $.trim($("#password").val());

        if (uname.length == 0) {

            $("#unerror").html('<p><small style="color:red;">username field cannot be left empty.</small><p/>');
            $("#lgwait").css("display", "none");
            $("#loginBtn").removeAttr("disabled", "disabled");
        }
        if (pss.length == 0) {

            $("#perror").html('<p><small style="color:red;">password field cannot be left empty.</small><p/>');
            $("#lgwait").css("display", "none");
            $("#loginBtn").removeAttr("disabled", "disabled");
        }

        if (uname.length != 0 && pss.length != 0) {
            $.ajax({
                type: "POST",
                url: "controller/loginController.php",
                data: $('#loginForm').serialize(),
                success: function (msg) {
                    if (msg === "ok") {
                        $("#lgwait").css("display", "none");
                        $('#ack').html('<div class="alert alert-success"> Login successful </div>' + "<img src='dist/img/spinner-grey.gif' /> Redirecting ...").fadeIn(1900, function () {
                            setInterval(function () {
                                $("form")[0].reset();
                                location = "inc/dashboard.php";
                            }, 5000);

                            //location.reload();
                        });
                    } else {
                        $("#ack").html('<div class="alert alert-danger">' + msg + '</div>');
                        $("#lgwait").css("display", "none");
                        $("#loginBtn").removeAttr("disabled");
                    }
                }
            });
            return false;
        }

    });
});

