@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Data Panitia</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('adminUpdate', $panitia['id']) }}" method="POST">
                @csrf
                @method('PUT')

                
            </form>
        </div>
    </div>
</div>
@endsection
