@extends('dashboard.common.app')
@section('style')
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

@endsection

@section('content')

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="card-body p-0">
                    <!--begin: Wizard-->
                    <div class="wizard wizard-3" id="kt_wizard_v3" data-wizard-state="step-first" data-wizard-clickable="true">
                        <!--begin: Wizard Nav-->
                        <div class="wizard-nav">
                            <div class="wizard-steps px-8 py-8 px-lg-15 py-lg-3">
                                <!--begin::Wizard Step 1 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                            <span>1.</span>Setup Country & Lang</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 1 Nav-->
                                <!--begin::Wizard Step 2 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                            <span>2.</span>Doctor Basic Info</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 2 Nav-->
                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                            <span>3.</span>Select Speciality & Licence</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 3 Nav-->
                                <!--begin::Wizard Step 4 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                            <span>4.</span>Completed</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 4 Nav-->
                            </div>
                        </div>
                        <!--end: Wizard Nav-->
                        <!--begin: Wizard Body-->
                        <div class="row justify-content-center py-10 px-8 py-lg-12 px-lg-10">
                            <div class="col-xl-12 col-xxl-7">
                                <!--begin: Wizard Form-->
                                <form class="form" method="post" action="{{route('doctor.store')}}" id="kt_form" enctype="multipart/form-data">
                                    @csrf
                                    <!--begin: Wizard Step 1-->
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                        <h4 class="mb-10 font-weight-bold text-dark">Setup Your Country</h4>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!--begin::Select-->
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select  name="country" id="kt_select2_1" class="form-control">
                                                        <option value="">Select</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->id}}">{{$country->country}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Select-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Select-->
                                                <div class="form-group">
                                                    <label>Profissional Title</label>
                                                    <select  name="title" id="kt_select2_100" class="form-control">
                                                        <option value="">Select</option>
                                                        @foreach($titles as $title)
                                                            <option value="{{$title->id}}">{{$title->title}}</option>
                                                        @endforeach
                                                    </select>
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
                                                            <input type="radio" value="en" name="lang" />
                                                            <span></span>English</label>
                                                        <label class="radio radio-primary">
                                                            <input type="radio"  value="ar" name="lang" checked="checked" />
                                                            <span></span>Arabic</label>
                                                        <label class="radio radio-primary">
                                                            <input type="radio" value="ro" name="lang" />
                                                            <span></span>Romanian</label>
                                                    </div>
                                                </div>
                                                <!--end::Select-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Wizard Step 1-->
                                    <!--begin: Wizard Step 2-->
                                    <div class="pb-5" data-wizard-type="step-content">
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
                                                            <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
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
                                            <input type="text" class="form-control" name="name"  value="{{old('name')}}" />
                                        </div>
                                        <!--end::Input-->
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input id="phone" type="text" class="form-control" name="phone"  value="{{old('phone')}}" />
                                            @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <!--end::Input-->
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Graduation Year</label>
                                                    <input type="number" class="form-control" name="graduation_year"  min="1910" max="2099" step="1" value="{{date("Y")}}" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <div class="radio-inline">
                                                        <label class="radio radio-primary">
                                                            <input type="radio" value="0" name="gender" checked="checked" />
                                                            <span></span>Male</label>
                                                        <label class="radio radio-primary">
                                                            <input type="radio"  value="1" name="gender"  />
                                                            <span></span>Female</label>

                                                    </div>

                                                </div>
                                                <!--end::Input-->
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input id="email" type="email" class="form-control" name="email"  value="{{old('email')}}" />
                                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password"  id="password" class="form-control" name="password"  />

                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Password Confirm</label>
                                                    <input type="password" id="confirm_password" class="form-control"   />
                                                    <span id='message'></span>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Wizard Step 2-->
                                    <!--begin: Wizard Step 3-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h4 class="mb-10 font-weight-bold text-dark">Select Doctor Speciality</h4>
                                        <!--begin::Select-->
                                        <div class="form-group">
                                            <label>Speciality</label>
                                            <select  id="choices-multiple-remove-button" name="speciality[]" multiple="">
                                                @foreach($specialities as $spec)
                                                    <option value="{{$spec->id}}">{{$spec->speciality}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-muted">Please Select at least One Speciality *</span>
                                        </div>
                                        <!--end::Select-->
                                        <h4 class="mb-10 font-weight-bold text-dark">Enter Doctor Licence</h4>
                                        <span class="text-muted">Please Select at least One File *</span>
                                        <table class="table table-bordered" id="dynamicAddRemove">
                                            <tr>
                                                <th>File</th>
                                                <th>Action</th>
                                            </tr>
                                            <tr>
                                                <td><input type="file" name="addMoreInputFields[0]"  class="form-control" />
                                                </td>
                                                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add File</button></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--end: Wizard Step 3-->
                                    <!--begin: Wizard Step 4-->
                                    <div class="pb-5" data-wizard-type="step-content">



                                    </div>
                                    <!--end: Wizard Step 4-->
                                    <!--begin: Wizard Actions-->
                                    <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        <div class="mr-2">
                                            <button type="button" class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-prev">Previous</button>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-submit">Submit</button>
                                            <button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-next">Next</button>
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


@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script src="{{asset('dashboard/assets/js/pages/custom/wizard/wizard-3.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/crud/file-upload/image-input.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var startTimer;
            $('#email').on('keyup', function () {
                clearTimeout(startTimer);
                let email = $(this).val();
                startTimer = setTimeout(checkEmail, 500, email);
            });

            $('#email').on('keydown', function () {
                clearTimeout(startTimer);
            });

            function checkEmail(email) {
                $('#email-error').remove();
                if (email.length > 1) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('checkEmail') }}",
                        data: {
                            email: email,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success == false) {
                                $('#email').after('<div id="email-error" class="text-danger" <strong>'+data.message[0]+'<strong></div>');
                            } else {
                                $('#email').after('<div id="email-error" class="text-success" <strong>'+data.message+'<strong></div>');
                            }

                        }
                    });
                } else {
                    $('#email').after('<div id="email-error" class="text-danger" <strong>Email address can not be empty.<strong></div>');
                }
            }
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            var startTimer;
            $('#phone').on('keyup', function () {
                clearTimeout(startTimer);
                let phone = $(this).val();
                startTimer = setTimeout(checkPhone, 500, phone);
            });

            $('#phone').on('keydown', function () {
                clearTimeout(startTimer);
            });

            function checkPhone(phone) {
                $('#phone-error').remove();
                if (phone.length > 1) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('checkPhone') }}",
                        data: {
                            phone: phone,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success == false) {
                                $('#phone').after('<div id="phone-error" class="text-danger" <strong>'+data.message[0]+'<strong></div>');
                            } else {
                                $('#phone').after('<div id="phone-error" class="text-success" <strong>'+data.message+'<strong></div>');
                            }

                        }
                    });
                } else {
                    $('#phone').after('<div id="phone-error" class="text-danger" <strong>Phone can not be empty.<strong></div>');
                }
            }
        });
    </script>
    <script>
        $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else
                $('#message').html('Not Matching').css('color', 'red');
        });
    </script>

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
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="file" name="addMoreInputFields[' + i +
                ']"  class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>

{{--    <script>--}}
{{--        jQuery(document).ready(function () {--}}
{{--            ImgUpload();--}}
{{--        });--}}

{{--        function ImgUpload() {--}}
{{--            var imgWrap = "";--}}
{{--            var imgArray = [];--}}

{{--            $('.upload__inputfile').each(function () {--}}
{{--                $(this).on('change', function (e) {--}}
{{--                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');--}}
{{--                    var maxLength = $(this).attr('data-max_length');--}}

{{--                    var files = e.target.files;--}}
{{--                    var filesArr = Array.prototype.slice.call(files);--}}
{{--                    var iterator = 0;--}}
{{--                    filesArr.forEach(function (f, index) {--}}

{{--                        if (!f.type.match('image.*')) {--}}
{{--                            return;--}}
{{--                        }--}}

{{--                        if (imgArray.length > maxLength) {--}}
{{--                            return false--}}
{{--                        } else {--}}
{{--                            var len = 0;--}}
{{--                            for (var i = 0; i < imgArray.length; i++) {--}}
{{--                                if (imgArray[i] !== undefined) {--}}
{{--                                    len++;--}}
{{--                                }--}}
{{--                            }--}}
{{--                            if (len > maxLength) {--}}
{{--                                return false;--}}
{{--                            } else {--}}
{{--                                imgArray.push(f);--}}

{{--                                var reader = new FileReader();--}}
{{--                                reader.onload = function (e) {--}}
{{--                                    var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";--}}
{{--                                    imgWrap.append(html);--}}
{{--                                    iterator++;--}}
{{--                                }--}}
{{--                                reader.readAsDataURL(f);--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}
{{--                });--}}
{{--            });--}}

{{--            $('body').on('click', ".upload__img-close", function (e) {--}}
{{--                var file = $(this).parent().data("file");--}}
{{--                for (var i = 0; i < imgArray.length; i++) {--}}
{{--                    if (imgArray[i].name === file) {--}}
{{--                        imgArray.splice(i, 1);--}}
{{--                        break;--}}
{{--                    }--}}
{{--                }--}}
{{--                $(this).parent().parent().remove();--}}
{{--            });--}}
{{--        }--}}

{{--    </script>--}}




@endsection
