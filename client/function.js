var p1 = 0, t1 = 0;
function pack() {
    p1 = $('#packages').val();
    showprice(p1, t1);

    // alert(p1);

}
function selecttime() {
    t1 = $('#time').val();
    showprice(p1, t1);

    // alert(t1);

}
function showprice(packageno, selectime) {
    if (packageno == '0') {
        document.getElementById('price').innerHTML = '';

    } else if (selectime == '0') {
        document.getElementById('price').innerHTML = '';

    } else {
        $.ajax({
            url: 'reserve-dash-showprice.php',
            method: 'POST',
            data: {
                p1: p1,
                t1: t1
            },
            success: function (response) {
                //   alert(response);
                document.getElementById('price').innerHTML = response;
            }
        })

    }
}