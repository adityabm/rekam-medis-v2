<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Jenjang;
use App\User;

use DB;
use Auth;
use Hash;
use Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $total = Jenjang::leftJoin(DB::raw('(SELECT count(*) as jumlah,jenjang_id FROM pasien WHERE deleted_at IS NULL GROUP BY jenjang_id) as b'),'b.jenjang_id','=','jenjang.id')->get();

        $other = Pasien::whereNull('jenjang_id')->count();

        return view('home',compact('total','other'));
    }

    public function change()
    {
        return view('change');
    }

    public function changeProses(Request $request)
    {
        $lama = $request->pass_lama;
        $baru = $request->pass_baru;

        if (!Hash::check($lama, Auth::user()->password)){
            return response()->json(false);
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($baru);
        $user->save();

        return response()->json(true);
    }

    public function getData(Request $request)
    {
        $models = Pasien::with(['riwayat'])->leftJoin(DB::raw('(SELECT count(*) as jumlah,pasien_id FROM riwayat_pasien WHERE deleted_at IS NULL GROUP BY pasien_id) as b'),'b.pasien_id','=','pasien.id');
        $params = $request->get('params', false);
        $order  = $request->get('order', false);

        if ($params) {
            foreach ($params as $key => $val) {
                if ($val == '') continue;
                switch ($key) {
                    case 'jenjang_id':
                        if($val == 'no'){
                            $models = $models->whereNull('jenjang_id');
                        }else{
                            $models = $models->where($key, $val);
                        }
                        break;
                    default:
                        $models = $models->where($key, $val);
                        break;
                }
            }
        }

        $count = $models->count();

        $search = $request->get('search',false);
        if($search){
            $models = $models->where(function($q) use ($search){
                $q->where('nama','like',"%$search%")
                  ->orWhere('no_rekam_medis','like',"%$search%");
            });
        }

        if ($order) {
            $order_direction = $request->get('order_direction', 'asc');
            if (empty($order_direction)) $order_direction = 'asc';

            switch ($order) {
                default:
                    $models = $models->orderBy($order, $order_direction);
                    break;
            }
        }

        $page    = $request->get('page', 1);
        $perpage = count($models->get());

        $models = $models->skip(($page - 1) * $perpage)->take($perpage)->get();
        foreach ($models as &$model) {
        }

        $result = [
            'data'  => $models,
            'count' => $count
        ];

        return response()->json($result);
    }

    public function export(Request $request)
    {
        $id = $request->get('id',false);
        $models = Pasien::with(['riwayat','jenjang'])->leftJoin(DB::raw('(SELECT count(*) as jumlah,pasien_id FROM riwayat_pasien WHERE deleted_at IS NULL GROUP BY pasien_id) as b'),'b.pasien_id','=','pasien.id');
        $nama = '';
        if($id != 'no'){
            $jenj = Jenjang::find($id);
            $nama = "Rekam Medis Jenis Pendidikan ".$jenj ? $jenj->name : '';
            $models = $models->where('jenjang_id',$id);
        }else{
            $nama = "Rekam Medis Non Jenis Pendidikan";
            $models = $models->whereNull('jenjang_id');
        }

        $data = $models->get();

        Excel::create('Rekam Medis', function($excel) use ($data) {
            $excel->sheet('Rekam Medis Semua', function($sheet) use ($data) {
                $sheet->setWidth(array(
                    'A'     =>  8 * 1,
                    'B'     =>  16 * 1,
                    'C'     =>  37 * 1,
                    'D'     =>  18 * 1,
                    'E'     =>  37 * 1,
                    'F'     =>  27 * 1,
                    'G'     =>  13 * 1,
                    'H'     =>  13 * 1,
                    'I'     =>  39 * 1
                ));

                $sheet->setColumnFormat(array(
                    'F' => '@'
                ));

                $row = ["No.","No Rekam Medis","Nama","Tanggal Lahir","Alamat","No. Telp","Jenis Kelamin","Golongan Darah","Jenis Pendidikan"];
                $sheet->row(1, $row);
                // $sheet->mergeCells('A1:K2');
                $sheet->cell("A1:I1", function($cell) {
                    $cell->setValignment('center');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#000000');
                });

                $no = 1;
                $rr = 2;
                foreach($data as $d){
                    $row = [$no++,$d->no_rekam_medis,$d->nama,date('d F Y',strtotime($d->tanggal_lahir)),$d->alamat,"'".$d->kontak,($d->jenis_kelamin == 'l' ? 'Laki-Laki' : 'Perempuan'),ucwords($d->gol_darah),$d->jenjang ? $d->jenjang->name : ''];
                    $sheet->row($rr, $row);
                    $sheet->cell("A".$rr, function($cell) {
                        $cell->setAlignment('center');
                    });
                    $sheet->cell("B".$rr, function($cell) {
                        $cell->setAlignment('center');
                    });
                    $sheet->cell("D".$rr, function($cell) {
                        $cell->setAlignment('center');
                    });
                    $sheet->cell("G".$rr, function($cell) {
                        $cell->setAlignment('center');
                    });
                    $sheet->cell("H".$rr, function($cell) {
                        $cell->setAlignment('center');
                    });
                    
                    $rowss = $rr + 1;
                    $row = ["Riwayat Pasien"];
                    $sheet->row($rowss, $row);
                    $sheet->mergeCells('A'.$rowss.':I'.$rowss);
                    $sheet->cell('A'.$rowss.':I'.$rowss, function($cell) {
                        $cell->setValignment('center');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#000000');
                        $cell->setBackground('#EAEAEA');
                    });

                    $rowss += 1;
                    $row = ["No.","Diagnosa","","Tanggal Berkunjung","Lama Rawat","Tindakan","Obat","Keluhan","Saran Medis"];
                    $sheet->row($rowss, $row);
                    $sheet->cell('A'.$rowss.':I'.$rowss, function($cell) {
                        $cell->setValignment('center');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#000000');
                    });
                    $sheet->mergeCells('B'.$rowss.':C'.$rowss);
                    $sheet->cell('B'.$rowss.':C'.$rowss, function($cell) {
                        $cell->setValignment('center');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#000000');
                    });

                    if(count($d->riwayat) > 0){
                        $rowss += 1;
                        $nos = 1;
                        foreach($d->riwayat as $rw){
                            $row = [$nos++,$rw->diagnosa_sakit,"",date('d F Y',strtotime($rw->tanggal_dirawat)),$rw->lama_rawat,$rw->tindakan,$rw->obat,$rw->keluhan,$rw->saran_medis];
                            $sheet->row($rowss, $row);
                            $sheet->mergeCells('B'.$rowss.':C'.$rowss);

                            $sheet->cell("A".$rowss, function($cell) {
                                $cell->setAlignment('center');
                            });
                            $sheet->cell("D".$rowss, function($cell) {
                                $cell->setAlignment('center');
                            });
                            $sheet->cell("E".$rowss, function($cell) {
                                $cell->setAlignment('center');
                            });

                            $rowss++;
                        }
                    }

                    $rr = $rowss;
                }

                $sheet->getStyle('A1:I'.($rr - 1))->getAlignment()->setWrapText(true);
            });
            $excel->sheet('Pasien', function($sheet) use ($data) {
                $sheet->setWidth(array(
                    'A'     =>  8 * 1,
                    'B'     =>  16 * 1,
                    'C'     =>  37 * 1,
                    'D'     =>  18 * 1,
                    'E'     =>  37 * 1,
                    'F'     =>  27 * 1,
                    'G'     =>  13 * 1,
                    'H'     =>  13 * 1,
                    'I'     =>  39 * 1
                ));

                $sheet->setColumnFormat(array(
                    'F' => '@'
                ));

                $row = ["No.","No Rekam Medis","Nama","Tanggal Lahir","Alamat","No. Telp","Jenis Kelamin","Golongan Darah","Jenis Pendidikan"];
                $sheet->row(1, $row);
                // $sheet->mergeCells('A1:K2');
                $sheet->cell("A1:I1", function($cell) {
                    $cell->setValignment('center');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#000000');
                });

                $no = 1;
                $rr = 2;
                foreach($data as $d){
                    $row = [$no++,$d->no_rekam_medis,$d->nama,date('d F Y',strtotime($d->tanggal_lahir)),$d->alamat,"'".$d->kontak,($d->jenis_kelamin == 'l' ? 'Laki-Laki' : 'Perempuan'),ucwords($d->gol_darah),$d->jenjang ? $d->jenjang->name : ''];
                    $sheet->row($rr, $row);
                    $sheet->cell("A".$rr, function($cell) {
                        $cell->setAlignment('center');
                    });
                    $sheet->cell("B".$rr, function($cell) {
                        $cell->setAlignment('center');
                    });
                    $sheet->cell("D".$rr, function($cell) {
                        $cell->setAlignment('center');
                    });
                    $sheet->cell("G".$rr, function($cell) {
                        $cell->setAlignment('center');
                    });
                    $sheet->cell("H".$rr, function($cell) {
                        $cell->setAlignment('center');
                    });
                    
                    $rr++;
                }

                $sheet->getStyle('A1:I'.($rr - 1))->getAlignment()->setWrapText(true);
            });
        })->download('xlsx');
    }
}
