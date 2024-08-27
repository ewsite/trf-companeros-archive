(function() {
    let kickButton = $(".kick");


    $(kickButton).click(function() {
        let room_no = $(this).attr("roomno");
        let main_id = $(this).attr("mainid");
        Swal.fire({
            title: `Do you want to set Room ${room_no} as unoccupied?`,
            showDenyButton: true,
            icon: 'question',
            confirmButtonText: "Yes",
            denyButtonText: `No`
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: 'kick-room-process.php',
                    method: 'POST',
                    data: {
                        room_no: room_no,
                        main_id: main_id
                    },
                    success: function(response) {
                        // alert(response);
                        if (response == "Success") {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Success',
                                color: '#000000',
                                showConfirmButton: false,
                                timer: 1500,
                                willClose: () => {
                                    location.reload()
                                }
                            });
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'warning',
                                title: response,
                                color: '#000000',
                                showConfirmButton: false,
                                timer: 1500,
                                willClose: () => {
                                    location.reload()
                                }
                            });
                        }
                    }
                })
            }
          });
    })
}())