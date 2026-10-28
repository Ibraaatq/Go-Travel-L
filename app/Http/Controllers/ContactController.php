<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a newly created contact message in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required_without:nama_lengkap|nullable|string|max:255',
            'nama_lengkap'  => 'required_without:name|nullable|string|max:255',
            'phone'         => 'required_without:nomor_telepon|nullable|string|max:50',
            'nomor_telepon' => 'required_without:phone|nullable|string|max:50',
            'email'         => 'required|email|max:255',
            'message'       => 'required_without:pesan|nullable|string',
            'pesan'         => 'required_without:message|nullable|string',
        ], [
            'name.required_without'          => 'Nama lengkap wajib diisi.',
            'nama_lengkap.required_without'  => 'Nama lengkap wajib diisi.',
            'phone.required_without'         => 'Nomor telepon wajib diisi.',
            'nomor_telepon.required_without' => 'Nomor telepon wajib diisi.',
            'email.required'                 => 'Email wajib diisi.',
            'email.email'                    => 'Format email tidak valid.',
            'message.required_without'       => 'Pesan wajib diisi.',
            'pesan.required_without'         => 'Pesan wajib diisi.',
        ]);

        $name = $request->input('name', $request->input('nama_lengkap'));
        $phone = $request->input('phone', $request->input('nomor_telepon'));
        $email = $request->input('email');
        $message = $request->input('message', $request->input('pesan'));

        $contact = Contact::create([
            'name'          => $name,
            'phone'         => $phone,
            'email'         => $email,
            'message'       => $message,
            'nama_lengkap'  => $name,
            'nomor_telepon' => $phone,
            'pesan'         => $message,
        ]);

        $successMessage = 'Pesan Anda berhasil dikirim! Tim Go Travel akan segera menghubungi Anda.';

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage,
                'contact' => $contact,
            ]);
        }

        return redirect()->back()->with('success', $successMessage);
    }
}
