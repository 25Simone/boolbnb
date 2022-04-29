<template>
    <nav class="nav navbar navbar-expand-md shadow-sm" :class="$route.name === 'advancedSearch' ? 'navbar-light bg-light' : 'navbar-dark bg-dark'">
        <div class="container">
            <a class="navbar-brand" href="/">BoolBnB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-bs-controls="navbarSupportedContent" aria-bs-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ms-auto"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item" >
                        <a class="nav-link" href="/login" v-if="!user">Login</a>
                        <a class="nav-link" href="/admin" v-else> {{ user.name }} </a>
                    </li>
                    <li class="nav-item" v-if="!user">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</template>

<script>
import axios from 'axios';
export default {
    data () {
        return { 
            user:null,
        }
    },
    methods: {
        fetchUser() {
            axios.get('/api/user').then(res=>{
                console.log(res.data)
                this.user = res.data;
                localStorage.setItem ('user', JSON.stringify(res.data))
            })

            .catch(er=>{
                localStorage.removeItem('user')
            })
        }

    },
    mounted () {
        this.fetchUser();
    }
}
</script>

<style lang="scss" scoped>
.nav{
    .navbar-brand{
        color: #ff385c;
        font-size: 25px;
    }
}
.nav.bg-dark {
    background-color: #000 !important;
}
</style>