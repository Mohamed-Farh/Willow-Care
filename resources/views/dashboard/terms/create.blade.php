@extends('dashboard.common.app')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Terms & Cond.</h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                                <a href="{{route('terms.index')}}" class="btn btn-warning mr-2">Back</a>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="form" action="{{route('terms.store')}}" method="POST" >
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Arabic Content:</label>
                                <textarea name="text_ar" class="form-control" id="exampleTextarea" rows="3">
                                    {{old('text_ar')}}
                                </textarea>
                                @error('text_ar')<span class="text-danger">{{ $message }}</span>@enderror

                            </div>
                            <div class="form-group">
                                <label>English Content:</label>
                                <textarea name="text_en" class="form-control" id="exampleTextarea" rows="3">
                                     {{old('text_en')}}
                                </textarea>
                                @error('text_en')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label>Roman Content:</label>
                                <textarea name="text_ro" class="form-control" id="exampleTextarea" rows="3">
                                     {{old('text_ro')}}
                                </textarea>
                                @error('text_ro')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-12">Category</label>
                                <div class=" col-sm-12">
                                    <select class="form-control" id="kt_select2_1" name="category">
                                        @foreach($category as $cat)
                                        <option {{ old('category') == $cat->id ? "selected" : "" }} value="{{$cat->id}}">{{$cat->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label>Active</label>
                                <div class="checkbox-list">
                                    <label class="checkbox checkbox-outline">
                                        <input @if(old('active')) checked @endif name="active" type="checkbox"/>
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
@section('scripts')
    <script src="{{asset('dashboard/assets/js/pages/crud/file-upload/image-input.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
@endsection
