<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>No Rekam Medis</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>No. Telp</th>
            <th>Jenis Kelamin</th>
            <th>Golongan Darah</th>
            <th>Jenis Pendidikan</th>
        </tr>
    </thead>
    <tbody>
        @php 
            $no = 1;
        @endphp
        @foreach($data as $d)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$d->no_rekam_medis}}</td>
            <td>{{$d->nama}}</td>
            <td>{{$d->tanggal_lahir}}</td>
            <td>{{$d->alamat}}</td>
            <td>'{{$d->kontak}}</td>
            <td>{{$d->jenis_kelamin == 'l' ? 'Laki-Laki' : 'Perempuan'}}</td>
            <td>{{ucwords($d->gol_darah)}}</td>
            <td>{{$d->jenjang ? $d->jenjang->name : ''}}</td>
        </tr>
        <tr>
            <td colspan="9">Riwayat Penyakit</td>
        </tr>
        @endforeach
    </tbody>
</table>