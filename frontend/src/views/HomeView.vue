<template>
  <div class="container-md">
    <div class="row">
      <!-- Columna para centrar la tabla -->
      <div class="col-lg-8 offset-lg-2">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">ID</th>
              <th scope="col">FOTO</th>
              <th scope="col">NOMBRE</th>
              <th scope="col">APELLIDO</th>
              <th scope="col">REGISTRO</th>
              <th scope="col">ACCIONES</th>
            </tr>
          </thead>
          <tbody class="table-group-divider" id="contenido">
            <!-- Mostrar mensaje de carga si está cargando -->
            <tr v-if="cargando">
              <td colspan="7"><h6>Cargando...</h6></td>
            </tr>
            <!-- Iterar a través de los estudiantes -->
            <tr v-else v-for="(est, index) in estudiantes" :key="est.id">
              <td>{{ index + 1 }}</td>
              <td>{{ est.id }}</td>
              <td>
                <!-- Mostrar foto si existe, de lo contrario mostrar imagen predeterminada -->
                <img
                  :src="est.foto ? est.foto : require('@/assets/img/1.png')"
                  :style="{ width: '150px' }"
                  :class="['img-thumbnail', { 'h-100': !est.foto }]"
                  alt="Foto"
                />
              </td>
              <td>{{ est.nombre }}</td>
              <td>{{ est.apellido }}</td>
              <td>{{ formatDate(est.created_at) }}</td>
              <td>
                <!-- Enlace para ver detalles del estudiante -->
                <router-link
                  :to="{ path: 'viewE/' + est.id }"
                  class="btn btn-info me-1"
                >
                  <i class="fa-solid fa-eye"></i>
                </router-link>
                <!-- Enlace para editar detalles del estudiante -->
                <router-link
                  :to="{ path: 'editE/' + est.id }"
                  class="btn btn-warning me-1"
                >
                  <i class="fa-solid fa-edit"></i>
                </router-link>
                <!-- Botón para eliminar estudiante -->
                <button
                  class="btn btn-danger"
                  @click="() => eliminar(est.id, est.nombre)"
                >
                  <i class="fa-solid fa-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { confirmar } from "../funciones";

export default {
  data() {
    return {
      estudiantes: null,
      cargando: false,
    };
  },
  mounted() {
    this.getEstudiantes();
  },
  methods: {
    // Obtener la lista de estudiantes
    getEstudiantes() {
      this.cargando = true;

      axios.get("http://127.0.0.1:8000/api/estudiantes").then((res) => {
        this.estudiantes = res.data.data;
        this.cargando = false;
      });
    },
    // Mostrar confirmación antes de eliminar
    eliminar(id, nombre) {
      confirmar(
        "http://127.0.0.1:8000/api/estudiantes/",
        id,
        "Eliminar registro",
        `Realmente desea eliminar a ${nombre}?`
      );
      this.cargando = false;
    },
    // Formatear la fecha (manejar fechas nulas o indefinidas)
    formatDate(date) {
      if (!date) return "";
      return new Date(date).toLocaleDateString();
    },
  },
};
</script>
