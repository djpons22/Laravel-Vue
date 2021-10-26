<template>
  <div>
    <h1 class="text-center">Hospitales</h1>
    <hr />
    <!-- Button trigger modal -->
    <button
      @click="
        update = false;
        openModal();
      "
      type="button"
      class="btn btn-primary"
    >
      Añadir Hospital
    </button>
    <hr />
    <!-- Modal -->
    <div class="modal" :class="{ show: modal }">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ titleModal }}</h5>
            <button
              @click="closeModal()"
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <b><label for="namehospital">Nombre</label></b
              ><br />
              <input
                v-model="hospital.namehospital"
                type="text"
                id="namehospital"
                placeholder="Nombre del Hospital"
                name=""
                maxlength="50"
              />
              <br />

              <b><label for="codi">Codigo</label></b>
              <br />
              <input
                v-model="hospital.codi"
                type="number"
                id="quantity"
                placeholder="Codigo"
                name="quantity"
                min="1"
                max="9999"
              />
              <br />
              <b><label for="tipo">Tipo</label></b>
              <label class="container"
                >Free
                <input
                  type="radio"
                  id="free"
                  checked="checked"
                  name="hospital.tipo"
                  v-model="hospital.tipo"
                  value="0"
                />
                <span class="checkmark"></span>
              </label>
              <label class="container"
                >Premium
                <input
                  type="radio"
                  id="premium"
                  name="hospital.tipo"
                  v-model="hospital.tipo"
                  value="1"
                />
                <span class="checkmark"></span>
              </label>
            </div>
          </div>
          <div class="modal-footer">
            <button
              @click="closeModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cerrar
            </button>
            <button @click="save()" type="button" class="btn btn-success">
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal modalInfo" :class="{ show: modalInfo }">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ titleModal }}</h5>
            <button
              @click="closeModalInfo()"
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <b><label for="namehospital">Nombre</label></b
              ><br />
              <label
                v-model="hospital.namehospital"
                type="text"
                id="namehospital"
                >{{ hospital.namehospital}}
              </label>
              <br />

              <b><label for="codi">Codigo</label></b>
              <br />
              <label v-model="hospital.codi" type="number" id="codi"
                >{{ hospital.codi}}
              </label>
              <br />
              <b><label for="tipo">Tipo</label></b
              ><br />
              <label
                v-model="hospital.tipo"
                type="radio"
                id="tipo"
                v-if="hospital.tipo==0"
              >
                Free
              </label>
            </div>
          </div>
          <div class="modal-footer">
            <button
              @click="closeModalInfo()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <table class="table table-striped table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Nombre</th>
          <th scope="col">Codigo</th>
          <th scope="col">Tipo</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="hospital in hospitals" :key="hospital.id">
          <th scope="row">{{ hospital.id }}</th>

          <td>{{ hospital.namehospital }}</td>
          <td>*</td>
          <td v-if="hospital.tipo == 1">Premium</td>
          <td
            @click="
              update = false;
              codiModal(hospital);
            "
            v-else
          >
            Free <img src="https://img.icons8.com/ios/20/000000/info--v1.png" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      hospital: {
        namehospital: "",
        codi: "",
        tipo: "",
      },
      update: null,
      modal: 0,
      modalInfo:0,
      titleModal: " ",
      hospitals: [],
    };
  },
  methods: {
    async list() {
      const res = await axios.get("hospitals");
      this.hospitals = res.data;
    },
    async save() {
      const res = await axios.post("/hospitals", this.hospital);
      this.closeModal();
      this.list();
    },

    openModal(data = {}) {
      this.modal = 1;
      this.titleModal = "Crear Hospital";
      this.hospital.namehospital = "";
      this.hospital.codi = "";
      this.hospital.tipo = "";
    },

    codiModal(data = {}) {
      this.modalInfo = 1;
      this.titleModal = "Información Hospital";
      this.hospital.namehospital = data.namehospital;
      this.hospital.codi = data.codi;
      this.hospital.tipo = data.tipo;
    },

    closeModal() {
      this.modal = 0;
    },
    closeModalInfo() {
      this.modalInfo = 0;
    },
  },
  created() {
    this.list();
  },
};
</script>

<style>
.show {
  display: list-item;
  opacity: 1;
  background: rgba(44, 38, 75, 0.9);
}
</style>
