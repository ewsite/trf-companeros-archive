(function() {

    let toggle = $("#dropdown-toggle");
    let dropdown = $("#custom-dropdown");
    $(toggle).click(function() {
        console.log(dropdown)
        $(dropdown).toggleClass("active");
    })
}())