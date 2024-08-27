(function() {

    let form = $("form");

    $(form).submit(function(e) {
        e.preventDefault();
        let data = Object.fromEntries(new FormData(this));
        Swal.fire({
            title: "Sign Up",
            html: "Please Wait :)",
            didOpen: () => {
              Swal.showLoading();
            }
        })
        $.ajax({
            url: 'signup-process.php',
            method: 'POST',
            data: data,
            success: function(response) {
                if (response.trim() == 'Sign-up Successfully') {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Successfully Sign-up',
                        color: '#000000',
                        showConfirmButton: false,
                        timer: 1500,
                        willClose: () => {
                            window.location.href = "/login.php";
                        }
                    });

                }
                else {
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: response,
                        color: '#000000',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        })
    })
}())