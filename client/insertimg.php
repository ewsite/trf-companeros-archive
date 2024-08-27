<?php
if (isset($_POST['customerid']) && isset($_POST['mainid'])) {
  $customer_id = $_POST['customerid'];
  $main_id = $_POST['mainid'];
?>
  <h6 style="color:red;font-size:18px;font-weight:600;">NOTE: If you want to pay full payment, send the 100% payment. If you pay the 50% of payment the rest of payment,it will be when your event start </h6>
  <b>To pay, scan the QR code below using GCash.</b>
  <img src="/assets/img/gcash.png" class="w-100" alt="">
  <label for="">Insert G-Cash Reference Here:</label>
  <input type="file" id="myFileInput" accept=".png, .jpeg, .jpg" />

  <script>
    var customer_id = <?php echo json_encode($customer_id); ?>;
    var main_id = <?php echo json_encode($main_id); ?>;

    var fileInput = document.getElementById('myFileInput');
    var button = document.getElementById('btnsaveinsert');

    button.addEventListener('click', showAlert);

    fileInput.addEventListener('change', validateFile);

    function validateFile() {
      var filePath = fileInput.value;
      var allowedExtensions = /(\.png|\.jpeg|\.jpg)$/i;

      if (!allowedExtensions.exec(filePath)) {
        alert('Please upload a file with a valid extension: .png, .jpeg, or .jpg');
        fileInput.value = '';
        return false;
      }
      // Proceed with file upload
      // ...
    }

    function showAlert(e) {
      e.preventDefault();

      var file = fileInput.files[0];

      if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
          var imageData = e.target.result;
          Swal.fire({
            title: "Proof of Payment",
            html: "Image Uploading :)",
            didOpen: () => {
              Swal.showLoading();
            }
          })  
          $.ajax({
            url: "transaction-upload-dash.php",
            type: "POST",
            data: {
              imageData: imageData,
              customer_id: customer_id,
              main_id: main_id
            },
            success: function(response) {
              if (response == 'Success') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Proof of Payment',
                    html: 'Image Uploaded Successfully',
                    color: '#000000',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                      location.reload()
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
          });
        };

        reader.readAsDataURL(file);
      }
    }
  </script>
<?php
} else {
  echo "Missing variable";
}
?>
