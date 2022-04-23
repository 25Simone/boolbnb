<template>
    <div class="px-4">
        <div class="container-fluid py-3 border-top">
            <div class="row">
                <div class="image-container">
                    <img :src="apartment.photo" :alt="apartment.title + 'image'">
                </div>
                <div class="ad-content px-5">
                    <h2>{{ apartment.title }}</h2>
                    <div> <i class="fas fa-map-marker-alt my-3"></i> {{ apartment.address }} </div>
                    <span class="me-3"> <i class="fas fa-home"></i> {{ apartment.rooms_number }} rooms </span>
                    <span class="me-3"> <i class="fas fa-bed"></i> {{ apartment.beds_number }} beds </span>
                    <span class="me-3"> <i class="fas fa-bath"></i> {{ apartment.baths_number }} baths </span>
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
.container-fluid{
    .row {
        height: 23vh;
        .image-container {
            width: 20%;
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
            width: 70%;
            i {
                color: #ff385c;
            }
        }
    }
}

</style>