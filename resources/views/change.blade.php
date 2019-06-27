@extends('layouts.dashboard')

@section('content')
<div class="row">
  <div class="col-md-12 d-flex align-items-stretch grid-margin">
    <div class="row flex-grow">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Ganti Password</h4>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Password Lama</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password-lama" id="lama" placeholder="Password Lama">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Password Baru</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password-baru" id="baru" placeholder="Password Baru">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Konfirmasi Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="konfirmasi" id="konfirmasi" placeholder="Konfirmasi Password">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">&nbsp;</label>
              <div class="col-sm-10">
                <button type="button" id="save" class="btn btn-success">Simpan</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $('#save').on('click',function(){
    var lama = $('#lama').val();
    var baru = $('#baru').val();
    var konfirmasi = $('#konfirmasi').val();

    if(baru != konfirmasi){
      swal("Gagal!", "Konfirmasi Password Tidak Sama.", "error");
      return;
    }

    $.post("{{url('change-proses')}}",{_token:$("meta[name='csrf-token']").attr("content"),pass_lama:lama,pass_baru:baru},function(data){
      if(data){
        swal("Berhasil!", "Password Berhasil di ubah.", "success");
        setTimeout(function(){
          window.location.href = "{{url('change-password')}}";
        }, 3000);
      }else{
        swal("Gagal!", "Password Lama Salah", "error");
      }
    });
  });
</script>
@endsection
