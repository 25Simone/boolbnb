<template>
    <main class="container-fluid p-0">
        <div class="container-fluid bg">
            <div class="container pt-5">
                <div class="jumbotron d-flex align-items-center justify-content-center">
                    <p class="text-center">Affitta la casa dei tuoi sogni</p>
                </div>
        
                <div class="box-img">
                    <img src="../img/casa-nel-bosco.webp" alt="">
                </div>
            </div>
        </div>

        <div class="container-fluid bg-white">
            <div class="ispirazione-container container">
                <h2>Ispirazione per i tuoi viaggi</h2>
                <div class="row row-cols-1 row-cols-md-3 pt-3">
                    <div class="col card">
                        <img src="../img/giardino_verticale.jpeg" alt="">
                    </div>
                    <div class="col card">
                        <img src="../img/city-life.jpeg" alt="">
                    </div>
                    <div class="col card">
                        <img src="../img/img_milano_centro.jpeg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    
}
</script>

<style lang="scss" scoped>
main {
    .bg {
        background-color: black;
    }

    .jumbotron {
        height: 400px;
        background-color: #fa4f55;
        border-radius: 15px;
        margin: 0 auto;

        p {
            color: white;
            font-size: 60px;
        }
    }

    .box-img {
        margin-top: 70px;
        
        img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            margin-bottom: 40px;
        }
    }

    .ispirazione-container {
        padding-top:50px;
        
        .card {
            border: 0px;
            padding-bottom: 50px;
            
            img {
                height: 300px;
                object-fit: cover;
                border-radius: 10px;
                opacity: 0.8;
                &:hover {
                    cursor: pointer;
                    box-shadow: 7px 7px 10px rgb(145, 145, 145);
                    opacity: 1;
                }
            }
        }
    }
}
</style>