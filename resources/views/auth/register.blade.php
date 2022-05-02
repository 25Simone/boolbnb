@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card box-shadow">
                <div class="pt-3 over color">{{ __('Register') }}</div>

                <div class="card-body d-flex flex-column justify-content-center">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-3">
                            {{-- <label for="name" class="col-form-label text-md-right">{{ __('Name') }} *</label> --}}

                            <div class="col-md-8">
                                <input id="name" placeholder="name *" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            {{-- <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address *') }}</label> --}}

                            <div class="col-md-8">
                                <input id="email" placeholder="email *" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group  mb-3">
                            {{-- <label class=" col-form-label text-md-right" for="birth_date">Birth date</label> --}}
                            <div class="col-md-8">
                                <input id="birth_date" placeholder="birth date *" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" autocomplete="birth_date">

                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            {{-- <label for="password" class=" col-form-label text-md-right">{{ __('Password *') }}</label> --}}

                            <div class="col-md-8">
                                <input id="password" placeholder="password *" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}*</label> --}}

                            <div class="col-md-8">
                                <input id="password-confirm" placeholder="password confirm *" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group  mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-bnb">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
     function checkDate(){
        let dtToday = new Date();
        let month = dtToday.getMonth() + 1;// jan=0; feb=1 .......
        let day = dtToday.getDate();
        let year = dtToday.getFullYear() - 18;
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
    	let minDate = year + '-' + month + '-' + day;
        let maxDate = year + '-' + month + '-' + day;
    	document.getElementById('birth_date').setAttribute('max', maxDate);
    };
    document.addEventListener("DOMContentLoaded", function() {
        checkDate();
    });
</script>
