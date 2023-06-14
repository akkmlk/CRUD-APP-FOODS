@extends('layout.template')
@section('konten')
{{-- @if ($errors->any())
    <div class="pt-3">
        <div class="alert alert-danger">
            <ol>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>
        </div>
    </div>
@endif --}}

    <form action="{{ url('makanan') }}" method="POST" enctype="multipart/form-data" class="p-3 rounded" style="background: rgb(205, 252, 229)">
        @csrf
        <div class="d-flex justify-content-center">
            <h2 style="color: rgb(123, 248, 186)">Tambah Data</h2>
        </div>
        <div class="mt-2 p-3 bg-body rounded shadow-sm">
            <div class="mb-2 row">
                <label for="name" class="col-sm-2 col-form-label" style="font-weight: bold">NAMA</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama Makanan" value="{{ Session::get('name') }}">

                    {{-- Untuk Menampilkan Message Error Name --}}
                    @error('name')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

            <div class="mb-2 row">
                <label for="price" class="col-sm-2 col-form-label" style="font-weight: bold">PRICE</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="price" id="price" placeholder="Masukkan Harga Makanan" value="{{ Session::get('price') }}">

                    {{-- Untuk Menampilkan Message Error Price --}}
                    @error('price')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-2 row">
                <label for="description" class="col-sm-2 col-form-label" style="font-weight: bold" >DESCRIPTION</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="Masukkan Deskripsi"></textarea>

                    {{-- Untuk Menampilkan Message Error Description --}}
                    @error('description')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

            <div class="mb-2 row">
                <label for="qty" class="col-sm-2 col-form-label" style="font-weight: bold" >QTY</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="qty" id="qty" placeholder="Masukkan Quantity" value="{{ Session::get('qty') }}">

                    {{-- Untuk Menampilkan Message Error Qty --}}
                    @error('qty')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

            <div class="mb-2 row">
                <label for="" class="col-sm-2 col-form-label" style="font-weight: bold">GAMBAR</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="image" id="">

                    {{-- Messsage Untuk Menampilkan Error Image --}}
                    @error('image')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>
        </div>

        <div class="d-flex bd-highlight bg-body mt-3 p-1 rounded shadow">
            <div class="p-2 flex-grow-1">
                <button class="btn btn-outline-primary" type="submit">SIMPAN</button>
            </div>
            <div class="p-2 bd-highlight">
                <button class="btn btn-outline-danger" type="reset">RESET</button>
            </div>
            <div class="p-2 bd-hightlight">
                <a href="{{ url('makanan') }}" class="btn btn-outline-warning">KEMBALI</a>
            </div>
        </div>
    </form>
@endsection