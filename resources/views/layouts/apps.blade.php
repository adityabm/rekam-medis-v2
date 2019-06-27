<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Rekam Medis</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('asset/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('asset/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('asset/vendors/css/vendor.bundle.addons.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('asset/images/favicon.png')}}"/>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one" style="background: url({{asset('asset/images/auth/bg.jpg')}});background-size: cover;">
        <div class="row w-100">
          <div class="col-lg-10 mx-auto">
            <div class="auto-form-wrapper">
              <h5>Data Awal Kesehatan Calon Peserta Diklat / DIKBANGSPES</h5>
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                  <label class="label">Diklat / DIKBANGSPES</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Nama</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Umur</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Jenis Kelamin</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Status</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Agama</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Pangkat</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">NRP / NIP</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Kesatuan</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Golongan Darah</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Tinggi Badan</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Berat Badan</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                      
                    </div>
                  </div>
                </div>
                <fieldset>
                    <legend style="font-size:1rem;font-weight:500">Riwayat Penyakit</legend>
                    <div class="form-group">
                        <label class="label">Hypertensi</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="input-group-append">
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Diabetes</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="input-group-append">
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">THT</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="input-group-append">
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Mata</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="input-group-append">
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Jantung</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="input-group-append">
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Paru-Paru</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="input-group-append">
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Liver</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="input-group-append">
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Ginjal</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="input-group-append">
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Tulang</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="input-group-append">
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Berat Badan</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="input-group-append">
                            
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block">Selanjutnya</button>
                </div>
              </form>
            </div>
            <p class="footer-text text-center mt-3">copyright © {{date('Y')}} @adityaxt. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset('asset/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('asset/vendors/js/vendor.bundle.addons.js')}}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{asset('asset/js/off-canvas.js')}}"></script>
  <script src="{{asset('asset/js/misc.js')}}"></script>
  <!-- endinject -->
</body>

</html>