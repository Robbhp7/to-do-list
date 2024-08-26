@extends('layouts.main')
@section('content')
<img src="{{asset('assets/logo.png')}}" alt="MLP logo" class="mt-2 mb-5">
<div class="row">
    <div class="col-12 col-md-4 mb-2 mb-md-0">
        <form action="{{route('tasks.store')}}" method="POST" id="form-create">
            @csrf
            @include('tasks.partials.form')
            <button type="submit" class="btn btn-primary w-100 btn-create">Add</button>
        </form>
    </div>
    <div class="col-12 col-md-8">
        <div class="card card-body">
            <table id="main-table" class="table table-striped">
                <thead>
                    <tr>
                        <th data-key="id">#</th>
                        <th data-key="name">Task</th>
                        <th data-key="actions"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(function()
    {
        var table = new DataTable('#main-table', {
            ajax: "{{route('tasks.index', ['ajax' => true])}}",
            columns: [
                { data: 'id', width: '10%' },
                { data: 'name', width: '70%' },
                {
                    data: null,
                    defaultContent: `
                            <div class="btn btn-group">\
                                <button class="btn btn-success btn-sm btn-completed" data-item_id="ITEM_ID"><i class="fas fa-check text-white"></i></button>\
                                <button class="btn btn-primary btn-sm btn-edit" data-bs-toggle="modal" data-bs-target="#modal-edit" data-item_id="ITEM_ID"><i class="fas fa-edit text-white"></i></button>\
                                <button class="btn btn-danger btn-sm btn-delete" data-item_id="ITEM_ID"><i class="fas fa-close text-white"></i></button>\
                            </div>`,
                    width: '20%'
                }
            ],
            createdRow: function(row, data, index){
                let $row = $(row);
                let $nameCol = $($row.find("td")[1]);
                let $actionsCol = $($row.find("td")[2]);

                $actionsCol.find(".btn-completed").data("item_id", data.id);
                $actionsCol.find(".btn-edit").data("item_id", data.id);
                $actionsCol.find(".btn-delete").data("item_id", data.id);
                if(data.status == 'completed')
                {
                    $row.find(".btn-group").hide();
                    $nameCol.addClass("text-decoration-line-through");
                }

            },
        });

        let $modalEdit = $("#modal-edit");

        $("body").on("click", ".btn-edit", function(e){
            let $btn = $(this);
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

        $("#form-create").on("submit", function( event ) {
            event.preventDefault();
            let $form = $(this)[0];
            var form = document.getElementById("form-create");
            var formData = new FormData(form);
            formData.append("ajax", true);

            App.Ajax.create({
                url: $form.action,
                method: 'post',
                data: formData,
                onSuccess: function (res) {
                    let item = res.data;
                    $(form).find("input[name=name]").val("");
                    table.ajax.reload();
                }
            });
        });

        $("#form-modal-edit").on("submit", function( event ) {
            event.preventDefault();
            let $form = $(this)[0];
            var form = document.getElementById($form.id);
            var formData = new FormData(form);
            formData.append("ajax", true);

            App.Ajax.create({
                url: $form.action,
                method: 'put',
                data: formData,
                onSuccess: function (res) {
                    let item = res.data;
                    $modalEdit.modal("hide");
                    table.ajax.reload();
                }
            });
        });

        $("body").on("click", ".btn-completed", function(e){
            let $btn = $(this);
            let item_id = $btn.data("item_id");

            let route = "{{route('tasks.update-status', ':item_id')}}".replace(":item_id", item_id);

            App.Alerts.onConfirm(function(){
                    App.Ajax.create({
                    url: route,
                    method: 'put',
                    data:{
                        ajax: true,
                        status: 'completed',
                    },
                    onSuccess: function (res) {
                        let item = res.data;
                        table.ajax.reload();
                    }
                });
            }, {
                title: 'Mark task as completed',
                message: 'Are you sure you want to do this action?',
                icon: 'success',
            });
        });

        $("body").on("click", ".btn-delete", function(e){
            let $btn = $(this);
            let item_id = $btn.data("item_id");

            let route = "{{route('tasks.destroy', ':item_id')}}".replace(":item_id", item_id);

            App.Alerts.onConfirm(function(){
                    App.Ajax.create({
                    url: route,
                    data:{
                        ajax: true,
                    },
                    method: 'delete',
                    onSuccess: function (res) {
                        let item = res.data;
                        table.ajax.reload();
                    }
                });
            }, {
                title: 'Delete task',
                message: 'Are you sure you want to do this action?',
            });
        });
    });
</script>
@endsection
@section('modals')
<x-modals.basic title="Edit Task" id="modal-edit" body="tasks.partials.form" btnSubmitIcon="fas fa-save" extraFormMethod="PUT"/>
@endsection
