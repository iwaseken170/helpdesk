@extends('layouts.app')

@section('sidebar')
    @include('_includes.navigation.aside')
@endsection

@section('style')
    <link href="{{asset('assets/DT_bootstrap.css')}}" rel="stylesheet" media="screen">
    @endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="span9" id="content">
        <div class="row-fluid">
            <!-- block -->
            <section class="content-header">
                <legend><h2>
                    Support Contacts
                </h2></legend>
            </section>

            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left">Support Contact List</div>
                </div>
                <div class="block-content collapse in">
                    <div class="span12">
                        <div class="table-toolbar">
                            <div class="btn-group">
                                <a href="{{route('support_contacts.create')}}"><button class="btn btn-success"><i class="icon-plus icon-white"></i> Add Support Contact</button></a>
                            </div>
                            <div class="btn-group pull-right">
                                <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Print</a></li>
                                    <li><a href="#">Save as PDF</a></li>
                                    <li><a href="#">Export to Excel</a></li>
                                </ul>
                            </div>
                        </div>

                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1">
                            <thead>
                            <tr>
                                <th>Team Name</th>
                                <th>Mailing List</th>
                                <th>Number (BA/CLRK)</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($supports as $key => $support)
                                <tr id="support{{$support->id}}">
                                    <td>{{$support->team_name}}</td>
                                    <td>{{$support->mailing}}</td>
                                    <td>{{$support->number}}</td>
                                    <td style="text-align: center; vertical-align:middle;width:190px">
                                        <a href="{{route('support_contacts.show', $support->id)}}"><button class="btn btn-default btn-edit-pet btn-mini"  data-id="{{$support->id}}"><i class="icon-eye-open"></i> View</button></a>
                                        <a href="{{route('support_contacts.edit', $support->id)}}"><button class="btn btn-info btn-edit-pet btn-mini"  data-id="{{$support->id}}"><i class="icon-edit"></i> Edit</button></a>
                                        <button class="btn btn-danger btn-delete-support btn-mini btn-delete-file" data-id="{{$support->id}}"><i class="icon-trash"></i> Del</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /block -->
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('vendors/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/scripts.js')}}"></script>
    <script src="{{asset('assets/DT_bootstrap.js')}}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })

        $('tbody').delegate('.btn-delete-support','click',function(){
            var value = $(this).data('id');
            var url = '{{URL::to('manage/deleteSupport')}}';
            if(confirm('Are you sure to delete?')==true){
                $.ajax({
                type : 'post',
                url :url,
                data : {'id':value},
                success:function(data){
                window.location.reload();
                }
            });
            }
        });
    </script>
@endsection

