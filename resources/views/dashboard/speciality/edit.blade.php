@extends('dashboard.common.app')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Speciality</h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                                <a href="{{route('speciality.index')}}" class="btn btn-warning mr-2">Back</a>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="form" action="{{route('speciality.update',$specialty->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Arabic Name:</label>
                                <input type="text" class="form-control" name="name_ar" value="{{old('name_ar',$specialty->name_ar)}}"/>
                                @error('name_ar')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label>English Name:</label>
                                <input type="text" class="form-control" name="name_en" value="{{old('name_en',$specialty->name_en)}}"/>
                                @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label>Roman Name:</label>
                                <input type="text" class="form-control" name="name_ro" value="{{old('name_ro',$specialty->name_ro)}}"/>
                                @error('name_ro')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group row ">
                                <label class="col-form-label col-sm-12">Category</label>
                                <div class=" col-sm-12">
                                    <select class="form-control select2" id="kt_select2_3" name="category[]" multiple="multiple">
                                        @foreach($category as $item)
                                            <option  value="{{$item['id']}}"
                                                     @if($specialty->categories->containsStrict('id', $item->id)) selected="selected" @endif >
                                                {{$item['category']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group mb-0">
                                <label>Active</label>
                                <div class="checkbox-list">
                                    <label class="checkbox checkbox-outline">
                                        <input @if($specialty->active==1) checked @endif name="active" type="checkbox"/>
                                        <span></span></label>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-6">
                                        <div  class="image-input image-input-outline" id="kt_image_4"
                                              style="background-image: url({{asset($specialty->icon)}})">
                                            <div class="image-input-wrapper"
                                                 style="background-image: url({{asset($specialty->icon)}})">

                                            </div>
                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="icon" accept=".png, .jpg, .jpeg"/>
                                                <input type="hidden" name=""/>
                                            </label>
                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="remove" data-toggle="tooltip" title="Remove avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
                                        </div>
                                        @error('icon')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <!--begin::Code-->
                                <div class="example-code">
                                    <ul class="example-nav nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-2x">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#example_code_4_html">HTML</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#example_code_4_js">JS</a>
                                        </li>
                                    </ul>
                                    <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="example_code_4_html" role="tabpanel">
                                            <div class="example-highlight">
															<pre>
                                                         <code class="language-html">
      &lt;div class="image-input image-input-outline" id="kt_image_4" style="background-image: url(assets/media/&gt;users/blank.png)"&gt;
       &lt;div class="image-input-wrapper" style="background-image: url(&lt;?php echo Page::getMediaPath();?&gt;users/100_1.jpg)"&gt;&lt;/div&gt;

       &lt;label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar"&gt;
        &lt;i class="fa fa-pen icon-sm text-muted"&gt;&lt;/i&gt;
        &lt;input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg"/&gt;
        &lt;input type="hidden" name="profile_avatar_remove"/&gt;
       &lt;/label&gt;

       &lt;span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar"&gt;
        &lt;i class="ki ki-bold-close icon-xs text-muted"&gt;&lt;/i&gt;
       &lt;/span&gt;

       &lt;span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar"&gt;
        &lt;i class="ki ki-bold-close icon-xs text-muted"&gt;&lt;/i&gt;
       &lt;/span&gt;
      &lt;/div&gt;
            </code>
                                                                </pre>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="example_code_4_js">
                                            <div class="example-highlight">
															<pre style="height:400px">
                                                        <code class="language-js">
                                                              var avatar4 = new KTImageInput('kt_image_4');

                                                              avatar4.on('cancel', function(imageInput) {
                                                               swal.fire({
                                                                title: 'Image successfully canceled !',
                                                                type: 'success',
                                                                buttonsStyling: false,
                                                                confirmButtonText: 'Awesome!',
                                                                confirmButtonClass: 'btn btn-primary font-weight-bold'
                                                               });
                                                              });

                                                              avatar4.on('change', function(imageInput) {
                                                               swal.fire({
                                                                title: 'Image successfully changed !',
                                                                type: 'success',
                                                                buttonsStyling: false,
                                                                confirmButtonText: 'Awesome!',
                                                                confirmButtonClass: 'btn btn-primary font-weight-bold'
                                                               });
                                                              });


                                                                    </code>
                                                         </pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Code-->
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
    <script src="{{asset('dashboard/assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/crud/file-upload/image-input.js')}}"></script>

    <script>
        var avatar4 = new KTImageInput('kt_image_4');

        avatar4.on('remove', function(imageInput) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            var confirmed= swal.fire({
                title: 'Image successfully removed !',
                type: 'confirmed',
                buttonsStyling: false,
                confirmButtonText: 'Got it!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
            if(confirmed){
                $.ajax({
                    url: "{{ route('delSpecImg', ['id'=>$specialty->id]) }}",
                    type: "POST",
                    success: function(data) {
                        setTimeout(function() {
                            window.location.reload();
                        },500);
                    }
                });
            }


        })

    </script>




@endsection
