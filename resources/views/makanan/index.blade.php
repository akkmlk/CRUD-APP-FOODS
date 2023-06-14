
@extends('layout.template')
@section('konten')
{{-- START DATA --}}

{{-- @if (Session::has('success'))
    <div class="pt-2">
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    </div>
@endif --}}

<div class="my-3 p-3 bg-body rounded shadow-sm">
    {{-- FORM PENCARIAN --}}
    <div class="pb-3">
        <form class="d-flex" action="{{ url('makanan') }}" method="GET">
            <input type="search" class="form-control me-1" name="keyWords" value="{{ Request::get('keyWords') }}" placeholder="Masukkan Kata Kunci" aria-label="Search" >
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    {{-- TAMBAH DATA --}}
    <div class="pb-3">
        <a href="{{ url('makanan/create') }}" class="btn btn-success">+ TAMBAH DATA</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAMA</th>
                <th scope="col">PRICE</th>
                <th scope="col" class="text-center">DESCRIPTION</th>
                <th scope="col">QTY</th>
                <th scope="col" class="text-center">IMAGE</th>
                <th scope="col" class="text-center">AKSI</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $foods->firstItem() ?>
            @foreach ($foods as $food)
            <tr>
                <td><?= $i ?></td>
                <td>{{ $food->name }}</td>
                <td>{{ $food->price }}</td>
                <td>{{ $food->description }}</td>
                <td>{{ $food->qty }}</td>
                <td class="text-center">
                    <img src="{{ Storage::url('public/makanans/').$food->image }}" class="rounded" style="width: 150px" alt="Image Content" title="{{ $food->name }}">
                </td>
                <td class="text-center">
                    <a href="{{ url('makanan/'.$food->id.'/edit') }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                    <form onsubmit="return confirm('Yakin Ingin Menghapusnya?')" class="d-inline" action="{{ url('makanan/'.$food->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit-del" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </tbody>
    </table>
    {{ $foods->withQueryString()->links() }}
</div>

<script>
    @if(Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
    @elseif(Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
    @endif
</script>
{{-- AKHIR DATA--}}
@endsection
