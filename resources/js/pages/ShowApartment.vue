<template>
  <div>
    <head>
      <link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.15.0/maps/maps.css" type="text/css">
    </head>
      <div class="container">
        <div class="img-container mt-4">
          <img :src="apartment.photo" class="img-show">
        </div>  
        <div class="row">
         
          <div class="details mx-4 col-11 col-md-7 mt-3">
             <h1 class="fw-bold">{{apartment.title}}</h1>
             <div>
               <h5>Host: {{apartment.user.name}}</h5>
               <hr>
             </div>
             <div class="apartment-details mt-2">
               <div class="mt-4">
                 <span>
                   <i class="fas fa-user"></i> 
                   {{apartment.guests}} Ospiti
                 </span>
               </div>
                <div class="mt-3">
                  <span>
                    <i class="fas fa-home"></i>
                    {{apartment.rooms_number}} Stanze
                  </span>
               </div>
               <div class="mt-3">
                 <span>
                   <i class="fas fa-bed"></i>
                   {{apartment.beds_number}} Posti letto
                 </span>
               </div>
                <div class="mt-3">
                 <span>
                   <i class="fas fa-bath"></i>
                   {{apartment.baths_number}} Bagni
                 </span>
               </div>
               <div class="mt-3">
                 <span>
                   <i class="fas fa-th"></i>
                   {{apartment.squaremeters}} Mq.
                 </span>
               </div>
               <hr>
               <h4 class="mb-3 additional-services">Servizi aggiuntivi</h4>
               <!-- sezione servizi aggiuntivi -->
               <div class="mt-1 services-section row">
                 <div class="services-left col-12 col-md-6">
                   <div v-for="service in apartment.additional_services" :key="service.id">
                     <i class="fas fa-check check"></i>
                     {{service.name}}
                   </div>
            
                 </div>
                 
               </div>
             </div>
          </div>

          <button class="btn message-button" @click="sendMessage">Invia un messaggio all'host</button>
          <div class="contact-form card p-3 mt-5 col-9 col-md-4" id="contact-form">
           
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
        <h3 class="px-3 fw-bold where">Dove ti troverai</h3>
        <h6 class="px-3">{{apartment.address}}</h6>

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
    },
    sendMessage(){
      const form = document.getElementById('contact-form');
      if(form.style.display === 'none'){
        form.style.display = "block";
      }else{
        form.style.display = "none";
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

.additional-services{
  font-weight: bold;
}

h5{
  color: grey;
}

  .img-container{
    height: 45vh;

    .img-show{
      border-radius: 10px;
      width: 100%;
      height: 100%;
      object-fit: cover;
  }
  }

  .contact-form{
   box-shadow: 0px 0px 5px 2px rgba(123,112,112,0.75);
-webkit-box-shadow: 0px 0px 5px 2px rgba(123,112,112,0.75);
-moz-box-shadow: 0px 0px 5px 2px rgba(123,112,112,0.75);
border-radius: 30px;
    .btn {
      background: #ff385c;
    }
  }
  
  .services-section{
    .services-left{
      width: 100%;
      max-height: 200px;
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
    }

  }

  i{
    color:#ff385c;
  }

  .check{
    color: rgb(60, 202, 39);
    margin-right: 10px;
  }

  .where{
    margin-top: 90px;
  }

  .message-button{
    display: none;
  }

//media query
  @media screen and (max-width: 767px){
    .contact-form{
      margin: 0 auto;
      display: none;
    }
  .where{
    margin-top: 60px;
  }
  .message-button{
    background-color: #ff385c;
    color: white;
    font-weight: bold;
    display: block;
    width: 90%;
    margin: 0 auto;
    margin-top: 40px;
  }

  }
</style>