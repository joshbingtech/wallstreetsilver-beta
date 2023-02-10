@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
@endpush
@section('content')
<div class="container">
    <div class="content-wrapper mt-3 border-white">
        <div class="row">
            <table id="supporters-table" class="hover stripe" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center"> # </th>
                        <th class="text-center"> Company Logo </th>
                        <th class="text-center"> Company Name </th>
                        <th class="text-center"> Company URL </th>
                        <th class="text-center"> Edit </th>
                        <th class="text-center"> Delete </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supporters as $supporter)
                        <tr data-supporter_id="{{ $supporter['id'] }}" data-supporter_logo_src="{{ asset('images/supporters/'.$supporter['logo']) }}" data-supporter_name="{{ $supporter['name'] }}" data-supporter_url="{{ $supporter['url'] }}">
                            <td class="text-center"> {{ $supporter['id'] }} </td>
                            <td class="text-center"> <img class="thumbnail" src="{{ asset('images/supporters/'.$supporter['logo']) }}"> </td>
                            <td class="text-center"> {{ $supporter['name'] }} </td>
                            <td> {{ $supporter['url'] }} </td>
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
    <div class="modal fade" id="addSupporterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="text-center"> Add a new supporter </h4>
                    <form id="add-supporter-form" class="pt-3" autocomplete="off">
                        @csrf
                        <img id="supporter-company-logo" class="mb-3">
                        <div class="form-group">
                            <label for="add-supporter-logo-btn" class="btn btn-block btn-gradient-primary btn-lg"> Choose Company Logo </label>
                            <input type="file" id="add-supporter-logo-btn" name="logo" accept="image/*" hidden/>
                        </div>
                        <div class="form-group">
                            <input id="name" type="text" class="form-control form-control-lg" name="name" value="" placeholder="Company Name" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input id="url" type="text" class="form-control form-control-lg" name="url" value="" placeholder="Company URL" autocomplete="off">
                        </div>
                        <div class="modal-button-group">
                            <button id="add-supporter-btn" type="submit" class="btn btn-gradient-success"> Add </button>
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
    <div class="modal fade" id="editSupporterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="text-center"> Edit service </h4>
                    <form id="edit-supporter-form" class="pt-3" autocomplete="off">
                        @csrf
                        <input id="edit-supporter-id" name="supporter_id" type="hidden">
                        <img id="edit-supporter-company-logo" class="mb-3">
                        <div class="form-group">
                            <label for="edit-supporter-logo-btn" class="btn btn-block btn-gradient-primary btn-lg"> Choose Company Logo </label>
                            <input type="file" id="edit-supporter-logo-btn" name="logo" accept="image/*" hidden/>
                        </div>
                        <div class="form-group">
                            <input id="edit-supporter-name" type="text" class="form-control form-control-lg" name="name" value="" placeholder="Company Name" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input id="edit-supporter-url" type="text" class="form-control form-control-lg" name="url" value="" placeholder="Company URL" autocomplete="off">
                        </div>
                        <div class="modal-button-group">
                            <button id="edit-supporter-btn" type="submit" class="btn btn-gradient-success"> Save changes </button>
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

        $(document).ready(() => {
            var supporter_table = $("#supporters-table").DataTable({
                dom: 'rf<"create-btn create-supporter-btn">tip',
                pageLength: 10,
                sPaginationType: "numbers",
                columnDefs: [
                    { "width": "200px", "targets": 1 },
                    { orderable: false, targets: [4, 5] }
                ],
                order: [[0, 'asc']],
                scrollX: true
            });

            $("div.create-supporter-btn").html(
                '<button class="btn btn-gradient-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addSupporterModal"> Add a new service </button>'
            );

            $("#add-supporter-logo-btn").change(function() {
                $("#add-supporter-logo-btn").removeClass("is-invalid");
                $("#add-supporter-logo-btn").next().remove("span");
                const file = this.files[0];
                if (file) {
                    const fileType = file["type"];
                    const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp', 'image/bmp'];
                    if (validImageTypes.includes(fileType)) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("#supporter-company-logo").attr("src", e.target.result);
                        }
                        reader.readAsDataURL(file);
                    } else {
                        $("#supporter-company-logo").attr("src", "");
                        $("#add-supporter-logo-btn").val('');
                        $("#add-supporter-logo-btn").addClass("is-invalid");
                        $("#add-supporter-logo-btn").after('<span class="invalid-feedback" role="alert"><strong> Accepted company logo formats include gif, jpg, jpeg, webp, bmp and png. </strong></span>');
                    }
                } else {
                    $("#supporter-company-logo").attr("src", "");
                    $("#add-supporter-logo-btn").val('');
                    $("#add-supporter-logo-btn").addClass("is-invalid");
                    $("#add-supporter-logo-btn").after('<span class="invalid-feedback" role="alert"><strong> Please choose a company logo. </strong></span>');
                }
            });

            $("#add-supporter-form").submit(function(e) {
                e.preventDefault();
                var has_error = false;

                $(".is-invalid").removeClass("is-invalid");
                $(".invalid-feedback").remove();
                
                try {
                    const file = $("#add-supporter-logo-btn")[0].files[0];
                    if (file) {
                        const fileType = file["type"];
                        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp', 'image/bmp'];
                        if (!validImageTypes.includes(fileType)) {
                            $("#supporter-company-logo").attr("src", "");
                            $("#add-supporter-logo-btn").val('');
                            $("#add-supporter-logo-btn").addClass("is-invalid");
                            $("#add-supporter-logo-btn").after('<span class="invalid-feedback" role="alert"><strong> Accepted company logo formats include gif, jpg, jpeg, webp, bmp and png. </strong></span>');
                            has_error = true;
                        }
                    } else {
                        $("#supporter-company-logo").attr("src", "");
                        $("#add-supporter-logo-btn").val('');
                        $("#add-supporter-logo-btn").addClass("is-invalid");
                        $("#add-supporter-logo-btn").after('<span class="invalid-feedback" role="alert"><strong> Please choose a company logo. </strong></span>');
                        has_error = true;
                    }
                } catch(err) {
                    $("#supporter-company-logo").attr("src", "");
                    $("#add-supporter-logo-btn").val('');
                    $("#add-supporter-logo-btn").addClass("is-invalid");
                    $("#add-supporter-logo-btn").after('<span class="invalid-feedback" role="alert"><strong> Please choose a company logo. </strong></span>');
                    has_error = true;
                }
                if(!has_error) {
                    $(".modal-button-group button").hide();
                    $(".modal-button-group .dot-opacity-loader").show();
                    var formData = new FormData(this);
                    $.ajax({
                        url:"{{ route('admin/add-supporter') }}",
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            $(".modal-button-group button").show();
                            $(".modal-button-group .dot-opacity-loader").hide();

                            if(response.status) {
                                location.reload();
                            } else {
                                if(response.message == "Unable to add a new supporter.") {
                                    location.reload();
                                } else {
                                    var errors = response.message
                                    $.each(errors, function(key, error) {
                                        if(key == "logo") {
                                            $("#add-supporter-logo-btn").addClass("is-invalid");
                                            $("#add-supporter-logo-btn").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                        } else if(key == "name") {
                                            $("#name").addClass("is-invalid");
                                            $("#name").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                        } else if(key == "url") {
                                            $("#url").addClass("is-invalid");
                                            $("#url").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                        }
                                    });
                                }
                            }
                        }
                    });
                }
            });

            $(".edit-btn").click(function(e) {
                e.preventDefault();

                var edit_btn = $(this);
                var supporter_id = $(this).parent().parent().data("supporter_id");
                var supporter_logo_src = $(this).parent().parent().data("supporter_logo_src");
                $("#edit-supporter-company-logo").attr("src", supporter_logo_src);
                var supporter_name = $(this).parent().parent().data("supporter_name");
                var supporter_url = $(this).parent().parent().data("supporter_url");

                $("#edit-supporter-id").val(supporter_id);
                $("#edit-supporter-name").val(supporter_name);
                $("#edit-supporter-url").val(supporter_url);

                $("#editSupporterModal").modal("show");
            });

            $("#edit-supporter-logo-btn").change(function() {
                $("#edit-supporter-logo-btn").removeClass("is-invalid");
                $("#edit-supporter-logo-btn").next().remove("span");
                const file = this.files[0];
                if (file) {
                    const fileType = file["type"];
                    const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp', 'image/bmp'];
                    if (validImageTypes.includes(fileType)) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("#edit-supporter-company-logo").attr("src", e.target.result);
                        }
                        reader.readAsDataURL(file);
                    } else {
                        $("#edit-supporter-company-logo").attr("src", "");
                        $("#edit-supporter-logo-btn").val('');
                        $("#edit-supporter-logo-btn").addClass("is-invalid");
                        $("#edit-supporter-logo-btn").after('<span class="invalid-feedback" role="alert"><strong> Accepted company logo formats include gif, jpg, jpeg, webp, bmp and png. </strong></span>');
                    }
                } else {
                    $("#edit-supporter-company-logo").attr("src", "");
                    $("#edit-supporter-logo-btn").val('');
                    $("#edit-supporter-logo-btn").addClass("is-invalid");
                    $("#edit-supporter-logo-btn").after('<span class="invalid-feedback" role="alert"><strong> Please choose a company logo. </strong></span>');
                }
            });

            $("#edit-supporter-form").submit(function(e) {
                e.preventDefault();
                var has_error = false;

                $(".is-invalid").removeClass("is-invalid");
                $(".invalid-feedback").remove();
                
                try {
                    const file = $("#edit-supporter-logo-btn")[0].files[0];
                    if (file) {
                        const fileType = file["type"];
                        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp', 'image/bmp'];
                        if (!validImageTypes.includes(fileType)) {
                            $("#edit-supporter-company-logo").attr("src", "");
                            $("#edit-supporter-logo-btn").val('');
                            $("#edit-supporter-logo-btn").addClass("is-invalid");
                            $("#edit-supporter-logo-btn").after('<span class="invalid-feedback" role="alert"><strong> Accepted company logo formats include gif, jpg, jpeg, webp, bmp and png. </strong></span>');
                            has_error = true;
                        }
                    }
                } catch(err) {
                    $("#edit-supporter-company-logo").attr("src", "");
                    $("#edit-supporter-logo-btn").val('');
                    $("#edit-supporter-logo-btn").addClass("is-invalid");
                    $("#edit-supporter-logo-btn").after('<span class="invalid-feedback" role="alert"><strong> Please choose a company logo. </strong></span>');
                    has_error = true;
                }
                if(!has_error) {
                    $(".modal-button-group button").hide();
                    $(".modal-button-group .dot-opacity-loader").show();
                    var formData = new FormData(this);
                    $.ajax({
                        url:"{{ route('admin/edit-supporter') }}",
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            $(".modal-button-group button").show();
                            $(".modal-button-group .dot-opacity-loader").hide();

                            if(response.status) {
                                location.reload();
                            } else {
                                if(response.message == "Unable to edit the supporter.") {
                                    location.reload();
                                } else {
                                    var errors = response.message
                                    $.each(errors, function(key, error) {
                                        if(key == "logo") {
                                            $("#edit-supporter-logo-btn").addClass("is-invalid");
                                            $("#edit-supporter-logo-btn").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                        } else if(key == "name") {
                                            $("#edit-supporter-name").addClass("is-invalid");
                                            $("#edit-supporter-name").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                        } else if(key == "url") {
                                            $("#edit-supporter-url").addClass("is-invalid");
                                            $("#edit-supporter-url").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                        }
                                    });
                                }
                            }
                        }
                    });
                }
            });

            $(".delete-btn").click(function(e) {
                e.preventDefault();
                var delete_btn = $(this);
                $(delete_btn).hide();
                $(delete_btn).next().show();
                var supporter_id = $(this).parent().parent().data("supporter_id");

                $.ajax({
                    type:'POST',
                    url:"{{ route('admin/delete-supporter') }}",
                    data:{
                        supporter_id: supporter_id
                    },
                    success:function(response){
                        $(delete_btn).show();
                        $(delete_btn).next().hide();

                        location.reload();
                    }
                });
            });
        });
    </script>
@endpush
