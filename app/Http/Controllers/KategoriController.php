<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('isAdmin');
        
        $search =  $request->input('q');
        if($search!=""){
            $data = kategori::where(function ($query) use ($search){
                $query->where('nama', 'like', '%'.$search.'%');
            })
            ->paginate(2);
            $data->appends(['q' => $search]);
        }
        else{
            $data = kategori::paginate(2);
        }

        return view('dashboard.kategori.index', [
            'title' => 'Kategori Buku',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin');
        
        return view('dashboard.kategori.create',[
            'title' => 'Kategori Buku'
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
            'kategori' => 'required|string'
        ]);

        $kategori = kategori::create([
            'nama' => $request->kategori,
            'slug' => Str::slug($request->kategori)
        ]);

        if ($kategori) {
            return redirect()
                ->route('kategori.index')
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
        $this->authorize('isAdmin');
        
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('isAdmin');
        
        $row = kategori::findOrFail($id);

        return view('dashboard.kategori.edit',[
            'title' => 'Kategori Buku',
            'row' => $row
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin');
        
        $this->validate($request, [
            'kategori' => 'required|string'
        ]);

        $kategori = kategori::findOrFail($id);

        $kategori->update([
            'nama' => $request->kategori,
            'slug' => Str::slug($request->kategori)
        ]);

        if ($kategori) {
            return redirect()
                ->route('kategori.index')
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        
        $kategori = kategori::findOrFail($id);
        $kategori->delete();

        if ($kategori) {
            return redirect()
                ->route('kategori.index')
                ->with([
                    'success' => 'Berhasil dihapus!'
                ]);
        } else {
            return redirect()
                ->route('kategori.index')
                ->with([
                    'error' => 'Oops!, something went wrong please try again!'
                ]);
        }
    }
}
