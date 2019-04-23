$(document).ready(function() {
    $("#birth").datepicker();
    $("button").click(function() {
        var birth = $("#birth").val();
        if (birth === "") {
			alert("Please select Date Of Birth");
        }
    });
});