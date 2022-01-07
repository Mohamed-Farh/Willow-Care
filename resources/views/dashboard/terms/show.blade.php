@extends('dashboard.common.app')
@section('style')
    <link href="{{asset('dashboard/assets/css/pages/invoice/invoice-6.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

    <!--begin::Container-->
    <div class="container">
        <div class="card card-custom overflow-hidden">
            <div class="card-body invoice-6 p-0">
                <!--begin::Invoice-->
                <div class="invoice-6-container bgi-size-contain bgi-no-repeat bgi-position-y-top bgi-position-x-center"
                     style="background-image: url({{asset('dashboard/assets/media/svg/shapes/abstract-10.svg')}});">
                    <div class="container">
                        <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                            <div class="col-md-9">
                                <!--begin::Invoice header-->
                                <div
                                    class="d-flex justify-content-between align-items-center flex-column flex-md-row mb-40">
                                    <h1 class="display-3 font-weight-boldest text-white mb-5 mb-md-0">Terms & Condition</h1>

                                </div>
                                <!--end::Invoice header-->

                                <div class="border-bottom w-100 my-5 opacity-15"></div>

                                <!--begin::Invoice note-->
                                <div class="d-flex flex-wrap align-items-end mt-30">
                                    <div>
                                        <div class="font-size-h4 font-weight-boldest title-color mb-3">
                                            {{$term->category->category}} Term And Condition
                                        </div>
                                        <div class="font-size-h6 font-weight-bold note-color max-w-1000px">
                                            {{$term->term}}
                                        </div>
                                    </div>

                                </div>
                                <!--end::Invoice note-->

                                <!--begin::Invoice footer-->
                                <div
                                    class="d-flex justify-content-between flex-column flex-sm-row text-center text-sm-left mt-30">
                                    <div class="font-size-h2 font-weight-bolder text-white"></div>
                                    <!--begin::Logo-->
                                    <a href="#" class="max-w-150px mx-auto mx-sm-0 mt-5 mt-sm-0">
                                    <span  class="svg-icon svg-icon-full svg-logo-white">
                                        <!--begin::Svg Icon | path:assets/media/svg/logos/duolingo.svg-->
                                         <img  src="/images/health.svg" width="70px" alt="My Happy SVG" />
                                        <!--end::Svg Icon-->
                                    </span>
                                    </a>
                                    <!--end::Logo-->
                                </div>
                                <!--end::Invoice footer-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Invoice-->
            </div>
        </div>
    </div>
    <!--end::Container-->

@endsection
@section('scripts')





@endsection
