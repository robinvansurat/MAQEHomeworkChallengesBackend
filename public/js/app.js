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
            let html = '<p>X = '+response.x+'</p>'+
            '<p>Y = '+response.y+'</p>'+
            '<p>Direction = '+response.direction+'</p>'
            $("#result_codex").empty().append(html);
        },
        error: function (response) {
            console.log("error");
            console.log(response);
            $("#result_codex").empty();
            
        },
    });
}