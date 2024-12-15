<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Carbon\Carbon; // Impor Carbon dengan benar

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // Mendapatkan input pencarian jika ada
        $startDate = $request->input('start_date'); // Mendapatkan input tanggal mulai
        $endDate = $request->input('end_date'); // Mendapatkan input tanggal akhir

        // Menggunakan Carbon untuk memanipulasi tanggal
        $startDate = $startDate ? Carbon::parse($startDate)->startOfDay() : null;
        $endDate = $endDate ? Carbon::parse($endDate)->endOfDay() : null;

        $reports = Report::with(['product', 'user']) // Relasi
            ->join('products', 'reports.product_id', '=', 'products.id') // Join dengan tabel products
            ->join('users', 'reports.user_id', '=', 'users.id') // Join dengan tabel users
            ->when($search, function ($query, $search) {
                return $query->where('products.nama', 'like', "%{$search}%") // Pencarian pada kolom nama di tabel products
                    ->orWhere('users.name', 'like', "%{$search}%"); // Pencarian pada kolom name di tabel users
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('reports.created_at', [$startDate, $endDate]); // Filter berdasarkan rentang tanggal
            })
            ->orderBy('reports.created_at', 'desc') // Menambahkan alias pada order by
            ->select('reports.*', 'products.nama as product_name', 'users.name as user_name') // Menambahkan kolom yang ingin dipilih
            ->paginate(10);

        return view('report.index', compact('reports'));
    }
}
