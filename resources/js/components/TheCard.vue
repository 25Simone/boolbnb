<template>
    <div class="px-4 card-container">
        <div class="container-fluid py-3 border-top">
            <div class="row container-row">
                <div class="image-container col-2">
                    <img :src="apartment.photo" :alt="apartment.title + 'image'">
                </div>
                <div class="d-flex align-items-center justify-content-between px-5 col-10 card-data">
                    <div class="ad-content">
                        <h2>{{ apartment.title }}</h2>
                        <div> <i class="fas fa-map-marker-alt my-3"></i> {{ apartment.address }} </div>
                        <div>
                            <span class="me-3"> <i class="fas fa-home"></i> {{ apartment.rooms_number }} rooms </span>
                            <span class="me-3"> <i class="fas fa-bed"></i> {{ apartment.beds_number }} beds </span>
                            <span class="me-3"> <i class="fas fa-bath"></i> {{ apartment.baths_number }} baths </span>
                        </div>
                    </div>
                    <div class="service-section">
                        <h5 class="pt-3 pb-2">Additional Services</h5>
                        <!-- <ul>
                            <li
                            class="mx-2"
                            v-for="(service, i) in apartment.additional_services"
                            :key="i"
                            >
                                {{ service.name }}
                            </li>
                        </ul> -->
                        <!-- sezione servizi aggiuntivi -->
                        <div class="services-section-row services-section d-flex">
                            <div class="services-left">
                                <div class="p-1" v-for="service in apartment.additional_services" :key="service.id">
                                  {{service.name}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <router-link :to="{name:'apartment.show',params: {apartment:apartment.slug}}" class="btn">Show</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        apartment: Object,
    }
}
</script>

<style lang="scss" scoped>
  .services-section-row{
      max-height: 95%;
    .services-left{
      width: 100%;
      max-height: 23vh;
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
    }

  }
.card-container {
    height: 23vh;
    .container-fluid {
        height: 100%;
        .container-row {
            height: 100%;
            .card-data {
                max-height: 100%;
                .service-section {
                    height: 100%;
                    width: 35%;
                }
            }
        }
    }
}
.container-fluid{
    .row {
        .image-container {
            // width: 20%;
            height: 100%;
            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 15px;
            }
        }
        .ad-content {
            margin-left: 30px;
            // width: 70%;
            i {
                color: #ff385c;
            }
        }
        .btn {
            background: #ff385c;
            color: #fff;
        }
    }
}

</style>