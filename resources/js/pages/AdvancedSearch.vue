<template>
    <div>
      <div v-for="apartment in apartments" :key="apartment.id">
          <the-card :apartment="apartment"></the-card>
      </div>

     
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
                            <input type="number" class="form-control" v-model="roomsNumber">
                        </div>
                        <div class="form-check  mb-3">
                            <label class="form-label">Min. beds number</label>
                            <input type="number" class="form-control" v-model="bedsNumber">
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
                        <button @click="fetchFilterApartments" type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Filter</button>
                    </div>
                </div>
            </div>
        </div>
    
   
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
            roomsNumber ,
            bedsNumber ,
            
        }
    },
    methods:{
        async fetchAdditionalServices(){
            try{
                const resp = await axios.get('/api/additionalServices');
                this.additionalServices = resp.data;
                console.log(this.additionalServices);
            
            }catch(e){
                error.log(e.message)
            }
        },
             async fetchFilterApartments(){
            try{
                const resp = axios.get('/api/apartments',{
                    params: {
                        roomsNumber: this.roomsNumber,
                        bedsNumber: this.bedsNumber,
                        checkedService: this.checkedService,

                    }
                    
                });
                console.log(resp);
            }catch(e){
                console.log('error in call api' + e.message);
            }
        }
  
   
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