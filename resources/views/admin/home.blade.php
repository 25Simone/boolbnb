@extends('layouts.app')

@section('content')
<div class="container-fluid">


    <div class="container">
        <div class="row">
            <div class="mt-5 col-4 col-md-3 col-lg-2">
                <div class="dash_card rounded-3">
                    <div class="card_header">
                        <img src="{{asset('images/user_placeholder.png')}}" alt="user placeholder" class="img-fluid img-thumbnail ">
                    </div>
                    <div class="card_body p-3">
                        {{-- sezione informazioni utente --}}
                        <section class="text-center">
                            <div class="fw-bold name-section">{{Auth::user()->name}}</div>
                            <hr>
                           <button class="btn btn-secondary" id="details">See details</button>
                           <div id="section-details" class="d-none mt-4">
                                <div><span>Email:</span> {{Auth::user()->email}}</div>
                                <div><span>Birth date:</span> {{Auth::user()->birth_date}}</div>
                                <div><span>Date of registration: </span>{{Auth::user()->created_at}}</div>
                           </div>
                        </section>
                    </div>
                </div>
            </div>

            <div class="col-8 col-md-9 col-lg-10 mt-5">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
    
                    <div class="card-body">
                        <ul>
                            <li>
                                <div class="row">
                                    <div class="col-6 dash-left">
                                        My apartments
                                    </div>
                                    <div class="col-6 dash-right">
                                        <a href="{{route('admin.apartments.index')}}"><button class="btn dash-button text-white">Apartments</button></a>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-3">
                                <div class="row">
                                    <div class="col-6 dash-left">
                                        Publish your apartment
                                    </div>
                                    <div class="col-6 dash-right">
                                        <a href="{{route('admin.apartments.create')}}"><button class="btn dash-button text-white">Publish</button></a>
                                    </div>
                                    
                                </div>
                            </li>
                            <li class="mt-3">
                                <div class="row">
                                    <div class="col-6 dash-left">
                                        Check messages
                                    </div>
                                    <div class="col-6 dash-right">
                                        <a href="{{route('admin.inbox')}}"><button class="btn dash-button text-white">Inbox messages</button></a>
                                    </div>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

       
          
        
    </div>

   
</div>

<script>
    const button = document.getElementById('details');
    const details = document.getElementById('section-details');
    button.addEventListener('click',function(){
        details.classList.toggle('d-none');
        if(button.innerText === 'See details'){
            button.innerText = 'Hide details'
        }else{
            button.innerText = 'See details'
        }
    })
</script>

@endsection

