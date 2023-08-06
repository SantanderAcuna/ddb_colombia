import Swal from "sweetalert2";
import axios from "axios";

export function mostrarAlerta(titulo, icono, foco = '') {

    if (foco != '') {
        document.getElementById(foco).focus();
    }

    Swal.fire({
        title: titulo,
        icon: icono,
        customClass: {
            confirmButton: 'btn btn-primary', popup: 'animated zoonIn',
            buttonsStyling: false

        }
    });

}

export function confirmar(urlSlash, id, titulo, icono, mensaje) {

    var url = urlSlash + id;
    const swalWithBootstrapButton = swal.mixin({

        customClass: {
            confirmButton: 'btn btn-success me-3', cancelButton: 'btn btn-danger',
        },


    });

    swalWithBootstrapButton.fire({
        title: titulo,
        text:mensaje,
        icon: 'question',
        showCancelButton:true,
        confirmButtonText:' <i class="fa-solid fa-check"></i> Si, eliminar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'}).then((res)=>{

            
        })

    }
    

    Swal.fire({
        title: titulo,
        icon: icono,
        customClass: {
            confirmButton: 'btn btn-primary', popup: 'animated zoonIn',
            buttonsStyling: false

        }
    }),

}