<template>
  <div class="row mt-3">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <!-- Encabezado de la tarjeta -->
        <div class="card-header bg-dark text-white text-center">
          Editar estudiante
        </div>
        <div class="card-body">
          <!-- Enlace para volver a la página anterior -->
          <router-link :to="{ path: '/' }" class="btn btn-info">
            <i class="fa-solid fa-arrow-left"></i> Anterior
          </router-link>
          <!-- Contenedor para la imagen previsualizada -->
          <div class="d-grid col-6 mx-auto mb-3">
            <img
              :style="{ height: '150px', width: '150px' }"
              :src="foto ? foto : require('@/assets/img/1.png')"
              id="fotoImg"
              alt="Foto"
              class="img-thumbnail"
            />
          </div>
          <!-- Campo de nombre -->
          <div class="input-group mb-3">
            <span class="input-group-text">
              <i class="fa-solid fa-user"></i>
            </span>
            <!-- Etiqueta para mostrar el nombre -->
            <label class="form-control" :for="nombre">{{ nombre }}</label>
          </div>
          <!-- Campo de apellido -->
          <div class="input-group mb-3">
            <span class="input-group-text">
              <i class="fa-solid fa-user"></i>
            </span>
            <!-- Etiqueta para mostrar el apellido -->
            <label class="form-control" :for="apellido">{{ apellido }}</label>
          </div>
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
    // Obtener el ID del estudiante de la ruta actual
    const route = useRoute();
    this.id = route.params.id;
    this.url += "/" + this.id;
    // Obtener y mostrar los detalles del estudiante
    this.getEstudiante();
  },
  methods: {
    // Obtener los detalles del estudiante
    getEstudiante() {
      axios.get(this.url).then((res) => {
        // Asignar los valores obtenidos a las propiedades
        this.nombre = res.data.data.nombre;
        this.apellido = res.data.data.apellido;
        this.foto = res.data.data.foto;
      });
    },
    // Actualizar los datos del estudiante
    async actualizar() {
      // Validar si se ingresó nombre y apellido
      if (!this.nombre.trim()) {
        mostrarAlerta("Ingrese un nombre", "warning", "nombre");
      } else if (!this.apellido.trim()) {
        mostrarAlerta("Ingrese un apellido", "warning", "apellido");
      } else {
        try {
          // Construir objeto de parámetros para la actualización
          const parametros = {
            nombre: this.nombre,
            apellido: this.apellido,
            foto: this.foto,
          };
          // Enviar solicitud de actualización y mostrar mensaje de éxito
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
          // Cargar la imagen en this.foto para previsualización
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
      if (!date) return "";
      return new Date(date).toLocaleDateString();
    },
  },
};
</script>
