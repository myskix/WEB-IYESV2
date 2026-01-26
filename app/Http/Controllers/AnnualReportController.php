<?php

namespace App\Http\Controllers;

use App\Models\AnnualReport;
use Illuminate\Support\Facades\Storage;

class AnnualReportController extends Controller
{
    public function index()
    {
        $reports = AnnualReport::orderBy('year', 'desc')->get();
        return view('annual-report.index', compact('reports'));
    }

    public function download($id)
    {
        $report = AnnualReport::findOrFail($id);

        // UBAH DARI 'file_document' KE 'file_path'
        if (empty($report->file_path)) {
            abort(404, 'Dokumen PDF belum diunggah.');
        }

        if (!Storage::disk('public')->exists($report->file_path)) {
            abort(404, 'File fisik tidak ditemukan.');
        }

        return Storage::disk('public')->download(
            $report->file_path, // Ganti ini
            'Annual Report IYES ' . $report->year . '.pdf'
        );
    }
}