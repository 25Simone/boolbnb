<template>
    <footer class="">
        <div class="container ">
            <div class="row d-flex justify-content-between pt-5">
                <div class="col">
                    <h5>Assistenza</h5>
                    <p>Centro Assistenza</p>
                    <p>Informazioni di sicurezza</p>
                    <p>Opzioni di cancellazione</p>
                    <p>La nostra risposta all'emergienza COVID-19</p>
                    <p>Accessibilità per tutti</p>
                    <p>Segnala problemi nel quartiere</p>
                </div>
                <div class="col">
                    <h5>Community</h5>
                    <p>Airbnb.org: un rifugio sicuro</p>
                    <p>Supporta i rifugiati afghani</p>
                    <p>Contro la discriminazione</p>
                </div>
                <div class="col">
                    <h5>Ospitare</h5>
                    <p>Prova ad ospitare</p>
                    <p>AirCover per gli ospiti</p>
                    <p>Esplora le risorse per host</p>
                    <p>Vai al forum della community</p>
                    <p>Come ospitare responsabilmente</p>
                </div>
                <div class="col">
                    <h5>Informazioni</h5>
                    <p>Newsroom</p>
                    <p>Scopri le nuove funzionalità</p>
                    <p>Lettera dai nostri fondatori</p>
                    <p>Opportunità di lavoro</p>
                    <p>Investitori</p>
                    <p>BoolBnB Luxe</p>
                </div>
            </div>

            <div class="info-box d-flex pb-3">
                <div class="p-2">
                    <span>© 2022 BoolBnB, Inc.</span>
                    <span>Privacy</span>
                    <span>Termini</span>
                    <span>Mappa del sito</span>
                    <span>Dettagli dell'azienda</span> 
                </div>
                <div class="ms-auto p-2">
                    <span>Italiano(IT)</span>
                    <span>€ EUR</span>
                </div>
            </div>   
        </div>    
    </footer>
</template>

<script>
export default {
    
}
</script>

<style lang="scss" scoped>
footer {
    background-color: whitesmoke ;

    h5 {
        font-weight: 900;
    }
    p {
        cursor: pointer;
        font-size: 13px ;
        &:hover {
            text-decoration: underline;
        }
    }

    .info-box {
        border-top: 1px rgb(182, 182, 182) solid ;

        span {
            padding-left: 10px;
        }
    }
}
</style>