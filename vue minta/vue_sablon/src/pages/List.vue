<template>
    <div class="container">
        <h1 class="text-center">Turák</h1>
        <p>GET kérés az a <code>api/turak</code> végpontra</p>

        <table>
            <tr>
                <th>ID</th>
                <th>Név</th>
                <th>Kategória</th>
                <th>Távolság</th>
                <th>Nehézség</th>
                <th>Szint</th>
                <th>Idő</th>
                <th>Helyszín</th>
                <th>Leírás</th>
                <th>Kutyabarát</th>
            </tr>
            <tr v-for="tura in turak" :key="tura.id">
                <td>{{ tura.id }}</td>
                <td>{{ tura.nev }}</td>
                <td>{{ tura.kategoria.ikon }}{{ tura.kategoria.nev }}</td>
                <td>{{ tura.tavolsagKm }}</td>
                <td>{{ tura.nehezseg }}</td>
                <td>{{ tura.szintkulonbsegM }}</td>
                <td>{{ tura.becsultIdoPerc }}</td>
                <td>{{ tura.helyszin }}</td>
                <td>{{ tura.leiras }}</td>
                <td class="text-center" :class="tura.kutyaBarát ? 'zold' : 'piros'">{{ tura.kutyaBarát ? 'Igen' : 'Nem' }}</td>

            </tr>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:5000/api/';

export default {
    data() {
        return {
            turak: []
        };
    },
    mounted() {
        axios.get('turak')
            .then(response => {
                this.turak = response.data;
            })
            .catch(error => {
                console.error('Hiba a turák lekérésekor:', error);
            });
    },
}
</script>

<style>
table th, table td{
    border: 1px solid #ddd;
    padding: 8px;
}

th{
    text-align: center;
}

.zold{
    color: green;
}

.piros{
    color: red;
}
</style>