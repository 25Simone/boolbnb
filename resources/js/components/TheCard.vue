<template>
    <div class="px-4">
        <div class="container-fluid py-3 border-top">
            <div class="row">
                <div class="image-container">
                    <img :src="apartment.photo" :alt="apartment.title + 'image'">
                </div>
                <div class="ad-content px-3">
                    <h3>{{ apartment.title }}</h3>
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
        height: 25vh;
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
            width: 70%;
        }
    }
}

</style>