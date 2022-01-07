
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link href="{{asset('dashboard/assets/css/pages/wizard/wizard-3.css')}}" rel="stylesheet" type="text/css" />
    <style>

        .upload__box {
            padding: 40px;
        }
        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
        .upload__btn {
            display: inline-block;
            font-weight: 600;
            color: #fff;
            text-align: center;
            min-width: 116px;
            padding: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: #1e1e2d;
            border-color: #1e1e2d;
            border-radius: 10px;
            line-height: 26px;
            font-size: 14px;
        }
        .upload__btn:hover {
            background-color: unset;
            color: #1e1e2d;
            transition: all 0.3s ease;
        }
        .upload__btn-box {
            margin-bottom: 10px;
        }
        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        .upload__img-box {
            width: 200px;
            padding: 0 10px;
            margin-bottom: 12px;
        }
        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }
        .upload__img-close:after {
            content: "✖";
            font-size: 14px;
            color: white;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
        }

    </style>

@endpush


<div>
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="card-body p-0">
                    <!--begin: Wizard-->
                    <div class="wizard wizard-3" >
                    {{--                        <!--begin: Wizard Nav-->--}}
                    {{--                        <div class="wizard-nav">--}}
                    {{--                            <div class="wizard-steps px-8 py-8 px-lg-15 py-lg-3">--}}
                    {{--                                <!--begin::Wizard Step 1 Nav-->--}}
                    {{--                                <div class="wizard-step" >--}}
                    {{--                                    <div class="wizard-label">--}}
                    {{--                                        <h3 class="wizard-title">--}}
                    {{--                                            <span>1.</span>Setup Country & Lang</h3>--}}
                    {{--                                        <div class="wizard-bar"></div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!--end::Wizard Step 1 Nav-->--}}
                    {{--                                <!--begin::Wizard Step 2 Nav-->--}}
                    {{--                                <div class="wizard-step" >--}}
                    {{--                                    <div class="wizard-label">--}}
                    {{--                                        <h3 class="wizard-title">--}}
                    {{--                                            <span>2.</span>Doctor Basic Info</h3>--}}
                    {{--                                        <div class="wizard-bar"></div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!--end::Wizard Step 2 Nav-->--}}
                    {{--                                <!--begin::Wizard Step 3 Nav-->--}}
                    {{--                                <div class="wizard-step" >--}}
                    {{--                                    <div class="wizard-label">--}}
                    {{--                                        <h3 class="wizard-title">--}}
                    {{--                                            <span>3.</span>Select Speciality & Licence</h3>--}}
                    {{--                                        <div class="wizard-bar"></div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!--end::Wizard Step 3 Nav-->--}}
                    {{--                                <!--begin::Wizard Step 4 Nav-->--}}
                    {{--                                <div class="wizard-step" >--}}
                    {{--                                    <div class="wizard-label">--}}
                    {{--                                        <h3 class="wizard-title">--}}
                    {{--                                            <span>4.</span>Completed</h3>--}}
                    {{--                                        <div class="wizard-bar"></div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!--end::Wizard Step 4 Nav-->--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <!--end: Wizard Nav-->--}}
                    <!--begin: Wizard Body-->
                        <div class="row justify-content-center py-10 px-8 py-lg-12 px-lg-10">
                            <div class="col-xl-12 col-xxl-7">
                                <!--begin: Wizard Form-->
                                <form wire:submit.prevent="register" class="form" >
                                    <!--begin: Wizard Step 1-->

                                        <div @if($currentStep!==1) style="visibility: hidden" @endif  class="pb-5"  >
                                            <h4 class="mb-10 font-weight-bold text-dark">Setup Your Country</h4>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <!--begin::Select-->
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <select wire:model="country" id="kt_select2_1" class="form-control">
                                                            <option value="">Select</option>
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->id}}">{{$country->country}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('country') <span class="text-danger">{{$message}}</span>@enderror
                                                    </div>
                                                    <!--end::Select-->
                                                </div>
                                            </div>
                                            <h4 class="mb-10 font-weight-bold text-dark">Setup Your Language</h4>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <!--begin::Select-->
                                                    <div class="form-group">
                                                        <label>Languages</label>
                                                        <div class="radio-inline">
                                                            <label class="radio radio-primary">
                                                                <input type="radio" value="en"  wire:model="lang" />
                                                                <span></span>English</label>
                                                            <label class="radio radio-primary">
                                                                <input type="radio"  value="ar"  wire:model="lang" checked="checked" />
                                                                <span></span>Arabic</label>
                                                            <label class="radio radio-primary">
                                                                <input type="radio" value="ro"  wire:model="lang" />
                                                                <span></span>Romanian</label>
                                                        </div>
                                                        @error('lang') <span class="text-danger">{{$message}}</span>@enderror
                                                    </div>
                                                    <!--end::Select-->
                                                </div>
                                            </div>
                                        </div>

                                <!--end: Wizard Step 1-->
                                    <!--begin: Wizard Step 2-->

                                        <div @if($currentStep!==2) style="visibility: hidden" @endif class="pb-5" >
                                            <h4 class="mb-10 font-weight-bold text-dark">Enter the Details of your Doctor</h4>
                                            <div class="card-body text-center">
                                                <div class="form-group row">
                                                    <div class="col-lg-12 col-xl-12">
                                                        <div class="image-input image-input-outline" id="kt_image_4"
                                                             style="background-image: url({{asset('dashboard/assets/js/pages/crud/file-upload/image-input.js')}})">
                                                            <div class="image-input-wrapper"
                                                                 style="background-image: url({{asset('dashboard/assets/media/users/100_1.jpg')}})"></div>
                                                            <label
                                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                data-action="change" data-toggle="tooltip" title=""
                                                                data-original-title="Change avatar">
                                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                                <input type="file" wire:model="image" accept=".png, .jpg, .jpeg"/>
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
                                                    @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" wire:model="name"  value="{{old('name')}}" />
                                                @error('name') <span class="text-danger">{{$message}}</span>@enderror
                                            </div>
                                            <!--end::Input-->
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" wire:model="phone"  value="{{old('phone')}}" />
                                                @error('phone') <span class="text-danger">{{$message}}</span>@enderror
                                            </div>
                                            <!--end::Input-->

                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" wire:model="email"  value="{{old('email')}}" />
                                                        @error('email') <span class="text-danger">{{$message}}</span>@enderror
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-4">
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control" wire:model="password"  />
                                                        @error('password') <span class="text-danger">{{$message}}</span>@enderror
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-4">
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label>Password Confirm</label>
                                                        <input type="password" class="form-control" wire:model="password_confirmation"  />
                                                        @error('password_confirmation') <span class="text-danger">{{$message}}</span>@enderror
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                        </div>

                                <!--end: Wizard Step 2-->
                                    <!--begin: Wizard Step 3-->

                                        <div @if($currentStep!==3) style="visibility: hidden" @endif class="pb-5" >
                                            <h4 class="mb-10 font-weight-bold text-dark">Select Doctor Speciality</h4>
                                            <!--begin::Select-->
                                            <div class="form-group">
                                                <label>Speciality</label>
                                                <select id="choices-multiple-remove-button" wire:model="speciality" multiple="">
                                                    @foreach($specialities as $spec)
                                                        <option value="{{$spec->id}}">{{$spec->speciality}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--end::Select-->
                                            <h4 class="mb-10 font-weight-bold text-dark">Enter Doctor Licence</h4>
                                            <div class="upload__box">
                                                <div class="upload__btn-box">
                                                    <label class="upload__btn">
                                                        <p>Upload images</p>
                                                        <input type="file" wire:model="files[]" multiple="" data-max_length="20" class="upload__inputfile">
                                                    </label>
                                                </div>
                                                <div class="upload__img-wrap"></div>

                                                @error('files') <span class="text-danger">{{$message}}</span>@enderror
                                            </div>
                                        </div>


                                <!--end: Wizard Step 3-->
                                    <!--begin: Wizard Step 4-->
                                    @if($currentStep===4)
                                        <div class="pb-5" >



                                        </div>

                                @endif
                                <!--end: Wizard Step 4-->
                                    <!--begin: Wizard Actions-->
                                    <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        @if($currentStep===1)
                                            <div></div>
                                        @endif

                                        @if($currentStep===2 || $currentStep===3 ||$currentStep===4)
                                            <div class="mr-2">
                                                <button type="button"  class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4" wire:click="decreaseStep()">Previous</button>
                                            </div>
                                        @endif
                                        <div>
                                            @if($currentStep===1 || $currentStep===2 ||$currentStep===3)
                                                <button  class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4"  wire:click.prevent="increaseStep()">Next</button>
                                            @endif
                                            @if($currentStep===4)
                                                <button type="button"  class="btn btn-success font-weight-bolder text-uppercase px-9 py-4" >Submit</button>
                                            @endif
                                        </div>
                                    </div>
                                    <!--end: Wizard Actions-->
                                </form>
                                <!--end: Wizard Form-->
                            </div>
                        </div>
                        <!--end: Wizard Body-->
                    </div>
                    <!--end: Wizard-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>




@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
{{--    <script src="{{asset('dashboard/assets/js/pages/custom/wizard/wizard-3.js')}}"></script>--}}
    <script src="{{asset('dashboard/assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/crud/file-upload/image-input.js')}}"></script>




    <script>
        $(document).ready(function(){

            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount:50,
                searchResultLimit:6,
                renderChoiceLimit:50,
                searchEnabled: true,
                searchChoices: true,
                resetScrollPosition: true,
                silent: false,
                editItems:true,
                position: 'bottom',
            });


        });
    </script>

    <script>
        jQuery(document).ready(function () {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function () {
                $(this).on('change', function (e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function (f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function (e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }
    </script>
@endpush


