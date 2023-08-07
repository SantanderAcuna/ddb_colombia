<template>
  <div class="row mt-3">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header bg-dark text-white text-center">
          Editar estudiante
        </div>

        <div class="card-body">
          <form @submit.prevent="actualizar">
            <div class="d-grid col-6 mx-auto mb-3">
              <img
                v-if="this.foto"
                height="100px"
                :src="this.foto"
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
            <div class="input-group mb-3">
              <span class="input-group-text">
                <i class="fa-solid fa-gift"></i>
              </span>
              <input
                v-on:change="previsualizarFoto"
                type="file"
                class="form-control"
                accept="image/png, image/jpg, image/jpeg, image/gif"
                id="foto"
              />
            </div>
            <div class="d-grid col-6 mx-auto mb-3">
              <button class="btn btn-success">
                <i class="fa-solid fa-refresh"></i> Actualizar
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
import { useRoute } from "vue-router";
import axios from "axios";

export default {
  data() {
    return {
      id: 0,
      nombre: "",
      apellido: "",
      foto: null,
      url: "http://127.0.0.1:8000/api/estudiantes",
      cargando: false,
    };
  },
  mounted() {
    const route = useRoute();
    this.id = route.params.id;
    this.url += "/" + this.id;
    this.getEstudiante();
  },
  methods: {
    // Obtener los detalles del estudiante
    getEstudiante() {
      axios.get(this.url).then((res) => {
        this.nombre = res.data.data.nombre;  // Corregido: 'nommbre' a 'nombre'
        this.apellido = res.data.data.apellido;
        this.foto = res.data.data.foto;
      });
    },
    // Actualizar los datos del estudiante
    async actualizar() {
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
            "PUT",
            parametros,
            this.url,
            "Estudiante Actualizado!!"
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
    // Formatear la fecha
    formatDate(date) {
      if (!date) return ""; // Manejar fechas nulas o indefinidas si es necesario
      return new Date(date).toLocaleDateString();
    },
  },
};
</script>
