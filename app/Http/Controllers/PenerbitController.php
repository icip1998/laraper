<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
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
            $data = Penerbit::where(function ($query) use ($search){
                $query->where('penerbit', 'like', '%'.$search.'%');
            })
            ->paginate(2);
            $data->appends(['q' => $search]);
        }
        else{
            $data = Penerbit::paginate(2);
        }

        return view('dashboard.penerbit.index', [
            'title' => 'Penerbit Buku',
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
        
        return view('dashboard.penerbit.create',[
            'title' => 'Penerbit Buku'
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
            'penerbit' => 'required|string'
        ]);

        $penerbit = Penerbit::create([
            'nama' => $request->penerbit,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp
        ]);

        if ($penerbit) {
            return redirect()
                ->route('penerbit.index')
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
        
        $row = Penerbit::findOrFail($id);

        return view('dashboard.penerbit.edit',[
            'title' => 'Penerbit Buku',
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
            'penerbit' => 'required|string'
        ]);

        $penerbit = Penerbit::findOrFail($id);

        $penerbit->update([
            'nama' => $request->penerbit,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp
        ]);

        if ($penerbit) {
            return redirect()
                ->route('penerbit.index')
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
        
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();

        if ($penerbit) {
            return redirect()
                ->route('penerbit.index')
                ->with([
                    'success' => 'Berhasil dihapus!'
                ]);
        } else {
            return redirect()
                ->route('penerbit.index')
                ->with([
                    'error' => 'Oops!, something went wrong please try again!'
                ]);
        }
    }
}
