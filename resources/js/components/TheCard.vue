<template>
    <div class="container-fluid px-4 py-3 mt-3">
        <div class="row">
            <div class="image-container rounded">
                <img :src="apartment.photo" :alt="apartment.title + 'image'">
            </div>
            <div class="ad-content px-3">
                <h3>{{ apartment.title }}</h3>
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
        height: 35vh;
        .image-container {
            width: 20%;
            height: 100%;
            overflow: hidden;
            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }
        .ad-content {
            width: 70%;
        }
    }
}

</style>