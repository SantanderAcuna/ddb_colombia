// Importa la librería SweetAlert2 para mostrar alertas bonitas
import Swal from "sweetalert2";

// Importa la librería axios para hacer peticiones HTTP
import axios from "axios";

// Función para mostrar una alerta con SweetAlert2
export function mostrarAlerta(titulo, icono, foco = '') {
    if (foco !== '') {
        // Si se proporciona un ID de elemento, enfoca ese elemento
        document.getElementById(foco).focus();
    }

    // Muestra la alerta utilizando SweetAlert2 con los parámetros proporcionados
    Swal.fire({
        title: titulo,
        icon: icono,
        customClass: {
            confirmButton: 'btn btn-primary',
            popup: 'animated zoonIn',
            buttonsStyling: false
        }
    });
}

// Función para confirmar una acción con SweetAlert2
export async function confirmar(urlSlash, id, titulo, icono, mensaje) {
    // Crea la URL completa para la acción utilizando el ID proporcionado
    const url = urlSlash + id;

    // Crea una instancia personalizada de SweetAlert2 para los botones
    const swalWithBootstrapButton = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success me-3',
            cancelButton: 'btn btn-danger'
        }
    });

    try {
        // Muestra una ventana emergente de confirmación utilizando SweetAlert2
        const res = await swalWithBootstrapButton.fire({
            title: titulo,
            text: mensaje,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: ' <i class="fa-solid fa-check"></i> Si, eliminar',
            cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancelar'
        });

        // Si el usuario confirma la acción
        if (res.isConfirmed) {
            // Llama a la función para enviar la solicitud DELETE con el ID
            await enviarSolicitud('DELETE', { id: id }, url, 'Eliminado con éxito');
        } else {
            // Muestra una alerta de información si el usuario cancela
            mostrarAlerta('Operacion cancelada', 'info');
        }
    } catch (error) {
        // Muestra una alerta de error si ocurre algún error en el proceso
        mostrarAlerta('Error al confirmar', 'error');
    }
}

// Función para hacer una solicitud HTTP
export async function enviarSolicitud(metodo, parametros, url, mensaje) {
    try {
        // Realiza la solicitud HTTP utilizando axios con el método, la URL y los parámetros proporcionados
        const res = await axios({ method: metodo, url: url, data: parametros });

        // Si el estado de la respuesta es exitoso (código 200)
        if (res.status === 200) {
            // Muestra una alerta de éxito con el mensaje proporcionado
            mostrarAlerta(mensaje, 'success');
            
            // Redirige a la página principal después de 1 segundo
            setTimeout(() => {
                window.location.href = '/';
            }, 1000);
        } else {
            // Muestra una alerta de error si la respuesta no es exitosa
            mostrarAlerta('No se pudo eliminar el registro', 'error');
        }
    } catch (error) {
        // Muestra una alerta de error si ocurre algún error en la solicitud HTTP
        mostrarAlerta('Error en la solicitud', 'error');
    }
}
