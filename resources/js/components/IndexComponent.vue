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
                <option value="5"
                    >&#9733; &#9733; &#9733; &#9733; &#9733;</option
                >
                <option value="4">&#9733; &#9733; &#9733; &#9733;</option>
                <option value="3">&#9733; &#9733; &#9733;</option>
                <option value="2">&#9733; &#9733;</option>
                <option value="1">&#9733;</option>
            </select>
        </div>

        <table class="table table-hover my-table" v-if="users.length > 0">
            <thead>
                <tr>
                    <th scope="col">Nome e Cognome</th>
                    <th scope="col">Specializzazioni</th>
                    <th scope="col">Media voti</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="index">
                    <td>
                        <div>{{ user.name }} {{ user.lastname }}</div>
                    </td>
                    <td>
                        <div
                            v-for="(spec, index) in user.specializations"
                            :key="index"
                        >
                            {{ spec.spec_name }}
                        </div>
                    </td>
                    <td>
                        <i
                            class="fas fa-star"
                            style="color: orange"
                            v-for="(star, index) in average(user)"
                            :key="index"
                        ></i>
                    </td>
                    <td>
                        <a :href="'/doctors/' + user.id + '/' + specId">
                            <img
                                :src="'../' + user.profile_image"
                                width="150px"
                                style="border-radius: 50%"
                            />
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <div v-if="results === false">
            Mi dispiace, non ci sono risultati per i tuoi criteri di ricerca.
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
            vote: 0
        };
    },
    mounted() {
        this.filterSpec();
    },
    watch: {
        specId: function() {
            this.filterSpec().then(() => {
                this.vote = 0;
            });
        },
        vote: function() {
            this.filterSpec().then(() => {
                return this.filterVote();
            });
        }
    },
    methods: {
        getAll: function() {
            return axios
                .get("http://127.0.0.1:8000/api/doctors")
                .then(response => {
                    this.users = response.data;
                });
        },
        filterSpec: function() {
            if (this.specId > 0) {
                return axios
                    .get(
                        "http://127.0.0.1:8000/api/doctors?specialization=" +
                            this.specId
                    )
                    .then(response => {
                        this.users = response.data;
                        if (this.users.length === 0) {
                            this.results = false;
                        }
                    });
            } else {
                return this.getAll();
            }
        },
        filterVote: function() {
            if (this.vote != 0) {
                this.users = this.users.filter(user => {
                    let media = this.average(user);
                    if (media == this.vote) {
                        return user;
                    }
                });
                if (this.users.length === 0) {
                    this.results = false;
                }
            } else {
                return;
            }
        },
        average: function(user) {
            let somma = 0;
            let n = 0;
            let media = 0;
            user.reviews.forEach(review => {
                somma += review.rv_vote;
                n += 1;
            });
            return (media = Math.round(somma / n));
        }
    }
};
</script>
