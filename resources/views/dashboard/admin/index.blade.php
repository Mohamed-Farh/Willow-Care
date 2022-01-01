@extends('dashboard.common.app')
@section('style')
    <style>
        table.dataTable tbody td.select-checkbox:before, table.dataTable tbody th.select-checkbox:before {
            content: " ";
            margin-top: 22px;
            margin-left: 0;
            border: 1px solid darkblue;
            border-radius: 3px;
        }
        table.dataTable tr.selected td.select-checkbox:after, table.dataTable tr.selected th.select-checkbox:after {
            content: "✓";
            font-size: 20px;
            margin-top: 6px;
            margin-left: 0px;
            text-align: center;
            text-shadow: 1px 1px #b0bed9, -1px -1px #b0bed9, 1px -1px #b0bed9, -1px 1px #b0bed9;
        }
    </style>
@endsection
@section('content')
    <div class="container mt-3">
        @include('sweetalert::alert')
        <div class="row ">

            <div class="col-12 d-flex justify-content-end">
                @if(\Illuminate\Support\Facades\Auth::user()->role == 0)
                <!--begin::Button-->
                <a href="{{route('admin.create')}}" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle fill="#000000" cx="9" cy="15" r="6" />
                                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>New Record</a>
                    @endif
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-12">
                <table  class="table table-bordered table-hover table-striped table-light yajra-datatable">
                    <thead class="table-dark ">
                    <tr class="text-light" >
                        <th  class="text-light">No</th>
                        <th  class="text-light">Name</th>
                        <th  class="text-light">Email</th>
                        <th  class="text-light">Phone</th>
                        <th  class="text-light">Image</th>
                        <th  class="text-light">Role</th>
                        <th  class="text-light">Status</th>
                        <th  class="text-light">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admins as $k=>$item)
                        <tr  data-entry-id="{{ $item->id }}">
                            <td class="@if($item->role==0)notSelect @else select @endif">{{$item->id}}</td>
                            <td >{{$item->name}}</td>
                            <td >{{$item->email}}</td>
                            <td >{{$item->phone}}</td>
                            <td class="text-center"><img class="rounded" width="60" height="60" src="{{asset($item->image)}}"></td>
                            <td >{{$item->role == 0 ? 'Super Admin':'Admin'}}</td>
                            <td class="text-center">
                                @if(\Illuminate\Support\Facades\Auth::user()->role == 0)
                                <input data-id="{{$item->id}}"
                                       class="toggle-class" type="checkbox" data-onstyle="success"
                                       data-offstyle="danger" data-toggle="toggle" data-on="On"
                                       data-width="40" data-height="30"
                                       data-off="Off" {{ $item->active ? 'checked' : '' }}>
                                @endif
                            </td>
                            <td class="text-center">
                                <div style="display: flex" class="text-center justify-content-between">
{{--                                    <a href="{{route("admin.edit", $item->id)}}"--}}
{{--                                       class="edit btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>--}}
                                    @if($item->role!==0 && \Illuminate\Support\Facades\Auth::user()->role !== 1)
                                    <form method="POST" action="{{route("admin.destroy", $item->id)}}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button id="confirm" class="show_confirm destroy btn btn-danger btn-sm"
                                                style="border: none" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>--}}
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    {{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>--}}
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>--}}

    <script type="text/javascript">

        $(function () {
            let languages = {
                'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
            };
            var table = $('.yajra-datatable').DataTable({
                //processing: true,
                //serverSide: true,
                language: {
                    url: languages['{{ app()->getLocale() }}']
                },

                columnDefs: [

                    {
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }

                , {
                    orderable: false,
                    searchable: false,
                    targets: -1
                }

                ]
                ,
                select: {
                    style: 'multi+shift',
                    selector: 'td.select'
                },

                order: [],
                scrollX: false,
                dom: 'lBfrtip<"actions">',
                buttons: [
                    {
                        extend: 'copy',
                        className: 'btn-default',
                        text: 'Copy',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-default',
                        text: 'CSV',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-default',
                        text: 'Excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-default',
                        text: 'PDF',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-warning',
                        text: 'Printf',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        className: 'btn-default',
                        text: 'Column Visible',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },

                    @if(\Illuminate\Support\Facades\Auth::user()->role == '0')

                    {
                        className: 'btn btn-danger',
                        text: 'Delete All',
                        url: "{{ route('admins.massDestroy') }}",
                        action: function (e, dt, node, config) {

                            var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                                return $(entry).data('entry-id')
                            });


                            if (ids.length === 0) {
                                Swal.fire('No Data Selected')
                                return
                            }
                            Swal.fire({
                                title: 'Do you want to save the changes?',
                                showDenyButton: true,
                                showCancelButton: true,
                                confirmButtonText: 'Save',
                                denyButtonText: `Don't save`,
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    })
                                    $.ajax({
                                        // headers: {'x-csrf-token': _token},
                                        method: 'POST',
                                        url: config.url,
                                        data: { ids: ids, _method: 'POST' }})
                                        .done(function () { location.reload() })
                                    Swal.fire('Saved!', '', 'success')
                                } else if (result.isDenied) {
                                    Swal.fire('Changes are not saved', '', 'info')
                                }
                            })


                        }

                    }
                    @endif

                ],

            });


        });


    </script>
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var active = $(this).prop('checked') == true ? 1 : 0;
                var admin_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{route('changeAdminStatus')}}',
                    data: {'active': active, 'admin_id': admin_id},
                    success: function(data){
                        Swal.fire({
                            title: 'Status Change Successfully',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })
                    }
                });
            })
        })
    </script>


@endsection
