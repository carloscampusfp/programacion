// Obtener referencias a los elementos del DOM
const planSelect = document.getElementById('plan');
const duracionSelect = document.getElementById('duracion');
const precioInput = document.getElementById('precio');
const edadInput = document.getElementById('edad');
const cineCheckbox = document.getElementById('cine');
const infantilCheckbox = document.getElementById('infantil');
const deporteCheckbox = document.getElementById('deporte');
const idEliminar = document.getElementById('idEliminar');

let precio = 0;
let paquetesPrecio = 0;

const preciosPlanes = { 'basico': 9.99, 'estandar': 13.99, 'premium': 17.99};

// Función para limitar la selección de checkboxes según las reglas
function limitarCheckboxes(event) {
    const plan = planSelect.value; // Obtener el plan seleccionado
    const edad = parseInt(edadInput.value, 10) || 0; // Edad ingresada (0 si no es válida)
    const duracion = duracionSelect.value; // Duración seleccionada

    // Primero, deshabilitar checkboxes según las reglas generales
    cineCheckbox.disabled = (plan === 'basico' && (infantilCheckbox.checked || deporteCheckbox.checked)) || edad < 18;
    infantilCheckbox.disabled = (plan === 'basico' && (cineCheckbox.checked || deporteCheckbox.checked));
    deporteCheckbox.disabled = (plan === 'basico' && (cineCheckbox.checked || infantilCheckbox.checked)) || edad < 18 || duracion !== 'anual';

    // Desmarcar cualquier checkbox que esté deshabilitado
    if (cineCheckbox.disabled) cineCheckbox.checked = false;
    if (infantilCheckbox.disabled) infantilCheckbox.checked = false;
    if (deporteCheckbox.disabled) deporteCheckbox.checked = false;

    //debido a que cuando tenia 2 o mas checkbox seleccionados estando en plan estandar o premium y luego cuando ponia basico sin desmarcarlas se me deshabilitaban 
    // todas las casillas por como he escrito el codigo, he repetido esta parte despues para que vuelva a establecer las reglas de mis checkbox
   
    if(event && event.target.value === 'basico'){
        cineCheckbox.disabled = (plan === 'basico' && (infantilCheckbox.checked || deporteCheckbox.checked)) || edad < 18;
        infantilCheckbox.disabled = (plan === 'basico' && (cineCheckbox.checked || deporteCheckbox.checked));
        deporteCheckbox.disabled = (plan === 'basico' && (cineCheckbox.checked || infantilCheckbox.checked)) || edad < 18 || duracion !== 'anual';
        if(!cineCheckbox.checked && !infantilCheckbox.checked && !deporteCheckbox.checked){
            paquetesPrecio = 0;
        } /* hay que hacer esto, ya que se van a desmarcar */
    }
    
    // Actualizar el precio tras cualquier cambio
    actualizarPrecio();
}

// Función para calcular el precio base según el plan y la duración
function actualizarPrecio(event) {
   
    const plan = planSelect.value;
    const duracion = duracionSelect.value;

    // Precios base según el plan
    precio = preciosPlanes[plan];

    // Si el evento proviene de un checkbox, actualizar los precios de los paquetes
    if (event && event.target.type === 'checkbox') {
        const checkbox = event.target;

        if (checkbox === cineCheckbox) {
            paquetesPrecio += cineCheckbox.checked ? 7.99 : -7.99;
        } else if (checkbox === infantilCheckbox) {
            paquetesPrecio += infantilCheckbox.checked ? 4.99 : -4.99;
        } else if (checkbox === deporteCheckbox) {
            paquetesPrecio += deporteCheckbox.checked ? 6.99 : -6.99;
        }
    }
    let multiplicador = 1;
    
    // Aumentar precio si la duración es anual
    
    if (duracion === 'anual'){
        multiplicador = 12;
    }

    // Actualizar el campo de precio con 2 decimales
    precioInput.value = ((precio + paquetesPrecio)*multiplicador).toFixed(2);
}


// Escuchar eventos en los elementos del formulario
planSelect.addEventListener('change', (event) => { 
    actualizarPrecio(event);
    limitarCheckboxes(event); // Aplicar reglas del nuevo plan
});

duracionSelect.addEventListener('change', (event) => {
    limitarCheckboxes(); // Actualizar reglas según la duración
    actualizarPrecio(event);
});

edadInput.addEventListener('input', () => {
    limitarCheckboxes(); // Actualizar reglas según la edad ingresada
});

cineCheckbox.addEventListener('change', (event) => {
    actualizarPrecio(event); // Actualizar precio si se cambia este checkbox
    limitarCheckboxes(); // Actualizar las restricciones
});

infantilCheckbox.addEventListener('change', (event) => {
    actualizarPrecio(event); // Actualizar precio si se cambia este checkbox
    limitarCheckboxes(); // Actualizar las restricciones
});

deporteCheckbox.addEventListener('change', (event) => {
    actualizarPrecio(event); // Actualizar precio si se cambia este checkbox
    limitarCheckboxes(); // Actualizar las restricciones
});

// Inicializar valores al cargar la página
window.addEventListener('DOMContentLoaded', (event) => {
    limitarCheckboxes(event); // Configurar estado inicial de los checkboxes
    actualizarPrecio(); // Calcular el precio inicial
});
