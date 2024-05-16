import './bootstrap';


 // Desaparecer el mensaje de éxito después de 5 segundos
 setTimeout(function() {
    $('#successAlert').fadeOut('slow');
}, 2000);

// Desaparecer el mensaje de error después de 5 segundos
setTimeout(function() {
    $('#errorAlert').fadeOut('slow');
}, 2000);