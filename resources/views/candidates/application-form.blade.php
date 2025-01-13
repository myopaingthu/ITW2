<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | ITW2</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini" style="font-size: 12px;">
    <div class="container mt-5">
        <div class="card shadow-sm w-50 mx-auto">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Join Our Team</h4>
            </div>
            <div class="card-body">
                <form action="/application-form" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group form-group-sm  col-12">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Enter your full name" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group form-group-sm col-12">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="Enter your email address" value="{{ old('email') }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group form-group-sm col-12">
                        <label for="phone">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control form-control-sm @error('phone') is-invalid @enderror" placeholder="Enter your phone number" value="{{ old('phone') }}">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group form-group-sm col-12">
                        <label for="github">GitHub Profile</label>
                        <input type="url" name="github" class="form-control form-control-sm @error('github') is-invalid @enderror" placeholder="Enter your GitHub profile URL" value="{{ old('github') }}">
                        @error('github')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group form-group-sm col-12">
                        <label for="linkedin">LinkedIn Profile</label>
                        <input type="url" name="linkedin" class="form-control form-control-sm @error('linkedin') is-invalid @enderror" placeholder="Enter your LinkedIn profile URL" value="{{ old('linkedin') }}">
                        @error('linkedin')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group form-group-sm col-12">
                        <label for="years_of_experience">Years of Experience <span class="text-danger">*</span></label>
                        <input type="number" name="years_of_experience" class="form-control form-control-sm @error('years_of_experience') is-invalid @enderror" placeholder="Enter your years of experience" value="{{ old('years_of_experience') }}">
                        @error('years_of_experience')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group form-group-sm col-12">
                        <label for="current_role">Current Role <span class="text-danger">*</span></label>
                        <input type="text" name="current_role" class="form-control form-control-sm @error('current_role') is-invalid @enderror" placeholder="Enter your current role" value="{{ old('current_role') }}">
                        @error('current_role')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group form-group-sm col-12">
                        <label for="expected_salary">Expected Salary <span class="text-danger">*</span></label>
                        <input type="text" name="expected_salary" class="form-control form-control-sm @error('expected_salary') is-invalid @enderror" placeholder="Enter your expected salary" value="{{ old('expected_salary') }}">
                        @error('expected_salary')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group form-group-sm col-12">
                        <label for="resume">Resume <span class="text-danger">*</span></label>
                        <input type="file" name="resume" class="form-control-file @error('resume') is-invalid @enderror">
                        @error('resume')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @if (session()->has('success'))
    <script type="module">
        $(document).ready(function() {
            toastr.success('{{session('success')}}')
        });
    </script>
    @endif

    @if (session()->has('error'))
    <script type="module">
        $(document).ready(function() {
            toastr.error('{{session('error')}}')
        });
    </script>
    @endif

    @if (session()->has('swalSuccess'))
    <script type="module">
        Swal.fire({
            text: "{{session('swalSuccess')}}",
            icon: "success",
            iconColor: "#6868AC",
            confirmButtonColor: "#6868AC",
        });
    </script>
    @endif
</body>

</html>