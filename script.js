// Espera a que el contenido del DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function() {
    // Busca todos los elementos que sean form
    const forms = document.querySelectorAll("form");

    // itera en cada formulario
    forms.forEach(form => {
        // le pone el evento submit a cada formulario
        form.addEventListener("submit", function(event) {

            // agarra el input que esta dentro del formulario en el que se esta iterando
            const inputs = form.querySelectorAll("input");
            
            // por cada input del formulario
            for (let input of inputs) {
                // verifica si el valor del input está vacío y a su vez recorta los lugares vacios
                if (!input.value.trim()) {
                    // muestra la alerta si algún input está vacío
                    alert("Todos los campos son obligatorios.");
                    
                    // no envia el formulario
                    event.preventDefault();
                    return;
                }
            }
        });
    });
});
