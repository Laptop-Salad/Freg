
$("#logo").hover(() => {
    $("#logo").attr("src", "../assets/freg-open.png");
})

$("#logo").mouseout(() => {
    $("#logo").attr("src", "../assets/freg.png");
})

var openBurger = false;

$("#hamburger").click(() => {
    if (openBurger) {
        $("#menu").hide();
        $("#menu").css("position", "fixed");
        openBurger = false;
    } else {
        $("#menu").show();
        $("#menu").css("display", "flex");
        $("#menu").css("position", "fixed");
        $("#hamburger").css("z-index", "102034");
        openBurger = true;
    }
})