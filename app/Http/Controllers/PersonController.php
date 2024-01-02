<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Menampilkan halaman person
     */
    public function index() {
        $person = Data::all();
        return view('person', compact('person'));
    }

    /**
     * Menambahkan data ke database
     */
    public function store(Request $request) {
        $data = Data::splitText($request->input('text'));
        if ($data == null) {
            return redirect()->back()->with('error', 'Format tidak sesuai');
        }
        Data::create($data);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }
}
