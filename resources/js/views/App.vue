<template>
    <div>
        <the-navbar></the-navbar>
       
        <the-searchbar @search=searchApartments></the-searchbar> 
        <!-- <advanced-search :apartments="apartments"></advanced-search> -->
         <main>
            <router-view :apartments="apartments" @filteredApartments=fetchFilterApartments></router-view>
        </main>
    </div>
</template>

<script>
import TheNavbar from '../components/TheNavbar.vue'
import TheSearchbar from '../components/TheSearchbar.vue'
import AdvancedSearch from '../pages/AdvancedSearch.vue'
export default {
  components: { TheNavbar,TheSearchbar,AdvancedSearch},
  data(){
    return{
    //   pagination: {},
      apartments: [],
      searchedText: '',
     
    }
  },
  methods: {
    async fetchApartments(searchedText=null){
       
        // if(page < 1 ){
        //     page = 1;
        // }
        // if(page > this.pagination.last_page){
        //     page = this.pagination.last_page;
        // }

        try{
            const resp = await axios.get('/api/apartments',{
                params: {
                    // page,
                    filter: searchedText
                }
            })
            
            // this.pagination = resp.data;
            console.log(resp);
            this.apartments = resp.data;
            // console.log(this.apartments);
            if(this.$route.name !== 'advancedSearch') {
                this.$router.replace({path: '/advancedSearch'});
            }
        }catch(e){
            console.log('error in axios call' + e.message);
        }
    },
    async fetchFilterApartments(roomsNumber){
        try{
            const resp = await axios.get('/api/apartments',{
                params: {
                    roomsNumber: roomsNumber,
                    filter: this.searchedText,
                    // bedsNumber: this.bedsNumber,
                    // checkedService: this.checkedService,
                }
                    
            });
        
            this.apartments = resp.data;
                
        }catch(e){
            console.log('error in call api' + e.message);
        }
    },
    searchApartments(text){
        this.searchedText = text;
        this.fetchApartments(this.searchedText);
    },
  }
}
</script>

<style lang="scss" scoped>

</style>