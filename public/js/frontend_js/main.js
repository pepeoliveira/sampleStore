/*price range*/

$('#sl2').slider();

var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*scroll to top*/

$(document).ready(function () {
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});
// Change Price & Stock with Size
$(document).ready(function () {
    $("#selSize").change(function () {
        const idSize = $(this).val();
        if (idSize == "") {
            return false;
        }
        $.ajax({
            type: 'get',
            url: '/get-product-price',
            data: {idSize: idSize},
            success: function (resp) {
                const arr = resp.split('#');
                $("#getPrice").html("€ " + arr[0]);
                $("#price").val(arr[0]);
                if (arr[1] == 0) {
                    $('#cartButton').hide();
                    $('#Availability').text("Out of Stock");
                } else {
                    $('#cartButton').show();
                    $('#Availability').text("In Stock");
                }
            }, error: function () {
                alert("Error");
            }
        })
    });
});

// REPLACE MAIN IMAGE WITH ALTERNATE IMAGE
$(document).ready(function () {
    $(".changeImage").click(function () {
        var image = $(this).attr('src');
        $("#mainImage").attr("src", image);
    });
});

//Shipping / Billing
$(document).ready(function () {
    $("#copyAddress").click(function(){
        if(this.checked){
            $("#shipping_name").val($("billing_name").val());
        }
    });
});



// FORM VALIDATION
$().ready(function () {
    // REGISTER FORM VALIDATION
    $("#registerForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                letters: true
            },
            password: {
                required: true,
                minlength: 6
            },
            email: {
                required: true,
                email: true,
                remote: "/check-email"
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Your name must be at least 2 characters long",
                accept: "Your name must be letters only",
            },
            password: {
                required: "Please provide your password",
                minlength: "Your Password must be at least 6 characters long"
            },
            email: {
                required: "Please enter your Email",
                email: "Please enter valid Email",
                remote: "Email already exists"
            }
        }
    });

    // LOGIN FORM VALIDATION
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            }
        },
        messages: {
            email: {
                required: "Please enter your Email",
                email: "Please enter valid Email",
            },
            password: {
                required: "Please provide your password",
            }
        }
    });

    // ACCOUNT FORM VALIDATION
    $("#accountForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                letters: true
            },
            address: {
                required: true,
                minlength: 10
            },
            city: {
                required: true,
                minlength: 4
            },
            country: {
                required: true,
            },
            zipcode: {
                required: true,
                minlength: 4
            },
            phone: {
                required: true,
                minlength: 4
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Your name must be at least 2 characters long",
                accept: "Your name must be letters only",
            },
            address: {
                required: "Please provide your address",
                minlength: "Your address must be at least 10 characters long"
            },
            city: {
                required: "Please enter your city",
                minlength: "Your city must be at least 4 characters long"
            },
            country: {
                required: "Please enter your country",
            },
            zipcode: {
                required: "Please enter your zipcode",
                minlength: "Your zipcode must be at least 4 characters long"
            },
            phone: {
                required: "Please enter your phone",
                minlength: "Your phone must be at least 9 characters long"
            }
        }
    });

    // AJAX CHECK CURRENT USER PASSWORD
    $("#current_pass").on('keyup',function() {
        const current_pass = $("#current_pass").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/check-user-pwd',
            data:{current_pass:current_pass},
            success:function (resp) {
                if (resp=="false"){
                    $("#checkpass")
                        .html("<span style='color:red;'>Current Password is incorrect</span>");
                }else if(resp=="true"){
                    $("#checkpass")
                        .html("<span style='color:green;'>Current Password is correct</span>");
                }
            }, error:function (){
                alert("Error");
            }
        });
    });

    // PASSWORD VALIDATION
    $("#pwvalidation").validate({
        rules: {
            current_pass: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            new_pass: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            confirm_pass: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_pass"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    // PASSWORD STRENGTH
    $('#myPassword').passtrength({

        minChars: 4,
        passwordToggle: true,
        tooltip: true,
        tooltip: true,
        textWeak: "Weak",
        textMedium: "Medium",
        textStrong: "Strong",
        textVeryStrong: "Very Strong",
        eyeImg: "images/frontend_images/eye.svg"

    });

});
