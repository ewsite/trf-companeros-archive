
(function() {

    let form = $("form");

    $(form).submit(function(e) {
        e.preventDefault();
        let data = Object.fromEntries(new FormData(this));

        Swal.fire({
            title: "Login?",
            html: "Logging In....",
            didOpen: () => {
              Swal.showLoading();
            }
        })
        $.ajax({
            url: 'login-process.php',
            method: 'POST',
            data: data,
            success: function(response) {
                // alert(response);
                if (response == "Success") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'You successfully log-in',
                        color: '#000000',
                        showConfirmButton: false,
                        timer: 1500,
                        willClose: () => {
                            window.location.href = "./client/dashboard.php";
                        }
                    });
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Username or Password is Invalid',
                        color: '#000000',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        })
    })
}())
