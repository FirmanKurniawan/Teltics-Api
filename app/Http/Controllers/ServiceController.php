<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all(['link', 'judul']);
        return response()->json(['services' => $services]);
    }

    public function show($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Layanan tidak ditemukan'], 404);
        }

        return response()->json(['service' => $service]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'link' => 'required|unique:services',
        ]);

        $service = new Service();
        $service->judul = $request->input('judul');
        $service->link = $request->input('link');

        $service->save();

        return response()->json(['message' => 'Layanan berhasil ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'link' => 'required|unique:services,link,' . $id,
        ]);

        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Layanan tidak ditemukan'], 404);
        }

        $service->judul = $request->input('judul');
        $service->link = $request->input('link');

        $service->save();

        return response()->json(['message' => 'Layanan berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Layanan tidak ditemukan'], 404);
        }

        $service->delete();

        return response()->json(['message' => 'Layanan berhasil dihapus']);
    }
}
