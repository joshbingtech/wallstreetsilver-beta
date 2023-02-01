@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
@endpush
@section('content')
<div class="container">
    <div class="content-wrapper mt-3 border-white">
        <div class="row">
            <table id="service-table" class="hover stripe" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center"> # </th>
                        <th class="text-center"> Service </th>
                        <th class="text-center"> URL </th>
                        <th class="text-center"> Edit </th>
                        <th class="text-center"> Delete </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr data-service_id="{{ $service['id'] }}" data-service_name="{{ $service['service'] }}" data-service_url="{{ $service['url'] }}">
                            <td class="text-center"> {{ $service['id'] }} </td>
                            <td class="text-center"> {{ $service['service'] }} </td>
                            <td> {{ $service['url'] }} </td>
                            <td class="text-center">
                                <a href="#" class="edit-btn icon-action"><i class="fa-solid fa-file-pen"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="#" class="delete-btn icon-action"><i class="fa-solid fa-trash"></i></a>
                                <div class="dot-opacity-loader" style="display: none;">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="addServiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="text-center"> Add a new service </h4>
                    <form class="pt-3" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <input id="service" type="text" class="form-control form-control-lg" value="" placeholder="Service Name" required="" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input id="url" type="text" class="form-control form-control-lg" value="" placeholder="Service URL" required="" autocomplete="off">
                        </div>
                        <div class="modal-button-group">
                            <button id="add-service-btn" type="button" class="btn btn-gradient-success"> Add </button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal"> Close </button>
                            <div class="dot-opacity-loader" style="display: none;">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editServiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="text-center"> Edit service </h4>
                    <form class="pt-3" autocomplete="off">
                        @csrf
                        <input id="edit_service_id" type="hidden">
                        <div class="form-group">
                            <input id="edit_service_name" type="text" class="form-control form-control-lg" value="" placeholder="Service Name" required="" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input id="edit_service_url" type="text" class="form-control form-control-lg" value="" placeholder="Service URL" required="" autocomplete="off">
                        </div>
                        <div class="modal-button-group">
                            <button id="edit-service-btn" type="button" class="btn btn-gradient-success"> Save changes </button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal"> Close </button>
                            <div class="dot-opacity-loader" style="display: none;">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var service_table = $("#service-table").DataTable({
            dom: 'rf<"create-btn create-service-btn">tip',
            pageLength: 10,
            sPaginationType: "numbers",
            columnDefs: [
                { orderable: false, targets: [3, 4] }
            ],
            order: [[0, 'asc']],
            scrollX: true
        });

        $("div.create-service-btn").html(
			'<button class="btn btn-gradient-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addServiceModal"> Add a new service </button>'
		);

        $("#add-service-btn").click(function(e) {
            e.preventDefault();
            $(".is-invalid").removeClass("is-invalid");
            $(".invalid-feedback").remove();

            $(".modal-button-group button").hide();
            $(".modal-button-group .dot-opacity-loader").show();

            $.ajax({
                type:'POST',
                url:"{{ route('admin/add-sns') }}",
                data:{
                    service: $("#service").val(),
                    url: $("#url").val()
                },
                success:function(response){
                    $(".modal-button-group button").show();
                    $(".modal-button-group .dot-opacity-loader").hide();

                    if(response.status) {
                        location.reload();
                    } else {
                        if(response.message == "Unable to add a new service.") {
                            location.reload();
                        } else {
                            var errors = response.message
                            $.each(errors, function(key, error) {
                                if(key == "service") {
                                    $("#service").addClass("is-invalid");
                                    $("#service").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                } else if(key == "url") {
                                    $("#url").addClass("is-invalid");
                                    $("#url").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                }
                            });
                        }
                    }
                }
            });
        });

        $(".edit-btn").click(function(e) {
            e.preventDefault();

            var edit_btn = $(this);
            var service_id = $(this).parent().parent().data("service_id");
            var service_name = $(this).parent().parent().data("service_name");
            var service_url = $(this).parent().parent().data("service_url");

            $("#edit_service_id").val(service_id);
            $("#edit_service_name").val(service_name);
            $("#edit_service_url").val(service_url);

            $("#editServiceModal").modal("show");
        });

        $("#edit-service-btn").click(function(e) {
            e.preventDefault();
            $(".is-invalid").removeClass("is-invalid");
            $(".invalid-feedback").remove();

            $(".modal-button-group button").hide();
            $(".modal-button-group .dot-opacity-loader").show();

            $.ajax({
                type:'POST',
                url:"{{ route('admin/edit-sns') }}",
                data:{
                    service_id: $("#edit_service_id").val(),
                    service: $("#edit_service_name").val(),
                    url: $("#edit_service_url").val()
                },
                success:function(response){
                    $(".modal-button-group button").show();
                    $(".modal-button-group .dot-opacity-loader").hide();

                    if(response.status) {
                        location.reload();
                    } else {
                        if(response.message == "Unable to edit the service.") {
                            location.reload();
                        } else {
                            var errors = response.message
                            $.each(errors, function(key, error) {
                                
                                if(key == "service") {
                                    $("#edit_service_name").addClass("is-invalid");
                                    $("#edit_service_name").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                } else if(key == "url") {
                                    $("#edit_service_url").addClass("is-invalid");
                                    $("#edit_service_url").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                }
                            });
                        }
                    }
                }
            });
        });

        $(".delete-btn").click(function(e) {
            e.preventDefault();
            var delete_btn = $(this);
            $(delete_btn).hide();
            $(delete_btn).next().show();
            var service_id = $(this).parent().parent().data("service_id");

            $.ajax({
                type:'POST',
                url:"{{ route('admin/delete-sns') }}",
                data:{
                    service_id: service_id
                },
                success:function(response){
                    $(delete_btn).show();
                    $(delete_btn).next().hide();

                    location.reload();
                }
            });
        });
    </script>
@endpush
