
<div class="table-responsive">
  <table id="search-client" class="table table-bordered table-striped" width="100%">
    <thead>
      <tr>
        <th class="text-center">#</th>
        <th>Customer No.</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";;
      $sql = mysqli_query($con, "SELECT * FROM user_accounts");
      $i = 1;
      while ($result = mysqli_fetch_assoc($sql)) {
        # code...

      ?>
        <tr>
          <td><?php echo $i . ".";
              $i++; ?></td>
          <td><?php
              echo $result['customer_no'];
              ?>
          </td>
          <td>
            <?php
            echo $result['lname'];
            ?>

          </td>
          <td>
            <?php
            echo $result['fname'];
            ?>

          </td>
          <td>
            <button class="btn btn-danger btn-md btnAttach" customer_id="<?php echo $result['customer_no']; ?>">Attach</button>

          </td>
        </tr>

      <?php
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th class="text-center">#</th>
        <th>Customer No.</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>
<script></script>
</div>

<script>
  $(".btnAttach").click(function() {
    customer_id = $(this).attr('customer_id');
    // alert(inquiryid);
    $.ajax({
      url: 'attach-cust.php',
      method: 'POST',
      data: {
        inquiryid: inquiryid,
        customer_id: customer_id
      },
      success: function(response) {
        alert(response);
        location.reload();
      }
    })
    // inquiryid=$(this).attr('inquiryid');


  })
</script>