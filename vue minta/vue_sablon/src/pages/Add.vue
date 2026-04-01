<template>
    <div class="container">
        <h1 class="text-center">Új túra hozzáadása</h1>
        <form @submit.prevent="hozzaadTura">
            <div>
                <label for="nev" class="form-label">Név:</label>
                <input type="text" id="nev" class="form-control" v-model="ujTura.nev">
            </div>

            <div>
                <label for="tavolsagKm" class="form-label">Távolság (km):</label>
                <input type="number" id="tavolsagKm" class="form-control" v-model="ujTura.tavolsagKm">
            </div>

            <div>
                <label for="nehezseg" class="form-label">Nehézség:</label>
                <input type="text" id="nehezseg" class="form-control" v-model="ujTura.nehezseg">
            </div>

            <div>
                <label for="becsultIdoPerc" class="form-label
">Becsült idő (perc):</label>
                <input type="number" id="becsultIdoPerc" class="form-control" v-model="ujTura.becsultIdoPerc">
            </div>

            <div>
                <label for="helyszin" class="form-label">Helyszín:</label>
                <input type="text" id="helyszin" class="form-control" v-model="ujTura.helyszin">

            </div>

            <div>
                <label for="kategoriaId" class="form-label">Kategória:</label>
                <select id="kategoriaId" class="form-select" v-model="ujTura.kategoriaId">
                    <option value="0" selected>-- Válassz kategóriát --</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.ikon }} {{ category.nev }}
                    </option>
                </select>
            </div>

            <div>
                <label for="kutyaBarat" class="form-label">Kutya barát:</label>
                <input type="checkbox" id="kutyaBarat" class="form-check-input" v-model="ujTura.kutyaBarat">
            </div>

            <div>
                <label for="leiras" class="form-label">Leírás:</label>
                <textarea id="leiras" class="form-control" v-model="ujTura.leiras"></textarea>
            </div>
            

            <button type="submit" class="btn btn-primary">Hozzáadás</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import router from '@/router';

axios.defaults.baseURL = 'http://localhost:5000/api/';

export default {
    data() {
        return {
            categories: [],
            ujTura: {
                nev: '',
                tavolsagKm: 0,
                nehezseg: '',
                becsultIdoPerc: 0,
                helyszin: '',
                kategoriaId: 0,
                kutyaBarát: false,
                leiras: ''

            }
        };
    },
    mounted() {
            axios.get('Kategoriak')
            .then(response => {
                this.categories = response.data;
            })
            .catch(error => {
                console.error('Hiba a kategóriák lekérésekor:', error);
            });
    },
    methods: {
        hozzaadTura() {
            axios.post('Turak', this.ujTura)
                .then(response => {
                    alert('Túra sikeresen hozzáadva!');
                    router.push({ name: 'Category' });
                })
                .catch(error => {
                    console.error('Hiba a túra hozzáadásakor:', error);
                });
        }
    }
}
</script>
