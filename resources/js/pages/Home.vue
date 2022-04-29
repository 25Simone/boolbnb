<template>
    <main class="container-fluid bg">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="jumbotron">
                    <h1>Affitta casa dei tuoi sogni</h1>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="box-img">
                    ciao
                </div>
            </div>
        

            <div class="ispirazione-container">
                <h2>Ispirazione per i tuoi viaggi</h2>
                <div class="row d-flex">
                    <div class="col card">
                        <div class="white-box"></div>
                    </div>
                    <div class="col card">
                        <div class="white-box"></div>
                    </div>
                    <div class="col card">
                        <div class="white-box"></div>
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
        width: 1200px;
        height: 400px;
        background-color: #fa4f55;
        margin-top: 60px ;
        margin-bottom: 30px;
        border-radius: 40px;

        h1 {
            color: white;
            text-align: center;
            padding-top: 150px;
            font-size: 60px;
        }
    }

    .box-img {
        width: 1200px;
        height: 700px;
        background-color: white;
        border-radius: 40px;
        margin-top: 70px ;
    }

    .ispirazione-container {
        margin-top: 80px;
        h2 {
            color:white;
        }
    }
}
</style>