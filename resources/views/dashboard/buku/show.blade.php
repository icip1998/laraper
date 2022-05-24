@extends('dashboard.layouts.main')

@section('container')
    <div class="row pt-3 pb-2">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    Detail <?= $title ?>
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        <div class="mb-3 row">
                            <label for="judul" class="col-sm-2 col-form-label text-end">Judul <span class="text-danger">*</span> </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                                    value="{{ old('judul', $row->judul) }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kategori" class="col-sm-2 col-form-label text-end">Kategori <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control @error('kategori') is-invalid @enderror" name="kategori" disabled>
                                    <option value="">--Pilih Kategori---</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}" {{ ($item->id == $row->kategori_id ? 'selected' : '') }}>{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="isbn" class="col-sm-2 col-form-label text-end">ISBN <span class="text-danger">*</span> </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('isbn') is-invalid @enderror" name="isbn"
                                    value="{{ old('isbn', $row->isbn) }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="deskripsi" class="col-sm-2 col-form-label text-end">Deskripsi </label>
                            <div class="col-sm-5">
                                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" readonly>{{ old('deskripsi', $row->deskripsi) }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="pengarang" class="col-sm-2 col-form-label text-end">Pengarang <span class="text-danger">*</span> </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('pengarang') is-invalid @enderror"
                                    name="pengarang" value="{{ old('pengarang', $row->pengarang) }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="penerbit" class="col-sm-2 col-form-label text-end">Penerbit <span class="text-danger">*</span> </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('penerbit') is-invalid @enderror"
                                    name="penerbit" value="{{ old('penerbit', $row->penerbit->nama) }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tahun_terbit" class="col-sm-2 col-form-label text-end">Tahun terbit <span class="text-danger">*</span> </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('tahun_terbit') is-invalid @enderror"
                                    name="tahun_terbit" value="{{ old('tahun_terbit', $row->tahun_terbit) }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="jumlah_buku" class="col-sm-2 col-form-label text-end">Jumlah Buku <span class="text-danger">*</span> </label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control @error('jumlah_buku') is-invalid @enderror"
                                    name="jumlah_buku" value="{{ old('jumlah_buku', $row->jumlah_buku) }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="sampul" class="col-sm-2 col-form-label text-end">Sampul Buku <span class="text-danger">*</span> <small>(jpg,png,jpeg,gif,svg, max:2048)</small> </label>
                            <div class="col-sm-5">
                                <div class="border rounded mt-2 p-2">
                                    @if ($row->sampul)
                                        <img src="{{ asset('storage/'.$row->sampul_path) }}" alt="{{ $row->sampul }}" width="390" class="img-fluid"/>
                                    @else
                                        No Image
                                    @endif
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="col-md-10 offset-md-2">
                            <a href="{{ route('buku.index') }}" class="btn btn-md btn-secondary">kembali</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
