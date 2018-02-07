$(document).ready(function() {
    $("body").hide().fadeIn(1000);
        $( function() {
            $( "#dob" ).datepicker();
        } );

}
    );
    $(".info-item .btns").click(function () {
        $(".container").toggleClass("log-in");
    });
    function showTick() {
        $(".container-form").toggleClass('special');
    };

    function errorFound() {
        $(".container").toggleClass('active');
    };

    $("#regBtn").click(function () {
        var fn = $("#first-name").val().trim();
        var ln = $("#last-name").val().trim();
        fn=fn.replace(" ", "_");
        ln=ln.replace(" ", "_");
        var nick = fn+ln;
        swal({
            title: "Psst...",
            text: "What's Your Nickname \n We are Currently calling you :\n <strong>"+nick +"</strong><br> \n Leave it empty if you like our Nickname",
            type: 'input',
            imageUrl: "img/question.svg",
            html: true,
            animation: "slide-from-top"
        }, function(inputValue){
$("#genderblock").hide();
            if(inputValue==""){
                register(nick);

            }
            else{
            register(inputValue);
            }
        });

    });
var gender;
$("#male").click((function () {
    gender = 1;

}));
$("#female").click((function () {
    gender = 0;

}));
function register(nickname) {
    $(".container").addClass("active");
    var fn = $("#first-name").val();
    var ln = $("#last-name").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var dob = $("#dob").val();
    var dataString = 'fn=' + fn +'&ln='+ln+ '&email=' + email + '&password=' + password+"&dob="+dob+"&gender="+gender+"&nn="+nickname;
    if (!validateReg(email, password, fn,ln,dob)) {
        return;
    }
    $.ajax({
        type: "POST",
        url: "php/registration.php",
        data: dataString,
        cache: false,
        success: function (res) {
            if (res == ("username found")) {
                swal("Oops...", "Email Already Exists!", "error", errorFound());

            }
            else {
                showTick();
                if (res == "gohome") {
                    setTimeout(function () {
                        window.location.href = "home/"
                    }, 1500);
                }
            }

        },
        error: function (obj) {
            console.log("Heyyy"+res);
        }


    });

    return false;

}

    $("#btnsLog").click(function () {
        $(".container").addClass("active");
        var password = $("#passwordlog").val();
        var email = $("#usernamelog").val();
        var dataString ='email=' + email + '&password=' + password;
        gender=1;
        if (!validateReg(email, password, 'dummy','dummy','dummy')) {
            return;
        }
        $.ajax({
            type: "POST",
            url: "php/login.php",
            data: dataString,
            cache: false,
            success: function (res) {

                if (res == ("username not found")) {
                    swal("Oops...", "User Doesn't Exist", "error", errorFound());

                }
                else {

                    showTick();
                    $(".container").fadeOut(1000);
                    console.log(res)
                    if (res == "gohome") {
                        setTimeout(function () {
                            window.location.href = "home/index.html"
                        }, 1500);
                    }



                }


            },
            error: function (obj) {

            }


        });

        return false;

    });

    function validateReg(email, password, fn,ln,dob) {
        var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
        if (email.trim() == '' || password.trim() == '' || fn.trim() == ''||ln.trim() == ''||dob.trim() == '') {
            swal("Oops...", "Something went wrong!\nPlease Fill all the Fields", "error", errorFound());
            return false;
        }
        if (email.search(emailRegEx) == -1) {
            swal("Oops...", "Something went wrong!\nPlease Enter a Valid Email Format", "error", errorFound());
            return false;
        }
        if (gender==null){
            swal("Oops...", "Something went wrong!\nPlease Fill all the Fields", "error", errorFound());

            return false;
        }
        return true;
    }

