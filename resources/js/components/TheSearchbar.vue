<template>
     <!-- address section -->
     <div>
           <form action="">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Apartment Address</label>
        
                    <input @keyup="getAddress" v-model="searchedText" id="address_input" placeholder="Via Roma 1, 20099 " type="text" value="" name="address" class="form-control" required>
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
            </form>
     </div>
   
        
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return{
            searchedText: '',
            results: [],
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
    }
 }
} 
</script>

<style lang="scss" scoped>

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


