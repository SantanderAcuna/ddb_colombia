<template>
  <div class="row mt-3">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header bg-dark text-white text-center">
          Registar estudiante
        </div>

        <div class="card-body">
          <form>
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
              <input type="text" class="form-control" id="nombre" v-model="nombre" required maxlength="50" placeholder="Ingrese su nombre" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { confirmar } from "../funciones";
import { getTransitionRawChildren } from "vue";
export default {
  data() {
    return {
      estudiantes: null,
      cargando: false,
    };
  },
  mounted() {
    this.getestudiantes();
  },
  methods: {
    getestudiantes() {
      this.cargando = true;

      axios.get("http://127.0.0.1:8000/api/estudiantes").then((res) => {
        this.estudiantes = res.data.data;
        this.cargando = false;
      });
    },
    eliminar(id, nombre) {
      confirmar(
        "http://127.0.0.1:8000/api/estudiantes/",
        id,
        "Eliminar registro",
        "Realmente desea eliminar a" + nombre + "?"
      );
      this.cargando = false;
    },
    formatDate(date) {
      if (!date) return ""; // Manejar fechas nulas o indefinidas si es necesario
      return new Date(date).toLocaleDateString();
    },
  },
};
</script>

