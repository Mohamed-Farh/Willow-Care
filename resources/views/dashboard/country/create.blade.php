@extends('dashboard.common.app')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Country</h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                                <a href="{{route('countries.index')}}" class="btn btn-warning mr-2">Back</a>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="form" action="{{route('countries.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Arabic Name:</label>
                                <input type="text" class="form-control" name="name_ar" value="{{old('name_ar')}}"/>
                                @error('name_ar')<span class="text-danger">{{ $message }}</span>@enderror

                            </div>
                            <div class="form-group">
                                <label>English Name:</label>
                                <input type="text" class="form-control" name="name_en" value="{{old('name_en')}}"/>
                                @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label>Roman Name:</label>
                                <input type="text" class="form-control" name="name_ro" value="{{old('name_ro')}}"/>
                                @error('name_ro')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label>Country Code:</label>
                                <input type="text" class="form-control" name="code" value="{{old('code')}}"/>
                                @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group mb-0">
                                <label>Active</label>
                                <div class="checkbox-list">
                                    <label class="checkbox checkbox-outline">
                                        <input @if(old('active')) checked @endif name="active" type="checkbox"/>
                                        <span></span></label>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="image-input image-input-outline" id="kt_image_4"
                                             style="background-image: url({{asset('dashboard/assets/js/pages/crud/file-upload/image-input.js')}})">
                                            <div class="image-input-wrapper"
                                                 style="background-image: url({{asset('dashboard/assets/media/users/100_1.jpg')}})"></div>
                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="flag" accept=".png, .jpg, .jpeg"/>
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
                                    </div>
                                    @error('flag')<span class="text-danger">{{ $message }}</span>@enderror
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

                                                              avatar4.on('remove', function(imageInput) {
                                                               swal.fire({
                                                                title: 'Image successfully removed !',
                                                                type: 'error',
                                                                buttonsStyling: false,
                                                                confirmButtonText: 'Got it!',
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
    <script src="{{asset('dashboard/assets/js/pages/crud/file-upload/image-input.js')}}"></script>
@endsection
