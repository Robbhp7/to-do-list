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
                    <td>
                        <div class="btn btn-group">
                            <button class="btn btn-success btn-sm"><i class="fas fa-check text-white"></i></button>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-edit" data-item_id="{{$item->id}}"><i class="fas fa-edit text-white"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-close text-white"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
<script>
    $(function(){
        /*App.Alerts.onConfirm(function(){
            console.log("entro");
        });*/
        /*const modalEdit = document.getElementById('modal-edit')
        modalEdit.addEventListener('show.bs.modal', event => {
            console.log("entro");
        });*/

        let $modalEdit = $("#modal-edit");
        $modalEdit.on("show.bs.modal", function(e){
            let $btn = $(e.relatedTarget);
            let item_id = $btn.data("item_id");

            let route = "{{route('tasks.show', ':item_id')}}".replace(":item_id", item_id);
            let updateRoute = "{{route('tasks.update', ':item_id')}}".replace(":item_id", item_id);
            App.Ajax.create({
                url: route,
                method: 'get',
                data:{
                    ajax: true,
                },
                showAlert: false,
                onSuccess: function (res) {
                    let item = res.data;

                    $modalEdit.find("input[name=name]").val(item.name);
                    $modalEdit.find("form").attr("action", updateRoute);
                }
            });
        });
    });
</script>
@endsection
@section('modals')
<x-modals.basic title="Edit Task" id="modal-edit" body="tasks.partials.form" btnSubmitIcon="fas fa-save" extraFormMethod="PUT"/>
@endsection
