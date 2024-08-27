<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
if (isset($_POST['inquiryid']) && isset($_POST['customerid']) ) {
    $inquiryid = $_POST['inquiryid'];
    $customerid=$_POST['customerid'];
    $sqlinspect = mysqli_query($con, "SELECT * FROM main_table where main_id = '$inquiryid'");
    $result = mysqli_fetch_assoc($sqlinspect);
    $downpay = $result['payment_one_img'];
?>
    
    <label for="img">Downpayment Image: </label>
    <div class="container" style="width: 100%; background: #ddd; align-items: center; padding: 15px;">
        <?php if (!empty($downpay)) : ?>
            <img id="imgedp" src="<?php echo $downpay; ?>" target="_blank" alt="" width="70%" style="display: block; margin-left: auto; margin-right: auto;">
            <button class="btn btn-danger" id="btnDeleteimg">Delete</button>
        <?php else : ?>
            <h4 style="color:red;text-align:center;font-size:50px;font-weight:700;">No Picture</h4>
        <?php endif; ?>
    </div>


    <form method="POST" action="#">
        <ul style="list-style:none;font-size:25px;">
        <li>
            <label for="or">O.R Number:</label>
        <input type="text" maxlength="13" oninput="restrictSpaces1(event)" id="orno1" value="<?php echo $result['or_no1'] ?>" required><br>
        </li>
            <li><label for="package_name">Room #<span><?=$result['room_no']?></span></label></li>
            <li><label for="amount" style="margin-top: 15px;">Amount Cost ₱</label>
                <input type="number" oninput="restrictSpaces(event)" id="currencyfield"  required>
            </li>
            <li>
                <label for="price">Package Price:</label>
                <p id="price"><?php
                                $packageno = $result['package'];
                                $sqlpack = mysqli_query($con, "SELECT * from main_table WHERE  main_id='$inquiryid'");
                                $res = mysqli_fetch_array($sqlpack);
                                echo $res['customer_price'];
                                $add = $_GET
                                ?></p>


            </li>
            <li>
                <label for="need">Payment 50%:</label>
                <p id="half"></p>
            </li>
            <li>
                <label for="balance">Notice</label>
                <p id="result"></p>
            </li>

        </ul>
    </form>
<?php
}


?>
<script>
    var orno = document.getElementById("orno1");
    var imagedp = document.getElementById("imgedp");
    var addhead = document.getElementById("add");
    document.getElementById("btnInspectSave").disabled = true;


    if (orno == "" && imagedp == "") {
        document.getElementById("btnInspectSave").disabled = true;

    }
    //FOR OR NO1
    var numericInput1 = document.getElementById('orno1');
    // Listen for the 'input' event on the input field
    numericInput1.addEventListener('input', function(event) {
        // Remove any non-numeric characters using regex
        numericInput1.value = numericInput1.value.replace(/[^0-9]/g, '');
    });

    function restrictSpaces1(event) {
        var input = event.target.value;
        var filteredInput = input.replace(/\s/g, ''); // Remove spaces
        event.target.value = filteredInput;
    }
    //FOR OR NO1
    let t = document.getElementById("currencyfield");
    var price = document.getElementById("price").innerHTML;
    var half = parseFloat(price)/2;
    document.getElementById("half").textContent = half;

    t.addEventListener("input", function() {
        //FOR OR AMOUNT
        var numericInput = document.getElementById('currencyfield');
        // Listen for the 'input' event on the input field
        numericInput.addEventListener('input', function(event) {
            // Remove any non-numeric characters using regex
            numericInput.value = numericInput.value.replace(/[^0-9]/g, '');
        });

        function restrictSpaces(event) {
            var input = event.target.value;
            var filteredInput = input.replace(/\s/g, ''); // Remove spaces
            event.target.value = filteredInput;
        }
        //FOR OR AMOUNT

        var money = document.getElementById("currencyfield").value;
        // alert(money);
        var total = parseFloat(money) - parseFloat(half);
        



        if (total < 0) {
            total = "Insufficient Amount";
            document.getElementById("btnInspectSave").disabled = true;

        } else if (total === 0) {
            total = "Payment:Ready";
            document.getElementById("btnInspectSave").disabled = false;
        } else if (total > half) {
            total = "Cannot Accept Change";
            document.getElementById("btnInspectSave").disabled = true;
        } else if (isNaN(total)) {
            total = "<span style='color:red;'>Invalid:Cannot Input Text</span>";
            document.getElementById("btnInspectSave").disabled = true;
        }else if (total = price) {
            total = "Payment:Ready";
            document.getElementById("btnInspectSave").disabled = false;
        } 
        
        else {
            total = "Cannot Accept Change";

            document.getElementById("btnInspectSave").disabled = true;

        }
        document.getElementById("result").innerHTML = total;
    });
    
    $("#btnDeleteimg").click(function(){
        var inquiryid = "<?php echo $_POST['inquiryid']; ?>";

         $.ajax({
            type: "POST",
            url: "deleteimg_forclient.php",
            data: { inquiryid: inquiryid },
            success: function(response) {
                alert(response);
                 
            }
        });
    })

</script>