<template>
  <div>
    <!-- <h1 class="custom-h1">Index - pagina di ricerca avanzata</h1> -->
    <br />
    <button class="btn button-none">
      <a href="/"><i class="fas fa-arrow-left"></i></a>
    </button>

    <div class="form-group">
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

    <div class="form-group">
      <select
        class="form-control"
        name="votes"
        v-model="vote"
        autocomplete="on"
      >
        <option value="0">filtra per media voti</option>
        <option value="5">5</option>
        <option value="4">4</option>
        <option value="3">3</option>
        <option value="2">2</option>
        <option value="1">1</option>
      </select>
    </div>

    <table class="table table-hover my-table" v-if="users.length > 0">
      <thead>
        <tr>
          <th scope="col">Nome e Cognome</th>
          <th scope="col">Email</th>
          <th scope="col">Indirizzo</th>
          <th scope="col"></th>
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

    <div v-if="results === false">
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
      results: true,
      vote: 0,
    };
  },
  beforeCreate() {
    console.log("before create");
  },
  mounted() {
    this.filterSpec();
  },
  watch: {
    specId: function() {
      if (this.specId > 0) {
        this.filterSpec();
      } else {
        this.getAll();
      }
    },
    vote: async function() {
      await this.filterSpec();
      let somma = 0;
      let n = 0;
      let media = 0;
      return this.users.filter((user, index, array) => {
        user.reviews.forEach((review) => {
          somma += review.rv_vote;
          n += 1;
        });
        media = Math.round(somma / n);
        console.log(media);
        if (media >= this.vote) {
          console.log("media maggiore di vote");
          return user;
        }
      });
    },
  },
  methods: {
    getAll: function() {
        axios.get("http://127.0.0.1:8000/api/doctors").then((response) => {
          this.users = response.data;
        });
    },
    filterSpec: function() {
      axios
        .get("http://127.0.0.1:8000/api/doctors?specialization=" + this.specId)
        .then((response) => {
          this.users = response.data;
          if (this.users.length === 0) {
            this.results = false;
          }
        });
    },
  },
};
</script>
