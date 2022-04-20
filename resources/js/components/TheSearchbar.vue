<template>
     <!-- address section -->
     <div class="container mt-3">
           
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Apartment Address</label>
        
                    <input autocomplete=off @keyup="getAddress" v-model="searchedText" id="address_input" placeholder="Via Roma 1, 20099 " type="text" value="" name="address" class="form-control mb-3" required>
                    <button class="btn btn-primary" @click="searchApartments()">submit</button>
                    <div id="suggestedAddresses">
                        <div v-for="(result,i) in results" :key="i">
                            <span @click="setAddress(i)">
                                {{
                                    result.address.freeformAddress
                                }}
                            </span>
                            
                        </div>
                    </div>
                  
                </div>
                    
                <div v-for="apartment in apartments" :key="apartment.id">
                    {{apartment.title}}
                </div>
            
     </div>
   
        
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return{
            searchedText: '',
            results: [],
            pagination: {},
            apartments: [],
        }
    },
    methods: {
        getAddress(){
            if(this.searchedText !== ''){
                delete axios.defaults.headers.common['X-Requested-With']; 
                 // Axios call to TomTom
                    axios.get('https://api.tomtom.com/search/2/search/.json?key=Cy3GhUqiHtCcdMfQksEJ5XAPmz6EeBsV&query=' + this.searchedText + ' Milano' + '&countrySet=IT')
                    .then(res=>{
                        this.results = res.data.results;
                       
                    })
        }else{
            this.results = [];
        }
    },
    setAddress(i){
        this.searchedText = this.results[i].address.freeformAddress;
        this.results = [];
    },
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
    searchApartments(){
       
        this.fetchApartments(1,this.searchedText);

    }

 }
} 
</script>

<style lang="scss" scoped>
    .container{
        width: 60%;
    }
</style>

 
//   const address = document.getElementById('address_input');
//   const suggestedAddresses = document.getElementById('suggestedAddresses');

//   console.log(address);
 
//   // Input listner
//   address.addEventListener('keypress',function(e){
//     // Reset
//     suggestedAddresses.innerHTML = '';
//     // Define the input value variable
//     const searchedAddress = e.target.value.toLowerCase();

//     if(searchedAddress !== ''){
//         delete axios.defaults.headers.common['X-Requested-With']; 
//         // Axios call to TomTom
//         axios.get('https://api.tomtom.com/search/2/search/.json?key=Cy3GhUqiHtCcdMfQksEJ5XAPmz6EeBsV&query=' + searchedAddress + ' Milano' + '&countrySet=IT')
//         .then(res=>{
//           const results = res.data.results;
//           results.forEach((element,i) => {
//             // Create in DOM the suggestedAddress element
//             const suggestedAddress = document.createElement('div');
//             suggestedAddress.innerHTML += `${element.address.freeformAddress}`;
//             // Append the suggestedAddress element in suggestedAddresses container
//             suggestedAddresses.append(suggestedAddress);
//             // Add click listener on each suggestedAddress element
//             suggestedAddress.addEventListener('click',function(){
//               address.value = this.textContent;
            
//               // Reset
//               suggestedAddresses.innerHTML = '';
//             })
//           });
//         })
//   }
//   })


