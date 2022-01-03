@extends('dashboard.common.app')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Professional Title</h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                                <a href="{{route('prof-title.index')}}" class="btn btn-warning mr-2">Back</a>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="form" action="{{route('prof-title.update',$professionalTitle->id)}}" method="POST" >
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Arabic Name:</label>
                                <input type="text" class="form-control" name="name_ar" value="{{old('name_ar',$professionalTitle->name_ar)}}"/>
                                @error('name_ar')<span class="text-danger">{{ $message }}</span>@enderror

                            </div>
                            <div class="form-group">
                                <label>English Name:</label>
                                <input type="text" class="form-control" name="name_en" value="{{old('name_en',$professionalTitle->name_en)}}"/>
                                @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label>Roman Name:</label>
                                <input type="text" class="form-control" name="name_ro" value="{{old('name_ro',$professionalTitle->name_ro)}}"/>
                                @error('name_ro')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group mb-0">
                                <label>Active</label>
                                <div class="checkbox-list">
                                    <label class="checkbox checkbox-outline">
                                        <input @if($professionalTitle->active==1) checked @endif name="active" type="checkbox"/>
                                        <span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col text-left">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                                <div class="col text-right">
                                    <button type="reset" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card-->

            </div>
        </div>
    </div>


@endsection

