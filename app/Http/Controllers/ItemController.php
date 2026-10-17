<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    // READ: Menampilkan halaman tabel utama
    public function index()
    {
        $items = Item::latest()->get();
        return view('items.index', compact('items'));
    }

    // CREATE: Menyimpan data baru + Upload Gambar
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'status'   => 'required|string|max:50',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Asset successfully created!');
    }

    // Menampilkan halaman Edit
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    // UPDATE: Memperbarui data & mengganti gambar jika ada gambar baru
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'status'   => 'required|string|max:50',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Asset successfully updated!');
    }

    // DELETE: Menghapus data beserta file gambarnya
    public function destroy(Item $item)
    {
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Asset successfully deleted!');
    }

    // BONUS POINT: Endpoint API (Mengembalikan data dalam bentuk JSON)
    public function apiIndex()
    {
        return response()->json([
            'status'  => 'success',
            'message' => 'IT Asset Inventory API Data',
            'data'    => Item::latest()->get()
        ], 200);
    }
}