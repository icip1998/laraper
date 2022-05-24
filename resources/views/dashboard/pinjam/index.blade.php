@extends('dashboard.layouts.main')

@section('container')
    <div class="row pt-3 pb-2">
        <div class="col-md-12">
            
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card ">
                <div class="card-header">
                    Daftar <?= $title ?>
                </div>
                <div class="card-body">
                    @can('isAdmin')
                        <a href="{{ route('pinjam.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah</a>
                    @endcan

                    <form action="">
                        <div class="input-group mb-3">
                            <input type="text" name="q" class="form-control" placeholder="keyword..." aria-label="keyword..." aria-describedby="button-addon-search" value="{{ app('request')->input('q') }}">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon-search">Search</button>
                        </div>
                    </form>

                    <table class="table table-striped table-hover mt-1">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tangal Peminjaman</th>
                                <th scope="col">Tanggal Pengembalian</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $row)
                                <tr>
                                    <td>{{ $row->pinjam_id }}</td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ date('m-d-Y', strtotime($row->tgl_pinjam)) }}</td>
                                    <td>{{ date('m-d-Y', strtotime($row->tgl_balik)) }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                @can('isAdmin')
                                                    <li><a class="dropdown-item" href="{{route('pinjam.edit', $row->pinjam_id)}}">Kembalikan</a></li>
                                                @endcan
                                                <li><a class="dropdown-item" href="{{route('pinjam.show', $row->pinjam_id)}}">Detail</a></li>
                                                @can('isAdmin')
                                                    <li>
                                                        <form action="{{ route('pinjam.destroy', $row->pinjam_id) }}"
                                                            class="pull-left" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item"
                                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center text-mute" colspan="6">Data buku tidak tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
