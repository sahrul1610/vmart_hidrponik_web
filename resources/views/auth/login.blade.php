<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ngeIE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Authentication Login &mdash; Vmart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ url('template') }}/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('template') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ url('template') }}/assets/css/bootstrap-override.css">
</head>

<body>
    <section class="container h-100">
        <div class="row justify-content-sm-center h-100 align-items-center">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <h1 class="fs-4 text-center fw-bold mb-4">Login</h1>
                        @if (session()->has('LoginError'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('LoginError') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ url('/auth') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email">Email</label>
                                <div class="input-group input-group-join mb-3">
                                    <input id="email" type="email" placeholder="email" class="form-control"
                                        name="email" value="" required autofocus>
                                    <span class="input-group-text rounded-end">&nbsp<i
                                            class="fa fa-envelope"></i>&nbsp</span>
                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password">Password</label>
                                    <a href="{{url('/forgot-password')}}" class="float-end">
                                        Forgot Password?
                                    </a>
                                </div>
                                <div class="input-group input-group-join mb-3">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Your password" required>
                                    <span class="input-group-text rounded-end password cursor-pointer">&nbsp<i
                                            class="fa fa-eye-splash"></i>&nbsp</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-primary ms-auto">
                                    Login
                                </button>
                            </div>
                        </form>

                        <div class="text-center mb-2 mt-3">&mdash; OR &mdash;</div>
                        <div class="d-grid gap-2">
                            <a href="{{ url('login/google') }}" class="btn btn-danger icon-left"><i
                                    class="fab fa-google"></i> Login
                                with Google</a>
                        </div>
                    </div>

                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            Belum punya akun? <a href="{{ route('register') }}" class="text-dark">Buat akun baru</a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5 text-muted">
                    Copyright &copy; 2023 &mdash; Vmart
                </div>
            </div>
        </div>
    </section>

    <script src="{{ url('template') }}/assets/js/login.js"></script>
</body>

</html>
