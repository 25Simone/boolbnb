<template>
  <div>
    <head>
      <link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.15.0/maps/maps.css" type="text/css">
    </head>
      <div class="container">
        <div class="img-container mt-5">
          <img :src="apartment.photo" class="img-show">
        </div>  
        <div class="row">
          <!-- Apartment details -->
          <div class="details px-4 col-12 col-md-8">
             <h1 class="mt-3">{{apartment.title}}</h1>
             <div>
               <h5>Host: {{apartment.user.name}}</h5>
             </div>
             <div class="apartment-details mt-2">
               <div class="mt-4">
                 <span>
                   <i class="fas fa-user"></i> 
                   {{apartment.guests}} ospiti
                 </span>
               </div>
                <div class="mt-3">
                  <span>
                    <i class="fas fa-home"></i>
                    {{apartment.rooms_number}} stanze
                  </span>
               </div>
               <div class="mt-3">
                 <span>
                   <i class="fas fa-bed"></i>
                   {{apartment.beds_number}} posti letto
                 </span>
               </div>
                <div class="mt-3">
                 <span>
                   <i class="fas fa-bath"></i>
                   {{apartment.baths_number}} bagni
                 </span>
               </div>
               <hr>
               <h3>Servizi aggiuntivi</h3>
               <!-- sezione servizi aggiuntivi -->
               <div class="mt-1 services-section d-flex">
                 <div class="services-left">
                   <span>ciao</span>
                   <span>bella</span>
                 </div>
                 <div class="services-right">bella</div>
               </div>
             </div>
          </div>
          <!-- Contact form -->
          <div class="contact-form card p-3 mt-4 col-12 col-md-4">
            <div class="mb-3">
              <label class="form-label">Name *</label>
              <input v-model="formData.name" type="text" placeholder="Insert your name" name="name" class="form-control" required>
              <span class="text-danger" v-if="formValidationErrors && formValidationErrors.name"> {{formValidationErrors.name}} </span>
            </div>
            <div class="mb-3">
              <label class="form-label">Lastname *</label>
              <input v-model="formData.lastname" type="text" placeholder="Insert your lastname" name="lastname" class="form-control" required>
              <span class="text-danger" v-if="formValidationErrors && formValidationErrors.lastname"> {{formValidationErrors.lastname}} </span>
            </div>
            <div class="mb-3">
              <label class="form-label">Email *</label>
              <input v-model="formData.email" type="email" placeholder="Insert your email" name="email" class="form-control" required>
              <span class="text-danger" v-if="formValidationErrors && formValidationErrors.email"> {{formValidationErrors.email}} </span>
            </div>
            <div class="mb-3">
              <label class="form-label">Message *</label>
              <textarea v-model="formData.message" name="message" class="form-control" required></textarea>
              <span class="text-danger" v-if="formValidationErrors && formValidationErrors.message"> {{formValidationErrors.message}} </span>
            </div>
            <button @click="submitForm" class="btn">Submit</button>

            <!-- Alert sending successfully -->
            <div v-if="contactSubmitted" class="alert alert-success my-4 py-5">
              <h5>Grazie per averci contattato!</h5>
              <p class="lead">Il suo messaggio è stato inviato correttamente, risponderemo il prima possibile.</p>
            </div>
          </div>
        </div>
        <h3 class="px-3 mt-3 fw-bold">Dove ti troverai</h3>
        <h5 class="px-3">{{apartment.address}}</h5>

        <!-- map container-->
        <div id="map" style="width: 100%; height: 45vh" class="mb-5"></div>
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
      },
      showedMap: false,
      contactSubmitted: false,
      formSubmittedError: false,
      errorMessage: null,
      formValidationErrors: null,
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
        // Reset formValidationErrors
        this.formValidationErrors = null;

        // Create an instance of FormData class
        const formDataInstance = new FormData();
        // Pass manually the keys and the values to the instance
        formDataInstance.append("name",this.formData.name);
        formDataInstance.append("lastname",this.formData.lastname);
        formDataInstance.append("email",this.formData.email);
        formDataInstance.append("message",this.formData.message);
        formDataInstance.append("apartment_id",this.apartment.id);

        // Axios post call
        const resp = await axios.post('/api/contacts',formDataInstance);

        // Alert show
        this.contactSubmitted = true;
        this.formSubmittedError = false;
      }catch(e){
        this.errorMessage = e.response.data.message;
        this.formSubmittedError = true;
        if (e.response.status === 422) {
          this.formValidationErrors = e.response.data.errors;
        }
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
    if(!this.showedMap) {
      let center = [ this.apartment.longitude , this.apartment.latitude]
      const map = tt.map({
        key: "hjLTHv68YTVsWXnlRPRvPwUUjOQSCt7n",
        container: "map",
        center: center,
        zoom: 18
      })
      map.on('load', () => {
          new tt.Marker().setLngLat(center).addTo(map)
      })
      this.showedMap = true;
    }
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

  // .details{
  //   width: 70%;
  // }

  .contact-form{
    // width: 30%;
    .btn {
      background: #ff385c;
    }
  }

  .apartment-details{
    border-top: 1px solid lightgrey;
  }
  
  .services-section{
    .services-left{
      width: 50%;
      display: flex;
      flex-direction: column;
    }
    .services-right{
      width: 50%;
       display: flex;
      flex-direction: column;
    }
  }
</style>