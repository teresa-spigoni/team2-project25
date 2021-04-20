<template>
  <div>
    <h1>Index - pagina di ricerca avanzata</h1>
    <br />
    <a href="/">Torna alla home</a>
    <div class="form-group">
      <label for="specializations">Specializzazione</label>
      <select
        class="form-control"
        name="specializations"
        v-model="specId"
        autocomplete="on"
      >
        <option value="0">vedi tutti i medici</option>
        <option
          v-for="(spec, index) in specializations"
          :key="index"
          :value="spec.id"
        >
          {{ spec.spec_name }}
        </option>
      </select>
    </div>

    <table
      class="table table-hover my-table"
      v-if="users.length > 0 && show === false"
    >
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Mail</th>
          <th scope="col">Immagine</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, index) in users" :key="index" @click="showUser(user)">
          <td>
            <div>{{ user.name }} {{ user.lastname }}</div>
          </td>
          <td>{{ user.email }}</td>
          <td>{{ user.address }}</td>
          <td><img :src="'../' + user.profile_image" width="150px" /></td>
        </tr>
      </tbody>
    </table>

    <div v-if="users.length === 0">
      Mi dispiace, non abbiamo nessun medico per la specializzazione
      selezionata.
    </div>

    <div v-if="show === true">
      <h1 class="custom-h1">Pagina Dottore</h1>
      <div class="card doctor-card">
        <div class="card-body">
          <img :src="'../' + user.profile_image" />
          <h2 class="card-title">
            <i class="fas fa-user-md" style="color: #32bea6"></i>
            {{user.name}} {{user.lastname}}
          </h2>
          <div class="card-text">
            <h5 v-for="(spec, index) in user.specializations" :key ="index">&diams; {{spec.spec_name}}</h5>
          </div>
          <hr />
          <p class="card-text"><strong>Email:</strong> {{user.email}}</p>
          <p class="card-text">
            <strong>Indirizzo:</strong> {{user.address}}
          </p>
          <button class="btn custom-button" @click="goBack()">
            Torna all'elenco dei medici
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: { selected: Number, specializations: Array },
  data() {
    return {
      specId: this.selected,
      users: [],
      show: false,
      user: []
    };
  },
  mounted() {
    axios
      .get("http://127.0.0.1:8000/api/doctors?specialization=" + this.specId)
      .then((response) => {
        this.users = response.data;
      });
  },
  watch: {
    specId() {
      console.log(this.specId);
      if (this.specId > 0) {
        axios
          .get(
            "http://127.0.0.1:8000/api/doctors?specialization=" + this.specId
          )
          .then((response) => {
            this.users = response.data;
          });
      } else {
        axios.get("http://127.0.0.1:8000/api/doctors").then((response) => {
          this.users = response.data;
        });
      }
    },
  },
  methods: {
    showUser(user) {
      this.show = true;
      this.user = user;
    },
    goBack() {
        this.show = false;
    }
  },
};
</script>
