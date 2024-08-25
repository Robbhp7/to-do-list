@extends('layouts.main')
@section('content')
<img src="{{asset('assets/logo.png')}}" alt="MLP logo" class="mt-2 mb-5">
<div class="row">
    <div class="col-12 col-md-4">
        <form action="{{route('tasks.store')}}" method="POST">
            @csrf
            @include('tasks.partials.form')
            <button type="submit" class="btn btn-primary w-100">Add</button>
        </form>
    </div>
    <div class="col-12 col-md-8">
        <table class="table">
            <thead>
                <col width="10%">
                <col width="70%">
                <col width="20%">
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
@endsection
@section('modals')
<x-modals.basic title="Create Task" id="modal-create" body="tasks.partials.form"/>
@endsection
