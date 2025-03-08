<head>
  <title>Users / Profile - Komunitas Usaha Bersama</title>

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

 
  
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet"> -->
  

  <!-- Template Main CSS File -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  <!-- <link href="{{asset('css/styles.css')}}" rel="stylesheet"> -->
  <link href="{{asset('css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('css/quill.bubble.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
  @extends('layouts.base')
  @section('content')
    <div class="container-fluid px-4">
      <h1 class="mt-4">User Profile</h1>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="{{route('index')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">User Profile</li>
      </ol>
      <section class="section profile">
        <div class="row">
          <div class="col-xl-4">

            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <h2>{{$user->nama}}</h2>
                <h3>{{$user->referral_code}}</h3>
                <div class="social-links mt-2">
                  <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                  <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                  <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                  <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>

          </div>

          <div class="col-xl-8">
          @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
          @endif
          @if(session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
          @endif

            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered" id="profileTabs">

                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                  </li>

                  <!-- <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                  </li> -->

                  <li class="nav-item">
                    <button class="nav-link" id="change-password-tab" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                  </li>

                </ul>
                <div class="tab-content pt-2" id="profileTabContent">

                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">Profile Details</h5>
                    <br>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Name</div>
                      <div class="col-lg-9 col-md-8">{{$user->nama}}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Referral Code</div>
                      <div class="col-lg-9 col-md-8 d-inline-flex align-items-center">
                        <span id="referralCode">{{$user->referral_code}}</span>
                        <button id="copyBtn" class="btn btn-outline-primary btn-sm ms-2 p-1" onclick="copyReferralCode()">
                          <i id="copyIcon" class="fas fa-clipboard"></i>
                        </button>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">WA Number</div>
                      <div class="col-lg-9 col-md-8">{{$user->wa_number}}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Pendapatan</div>
                      <div class="col-lg-9 col-md-8">Rp {{number_format($user->pendapatan,0,',','.')}}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Email</div>
                      <div class="col-lg-9 col-md-8">{{$user->email}}</div>
                    </div>

                  </div>

                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                    <!-- Profile Edit Form -->
                    <form action="{{route('update.user')}}" method="POST">
                      @csrf
                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="nama" type="text" class="form-control" id="fullName" value="{{$user->nama}}">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="waNumber" class="col-md-4 col-lg-3 col-form-label">WA Number</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="waNumber" type="text" class="form-control" id="waNumber" value="{{$user->wa_number}}"
                          oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,16)">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="accBankName" class="col-md-4 col-lg-3 col-form-label">Acc Bank Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="accBankName" type="text" class="form-control" id="accBankName" value="{{$user->bank_name}}"
                          oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="accNumber" class="col-md-4 col-lg-3 col-form-label">Acc Number</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="accNumber" type="text" class="form-control" id="accNumber" value="{{$user->acc_number}}"
                          oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,16)">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="accName" class="col-md-4 col-lg-3 col-form-label">Acc Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="accName" type="text" class="form-control" id="accName" value="{{$user->acc_name}}"
                          oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="email" type="email" class="form-control" id="Email" value="{{$user->email}}"
                          oninput="this.value = this.value.replace(/[^a-zA-Z0-9.@_-]/g, '')">
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                      </div>
                    </form><!-- End Profile Edit Form -->

                  </div>

                  <!-- <div class="tab-pane fade pt-3" id="profile-settings">

                    Settings Form
                    <form>

                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                        <div class="col-md-8 col-lg-9">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changesMade" checked>
                            <label class="form-check-label" for="changesMade">
                              Changes made to your account
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="newProducts" checked>
                            <label class="form-check-label" for="newProducts">
                              Information on new products and services
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="proOffers">
                            <label class="form-check-label" for="proOffers">
                              Marketing and promo offers
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                            <label class="form-check-label" for="securityNotify">
                              Security alerts
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                      </div>
                    </form>End settings Form

                  </div> -->

                  <div class="tab-pane fade pt-3" id="profile-change-password">
                    <!-- Change Password Form -->
                    <form action="{{route('change.password')}}" method="POST">
                      @csrf
                      <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                          @error('currentPassword') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="newPassword" type="password" class="form-control" id="newPassword">
                          @error('newPassword') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="newPassword_confirmation" type="password" class="form-control" id="renewPassword">
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                      </div>
                    </form><!-- End Change Password Form -->

                  </div>

                </div><!-- End Bordered Tabs -->

              </div>
            </div>

          </div>
        </div>
      </section>
    </div><!-- End Page Title -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
  <div id="copyToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        Referral Code copied!
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<script>
  function copyReferralCode() {
    const referralText = document.getElementById("referralCode").innerText;
    navigator.clipboard.writeText(referralText).then(() => {
      let toast = new bootstrap.Toast(document.getElementById("copyToast"));
      toast.show();

      const copyBtn = document.getElementById("copyBtn");
      const copyIcon = document.getElementById("copyIcon");

      // Ganti ikon clipboard dengan centang

      // Ubah warna tombol
      copyBtn.classList.remove("btn-outline-primary");
      copyBtn.classList.add("btn-success");

      

      setTimeout(() => {
        // Kembalikan ikon clipboard
        copyIcon.classList.remove("fa-circle-check");
        copyIcon.setAttribute("data-icon", "clipboard")

        // Kembalikan warna tombol
        copyBtn.classList.remove("btn-success");
        copyBtn.classList.add("btn-outline-primary");
      }, 1000);
    });
  }
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let activeTab = "{{ session('active_tab') }}"; // Ambil data dari session Laravel
    if (activeTab) {
        let tabElement = document.getElementById(activeTab); // Ambil tab sesuai ID
        if (tabElement) {
            new bootstrap.Tab(tabElement).show(); // Tampilkan tab yang sesuai
        }
    }
});
</script>


    @endsection                     
  <!-- Vendor JS Files -->
  <!-- <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script> -->

  <!-- Template Main JS File -->
  <!-- <script src="assets/js/main.js"></script> -->
