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
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string',
        ]);

        $contact = Contact::create($validated);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan Anda berhasil dikirim! Tim Go Travel akan segera menghubungi Anda.',
                'contact' => $contact,
            ]);
        }

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim!');
    }
}
