<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">BoolBnB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
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
                    
                    <!-- <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            </form>
                        </div>
                    </li> -->
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

</style>