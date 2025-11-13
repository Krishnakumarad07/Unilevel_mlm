<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unilevel MLM - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Times, Times New Roman', 'Cambria', 'Cochin', 'Georgia, serif';
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        h3 {
            font-weight: 600;
            color: #4e73df;
        }

        .btn-primary {
            background-color: #4e73df;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
        }

        .form-floating>.form-control:focus~label {
            color: #4e73df;
        }

        .form-floating>.form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .form-col {
            flex: 1 1 48%;
        }

        @media (max-width: 768px) {
            .form-col {
                flex: 1 1 100%;
            }
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card">
                    <h3 class="text-center mb-4">Register</h3>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('register.submit') }}" id="registerForm" novalidate>
                        @csrf
                        <div class="form-row">
                            <!-- First Name -->
                            <div class="form-col mb-3 form-floating">
                                <input type="text" name="firstname" class="form-control" id="first_name"
                                    placeholder="First Name" value="{{ old('first_name') }}">
                                <label for="first_name">First Name</label>
                                <div class="invalid-feedback">Please enter a valid first name (letters only).</div>
                            </div>

                            <!-- Last Name -->
                            <div class="form-col mb-3 form-floating">
                                <input type="text" name="lastname" class="form-control" id="last_name"
                                    placeholder="Last Name" value="{{ old('last_name') }}">
                                <label for="last_name">Last Name</label>
                                <div class="invalid-feedback">Please enter a valid last name (letters only).</div>
                            </div>

                            <!-- Username -->
                            <div class="form-col mb-3 form-floating">
                                <input type="text" name="username" class="form-control" id="username"
                                    placeholder="Username" value="{{ old('username') }}">
                                <label for="username">Username</label>
                                <div class="invalid-feedback">Username must be 3-15 characters and contain only letters,
                                    numbers, _ or -.</div>
                            </div>

                            <!-- Email -->
                            <div class="form-col mb-3 form-floating">
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Email" required value="{{ old('email') }}">
                                <label for="email">Email</label>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>

                            <!-- Password -->
                            <div class="form-col mb-3 form-floating">
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Password" required minlength="6">
                                <label for="password">Password</label>
                                <div class="invalid-feedback">Password must be at least 6 characters.</div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-col mb-3 form-floating">
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="password_confirmation" placeholder="Confirm Password" required>
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="invalid-feedback">Passwords do not match.</div>
                            </div>

                            <!-- Referral Code -->
                            <div class="form-col mb-3 form-floating">
                                <input type="text" name="referral_code" class="form-control" id="referral_code"
                                    placeholder="Referral Code" value="{{ $ref ?? old('referral_code') }}">
                                <label for="referral_code">Referral Code</label>
                                <div class="invalid-feedback">Referral code must contain only uppercase letters or
                                    numbers.</div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            'use strict';
            const form = document.getElementById('registerForm');

            form.addEventListener('submit', function(event) {
                // Password match check
                const password = form.password.value;
                const confirmPassword = form.password_confirmation.value;

                if (password !== confirmPassword) {
                    form.password_confirmation.setCustomValidity("Passwords do not match");
                } else {
                    form.password_confirmation.setCustomValidity("");
                }

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        })();
    </script>
</body>

</html>
