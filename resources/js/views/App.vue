<template>
    <div>
        <the-navbar></the-navbar>
        <the-searchbar @search=searchApartments></the-searchbar> 
        <advanced-research :apartments="apartments"></advanced-research>
    </div>
</template>

<script>
import TheNavbar from '../components/TheNavbar.vue'
import TheSearchbar from '../components/TheSearchbar.vue'
import AdvancedResearch from '../pages/AdvancedResearch.vue'

export default {
  components: { TheNavbar,TheSearchbar,AdvancedResearch},
  data(){
    return{
      pagination: {},
      apartments: [],
      searchedText: '',
    }
  },
  methods: {
    async fetchApartments(page=1,searchedText=null){
       
        if(page < 1 ){
            page = 1;
        }
        if(page > this.pagination.last_page){
            page = this.pagination.last_page;
        }

        try{
            const resp = await axios.get('/api/apartments',{
                params: {
                    page,
                    filter: searchedText
                }
            })
            
            this.pagination = resp.data;
            this.apartments = resp.data.data;
            console.log(this.apartments);
        }catch(e){
            console.log('error in axios call' + e.message);
        }
    },
    searchApartments(text){
        this.searchedText = text;
        this.fetchApartments(1,this.searchedText);

    }
  }
}
</script>

<style lang="scss" scoped>

</style>