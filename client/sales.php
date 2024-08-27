<?php
include('connection.php');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-10">
        <h1>SALES RECORD</h1>
      </div>
      <!-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Sales</li>
          </ol>
        </div> -->
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-20">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            Search: <input type="text" name="search" id="searchInput" placeholder="Search......" style="margin-bottom: 10px;margin-right:50px;">
            <input type="date" id="startDateInput">
            <input type="date" id="endDateInput">
            <button id="filtertable">Filter</button>
            <table id="example1" class="table table-bordered table-striped" style="text-align: center;">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Customer_Transaction_No.</th>
                  <th>Customer_No.</th>
                  <th>Packages</th>
                  <th>Price</th>
                  <th>Inclusion</th>
                  <th>Date_Created</th>
                  <th>Time_Schedule</th>
                  <th>Dppayment</th>
                  <th>Fullpayment</th>
                  <th>Total_Amount_Expected</th>
                  <th>Date_Done</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="tablebody">
                <?php
                include('connection.php');
                $sql = mysqli_query($con, "select * from sales");
                $i = 1;

                while ($result = mysqli_fetch_assoc($sql)) {
                ?>
                  <tr>
                    <td><?php echo $i . ".";
                        $i++; ?></td>
                    <td><?php echo $result['customer_transaction_no']; ?></td>
                    <td><?php echo $result['customer_no']; ?></td>
                    <td><?php echo $result['packages']; ?></td>
                    <td><?php echo $result['price']; ?></td>
                    <td><?php echo $result['inclusion']; ?></td>
                    <td><?php echo $result['date_created']; ?></td>
                    <td><?php echo $result['time_schedule']; ?></td>
                    <td><?php echo $result['dppayment']; ?></td>
                    <td><?php echo $result['fullpayment']; ?></td>
                    <td><?php echo $result['total_amount_expected']; ?></td>
                    <td><?php echo $result['date_done']; ?></td>
                    <td><?php echo $result['status']; ?></td>
                  </tr>
              </tbody>
            <?php
                }
            ?>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Customer_Transaction_No.</th>
                <th>Customer_No.</th>
                <th>Packages</th>
                <th>Price</th>
                <th>Inclusion</th>
                <th>Date_Created</th>
                <th>Time_Schedule</th>
                <th>Dppayment</th>
                <th>Fullpayment</th>
                <th>Total_Amount_Expected</th>
                <th>Date_Done</th>
                <th>Status</th>
              </tr>
            </tfoot>
            </table>
            <p class="col-4" style="font-weight:bold; font-size:20px; margin-top:10px;">Total FullPayment</p>
            <p class="col-4" id="totalFullPayment" style="font-weight:bold; font-size:20px; margin-top:10px;margin-left:50px;"> 0</p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

<script src="plugins/jquery/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  document.getElementById('searchInput').addEventListener('input', function() {
    searchTable();
  });

  function searchTable() {
    // Get the search term from the input field
    var searchTerm = document.getElementById('searchInput').value.toLowerCase();

    // Get all rows in the table body
    var table = document.getElementById('example1');
    var rows = table.getElementsByTagName('tr');

    // Loop through each row and hide or show based on the search term
    for (var i = 0; i < rows.length; i++) {
      var rowData = rows[i].getElementsByTagName('td');
      var match = false;

      for (var j = 0; j < rowData.length; j++) {
        if (rowData[j].textContent.toLowerCase().indexOf(searchTerm) > -1) {
          match = true;
          break;
        }
      }

      // Hide or show the row based on the match
      if (match) {
        rows[i].style.display = '';
      } else {
        rows[i].style.display = 'none';
      }
    }
  }
</script>

<script>
$('#filtertable').click(function(){

  var startDateInput = $('#startDateInput').val();
  var endDateInput = $('#endDateInput').val();

  $.ajax({

    url: 'filter_sales.php',
    method: "POST",
    data:{
      startDateInput:startDateInput,
      endDateInput:endDateInput
    },
    success: function(response){
      // alert(response);
      document.getElementById('totalFullPayment').innerHTML = response;
    }  
  });
})
</script>