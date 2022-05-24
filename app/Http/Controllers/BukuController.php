<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request) 
    {
        $search =  $request->input('q');
        if($search!=""){
            $data = Buku::where(function ($query) use ($search){
                $query->where('judul', 'like', '%'.$search.'%')
                    ->orWhere('isbn', 'like', '%'.$search.'%');
            })
            ->paginate(2);
            $data->appends(['q' => $search]);
        }
        else{
            $data = Buku::paginate(2);
        }
        return view('dashboard.buku.index', [
            'title' => 'Buku',
            'data' => $data
        ]);
    }

    public function create()
    {
        $this->authorize('isAdmin');
        
        $kategori = kategori::all();
        $penerbit = Penerbit::all();

        return view('dashboard.buku.create',[
            'title' => 'Buku',
            'kategori' => $kategori,
            'penerbit' => $penerbit,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');
        
        $this->validate($request, [
            'kategori' => 'required',
            'judul' => 'required|string',
            'isbn' => 'required|string',
            'pengarang' => 'required|string',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'required',
            'jumlah_buku' => 'required',
            'sampul' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file_name = $request->file('sampul')->getClientOriginalName();
        $file_path = $request->file('sampul')->store('img');

        $buku = Buku::create([
            'kategori_id' => $request->kategori,
            'penerbit_id' => $request->penerbit,
            'judul' => $request->judul,
            'isbn' => $request->isbn,
            'deskripsi' => $request->deskripsi,
            'pengarang' => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah_buku' => $request->jumlah_buku,
            'sampul' => $file_name,
            'sampul_path' => $file_path
        ]);

        if ($buku) {
            return redirect()
                ->route('buku.index')
                ->with([
                    'success' => 'Berhasil dibuat!'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Oops!, something went wrong please try again!'
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Buku::findOrFail($id);
        $kategori = kategori::all();

        return view('dashboard.buku.show',[
            'title' => 'Buku',
            'row' => $row,
            'kategori' => $kategori
        ]);
    }

    public function edit($id)
    {
        $this->authorize('isAdmin');
        
        $row = Buku::findOrFail($id);
        $kategori = kategori::all();
        $penerbit = Penerbit::all();

        return view('dashboard.buku.edit',[
            'title' => 'Buku',
            'row' => $row,
            'kategori' => $kategori,
            'penerbit' => $penerbit
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin');
        
        $this->validate($request, [
            'kategori' => 'required',
            'judul' => 'required|string',
            'isbn' => 'required|string',
            'pengarang' => 'required|string',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'required',
            'jumlah_buku' => 'required',
            'sampul' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $buku = Buku::findOrFail($id);

        $data = [
            'kategori_id' => $request->kategori,
            'penerbit_id' => $request->penerbit,
            'judul' => $request->judul,
            'isbn' => $request->isbn,
            'deskripsi' => $request->deskripsi,
            'pengarang' => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah_buku' => $request->jumlah_buku
        ];
        
        if ($request->file('sampul')) {
            $file_name = $request->file('sampul')->getClientOriginalName();
            $file_path = $request->file('sampul')->store('img');
            
            $data['sampul'] = $file_name;
            $data['sampul_path'] = $file_path;
        }

        $buku->update($data);

        if ($buku) {
            return redirect()
                ->route('buku.index')
                ->with([
                    'success' => 'Berhasil diupdate!'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Oops!, something went wrong please try again!'
                ]);
        }
    }

    public function destroy($id)
    {
        $this->authorize('isAdmin');
        
        $buku = Buku::findOrFail($id);
        $buku->delete();

        if ($buku) {
            return redirect()
                ->route('buku.index')
                ->with([
                    'success' => 'Berhasil dihapus!'
                ]);
        } else {
            return redirect()
                ->route('buku.index')
                ->with([
                    'error' => 'Oops!, something went wrong please try again!'
                ]);
        }
    }
    
}
