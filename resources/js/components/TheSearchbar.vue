<template>
    <!-- address section -->
    <div class="container-fluid py-3">
        <div class="container">
            <!-- <div class="mb-3">
                <input autocomplete=off @keyup="getAddress" v-model="searchedText" id="address_input" placeholder="Via Roma 1, 20099 " type="text" value="" name="address" class="form-control mb-3" required>
                <button class="btn btn-primary" @click="$emit('search',searchedText)">submit</button>
                <div id="suggestedAddresses">
                    <div v-for="(result,i) in results" :key="i">
                        <span @click="setAddress(i)">
                            {{ result.address.freeformAddress }}
                        </span>
                    </div>
                </div>
            </div> -->

            <!-- NEW SEARCH -->
            <div class="searchbar">
                <span>

                    <!-- Place -->
                    <div class="form-section d-flex flex-column" id="place-input-wrapper">
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

                    <!-- Check in date -->
                    <div class="form-section date-range-wrapper">
                        <label for="date" class="px-3 border-start">
                            <div>
                                Check-in
                                <br />
                                <span v-if="checkInDate" class="text-secondary">{{ checkInDate }}</span>
                                <span v-else class="text-secondary">Aggiungi date</span>
                            </div>
                            <input class="date-input" type="date" id="date" @change="saveCheckInDate">
                        </label>
                    </div>

                    <!-- Check out date -->
                    <div class="form-section date-range-wrapper">
                        <label for="date" class="px-3 border-start border-end">
                            <div>
                                Check-out
                                <br />
                                <span v-if="checkOutDate" class="text-secondary">{{ checkOutDate }}</span>
                                <span v-else class="text-secondary">Aggiungi date</span>
                            </div>
                            <input class="date-input" type="date" id="date" @change="saveCheckOutDate">
                        </label>
                    </div>

                    <!-- Guest -->
                    <div class="form-section d-flex justify-content-between" id="guest-input-wrapper">
                        <label for="guest" class="ps-3">
                            Ospiti
                            <br />
                            <span class="text-secondary">Aggiungi ospiti</span>
                        </label>
                        <!-- Submit button -->
                        <button class="button" @click="$emit('search',searchedText)"><i class="fas fa-search"></i></button>
                    </div>

                </span>
            </div>
            
            <div id="suggestedAddresses" class="bg-light">
                <div v-for="(result,i) in results" :key="i">
                    <span @click="setAddress(i)">
                        {{ result.address.freeformAddress }}
                    </span>
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
        },

        saveCheckInDate(e) {
            // console.log(e.target.value);
            this.checkInDate = e.target.value;
        },
        saveCheckOutDate(e) {
            // console.log(e.target.value);
            this.checkOutDate = e.target.value;
        }
    
    }
} 
</script>

<style lang="scss" scoped>
    .container-fluid{
        background: #000;
    }
    .searchbar {
        background: #fff;
        margin: 0 auto;
        width: 100%;
        padding: 15px 20px;
        border-radius: 40px;
    >span {
        display: flex;
        align-items: center;
        .form-section {
            label {
                width: 100%;
                font-weight: bold;
                font-size: 12px;
                position: relative;
                span {
                    font-weight: 400;
                    font-size: 14px;
                }
                .date-input{
                    &:focus-visible{
                        outline: 0;
                    }
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    background: none;
                    border: none;
                }
                ::-webkit-calendar-picker-indicator {
                    width: 100%;
                    height: 100%;
                    background: transparent;
                }
            }
            .button {
                position: absolute;
                right: 0;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: #ff5a5f;
                color: #fff;
            }
        }
        #place-input-wrapper {
            width: calc(100% / 4 + 4%);
            input {
                border: none;
            }
        }
        .date-range-wrapper {
            width: calc(100% / 4 - 4%);
        }
        #guest-input-wrapper {
            width: calc(100% / 4 + 4%);
            position: relative;
        }
    }
    #place-input{
        font-size: 14px;
    }
}
</style>


