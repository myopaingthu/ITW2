<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>

<body class="login-page" cz-shortcut-listen="true" style="min-height: 494.802px;">
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('login.post') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <input name="email" type="text" class="form-control form-control-sm  @error('email') is-invalid @enderror" placeholder="User Name">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" id="password" class="form-control form-control-sm  @error('password') is-invalid @enderror" name="password" placeholder="New Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="submit-btn btn btn-primary btn-sm">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session()->has('error'))
    <script type="module">
        $(document).ready(function() {
            toastr.error('{{session('error')}}')
        });
    </script>
    @endif

    @if (session()->has('success'))
    <script type="module">
        $(document).ready(function() {
            toastr.success('{{session('success')}}')
        });
    </script>
    @endif
</body>

</html>