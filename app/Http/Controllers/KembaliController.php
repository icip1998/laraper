<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\User;
use Illuminate\Http\Request;

class KembaliController extends Controller
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
                        ->where('status', '=', 'Dikembalikan')
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
                        ->where('status', '=', 'Dikembalikan')
                        ->groupBy('pinjam_id', 'user_id', 'tgl_pinjam', 'tgl_balik', 'status')
                        ->paginate(2);
            
            if ($role !== 'admin') {
                $data->where('user_id', '=', $user_id);
            }
        }
        
        return view('dashboard.kembali.index', [
            'title' => 'Pengembalian',
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
                        ->where('status', '=', 'Dikembalikan')
                        ->firstOrFail();
        if ($role != 'admin') {
            $row->where('user_id', '=', $user_id);
        }

        $row_buku = Pinjam::where('pinjam_id', '=', $id)
                        ->where('status', '=', 'Dikembalikan')
                        ->get();
        if ($role != 'admin') {
            $row_buku->where('user_id', '=', $user_id);
        }
        
        $users = User::where('role', '!=', 'admin')->get();
        $bukus = Buku::all();

        $bukuitemIds = [];
        foreach ($row_buku as $item) {
            $bukuitemIds[] = $item->buku_id;
        }

        return view('dashboard.kembali.show',[
            'title' => 'Pengembalian',
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
