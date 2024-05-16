// formulario.js
var canvas = document.getElementById('firma');
var clearButton = document.getElementById('clearButton');
var ctx = canvas.getContext('2d');
var drawing = false;

canvas.addEventListener('mousedown', function(e) {
    drawing = true;
    ctx.lineWidth = 2;
    ctx.strokeStyle = '#000';
    ctx.beginPath();
    ctx.moveTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
});

canvas.addEventListener('mousemove', function(e) {
    if (drawing === true) {
        ctx.lineTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
        ctx.stroke();
    }
});

canvas.addEventListener('mouseup', function(e) {
    drawing = false;
    document.getElementById('sign').value = canvas.toDataURL('image/png');
});

canvas.addEventListener('mouseleave', function(e) {
    drawing = false;
    document.getElementById('sign').value = canvas.toDataURL('image/png');
});


clearButton.addEventListener('click', () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    $('#sign').val('');
})

 // Desaparecer el mensaje de éxito después de 5 segundos
 setTimeout(function() {
    $('#successAlert').fadeOut('slow');
}, 2000);

// Desaparecer el mensaje de error después de 5 segundos
setTimeout(function() {
    $('#errorAlert').fadeOut('slow');
}, 2000);