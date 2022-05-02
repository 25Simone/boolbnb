<template>
    <div>
        <the-navbar></the-navbar>
       
        <the-searchbar @search=searchApartments @selection=getAddressSelected></the-searchbar> 
        <!-- <advanced-search :apartments="apartments"></advanced-search> -->
         <main>
            <div v-if="addressErrorModal" id="addressErrorModal">
                <div class="alert alert-danger container m-0 mx-auto" role="alert">
                    Seleziona un indirizzo valido
                </div>
            </div>
            <router-view :apartments="apartments" @filteredApartments=fetchFilterApartments></router-view>
        </main>
        <the-footer></the-footer>
    </div>
</template>

<script>
import axios from 'axios';
import TheFooter from '../components/TheFooter.vue'
import TheNavbar from '../components/TheNavbar.vue'
import TheSearchbar from '../components/TheSearchbar.vue'
import Home from '../pages/Home.vue'
import AdvancedSearch from '../pages/AdvancedSearch.vue'
import ShowApartment from '../pages/ShowApartment.vue'
export default {
  components: { TheNavbar,TheSearchbar,AdvancedSearch,ShowApartment, TheFooter, Home},
  data(){
    return{
    //   pagination: {},
      apartments: [],
      searchedText: '',
      addressSelected: false,
      addressErrorModal: false
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
            this.apartments = resp.data;
            const storedSearch = localStorage.setItem("apartmentsSearch",this.searchedText);
            // console.log(this.apartments);
            if(this.$route.name !== 'advancedSearch') {
                this.$router.push({path: '/advancedSearch'});
            }
        }catch(e){
            console.log('error in axios call' + e.message);
        }
    },
    async fetchFilterApartments(roomsNumber,bedsNumber,radius,checkedService){
        try{
            const resp = await axios.get('/api/apartments',{
                params: {
                    roomsNumber: roomsNumber,
                    filter: this.searchedText,
                    bedsNumber: bedsNumber,
                    radius: radius,
                    checkedService: checkedService,
                    
                }
                    
            });
        
            this.apartments = resp.data;
                
        }catch(e){
            console.log('error in call api' + e.message);
        }
    },
    searchApartments(text){
        if(this.addressSelected) {
            this.searchedText = text;
            this.fetchApartments(this.searchedText);
        } else {
            this.addressErrorModal = true;
            console.error('indirizzo non esatto')
        }
    },
    checkApartments(){
        let storedText = localStorage.getItem("apartmentsSearch");
        if(storedText){
            // this.fetchApartments(storedText);
            this.searchedText = storedText;
            this.fetchApartments(this.searchedText);
        }
    },
    getAddressSelected(boolean) {
        this.addressSelected = boolean;
        this.addressErrorModal = false
    }
  },
  mounted(){
   
          if(this.$route.name === 'advancedSearch') {
               if(!this.searchedText){
                     this.checkApartments();
               }
          }
 },
}
</script>

<style lang="scss" scoped>
main {
    #addressErrorModal {
        background: black;
    }
}
</style>