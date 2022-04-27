<template>
  <div>
    <head>
      <link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.15.0/maps/maps.css" type="text/css">
    </head>
      <div class="container">
        <h1>{{apartment.title}}</h1>
        <div>
          <img :src="apartment.photo">
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
        zoom: 12
    })
    map.on('load', () => {
        new tt.Marker().setLngLat(center).addTo(map)
    })
  }
}
</script>

<style>

</style>