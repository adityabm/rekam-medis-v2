@extends('layouts.dashboard')

@section('content')
<fieldset>
    <legend>Jumlah Pasien Berdasarkan Jenis Pendidikan</legend>
    <div class="row">
      @foreach($total as $t)
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
          <div class="card-body">
            <div class="clearfix">
              <div class="float-left">
                <i class="mdi mdi-account icon-lg"></i>
              </div>
              <div class="float-right">
                <p class="mb-0 text-right">{{$t->name}}</p>
                <div class="fluid-container">
                  <h3 class="font-weight-medium text-right mb-0">{{$t->jumlah}} Orang</h3>
                </div>
              </div>
            </div>
            <a href="#" data-jenis="{{$t->id}}" class="lihat-detail">
              <p class="mt-3 mb-0 pull-right">
                Lihat Detail &nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i>
              </p>
            </a>
          </div>
        </div>
      </div>
      @endforeach

      @if($other > 0)
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
          <div class="card-body">
            <div class="clearfix">
              <div class="float-left">
                <i class="mdi mdi-account text-danger icon-lg"></i>
              </div>
              <div class="float-right">
                <p class="mb-0 text-right">Lainnya</p>
                <div class="fluid-container">
                  <h3 class="font-weight-medium text-right mb-0">{{$other}} Orang</h3>
                </div>
              </div>
            </div>
            <a href="#" data-jenis="no" class="lihat-detail">
              <p class="mt-3 mb-0 pull-right">
                Lihat Detail &nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i>
              </p>
            </a>
          </div>
        </div>
      </div>
      @endif
    </div>
</fieldset>

<div class="row" id="detail" style="display: none">
  <div class="col-md-12 d-flex align-items-stretch grid-margin">
    <div class="row flex-grow">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <button class="btn btn-success pull-right" id="export">Export Excel</button>
            <h4 class="card-title">Data Pasien</h4>
            <ajax-table
                :url="'{{url('get-data-pasien-dashboard') }}'"
                :oid="'data-pasien-dashboard'"
                :params="params"
                :config="{
                    autoload: false,
                    show_all: false,
                    has_number: false,
                    has_entry_page: false,
                    has_pagination: false,
                    has_action: true,
                    has_search_input: false,
                    has_search_header: false,
                    custom_header: '',
                    default_sort: 'id',
                    default_sort_dir: 'asc',
                    custom_empty_page: false,
                    search_placeholder: 'Search',
                    class: {
                      wrapper: ['table-responsive'],
                    }
                }"
                :rowparams="{}"
                :rowtemplate="'tr-data-pasien-dashboard'"
                :columns="{
                    no_rekam_medis: 'No Rekam Medis',
                    nama: 'Nama Pasien',
                    tanggal_lahir: 'Tanggal Lahir',
                    kontak: 'No Telp',
                    jumlah:'Jumlah Riwayat'
                }" 
                >
            </ajax-table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Log</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        Versi Sekarang <strong>1.0.2</strong>
        <ul>
          <li>Menambahkan Input Riwayat : Saran Medis dan Keluhan</li>
          <li>String Fixed</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<modal-detail-pasien-dashboard></modal-detail-pasien-dashboard>
@endsection

@section('scripts')
<script type="text/javascript">
  var checker = localStorage.getItem("change-log-2");
  var jenis_all = '';

  $(document).ready(function(){
    if(checker == null || checker == ''){
      localStorage.setItem('change-log-2',true);
      $('#myModal').modal('show');
    }
  });

  $(document).on('click','.lihat-detail',function(){
    var jenis = $(this).data('jenis');
    jenis_all = jenis;
    app.params.jenjang_id = jenis;
    eventHub.$emit('refresh-ajaxtable','data-pasien-dashboard');

    $('#detail').show();
  });

  $(document).on('click','#export',function(){
    window.location.href = "{{url('export')}}?id=" + jenis_all;
  });
</script>
@endsection