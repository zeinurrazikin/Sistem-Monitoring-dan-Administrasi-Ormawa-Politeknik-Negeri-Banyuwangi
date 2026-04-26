<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdministrationController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $submissions = Submission::where('user_id', $user_id)->latest()->paginate(5);
        
        $stats = [
            'total' => Submission::where('user_id', $user_id)->count(),
            'revisi' => Submission::where('user_id', $user_id)->where('status', 'Revisi')->count(),
            'disetujui' => Submission::where('user_id', $user_id)->where('status', 'Disetujui')->count(),
        ];

        return view('dashboard.administrasi', compact('submissions', 'stats'));
    }

    public function create()
    {
        return view('dashboard.create_surat');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'jenis_surat' => 'required|string',
            'tanggal_pengajuan' => 'required|date',
            'file_dokumen' => 'required|mimes:pdf,docx|max:10240',
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi.',
            'jenis_surat.required' => 'Jenis surat wajib diisi.',
            'tanggal_pengajuan.required' => 'Tanggal pengajuan wajib diisi.',
            'file_dokumen.required' => 'Dokumen lampiran wajib diunggah.',
            'file_dokumen.mimes' => 'Format berkas harus berupa PDF atau DOCX.',
            'file_dokumen.max' => 'Ukuran berkas maksimal adalah 10MB.'
        ]);

        $path = $request->file('file_dokumen')->store('submissions', 'public');

        Submission::create([
            'user_id' => Auth::id(),
            'nama_kegiatan' => $request->nama_kegiatan,
            'jenis_surat' => $request->jenis_surat,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'keterangan' => $request->keterangan,
            'file_path' => $path,
            'status' => 'Diajukan'
        ]);

        return redirect()->route('administrasi.index')->with('notification', [
            'title' => 'Surat Diajukan',
            'message' => 'Surat untuk "' . $request->nama_kegiatan . '" berhasil dikirim ke Admin.',
            'type' => 'success',
            'icon' => 'send'
        ]);
    }

    public function updateRevision(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        
        $request->validate([
            'file_revisi' => 'required|mimes:pdf,docx|max:10240'
        ], [
            'file_revisi.required' => 'Berkas revisi wajib diunggah.',
            'file_revisi.mimes' => 'Format berkas harus berupa PDF atau DOCX.',
            'file_revisi.max' => 'Ukuran berkas maksimal adalah 10MB.'
        ]);

        if ($submission->file_path) {
            Storage::disk('public')->delete($submission->file_path);
        }

        $path = $request->file('file_revisi')->store('submissions', 'public');

        $submission->update([
            'file_path' => $path,
            'status' => 'Diajukan'
        ]);

        return redirect()->route('administrasi.index')->with('notification', [
            'title' => 'Revisi Terkirim',
            'message' => 'Dokumen revisi berhasil diunggah ulang.',
            'type' => 'info',
            'icon' => 'cloud_done'
        ]);
    }

    public function destroy($id)
    {
        $submission = Submission::where('user_id', Auth::id())->findOrFail($id);
        
        if ($submission->file_path) {
            Storage::disk('public')->delete($submission->file_path);
        }

        $submission->delete();

        return redirect()->route('administrasi.index')->with('notification', [
            'title' => 'Data Dihapus',
            'message' => 'Pengajuan berhasil dihapus dari sistem.',
            'type' => 'danger',
            'icon' => 'delete_sweep'
        ]);
    }
}
