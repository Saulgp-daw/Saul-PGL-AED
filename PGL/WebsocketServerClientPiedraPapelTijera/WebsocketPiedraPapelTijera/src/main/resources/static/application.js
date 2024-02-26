let stomp = null;

function setConnected(connected) {
    $("#connect").prop("disabled", connected);
    $("#disconnect").prop("disabled", !connected);
    $("#send").prop("disabled", !connected);

    if (connected) {
        $("#conversation").show();
    } else {
        $("#conversation").hide();
    }

    $('#output').val('');
    $("#responses").html("");
}

function connect() {
    stomp = webstomp.over(new SockJS('http://localhost:8080/sockjs'));

    stomp.connect({}, function (frame) {
        setConnected(true);
        console.log('Client connected: ' + frame);

        stomp.subscribe('/salas/general', function (response) {
            log(response, 'table-success');
        });

        const subscription = stomp.subscribe('/usuarios/cola/mensajes', function (response) {
            log(response, 'table-success');
        });

   
    });
}

function disconnect() {
    if (stomp !== null) {
        stomp.disconnect(function() {
            setConnected(false);
            console.log("Client disconnected");
        });
        stomp = null;
    }
}

function send() {
    const output = $("#output").val();
    console.log("Client sends: " + output);
    let mensaje={
		author: "pico",
		receiver: "desconocido",
		content: output
	}
    stomp.send("/app/mensajegeneral", JSON.stringify(mensaje),{});
}

function log(response, clazz) {
    const input = response.body;
    console.log("Client received: " + input);
    $("#responses").append("<tr class='" + clazz + "'><td>" + input + "</td></tr>");
}

$(function () {
    $("form").on('submit', function (e) {
        e.preventDefault();
    });
    $("#connect").click(function () {
        connect();
    });
    $("#disconnect").click(function () {
        disconnect();
    });
    $("#send").click(function () {
        send();
    });
});