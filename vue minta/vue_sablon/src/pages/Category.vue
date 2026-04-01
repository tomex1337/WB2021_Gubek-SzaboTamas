<template>
    <div class="container">
        <h1 class="text-center">Túrák listája kategóriára szűrve</h1>
        <p>Get kérés küldése a <code>api/Kategoriak/{id}</code> Végpontra.</p>

        <label for="category">Túra Katalizátor: </label>
        <select id="category" v-model="selectedCategory" @change="lekerdezTuraKategoria">
            <option value="0" selected>-- Válassz kategóriát --</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.ikon }} {{ category.nev }}
            </option>
        </select>

        <table v-if="turak.length > 0" class="table table-striped mt-3">
            <tr>
                <th>ID</th>
                <th>Név</th>
                <th>Távolság</th>
                <th>Nehézség</th>
                <th>Idő</th>
                <th>Helyszín</th>
                <th>Műveletek</th>
            </tr>
            <tr v-for="tura in turak" :key="tura.id">
                <td>{{ tura.id }}</td>
                <td>{{ tura.nev }}</td>
                <td>{{ tura.tavolsagKm }}</td>
                <td>{{ tura.nehezseg }}</td>
                <td>{{ tura.becsultIdoPerc }}</td>
                <td>{{ tura.helyszin }}</td>
                <td>
                    <button class="btn btn-primary" @click="modositTura(tura.id)">Módósít</button>
                    <button class="btn btn-danger" @click="torolTura(tura.id)">Töröl</button>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
import router from '../router';

axios.defaults.baseURL = 'http://localhost:5000/api/';

export default {
    data() {
        return {
            categories: [],
            selectedCategory: 0,
            turak: []
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
        lekerdezTuraKategoria() {
            axios.get(`Kategoriak/${this.selectedCategory}`)
                .then(response => {
                    this.turak = response.data.turak;
                })
                .catch(error => {
                    console.error('Hiba a túrák lekérésekor:', error);
                });
        },
        modositTura(turaId) {
            router.push({ name: 'Update', params: { id: turaId } });
        },
        torolTura(turaId) {
            if(confirm('Biztosan törölni szeretnéd ezt a túrát?')) {
                axios.delete(`Turak/${turaId}`)
                    .then(response => {
                        alert('Túra sikeresen törölve!');
                        this.lekerdezTuraKategoria(); // Frissítjük a listát a törlés után
                    })
                    .catch(error => {
                        console.error('Hiba a túra törlésekor:', error);
                    });
        }
    }
}
}
</script>

<style>

</style>