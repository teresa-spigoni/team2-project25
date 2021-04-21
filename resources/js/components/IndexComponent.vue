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

    <table class="table table-hover my-table" v-if="users.length > 0">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Mail</th>
          <th scope="col">Immagine</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, index) in users" :key="index">
          <td>
            <div>{{ user.name }} {{ user.lastname }}</div>
          </td>
          <td>{{ user.email }}</td>
          <td>{{ user.address }}</td>
          <td>
            <a :href="'/doctors/' + user.id + '/' + specId"
              ><img :src="'../' + user.profile_image" width="150px"
            /></a>
          </td>
        </tr>
      </tbody>
    </table>

    <div v-if="users.length === 0">
      Mi dispiace, non abbiamo nessun medico per la specializzazione
      selezionata.
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
    };
  },
  beforeCreate() {
      console.log('before create')
  },
  mounted() {
      //!!!!SPECID E SELECTED NON SI AGGIORNANO AL MOUNTED
      console.log('mounted')
      console.log('specid' + this.specId)
      console.log('selected' + this.selected)
    axios
      .get("http://127.0.0.1:8000/api/doctors?specialization=" + this.specId)
      .then((response) => {
        this.users = response.data;
      });
  },
  watch: {
    specId() {
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
  },
};
</script>
