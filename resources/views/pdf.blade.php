<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Rekam Medis {{$pasien->nama}}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<bold><h5>Rekam Medis {{$pasien->nama}}</h5></bold>
    </center>
    <br>
    <br>
	
    <form class="forms-sample">
        <div class="form-group row">
            <label class="col-md-12" style="width:100%">No Rekam Medis &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$pasien->no_rekam_medis}}</label>
        </div>
        <div class="form-group row">
            <label class="col-md-12" style="width:100%">Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$pasien->nama}}</label>
        </div>
        <div class="form-group row">
            <label class="col-md-12" style="width:100%">Tanggal Lahir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$pasien->tanggal_lahir}}</label>
        </div>
        <div class="form-group row">
            <label class="col-md-12" style="width:100%">Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$pasien->alamat}}</label>
        </div>
        <div class="form-group row">
            <label class="col-md-12" style="width:100%">No Telp / No HP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$pasien->kontak}}</label>
        </div>
        <div class="form-group row">
            <label class="col-md-12" style="width:100%">Jenis Kelamin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$pasien->jenis_kelamin == 'l' ? 'Laki-Laki' : 'Perempuan'}}</label>
        </div>
        <div class="form-group row">
            <label class="col-md-12" style="width:100%">Gol. Darah &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$pasien->gol_darah == 'a' ? 'A' : ($pasien->gol_darah == 'b' ? 'B' : ($pasien->gol_darah == 'ab' ? 'AB' : 'O'))}}</label>
        </div>

        <h6>Riwayat Pasien</h6>
        <table class="table table-striped table-bordered">
            <tr>
                <th>No</th>
                <th>Diagnosa</th>
                <th>Tanggal Berkunjung</th>
                <th>Lama Rawat</th>
                <th>Tindakan</th>
                <th>Obat</th>
                <th>Keluhan</th>
                <th>Saran Medis</th>
            </tr>
            @php $no = 1; @endphp
            @foreach($pasien->riwayat as $rw)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$rw->diagnosa_sakit}}</td>
                    <td>{{$rw->tanggal_dirawat}}</td>
                    <td>{{$rw->lama_rawat ? $rw->lama_rawat : '0'}} Hari</td>
                    <td>{{$rw->tindakan}}</td>
                    <td>{{$rw->obat ? $rw->obat : 'Tidak Ada'}}</td>
                    <td>{{$rw->keluhan}}</td>
                    <td>{{$rw->saran_medis}}</td>
                </tr>
            @endforeach
        </table>
    </form>
 
</body>
</html>