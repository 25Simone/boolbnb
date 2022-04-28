<template>
    <div class="py-4">
        <!-- Filter button -->
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Filter</button>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add filter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-check mb-3">
                            <label class="form-label">Min. Rooms number</label>
                            <input type="number" class="form-control" min="0" v-model="roomsNumber">
                        </div>
                        <div class="form-check  mb-3">
                            <label class="form-label">Min. beds number</label>
                            <input type="number" class="form-control" min="0" v-model="bedsNumber">
                        </div>
                        <div class="form-check mb-3">
                            <label class="form-label">Radius</label>
                            <input name="radius" type="range" class="form-range" min="0" max="40" step="5" v-model="radius">
                            <span>{{radius}}km</span>
                        </div>
                        <div class="mb-3 form-check">
                            <label class="mb-2">Additional services</label><br>
                            <div class="form-check form-check-inline" v-for="service in additionalServices" :key="service.id">      
                                <input type="checkbox" class="form-check-input" :value="service.id" v-model="checkedService">
                                <label class="form-label">{{service.name}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="$emit('filteredApartments',roomsNumber,bedsNumber,radius,checkedService)" type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Filter</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results -->
        <div v-if="apartments.length >= 1">
            <div v-for="apartment in apartments" :key="apartment.id">
                <the-card :apartment="apartment"></the-card>
            </div>
        </div>
        <h2 class="py-5 text-center" v-else>Nessuno appartamento corrispondente alla tua ricerca</h2>

     
    
   
  </div>
</template>

<script>
import TheCard from '../components/TheCard.vue';
export default {
  components: { TheCard },
    props: {
         apartments: Array,
    },
    data(){
        return{
            additionalServices: [],
            checkedService: [],
            roomsNumber: null,
            bedsNumber: null,
            radius: null
            
        }
    },
    methods:{
        async fetchAdditionalServices(){
            try{
                const resp = await axios.get('/api/additionalServices');
                this.additionalServices = resp.data;
               
            
            }catch(e){
                error.log(e.message)
            }
        },

   
  
   
    },
    mounted(){
      this.fetchAdditionalServices();
    },
}
</script>

<style lang="scss" scoped>
    .container{
        width: 50%;
    }
</style>