<template>
  <div class="container">
      <div v-for="apartment in apartments" :key="apartment.id">
          {{apartment.title}}
      </div>

     

       <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Filter</button>

       <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add filter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-check mb-3">
                            <label class="form-label">Rooms number</label>
                            <input type="number" class="form-control">
                        </div>
                        <div class="form-check  mb-3">
                            <label class="form-label">beds number</label>
                            <input type="number" class="form-control">
                        </div>
                        <div class="mb-3 form-check">
                            <label class="mb-2">Additional services</label><br>
                            <div class="form-check form-check-inline" v-for="service in additionalServices" :key="service.id">      
                                <input type="checkbox" class="form-check-input">
                                <label class="form-label">{{service.name}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
            
       

  </div>
</template>

<script>
export default {
    props: {
         apartments: Array,
    },
    data(){
        return{
            additionalServices: [],
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
    },
    mounted(){
      this.fetchAdditionalServices();
    }
}
</script>

<style lang="scss" scoped>
    .container{
        width: 50%;
    }
</style>