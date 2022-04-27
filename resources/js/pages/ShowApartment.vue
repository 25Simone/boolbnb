<template>
  <div>
    <head>
      <link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.15.0/maps/maps.css" type="text/css">
    </head>
      <div class="container">
        <div class="img-container mt-5">
          <img :src="apartment.photo" class="img-show">
        </div>  
        <div class="d-flex">
         
          <div class="details">
             <h1 class="mt-3">{{apartment.title}}</h1>
             <div>
               <span></span>
             </div>
          </div>
          <div class="contact-form">
           
              <div class="mb-3">
                <label class="form-label">Name *</label>
                <input v-model="formData.name" type="text" placeholder="Insert your name" name="name" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Lastname *</label>
                <input v-model="formData.lastname" type="text" placeholder="Insert your lastname" name="lastname" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Email *</label>
                <input v-model="formData.email" type="email" placeholder="Insert your email" name="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Message *</label>
                <textarea v-model="formData.message" name="message" class="form-control" required></textarea>
              </div>
              <button @click="submitForm" class="btn btn-danger">Submit</button>
          
          </div>
        </div>
        <div id="map" style="width: 40vw; height: 350px"></div>
      </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data(){
    return{
      apartment: {},
      formData: {
        name:'',
        lastname: '',
        email: '',
        message: '',
      }
    }
  },
  methods:{
    async fetchApartments(){
      try{
        const resp = await axios.get('/api/apartments/' + this.$route.params.apartment);
        this.apartment = resp.data;
      }catch(e){
        console.log('error in call api ' + e.message);
      }
    },
    async submitForm(){
      try{
        const formDataInstance = new FormData();
        formDataInstance.append("name",this.formData.name);
        formDataInstance.append("lastname",this.formData.lastname);
        formDataInstance.append("email",this.formData.email);
        formDataInstance.append("message",this.formData.message);
        formDataInstance.append("apartment_id",this.apartment.id);
        const resp = await axios.post('/api/contacts',formDataInstance);
      }catch(e){
        console.log('error in call api' + e.message);
      }
    }
  },

  mounted(){
    this.fetchApartments();
    console.log(this.apartment.photo);
    let tomtomScript = document.createElement('script')
    tomtomScript.setAttribute('src', 'https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.15.0/maps/maps-web.min.js')
    document.head.appendChild(tomtomScript);
  },
  updated(){
      let center = [ this.apartment.longitude , this.apartment.latitude]
      const map = tt.map({
        key: "hjLTHv68YTVsWXnlRPRvPwUUjOQSCt7n",
        container: "map",
        center: center,
        zoom: 17
    })
    map.on('load', () => {
        new tt.Marker().setLngLat(center).addTo(map)
    })
  }
}
</script>

<style lang="scss" scoped>

  .img-container{
    height: 45vh;

    .img-show{
      border-radius: 10px;
      width: 100%;
      height: 100%;
      object-fit: cover;
  }
  }

  .details{
    width: 70%;
  }

  .contact-form{
    width: 30%;
  }
  
</style>