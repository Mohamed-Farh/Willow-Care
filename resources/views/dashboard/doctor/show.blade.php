@extends('dashboard.common.app')
@section('style')
    <style>
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        .modal-2 {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        .modal-content-2 {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        .modal-content-2,
        #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }

        .close-2 {
            position: absolute;
            top: 87px;
            right: 333px;
            color: darkred;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close-2:hover,
        .close-2:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        @media only screen and (max-width: 700px) {
            .modal-content-2 {
                width: 100%;
            }
        }
    </style>
@endsection
@section('content')

    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <!--begin::Details-->
                <div class="d-flex mb-9">
                    <!--begin: Pic-->
                    <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                        <div class="symbol symbol-50 symbol-lg-120">
                            <img src="{{asset($doctor->image)}}" alt="image"/>
                        </div>
                        <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                            <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between flex-wrap mt-1">
                            <div class="d-flex mr-3">
                                <a href="{{route('doctor.show',$doctor->id)}}"
                                   class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{$doctor->name}}</a>
                                @if($doctor->is_approved===1)
                                    <a href="{{route('doctor.show',$doctor->id)}}">
                                        <i class="flaticon2-correct text-success font-size-h5"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="my-lg-0 my-3">
                                {{--                               <a href="#" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">ask</a>--}}
                                {{--                               <a href="#" class="btn btn-sm btn-info font-weight-bolder text-uppercase">hire</a>--}}
                            </div>
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap justify-content-between mt-1">
                            <div class="d-flex flex-column flex-grow-1 pr-8">
                                <div class="d-flex flex-wrap mb-4">
                                    <a href="{{route('doctor.show',$doctor->id)}}"
                                       class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <i class="flaticon2-new-email mr-2 font-size-lg"></i>{{$doctor->email}}</a>
                                    <a href="{{route('doctor.show',$doctor->id)}}"
                                       class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>{{$doctor->phone}}</a>
                                    <a href="{{route('doctor.show',$doctor->id)}}"
                                       class="text-dark-50 text-hover-primary font-weight-bold">
                                        <i class="flaticon2-placeholder mr-2 font-size-lg"></i>{{$doctor->country->country}}
                                    </a>
                                </div>


                            </div>
                            <div class="d-flex flex-column flex-grow-1 pr-8">
                                <div class="d-flex flex-wrap mb-4">
                                    <a href="{{route('doctor.show',$doctor->id)}}"
                                       class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <i class="flaticon-profile mr-2 font-size-lg"></i>{{$doctor->profTitle->title ?? ""}}
                                    </a>
                                    <a href="{{route('doctor.show',$doctor->id)}}"
                                       class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>{{$doctor->graduation_year}}
                                    </a>
                                    <a href="{{route('doctor.show',$doctor->id)}}"
                                       class="text-dark-50 text-hover-primary font-weight-bold">
                                        <i class="flaticon2-avatar mr-2 font-size-lg"></i>{{$doctor->gender ==0 ?'Male':'Female'}}
                                    </a>
                                </div>

                                <span style="max-width:450px"
                                      class="font-weight-bold text-dark-50 text-truncate">{{$doctor->about}}</span>
                            </div>
                            <div class="d-flex align-items-center w-25 flex-fill float-right mt-lg-12 mt-8">
                                <span class="font-weight-bold text-dark-75">Progress</span>
                                <div class="progress progress-xs mx-3 w-100">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 80%;"
                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="font-weight-bolder text-dark">78%</span>
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
                <div class="separator separator-solid"></div>
                <!--begin::Items-->
                <div class="d-flex align-items-center flex-wrap mt-8">

                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
												<span class="mr-4">
													<i class="flaticon2-safe display-4 text-muted font-weight-bold"></i>
												</span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">Insurance Companies</span>
                            <span class="font-weight-bolder font-size-h5">
													{{count($doctor->insuranceCompanies)}} Companies</span>
                            <a href="#" data-toggle="modal" data-target="#exampleModalSizeDefault-2"
                               class="text-primary font-weight-bolder">View</a>
                        </div>
                    </div>

                    <!--begin::Modal-->
                    <div class="modal fade" id="exampleModalSizeDefault-2" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalSizeDefault" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Insurance
                                        Company</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        @if(count($doctor->insuranceCompanies)>0)
                                            @foreach($doctor->insuranceCompanies as $insurance)
                                                <div class="row">
                                                    <div class="col-2">
                                                        <img
                                                            src="{{asset($insurance->image) ?asset($insurance->image) :'' }}"
                                                            class="rounded" width="40px" alt="">
                                                    </div>
                                                    <li class="col-10" style="list-style:none; padding: 5px">
                                                        {{$insurance->company}}
                                                    </li>
                                                </div>

                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                            data-dismiss="modal">Close
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Modal-->

                    <!--begin::Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
												<span class="mr-4">
													<i class="flaticon-edit-1 display-4 text-muted font-weight-bold"></i>
												</span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">Certifications</span>
                            <span class="font-weight-bolder font-size-h5">
													{{count($doctor->certifications)}}</span>
                        </div>
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->

                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
												<span class="mr-4">
													<i class="flaticon2-hospital display-4 text-muted font-weight-bold"></i>
												</span>
                        <div class="d-flex flex-column flex-lg-fill">
                            <span class="text-dark-75 font-weight-bolder font-size-sm">{{count($doctor->clinics)}} Clinics</span>
                            {{--                           <a href="#" class="text-primary font-weight-bolder">View</a>--}}
                        </div>
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
												<span class="mr-4">
													<i class="flaticon-clipboard display-4 text-muted font-weight-bold"></i>
												</span>
                        <div class="d-flex flex-column">
                            <span class="text-dark-75 font-weight-bolder font-size-sm">{{count($doctor->specialties)}} Specialities</span>
                            <a href="#" data-toggle="modal" data-target="#exampleModalSizeDefault"
                               class="text-primary font-weight-bolder">View</a>

                        </div>
                    </div>

                    <!--begin::Modal-->
                    <div class="modal fade" id="exampleModalSizeDefault" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalSizeDefault" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Specialities</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        @if(count($doctor->specialties)>0)
                                            @foreach($doctor->specialties as $spec)
                                                <div class="row">
                                                    <div class="col-2">
                                                        <img src="{{asset($spec->icon) ?asset($spec->icon) :'' }}"
                                                             class="rounded" width="40px" alt="">
                                                    </div>
                                                    <li class="col-10" style="list-style:none; padding: 5px">
                                                        {{$spec->speciality}}
                                                    </li>
                                                </div>

                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                            data-dismiss="modal">Close
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Modal-->


                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center flex-lg-fill mb-2 float-left">
												<span class="mr-4">
													<i class="flaticon-network display-4 text-muted font-weight-bold"></i>
												</span>
                        <div class="symbol-group symbol-hover">
                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Mark Stone">
                                <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_25.jpg')}}"/>
                            </div>
                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Charlie Stone">
                                <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_19.jpg')}}"/>
                            </div>
                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Luca Doncic">
                                <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_22.jpg')}}"/>
                            </div>
                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Nick Mana">
                                <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_23.jpg')}}"/>
                            </div>
                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Teresa Fox">
                                <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_18.jpg')}}"/>
                            </div>
                            <div class="symbol symbol-30 symbol-circle symbol-light">
                                <span class="symbol-label font-weight-bold">5+</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Item-->
                </div>
                <!--begin::Items-->
            </div>
        </div>
        <!--end::Card-->
        <div class="accordion accordion-solid accordion-panel accordion-svg-toggle" id="accordionExample8">
            <div class="card">
                <div class="card-header" id="headingOne8">
                    <div class="card-title" data-toggle="collapse" data-target="#collapseOne8">
                        <div class="card-label">Licences</div>
                        <span class="svg-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path
                                        d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
                                        fill="#000000" fill-rule="nonzero"/>
                                    <path
                                        d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"
                                        transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"/>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                </div>
                <div id="collapseOne8" class="collapse show" data-parent="#accordionExample8">
                    <div class="card-body">
                        <div class="row">
                            @if(count($doctor->licenses )>0)
                                @foreach($doctor->licenses as $licence)
                                    <div class="col-6">
                                        <img class="rounded" width="400px" src="{{asset($licence->image)}}" alt="">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo8">
                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo8">
                        <div class="card-label">Certifications</div>
                        <span class="svg-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path
                                    d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
                                    fill="#000000" fill-rule="nonzero"/>
                                <path
                                    d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3"
                                    transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"/>
                            </g>
                        </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                </div>
                <div id="collapseTwo8" class="collapse" data-parent="#accordionExample8">
                    <div class="card-body">
                        <div class="row">
                            @if(count($doctor->certifications )>0)
                                @foreach($doctor->certifications as $certification)
                                    <div class="col-2">
                                        <img class="myImages rounded" id="myImg" width="150px"
                                             src="{{asset($certification->image)}}" alt="">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- The Modal -->
                        <div id="myModal" class="modal-2">
                            <span class="close-2">&times;</span>
                            <img class="modal-content-2" id="img01">
                            <div id="caption"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 mb-3 ">
                <div class="card text-center py-3">
                    <h1>Home & Online Consultation</h1>
                </div>
            </div>
            <div class="col-xl-6">
                <!--begin::Card-->
                @if(count($doctor->homeConcultations)>0)
                <div class="card card-custom ">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Section-->
                        <div class="d-flex align-items-center">
                            <!--begin::Pic-->
                            <div class="flex-shrink-0 mr-4 symbol symbol-65 symbol-circle">
                                <i class="fas fa-home fa-3x text-primary"></i>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column mr-auto">
                                <!--begin: Title-->
                                <a href=""
                                   class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">
                                    Home Consultation
                                </a>

                                <!--end::Title-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar mb-auto">
                                  <button  type="button" data-toggle="modal" data-target="#exampleModalSizeDefault-3" class="btn btn-primary">Shifts</button>
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Modal-->
                            <div class="modal fade" id="exampleModalSizeDefault-3" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalSizeDefault" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Working Hours</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                @if(count($doctor->homeConcultations)>0)
                                                    @foreach($doctor->homeConcultations[0]->workingTimes as $home)
                                                        <div class="row">

                                                            <p class="col-10" style="list-style:none; padding: 5px">
                                                                {{array_flip((new \ReflectionClass(\App\Enum\WeekDaysEnum::class))->getConstants())[$home->day]}} =>
                                                                {{\Carbon\Carbon::parse($home->from)->format('H:i')}}
                                                                 ,
                                                                {{\Carbon\Carbon::parse($home->to)->format('H:i')}}

                                                            </p>
                                                        </div>

                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                                    data-dismiss="modal">Close
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Modal-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap mt-14">
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="d-block font-weight-bold mb-4">Price</span>
                                <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{$doctor->homeConcultations[0]->price}} $</span>
                            </div>
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="d-block font-weight-bold mb-4">Renwal Price</span>
                                <span
                                    class="btn btn-light-warning btn-sm font-weight-bold btn-upper btn-text">{{$doctor->homeConcultations[0]->renewal_price}} $</span>
                            </div>
                            <!--begin::Progress-->
                            <div class="flex-row-fluid mb-7">

                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Text-->
                        <p class="mb-7 mt-3">Payment Method : <span><i class="fab fa-cc-visa mr-2"></i>{{$doctor->homeConcultations[0]->payment_method ==1 ?  'Online' :($doctor->homeConcultations[0]->payment_method ==2 ? 'Cash':'Both')}}</span></p>
                        <!--end::Text-->
                        <!--begin::Blog-->
                        <div class="d-flex flex-wrap">
                            <!--begin: Item-->
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="font-weight-bolder mb-4">Budget</span>
                                <span class="font-weight-bolder font-size-h5 pt-1">
														<span
                                                            class="font-weight-bold text-dark-50">$</span>249,500</span>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="font-weight-bolder mb-4">Expenses</span>
                                <span class="font-weight-bolder font-size-h5 pt-1">
														<span
                                                            class="font-weight-bold text-dark-50">$</span>439,500</span>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                                <span class="font-weight-bolder mb-4">Members</span>
                                <div class="symbol-group symbol-hover">
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                         title="Mark Stone">
                                        <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_25.jpg')}}"/>
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                         title="Charlie Stone">
                                        <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_19.jpg')}}"/>
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                         title="Luca Doncic">
                                        <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_22.jpg')}}"/>
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Nick Mana">
                                        <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_23.jpg')}}"/>
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle symbol-light">
                                        <span class="symbol-label font-weight-bold">4+</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Blog-->
                    </div>
                    <!--end::Body-->

                </div>
                <!--end::Card-->
                @endif
            </div>
            <div class="col-xl-6">
                <!--begin::Card-->
                @if(count($doctor->onlineConcultations)>0)
                <div class="card card-custom ">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Section-->
                        <div class="d-flex align-items-center">
                            <!--begin::Pic-->
                            <div class="flex-shrink-0 mr-4 symbol symbol-65 symbol-circle">
                                <i class="fab fa-internet-explorer fa-3x text-primary"></i>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column mr-auto">
                                <!--begin: Title-->
                                <a href=""
                                   class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">
                                   Online Consultation
                                </a>

                                <!--end::Title-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar mb-auto">
                                <button data-toggle="modal" data-target="#exampleModalSizeDefault-4" class="btn btn-primary">Shifts</button>
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Modal-->
                            <div class="modal fade" id="exampleModalSizeDefault-4" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalSizeDefault" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Working Hours</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                @if(count($doctor->onlineConcultations)>0)
                                                    @foreach($doctor->onlineConcultations[0]->workingTimes as $online)
                                                        <div class="row">

                                                            <p class="col-10" style="list-style:none; padding: 5px">
                                                                {{array_flip((new \ReflectionClass(\App\Enum\WeekDaysEnum::class))->getConstants())[$online->day]}} =>
                                                                {{\Carbon\Carbon::parse($online->from)->format('H:i')}}

                                                                ,
                                                                {{\Carbon\Carbon::parse($online->to)->format('H:i')}}

                                                            </p>
                                                        </div>

                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                                    data-dismiss="modal">Close
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Modal-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap mt-14">
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="d-block font-weight-bold mb-4">Price</span>
                                <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{$doctor->onlineConcultations[0]->price}} $</span>
                            </div>
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="d-block font-weight-bold mb-4">Renwal Price</span>
                                <span
                                    class="btn btn-light-warning btn-sm font-weight-bold btn-upper btn-text">{{$doctor->onlineConcultations[0]->renewal_price}} $</span>
                            </div>
                            <!--begin::Progress-->
                            <div class="flex-row-fluid mb-7">

                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Text-->
                        <p class="mb-7 mt-3">Payment Method : <span><i class="fas fa-money-bill mr-2"></i>Cash</span></p>
                        <!--end::Text-->
                        <!--begin::Blog-->
                        <div class="d-flex flex-wrap">
                            <!--begin: Item-->
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="font-weight-bolder mb-4">Budget</span>
                                <span class="font-weight-bolder font-size-h5 pt-1">
														<span
                                                            class="font-weight-bold text-dark-50">$</span>249,500</span>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="font-weight-bolder mb-4">Expenses</span>
                                <span class="font-weight-bolder font-size-h5 pt-1">
														<span
                                                            class="font-weight-bold text-dark-50">$</span>439,500</span>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                                <span class="font-weight-bolder mb-4">Members</span>
                                <div class="symbol-group symbol-hover">
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                         title="Mark Stone">
                                        <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_25.jpg')}}"/>
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                         title="Charlie Stone">
                                        <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_19.jpg')}}"/>
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                         title="Luca Doncic">
                                        <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_22.jpg')}}"/>
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Nick Mana">
                                        <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_23.jpg')}}"/>
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle symbol-light">
                                        <span class="symbol-label font-weight-bold">4+</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Blog-->
                    </div>
                    <!--end::Body-->

                </div>
                <!--end::Card-->
                @endif
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 mb-3 ">
                <div class="card text-center py-3">
                    <h1>Clinics</h1>
                </div>
            </div>
            @if(count($doctor->clinics)>0)
            @foreach($doctor->clinics as $clinic)

            <div class="col-xl-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Section-->
                        <div class="d-flex align-items-center">
                            <!--begin::Pic-->
                            <div class="flex-shrink-0 mr-4 symbol symbol-65 symbol-circle">
                                <img src="{{asset($clinic->image)}}" alt="image"/>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column mr-auto">
                                <!--begin: Title-->
                                <a href="#"
                                   class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{$clinic->name}}</a>
                                <span class="text-muted font-weight-bold">{{$clinic->location}}</span>
                                <!--end::Title-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar mb-auto">

                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap mt-14">
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="d-block font-weight-bold mb-4">Price</span>
                                <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{$clinic->price}} $</span>
                            </div>
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="d-block font-weight-bold mb-4">Renewal Price</span>
                                <span
                                    class="btn btn-light-warning btn-sm font-weight-bold btn-upper btn-text">{{$clinic->renewal_price}} $</span>
                            </div>
                            <!--begin::Progress-->
                            <div class="flex-row-fluid mb-7">
                              <p>Waiting Time: <i class="fas fa-user-clock text-warning mr-2"></i>{{\Carbon\Carbon::parse($clinic->duration)->format('H:i')}}</p>
                              <p>Phone: <i class="fas fa-phone-square-alt text-primary mr-2"></i>{{$clinic->phone}}</p>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Text-->
                        <p class="mb-7 mt-3"></p>
                        <!--end::Text-->
                        <!--begin::Blog-->
                        <div class="d-flex flex-wrap">
                            <!--begin: Item-->
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="font-weight-bolder mb-4">Budget</span>
                                <span class="font-weight-bolder font-size-h5 pt-1">
														<span
                                                            class="font-weight-bold text-dark-50">$</span>249,500</span>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="font-weight-bolder mb-4">Expenses</span>
                                <span class="font-weight-bolder font-size-h5 pt-1">
														<span
                                                            class="font-weight-bold text-dark-50">$</span>439,500</span>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                                <span class="font-weight-bolder mb-4">Members</span>
                                <div class="symbol-group symbol-hover">
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                         title="Mark Stone">
                                        <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_25.jpg')}}"/>
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                         title="Charlie Stone">
                                        <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_25.jpg')}}"/>
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                         title="Luca Doncic">
                                        <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_25.jpg')}}"/>
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Nick Mana">
                                        <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_25.jpg')}}"/>
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                         title="Teresa Fox">
                                        <img alt="Pic" src="{{asset('dashboard/assets/media/users/300_25.jpg')}}"/>
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle symbol-light">
                                        <span class="symbol-label font-weight-bold">5+</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Blog-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer d-flex align-items-center">
                        <div class="d-flex">
                            <div class="d-flex align-items-center mr-7">
                                    <span class="svg-icon svg-icon-gray-500">

                                                                     <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Clipboard-check.svg--><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                                        viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path
                                        d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                        fill="#000000" opacity="0.3"/>
                                        <path
                                        d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z"
                                        fill="#000000"/>
                                        <path
                                        d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                        fill="#000000"/>
                                        </g>
                                        </svg>

                                    </span>
                                <a href="#" class="font-weight-bolder text-primary ml-2">72 Bookings</a>
                            </div>
                            <div class="d-flex align-items-center mr-7">
                            <span class="svg-icon svg-icon-gray-500">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                     height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none"
                                       fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path
                                            d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z"
                                            fill="#000000"/>
                                        <path
                                            d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z"
                                            fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                                <a href="#" class="font-weight-bolder text-primary ml-2">648 Comments</a>
                            </div>
                        </div>
                        <button data-toggle="modal" data-target="#modal-{{$clinic->id}}"
                                class="btn btn-primary btn-sm text-uppercase font-weight-bolder mt-5 mt-sm-0
                                mr-auto mr-sm-0 ml-sm-auto">
                            Shifts
                        </button>
                    </div>
                    <!--end::Footer-->
                    <!--begin::Modal-->
                    <div class="modal fade" id="modal-{{$clinic->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalSizeDefault" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Working Hours</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        @if(count($clinic->workingTimes)>0)
                                            @foreach($clinic->workingTimes as $time)
                                                <div class="row">

                                                    <p class="col-10" style="list-style:none; padding: 5px">
                                                        {{array_flip((new \ReflectionClass(\App\Enum\WeekDaysEnum::class))->getConstants())[$time->day]}} =>
                                                        {{\Carbon\Carbon::parse($time->from)->format('H:i')}}
                                                        ,
                                                        {{\Carbon\Carbon::parse($time->to)->format('H:i')}}

                                                    </p>
                                                </div>

                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                            data-dismiss="modal">Close
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Modal-->
                </div>
                <!--end::Card-->
            </div>
            @endforeach
            @endif
        </div>
    </div>
@endsection




@section('scripts')
    <script>
        // create references to the modal...
        var modal = document.getElementById('myModal');
        // to all images -- note I'm using a class!
        var images = document.getElementsByClassName('myImages');
        // the image in the modal
        var modalImg = document.getElementById("img01");
        // and the caption in the modal
        var captionText = document.getElementById("caption");

        // Go through all of the images with our custom class
        for (var i = 0; i < images.length; i++) {
            var img = images[i];
            // and attach our click listener for this image.
            img.onclick = function (evt) {
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }
        }

        var span = document.getElementsByClassName("close-2")[0];

        span.onclick = function () {
            modal.style.display = "none";
        }
    </script>
@endsection
