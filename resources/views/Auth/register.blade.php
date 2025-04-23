<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - {{ __('Register') }}</title>

    <!-- Custom fonts -->
    <link href="{{ asset('/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ __('Create an Account!') }}</h1>
                            </div>

                            <!-- Tampilkan pesan error -->
                            @if ($errors->any())
                                <div class="alert alert-danger mb-4">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form class="user" method="POST" action="/register">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="{{ __('Password') }}" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation" placeholder="{{ __('Repeat Password') }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="role" class="form-control form-control-user" required>
                                        <option value="">-- Pilih Role --</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="approver_1" {{ old('role') == 'approver_1' ? 'selected' : '' }}>Approver 1</option>
                                        <option value="approver_2" {{ old('role') == 'approver_2' ? 'selected' : '' }}>Approver 2</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Register Account') }}
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="/login">{{ __('Already have an account? Login!') }}</a>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>
</body>

</html>