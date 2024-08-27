(function() {

    let form = $("#inquiryForm");

    // Submit the reservation
    $(form).submit(function(e) {
      e.preventDefault();
      let data = Object.fromEntries(new FormData(this));

      Swal.fire({
        title: "Inquiry",
        html: "Please Wait :)",
        didOpen: () => {
          Swal.showLoading();
        }
      })
      $.ajax({
          url: 'inquire.php',
          method: 'POST',
          data: data,
          success: function(response) {
              if (response == 'Success') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Inquire Successfully',
                    color: '#000000',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                      window.location.href = "/";
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
                  timer: 2000
                });
              }
          }
      })
    })

}())