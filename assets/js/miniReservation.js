(function() {


  let reserveButtons = document.getElementsByClassName("reserve-button");
  let form = $("form");
  let guestReservationContainer = document.getElementById("guest-reddservation-container");
  let inquiryStatus = document.getElementById("inquiry-status")
  let cbopackage = document.getElementById("cbopackage");
  let priceIndicator = $("#price-indicator");
  let cbodate = document.getElementById("cbodate");
  let cboroom = document.getElementById("cboroom");
  let cboperson = document.getElementById("cboperson");
  let cboduration = document.getElementById("cboduration");
  let selectedRooms = [];
  let reserveSubmit = document.getElementById("reserve-submit");

  let dateDone = false;
  let roomDone = false;
  let personDone = false;
  let unavailable = false;

  function updateInput() {
    dateDone = $(cbodate).val() != null;

    if (unavailable) {
      dateDone = false;
      roomDone = false;
      personDone = false;
      cboperson.value = null
      cboduration.value = null
      cboperson.value = null
      priceIndicator.text("Php 0.00")
    }

    console.log(dateDone, personDone, roomDone)
    // let data = Object.fromEntries(new FormData(form));
    if (dateDone && personDone && roomDone) {
      console.log("meee")
      $("#btnConfirm").attr("disabled", false);
    }
    else {
      $("#btnConfirm").attr("disabled", true);
    }

  } 
  
  function refreshRoomInput(e) {
    let value = $(cbopackage).val();
    let targetPackage = rooms[value - 1] ?? null;

    if (!targetPackage)
      return

    selectedRooms = targetPackage.rooms;

    // Remove all options first
    cboroom.innerHTML = ""
    cboroom.value = null

    let plzSelectOption = new Option("Select Room", null, true);
    cboroom.appendChild(plzSelectOption)
    for (const room of selectedRooms) {
      let option = new Option(`Room ${room?.room_no}`, room?.room_no)
      cboroom.appendChild(option)
    }
    updateInput()
  }

  for (const button of reserveButtons) {
      button.addEventListener("click", function() {
          let packageId = button.getAttribute("package_id")
          // Set the selected package details in the modal
          let selectedPackageElement = form.querySelector(`select[name="packageno"]`);
          selectedPackageElement.value = packageId;
          guestReservationContainer.classList.add("show")
      })
  }


  // Submit the reservation
  $(form).submit(function(e) {
    e.preventDefault();
    let data = Object.fromEntries(new FormData(this));

    Swal.fire({
      title: "Reservation",
      html: "Please Wait :)",
      didOpen: () => {
        Swal.showLoading();
      }
    })
    $.ajax({
        url: '/admin/package-confirm.php',
        method: 'POST',
        data: data,
        success: function(response) {
            if (response == 'Success') {
              Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Success',
                  color: '#000000',
                  showConfirmButton: false,
                  timer: 2000,
                  willClose: () => {
                    location.reload();
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

  $(cbopackage).change(refreshRoomInput);

  $("#cboroom, #cbodate").change(function(e) {
    let roomNo = $(cboroom).val();
    let date = $(cbodate).val();

    if (roomNo == 'null') {
      return
    }

    $.ajax({
      url: '/client/room-check.php',
      method: "POST",
      data: {
        room_no: roomNo,
        expected_date: date
      },
      success: function(response) {
        $("#inquiry-status").removeClass("d-none");
        if (response == "Occupied") {
          inquiryStatus.textContent = `Room #${roomNo} already occupied`

          roomDone = false;
          unavailable = true;
        }
        else if (response == "Reserved") {
          inquiryStatus.textContent = `Room #${roomNo} already reserved`

          roomDone = false;
          unavailable = true;

        } else {
          inquiryStatus.textContent = `Room #${roomNo} available`

          roomDone = true;
          unavailable = false;
        }


        updateInput()
      }
    });
  })

  $(cboperson).change(function(e) {

    if (unavailable)
      return

    let roomNo = $(cboroom).val();
    let value = $(this).val();

    let target = selectedRooms.filter(function(room) {
      return room.room_no == roomNo
    })[0] ?? {}
    if (value <= parseInt(target?.room_limit)) {
      inquiryStatus.textContent = `Quantity Accepted`;
      inquiryStatus.classList.remove("d-none")
      personDone = true;
    }
    else {
      inquiryStatus.textContent = `Room ${roomNo} exceeds the limit of ${target?.room_limit ?? 0} person(s)`;
      inquiryStatus.classList.remove("d-none")
      personDone = false;
    }

    updateInput()
  })

  
  $(document).ready(function() {
    refreshRoomInput()
    updateInput()
  })

  $(form).change(updateInput)




  // Triggered when the package is selected
  $("#cboroom, #cboduration, #cbopackage").change(function() {

    if (unavailable)
      return
    let room_no = $(cboroom).val();
    let duration = $(cboduration).val();

    if (room_no == null || duration == null)
      priceIndicator.text("Php 0.00")
    else {
      $.ajax({
        url: '/client/show-price.php',
        method: "POST",
        data: {
          room_no: room_no,
          stay_duration: duration
        },
        success: function(response) {
          priceIndicator.text(response)
        }
      });
    }

  });



  
}())