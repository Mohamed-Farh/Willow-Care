<!--begin::Header-->
<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Header Menu Wrapper-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
            </div>
            <!--end::Header Menu-->
        </div>
        <!--end::Header Menu Wrapper-->
        <!--begin::Topbar-->
        <div class="topbar">

            <!--begin::Languages-->
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                        <img class="h-20px w-20px rounded-sm"
                             src="{{asset('dashboard/assets/media/svg/flags/'.\LaravelLocalization::getCurrentLocaleName().'.svg')}}"
                             alt=""/>
                    </div>
                </div>
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div
                    class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Nav-->
                    <ul class="navi navi-hover py-4">
                    @foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <!--begin::Item-->
                            <li class="navi-item">
                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                   href="{{\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                   class="navi-link">
                                <span class="symbol symbol-20 mr-3">
                                    <img src="{{asset('dashboard/assets/media/svg/flags/'.$properties['name'].'.svg')}}"
                                         alt=""/>
                                </span>
                                    <span class="navi-text">{{ $properties['native'] }}</span>
                                </a>
                            </li>
                            <!--end::Item-->
                        @endforeach
                    </ul>
                    <!--end::Nav-->
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Languages-->
            <!--begin::User-->
            <div class="topbar-item">
                <div
                    class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                    id="kt_quick_user_toggle">
                                <span
                                    class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    @if(\Illuminate\Support\Facades\Auth::check())
                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{auth()->user()->name}}</span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
											<span class="symbol-label font-size-h5 font-weight-bold">{{auth()->user()->name[0]}}</span>
										</span>
                    @endif
                </div>
            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->
