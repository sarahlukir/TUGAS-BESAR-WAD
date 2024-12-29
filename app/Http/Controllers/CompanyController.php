<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    // Form untuk mendaftarkan perusahaan
    public function create()
    {
        return view('companies.create');
    }

    // Proses pendaftaran perusahaan
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'description' => 'nullable|string|max:1000',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi logo
        ]);

        $user = Auth::user();

        // Menyimpan logo ke storage dan mendapatkan path-nya
        $logoPath = $request->file('logo')->store('company_logos', 'public');

        // Menggunakan Company::create untuk menyimpan data perusahaan
        Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'user_id' => $user->id, // Menyertakan user_id
            'logo' => $logoPath, // Menyimpan path logo
        ]);

        return redirect()->route('companies.index')->with('success', 'Perusahaan berhasil didaftarkan!');
    }

    // Daftar perusahaan yang diajukan user
    public function index()
    {
        // Ambil perusahaan yang dimiliki oleh user yang sedang login
        $company = Company::where('user_id', Auth::id())->first();

        // Jika perusahaan sudah disetujui, redirect ke route 'companies.settings'
        if ($company && $company->status === 'approved') {
            return redirect()->route('companies.settings', ['company' => $company->id]);
        }

        // Jika belum disetujui, tampilkan daftar perusahaan
        $companies = Company::where('user_id', Auth::id())->get();
        return view('companies.index', compact('companies'));
    }

    // Admin: Kelola pengajuan perusahaan
    public function adminIndex()
    {
        $companies = Company::where('status', 'pending')->get();
        return view('admin.companies.index', compact('companies'));
    }

    public function updateStatus(Request $request, Company $company)
    {
        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Validasi input
            $request->validate([
                'status' => 'required|in:approved,rejected',
            ]);

            // Update status perusahaan
            $company->update(['status' => $request->status]);

            // Jika status perusahaan disetujui, ubah role pengguna menjadi 'employee'
            if ($request->status === 'approved') {
                $user = $company->user;
                if ($user && $user->role !== 'employee') {
                    $user->update(['role' => 'employee']);
                }
            }

            DB::commit();

            return back()->with('success', 'Status perusahaan berhasil diperbarui.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollback();

            // Tangani error
            return redirect()->route('admin.companies.index')->with('error', 'Terjadi kesalahan saat memperbarui status perusahaan.');
        }
    }

    // Form untuk mengedit perusahaan
    public function edit(Company $company)
    {
        // Memastikan user hanya dapat mengedit perusahaan mereka sendiri
        if ($company->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('companies.edit', compact('company'));
    }

    // Proses update data perusahaan
    public function update(Request $request, Company $company)
    {
        // Periksa apakah user memiliki otorisasi untuk mengedit perusahaan ini
        if ($company->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'address' => 'string|max:500',
            'description' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Jika ada file logo baru, simpan dan hapus logo lama (jika ada)
        if ($request->hasFile('logo')) {
            if ($company->logo && \Storage::exists('public/' . $company->logo)) {
                \Storage::delete('public/' . $company->logo);
            }

            $validatedData['logo'] = $request->file('logo')->store('company_logos', 'public');
        }

        // Update perusahaan dengan data yang sudah divalidasi
        $company->update($validatedData);

        // Redirect dengan pesan sukses
        return back()->with('success', 'Data perusahaan berhasil diperbarui!');
    }

    public function destroy(Company $company)
    {
        // Pastikan hanya user yang terkait yang bisa menghapus perusahaan ini
        if ($company->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus logo perusahaan jika ada
        if ($company->logo && Storage::exists('public/' . $company->logo)) {
            Storage::delete('public/' . $company->logo);
        }

        $user = $company->user;
        if ($user && $user->role == 'employee') {
            $user->update(['role' => 'user']);
        }

        // Hapus data perusahaan
        $company->delete();

        // Redirect dengan pesan sukses setelah penghapusan
        return redirect()->route('companies.index')->with('success', 'Perusahaan berhasil dihapus!');
    }
}
