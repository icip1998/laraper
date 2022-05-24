@extends('dashboard.layouts.main')

@section('container')
    <div class="row pt-3 pb-2">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    Tambah <?= $title ?>
                </div>
                <div class="card-body">
                    <form action="{{ route('pinjam.store') }}" method="POST">
                        @csrf

                        <div class="mb-3 row">
                            <label for="id" class="col-sm-2 col-form-label text-end">ID <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id', $row['id']) }}" readonly>
                                
                                @error('id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="pengguna" class="col-sm-2 col-form-label text-end">Pengguna <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control select2 @error('pengguna') is-invalid @enderror" name="pengguna">
                                    <option value="">--Pilih Pengguna---</option>
                                    @foreach ($users as $item)
                                        @if (old('pengguna') == $item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->username.' - '.$item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->username.' - '.$item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                
                                @error('pengguna')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tgl_pinjam" class="col-sm-2 col-form-label text-end">Tgl Peminjaman <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control @error('tgl_pinjam') is-invalid @enderror" name="tgl_pinjam" value="{{ old('tgl_pinjam') }}" >
                                
                                @error('tgl_pinjam')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="lama_pinjam" class="col-sm-2 col-form-label text-end">Lama Peminjaman <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control @error('lama_pinjam') is-invalid @enderror" name="lama_pinjam" value="{{ old('lama_pinjam') }}" >

                                @error('lama_pinjam')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="buku" class="col-sm-2 col-form-label text-end">Buku <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control select2 @error('buku') is-invalid @enderror" name="buku[]" multiple="multiple">
                                    <option value="">--Pilih Buku---</option>
                                    @foreach ($bukus as $item)
                                        @if (old('buku') == $item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->judul }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                
                                @error('buku')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <div class="col-md-10 offset-md-2">
                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            <a href="{{ route('pinjam.index') }}" class="btn btn-md btn-secondary">kembali</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection