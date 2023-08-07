<template>
  <div class="row mt-3">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <!-- Encabezado de la tarjeta -->
        <div class="card-header bg-dark text-white text-center">
          Registrar estudiante
        </div>

        <div class="card-body">
          <!-- Formulario para registrar estudiante -->
          <form @submit.prevent="guardar">
            <!-- Previsualización de la foto -->
            <div class="d-grid col-6 mx-auto mb-3">
              <img
                v-if="foto"
                height="100px"
                :src="foto"
                id="fotoImg"
                alt="Foto"
                class="img-thumbnail"
              />
              <img
                v-else
                height="100px"
                id="fotoImg"
                :src="require('@/assets/img/1.png')"
                alt="Foto"
                class="img-thumbnail"
              />
            </div>
            <!-- Campo para ingresar nombre -->
            <div class="input-group mb-3">
              <span class="input-group-text">
                <i class="fa-solid fa-user"></i>
              </span>
              <input
                type="text"
                class="form-control"
                id="nombre"
                v-model="nombre"
                required
                maxlength="50"
                placeholder="Ingrese su nombre"
              />
            </div>
            <!-- Campo para ingresar apellido -->
            <div class="input-group mb-3">
              <span class="input-group-text">
                <i class="fa-solid fa-user"></i>
              </span>
              <input
                type="text"
                class="form-control"
                id="apellido"
                v-model="apellido"
                required
                maxlength="50"
                placeholder="Ingrese su apellido"
              />
            </div>
            <!-- Campo para cargar foto -->
            <div class="input-group mb-3">
              <span class="input-group-text">
                <i class="fa-solid fa-gift"></i>
              </span>
              <input
                @change="previsualizarFoto"
                type="file"
                class="form-control"
                accept="image/png, image/jpg, image/jpeg, image/gif"
                id="foto"
              />
            </div>
            <!-- Botón para registrar estudiante -->
            <div class="d-grid col-6 mx-auto mb-3">
              <button class="btn btn-success">
                <i class="fa-solid fa-floppy-disk"></i> Registrar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mostrarAlerta, enviarSolicitud } from "../funciones";

export default {
  data() {
    return {
      nombre: "",
      apellido: "",
      foto: null, // Cambiado de "" a null para manejar la previsualización
      url: "http://127.0.0.1:8000/api/estudiantes",
    };
  },

  methods: {
    // Guardar el estudiante en el servidor
    async guardar() {
      if (this.nombre.trim() === "") {
        mostrarAlerta("Ingrese un nombre", "warning", "nombre");
      } else if (this.apellido.trim() === "") {
        mostrarAlerta("Ingrese un apellido", "warning", "apellido");
      } else {
        try {
          const parametros = {
            nombre: this.nombre,
            apellido: this.apellido,
            foto: this.foto,
          };

          await enviarSolicitud(
            "POST",
            parametros,
            this.url,
            "Estudiante registrado!!"
          );
        } catch (error) {
          console.error("Error al guardar:", error);
          mostrarAlerta("Error al guardar", "error");
        }
      }
    },

    // Previsualizar la foto antes de guardarla
    previsualizarFoto(event) {
      const file = event.target.files[0];

      if (file) {
        try {
          const reader = new FileReader();

          reader.onload = () => {
            this.foto = reader.result;
          };

          reader.readAsDataURL(file);
        } catch (error) {
          console.error("Error al cargar la imagen:", error);
        }
      }
    },

    // Formatear la fecha (manejar fechas nulas o indefinidas)
    formatDate(date) {
      if (!date) return "";
      return new Date(date).toLocaleDateString();
    },
  },
};
</script>
