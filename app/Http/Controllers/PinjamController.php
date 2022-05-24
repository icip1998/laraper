<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\User;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $role = auth()->user()->role;

        $search =  $request->input('q');
        if($search!=""){
            $data = Pinjam::distinct()
                        ->select('pinjam_id', 'user_id', 'tgl_pinjam', 'tgl_balik', 'status')
                        ->groupBy('pinjam_id', 'user_id', 'tgl_pinjam', 'tgl_balik', 'status')
                        ->where('status', '=', 'Dipinjam')
                        ->where(function ($query) use ($search){
                $query->where('pinjam_id', 'like', '%'.$search.'%');
            })
            ->paginate(2);
            if ($role !== 'admin') {
                $data->where('user_id', '=', $user_id);
            }
            $data->appends(['q' => $search]);
        }
        else{
            $data = Pinjam::distinct()
                    ->select('pinjam_id', 'user_id', 'tgl_pinjam', 'tgl_balik', 'status')
                    ->where('status', '=', 'Dipinjam')
                    ->groupBy('pinjam_id', 'user_id', 'tgl_pinjam', 'tgl_balik', 'status')
                    ->paginate(2);
            if ($role !== 'admin') {
                $data->where('user_id', '=', $user_id);
            }
        }
        
        return view('dashboard.pinjam.index', [
            'title' => 'Pinjam',
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
        
        $users = User::where('role', '!=', 'admin')->get();
        $bukus = Buku::all();
        
        return view('dashboard.pinjam.create', [
            'title' => 'Pinjam',
            'row' => array(
                'id' => uniqid()
            ),
            'users' => $users,
            'bukus' => $bukus
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
            'id' => 'required',
            'pengguna' => 'required',
            'tgl_pinjam' => 'required|date',
            'lama_pinjam' => 'required',
            'buku' => 'required'
        ]);

        $lama_pinjam = $request->lama_pinjam;
        $tgl_pinjam = $request->tgl_pinjam;
        $tgl_balik = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($tgl_pinjam)) . ' +'.$lama_pinjam.' day'));

        $buku = $request->buku;

        foreach ($buku as $item) {
            $pinjam = Pinjam::create([
                'pinjam_id' => $request->id,
                'user_id' => $request->pengguna,
                'tgl_pinjam' => $tgl_pinjam,
                'lama_pinjam' => $lama_pinjam,
                'tgl_balik' => $tgl_balik,
                'buku_id' => $item
            ]);
        }

        if ($pinjam) {
            return redirect()
                ->route('pinjam.index')
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
        $user_id = auth()->user()->id;
        $role = auth()->user()->role;
        
        $row = Pinjam::where('pinjam_id', '=', $id)
                        ->where('status', '=', 'Dipinjam')
                        ->firstOrFail();
        if ($role !== 'admin') {
            $row->where('user_id', '=', $user_id);
        }
        $row_buku = Pinjam::where('pinjam_id', '=', $id)
                        ->where('status', '=', 'Dipinjam')
                        ->get();
        if ($role !== 'admin') {
            $row_buku->where('user_id', '=', $user_id);
        }

        $users = User::where('role', '!=', 'admin')->get();
        $bukus = Buku::all();

        $bukuitemIds = [];
        foreach ($row_buku as $item) {
            $bukuitemIds[] = $item->buku_id;
        }

        return view('dashboard.pinjam.show',[
            'title' => 'Pinjam',
            'row' => $row,
            'bukuitemIds' => $bukuitemIds,
            'users' => $users,
            'bukus' => $bukus
        ]);
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

        $row = Pinjam::where('pinjam_id', '=', $id)
                        ->where('status', '=', 'Dipinjam')
                        ->firstOrFail();
        $row_buku = Pinjam::where('pinjam_id', '=', $id)
                        ->where('status', '=', 'Dipinjam')
                        ->get();
        $users = User::where('role', '!=', 'admin')->get();
        $bukus = Buku::all();

        $bukuitemIds = [];
        foreach ($row_buku as $item) {
            $bukuitemIds[] = $item->buku_id;
        }

        return view('dashboard.pinjam.edit',[
            'title' => 'Pinjam',
            'row' => $row,
            'bukuitemIds' => $bukuitemIds,
            'users' => $users,
            'bukus' => $bukus
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

        $pinjam = Pinjam::where('pinjam_id', '=', $id);
        
        $pinjam->update([
            'status' => 'Dikembalikan',
            'tgl_kembali' => date('Y-m-d')
        ], );

        if ($pinjam) {
            return redirect()
                ->route('pinjam.index')
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

        $pinjam = Pinjam::where('pinjam_id', '=', $id);
        $pinjam->delete();

        if ($pinjam) {
            return redirect()
                ->route('pinjam.index')
                ->with([
                    'success' => 'Berhasil dihapus!'
                ]);
        } else {
            return redirect()
                ->route('pinjam.index')
                ->with([
                    'error' => 'Oops!, something went wrong please try again!'
                ]);
        }
    }
}
