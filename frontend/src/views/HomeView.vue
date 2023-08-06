<template>
  <div class="container-md">
    <div class="row">
      <div class="col-lg-6 offset-lg-2"></div>

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
          <tr v-if="cargando">
            <td colspan="6"><h6>Cargando...</h6></td>
          </tr>

          <tr v-else v-for="(est, i) in estudiantes" :key="est.id">
            <td v-text="i + 1"></td>
            <td v-text="est.id"></td>
            <td>
              <img
                v-if="est.foto"
                style="width: 150px; !important"
                :src="est.foto"
                alt="Foto"
                class="img-thumbnail"
              />
              <img
                v-else height="30"
                style="width: 90px;"
               :src="require('@/assets/img/1.png')"
                alt="Foto"
                class="img-thumbnail"
              />
            </td>
            <td v-text="est.nombre"></td>
            <td v-text="est.apellido"></td>
            <td v-text="formatDate(est.created_at)"></td>
            <td>
              <router-link :to="{ path: 'view/' + est.id }" class="btn btn-info"
                ><i class="fa-solid fa-eye"></i
              ></router-link>

              &nbsp;

              <router-link
                :to="{ path: 'edit/' + est.id }"
                class="btn btn-warning"
                ><i class="fa-solid fa-edit"></i
              ></router-link>

              &nbsp;
              <button class="btn btn-danger">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";
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
    formatDate(date) {
      if (!date) return ""; // Manejar fechas nulas o indefinidas si es necesario
      return new Date(date).toLocaleDateString();
    },
  },
};
</script>
