@extends('dashboard.common.app')
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Profile Personal Information-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
            @include('dashboard.admin.partial.sidebar')
            <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <!--begin::Header-->
                        <div class="card-header py-3">
                            <div class="card-title align-items-start flex-column">
                                <h3 class="card-label font-weight-bolder text-dark">Change Password</h3>
                                <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account password</span>
                            </div>

                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{route('doChangePassword',\Illuminate\Support\Facades\Auth::user()->id)}}" method="POST" class="form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Password</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input name="password" type="password" class="form-control form-control-lg form-control-solid mb-2"  placeholder="Current password" />

                                    </div>
                                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">New Password</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input name="new_password" type="password" class="form-control form-control-lg form-control-solid"  placeholder="New password" />
                                    </div>
                                    @error('new_password')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">Verify Password</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input name="new_password_confirmation" type="password" class="form-control form-control-lg form-control-solid"  placeholder="Verify password" />
                                    </div>
                                    @error('new_password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile Personal Information-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@endsection
@section('scripts')
    <script src="{{asset('dashboard/assets/js/pages/widgets.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/custom/profile/profile.js')}}"></script>
@endsection
