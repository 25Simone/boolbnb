<template>
    <!-- address section -->
    <div class="py-3" :class="$route.name === 'home' ? 'bg-dark' : ''">
        <div class="container">
            <!-- NEW SEARCH -->
            <div class="searchbar shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Place -->
                    <div class="col form-section d-flex flex-column" id="place-input-wrapper">
                        <label for="place-input">Dove</label>
                        <input
                        autocomplete=off
                        id="place-input"
                        type="text"
                        placeholder="Dove vuoi andare?"
                        @keyup="getAddress"
                        v-model="searchedText"
                        name="address"
                        >
                    </div>
                    <!-- Submit button -->
                    <button class="button shadow" @click="$emit('search',searchedText)"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <div id="suggestedAddresses-wrapper" class="container">
                <div id="suggestedAddresses" class="bg-light">
                    <div v-for="(result,i) in results" :key="i" @click="setAddress(i); $emit('selection',addressSelected)">
                        <span>
                            {{ result.address.freeformAddress }}
                        </span>
                    </div>
                </div>
            </div>
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
            checkInDate: "",
            checkOutDate: "", 
            addressSelected: false,
        }
    },
    methods: {
        getAddress(){
            if(this.searchedText !== ''){
                delete axios.defaults.headers.common['X-Requested-With']; 
                 // Axios call to TomTom
                    axios.get('https://api.tomtom.com/search/2/search/.json?key=Cy3GhUqiHtCcdMfQksEJ5XAPmz6EeBsV&query=' + this.searchedText + '&countrySet=IT')
                    .then(res=>{
                        this.results = res.data.results.filter(element => {
                            return element.address.countrySecondarySubdivision === 'Milano';
                        });
                        // this.results = res.data.results;
                    })
            }else{
                this.results = [];
            }
        },

        setAddress(i){
            this.searchedText = this.results[i].address.freeformAddress;
            this.results = [];
            this.addressSelected = true;
        },
    }
} 
</script>

<style lang="scss" scoped>
#suggestedAddresses-wrapper {
    margin: 0 auto;
    width: 70%;
    #suggestedAddresses{
        width: 40%;
        position: absolute;
        z-index:2;
    }
}
.bg-dark{
    background: #000 !important;
}
.container {
    position: relative;
}
.searchbar {
    background: #fff;
    margin: 0 auto;
    width: 70%;
    padding: 15px 20px;
    border-radius: 40px;
    >div {
        .form-section {
            label {
                width: 100%;
                font-weight: bold;
                font-size: 16px;
            }
        }
        .button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #f8393f;
            background: #ff5a5f;
            color: #fff;
        }
        #place-input-wrapper {
            input {
                width: 100%;
                border: none;
                font-size: 17px;
                &:focus-visible {
                    outline: none;
                }
            }
        }
    }
}
</style>


