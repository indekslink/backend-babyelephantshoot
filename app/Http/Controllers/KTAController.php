<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class KTAController extends Controller
{
    public function index()
    {
        $users = auth()->user();

        $view = 'kta.user';

        if ($users->role->name == 'admin') {
            $view = 'kta.admin';
            $users = User::where('role_id', '!=', '1')->latest()->get();
        }

        return view($view, compact('users'));
    }
    public function scan(Request $request, $key)
    {
        $first_encode = base64_decode($key);
        $split = explode('@@', $first_encode);
        $username = base64_decode($split[0]);
        $nik_kta = base64_decode($split[1]);

        $view = 'kta.scan.null';



        $user = User::with('kta')->whereUsername($username)->whereHas('kta', function ($query) use ($nik_kta) {
            $query->whereNikKta($nik_kta);
        })->first();

        if (!$user) {
            return view($view);
        }


        $now = Carbon::now();
        $masa_berlaku = $user->kta->masa_berlaku;
        // $masa_berlaku = $now->subDay(1);
        $diff = $now->diffInDays($masa_berlaku, false);



        $view  = $diff > 0  ? 'kta.scan.success' : 'kta.scan.failed';


        return view($view, compact('user'));
    }

    public function stream($type)
    {

        $typ = ['landscape', 'potrait'];
        if (!in_array($type, $typ)) {
            return redirect('/kta');
        }

        $user = auth()->user();
        if ($user->role->name == 'admin') {
            return redirect()->back();
        }
        $barcode = base64_encode(base64_encode($user->username) . "@@" . base64_encode($user->kta->nik_kta));

        $qrcode = base64_encode(QrCode::size('60')->errorCorrection('H')->generate(route('scan_kta', $barcode)));

        $nama_lengkap = Str::limit($user->name, 30);
        $pdf = PDF::loadView('kta.file.' . $type, compact('user', 'qrcode', 'nama_lengkap'));
        return $pdf->setPaper('a4', $type)->stream('kta-' . $user->username . '-' . $type . '.pdf');
    }

    function change_download(Request $request)
    {
        $username = base64_decode($request->username);
        $download = $request->download;

        $msg = $download == '1' ? 'buka' : 'kunci';
        $user = User::whereUsername($username)->firstOrFail();
        $user->kta()->update(['download' => $download]);
        return response()->json([
            'msg' => $msg,
            'name' => $user->name
        ]);
    }
}
