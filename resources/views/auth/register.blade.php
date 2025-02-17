<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - Komunitas Usaha Bersama</title>
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center mb-3">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control @error('nama') is-invalid @enderror" id="inputNama" type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Anda" required />
                                                    <label for="inputNama">Nama</label>
                                                    @error('nama') <div class="text-danger small">{{ $message }}</div> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control @error('nik') is-invalid @enderror" id="inputNIK" type="text" name="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK Anda" required />
                                                    <label for="inputNIK">NIK</label>
                                                    @error('nik') <div class="text-danger small">{{ $message }}</div> @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control @error('wa_number') is-invalid @enderror" id="inputNoWA" type="text" name="wa_number" value="{{ old('wa_number') }}" placeholder="Masukkan No WA Anda" required />
                                                    <label for="inputNoWA">No. WA</label>
                                                    @error('wa_number') <div class="text-danger small">{{ $message }}</div> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email Anda" required />
                                                    <label for="inputEmail">Email</label>
                                                    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputNamaBank" type="text" name="bank_name" value="{{ old('bank_name') }}" placeholder="Masukkan Nama Bank Anda" />
                                                    <label for="inputNamaBank">Nama Bank</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputNoRek" type="text" name="acc_number"  value="{{ old('acc_number') }}" placeholder="Masukkan No Rek Anda" />
                                                    <label for="inputNoRek">No. Rek</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputNamaRek" type="text" name="acc_name" value="{{ old('acc_name') }}" placeholder="Masukkan Nama Rekening Anda" />
                                                    <label for="inputNamaRek">Nama di Rek</label>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="col-md-12 border border-1 my-4">

                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('user_id') is-invalid @enderror" id="inputUserID" type="text" name="user_id" value="{{ old('user_id') }}" placeholder="Masukkan User ID" required />
                                            <label for="inputUserID">User ID</label>
                                            @error('user_id') <div class="text-danger small">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password" name="password" placeholder="Create a password" required />
                                                    <label for="inputPassword">Password</label>
                                                    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPasswordConfirm" type="password" name="password_confirmation" placeholder="Confirm password" required />
                                                    <label for="inputPasswordConfirm">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>

                                       

                                        <div class="form-floating mb-3 col-md-4">
                                        @if ($isReferralFromUrl)
                                            <input class="form-control" id="inputRefCode" type="text" name="referral_code" value="{{ $referral_code }}" placeholder="Masukkan Ref Code" readonly
                                            style="pointer-events: none; background-color: #e9ecef;" />
                                        @else
                                            <input class="form-control" id="inputRefCode" type="text" name="referral_code" value="{{ old('referral_code') }}" placeholder="Masukkan Ref Code"/>
                                        @endif    
                                            <label for="inputRefCode">Referral Code</label>
                                        </div>

                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="{{route('login')}}">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Komunitas Usaha Bersama 2025</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('js/scripts.js')}}"></script>
    </body>
</html>
