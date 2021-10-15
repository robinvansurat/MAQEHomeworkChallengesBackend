console.log("app");

function maqebot() {
    let codex = $("#maqebot").val()
    console.log(codex)
    $.ajax({
        url: `/ajax/maqebot`,
        method: "POST",
        data: {codex:codex},
        beforeSend: function () {
            
        },
        success: function (response) {
            console.log("success");
            console.log(response);
        },
        error: function (response) {
            console.log("error");
            console.log(response);
            $("#result_codex").empty();
            
        },
    });
}