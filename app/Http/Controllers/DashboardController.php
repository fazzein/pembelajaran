<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        [$view, $data] = $this->getDashboardViewByRole($user);
        return view($view, $data);

    }

    private function getDashboardViewByRole($user)
    {
        if ($user->hasRole('perusahaan')) {
            return ['pages.dashboard.perusahaan',[]];
        }
        if ($user->hasRole('pembimbing')) {
            return ['pages.dashboard.pembimbing', []];
        }
        if ($user->hasRole('siswa')) {
            $data = Pendaftaran::query()
            ->select('aa.nama_instansi','cc.name as nama_pembimbing')
            ->leftJoin('perusahaans as aa','aa.id','=','pendaftaran_pkl.perusahaan_id')
            ->leftJoin('users as bb','bb.id','=','aa.user_id')
            ->leftJoin('users as cc','cc.id','=','pendaftaran_pkl.guru_pembimbing_id')
            ->where('pendaftaran_pkl.status_id',2)
            ->where('pendaftaran_pkl.status2_id',2)
            ->first();
            $totalKegiatan = Kegiatan::where('user_id',auth()->user()->id)->count();
            $approvedKegiatan = Kegiatan::where('user_id',auth()->user()->id)->where('status', 2)->count();
            $unapprovedKegiatan = Kegiatan::where('user_id',auth()->user()->id)->where('status', 1)->count();
            return ['pages.dashboard.siswa', [
                'totalKegitan' => $totalKegiatan,
                'approve' => $approvedKegiatan,
                'belumapprove' => $unapprovedKegiatan,
                'data' => $data
            ]];
        }
        $totaluser = User::count();
        return ['dashboard',[
            'totaluser' => $totaluser,
        ]];
    }


    public function getDataLeader(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $pendaftranData = Pendaftaran::selectRaw('DAY(created_at) as day, COUNT(*) as count')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();
        
        $jumlahSiswa = User::role('siswa')->count();
        $jumlahPembimbing = User::role('pembimbing')->count();
        $jumlahPerusahaan = Perusahaan::count();

        $pendaftranData = $this->reformatDataKeys($pendaftranData);

        $jumlahPemasangan = array_sum($pendaftranData);

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        $days = array_map(function($day) {
            return str_pad($day, 2, '0', STR_PAD_LEFT);
        }, range(1, $daysInMonth));

        return response()->json([
            'siswa' => $jumlahSiswa,
            'pembimbing' => $jumlahPembimbing,
            'perusahaan' => $jumlahPerusahaan,
            'pendaftranData' => $pendaftranData,
            'labels' => $days,
        ]);
    }

    private function reformatDataKeys($data)
    {
        $formattedData = [];
        foreach ($data as $key => $value) {
            $formattedData[str_pad($key, 2, '0', STR_PAD_LEFT)] = $value;
        }
        return $formattedData;
    }


    public function getPersentase(Request $request)
    {
        $totalApproved = Kegiatan::where('status', 2)
        ->where('user_id', auth()->user()->id)
        ->count();
        $totalKegiatan = 40;
        $totalPersentase = ($totalApproved / $totalKegiatan) * 100;
        return response()->json(['totalPersentase' => $totalPersentase]);
    }
}
