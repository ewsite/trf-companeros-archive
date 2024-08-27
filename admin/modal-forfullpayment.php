<?php
if (isset($_POST['mainid']) && isset($_POST['customerid']) && isset($_POST['balance'])
    && isset($_POST['packagepriceselect'])
) {
    $customerid = $_POST['customerid'];
    $balance = $_POST['balance'];
    $packagepriceselect = $_POST['packagepriceselect'];

?>
    <ul style="list-style:none;font-size:25px;">
        <li>
            <label for="balance" style="margin-top: 15px;">Balance:</label>
            <input type="text" value="<?php
                                        $grandbalance = $packagepriceselect - $balance;
                                        echo $grandbalance;
                                        ?>" id="grandbalance" readonly>
        </li>
        <li>
            <label for="amount" style="margin-top: 15px;">Insert Rest of Payment ₱</label>
            <input id="amountforfullpay" type="number" required>
        </li>
        <li>
            <label for="total">Notice: </label>
            <p id="totalfromfull"></p>
        </li>
    </ul>
    <script>
        $("#amountforfullpay").keyup(function() {
            var amount = $("#amountforfullpay").val();
            var grandbalance = $("#grandbalance").val();
            var total = parseFloat(grandbalance) - parseFloat(amount);

            if (total < 0) {
                total = "Cannot Accept Change";
                document.getElementById("btnInspectSave").disabled = true;
            } else if (total === 0) {
                total = "Payment: Ready";
                document.getElementById("btnInspectSave").disabled = false;
            } else if (total > grandbalance) {
                total = "Cannot Accept Change";
                document.getElementById("btnInspectSave").disabled = true;
            } else if (isNaN(total)) {
                total = "<span style='color:red;'>Invalid: Cannot Input Text</span>";
                document.getElementById("btnInspectSave").disabled = true;
            } else {
                
                total = "Insufficient Amount";
                document.getElementById("btnInspectSave").disabled = true;
            }

            document.getElementById("totalfromfull").innerHTML = total;
        });
    </script>
<?php
    # code...
} else {
    echo "Missing Variable";
}
?>