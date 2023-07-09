<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-mv-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img alt="Logo" src="{{ auth()->user()->avatar_url }}" />
            </div>
            <!--end::Avatar-->

            <!--begin::Username-->
            <div class="d-flex flex-column">
                <div class="fw-bolder d-flex align-items-center fs-5">
                    {{ auth()->user()->name }}
                    <!-- <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span> -->
                </div>
                @foreach(auth()->user()->getRoleNames() as $_role)
                @if(!empty($_role))
                <span class="d-flex align-items-center text-gray-400 text-hover-primary mt-2 mb-2">                    
                    <!--begin::Badge-->
                    <div class="badge badge-lg badge-light-primary d-inline">{{ ucwords($_role) }}</div>
                    <!--end::Badge-->
                </span>
                @endif
                @endforeach                
                <span class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</span>
            </div>
            <!--end::Username-->
        </div>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->

    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="{{ theme()->getPageUrl('account/overview') }}" class="menu-link px-5">
            {{ __('My Profile') }}
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->
    <?php
    // $lang = [ 'en' => 'English', 'ar' => 'العَرَبِيَّة', 'tr' => 'Türkçe', 'bn' => 'বাংলা', 'es' => 'Español', 'fr'=>'Français', 'pt'=>'Português', 'te'=>'తెలుగు', 'th' => 'ภาษาไทย', 'vi'=> 'Tiếng Việt' ];
    //available languages
    $lang['en'] = array('English' => 'united-states');
    $lang['ar'] = array('العَرَبِيَّة' => 'saudi-arabia');
    $lang['tr'] = array('Türkçe' => 'turkey');
    $lang['bn'] = array('বাংলা' => 'bangladesh');
    $lang['es'] = array('Español' => 'spain');
    $lang['fr'] = array('Français' => 'france');
    $lang['pt'] = array('Português' => 'brazil');
    $lang['te'] = array('తెలుగు' => 'india');
    $lang['th'] = array('ภาษาไทย' => 'thailand');
    $lang['vi'] = array('Tiếng Việt' => 'vietnam');
    ?>
    <!--begin::Menu item-->
    <div class="menu-item px-5" data-mv-menu-trigger="hover" data-mv-menu-placement="left-start">
        <a href="#" class="menu-link px-5">
            <span class="menu-title position-relative">
                {{ __('Language') }}
                <?php foreach ($lang as $locale => $values) { ?>
                    @if(app()->getLocale() == $locale)
                    <?php foreach ($values as $txt => $flag) { ?>
                        <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                            {{ $txt }} <img class="w-15px h-15px rounded-1 ms-2" src="{{ asset(theme()->getMediaUrlPath() . 'flags/'.$flag.'.svg') }}" alt="{{$flag}}_flag" />
                        </span>
                    <?php } ?>
                    @endif
                <?php } ?>
            </span>
        </a>

        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-dropdown w-175px py-4">
            <!--begin::Menu item-->
            <?php foreach ($lang as $locale => $values) { ?>
                <div class="menu-item px-3">
                    <a href="#" class="menu-link d-flex px-5 {{ (app()->getLocale() == $locale )? 'active' : '' }}" data-mv-language-switcher="{{ $locale }}" name="data-mv-language-switcher">
                        <?php foreach ($values as $txt => $flag) { ?>
                            <span class="symbol symbol-20px me-4">
                                <img class="rounded-1" src="{{ asset(theme()->getMediaUrlPath() . 'flags/'.$flag.'.svg') }}" alt="{{$flag}}_flag" />
                            </span>
                            {{ $txt }}
                        <?php } ?>
                    </a>
                </div>
            <?php } ?>
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-5 my-1">
        <a href="{{ theme()->getPageUrl('settings.index') }}" class="menu-link px-5">
            {{ __('Account Settings') }}
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <form action="{{ theme()->getPageUrl('logout') }}" method="post" id="logoutForm">
            @csrf
            <!-- {{ csrf_field() }} -->
            <a href="" class="button-ajax menu-link px-5" id="mv_user_sign_out">
                {{ __('Sign Out') }}
            </a>
        </form>

    </div>
    <!--end::Menu item-->

    @if (theme()->isDarkModeEnabled())
    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->

    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <div class="menu-content px-5">
            <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="mv_user_menu_dark_mode_toggle">
                <input class="form-check-input w-30px h-20px" type="checkbox" value="1" name="skin" id="mv_user_menu_dark_mode_toggle" {{ theme()->isDarkMode() ? 'checked' : '' }} data-mv-url="{{ theme()->getPageUrl(url()->full(), '', theme()->isDarkMode() ? '' : 'dark') }}" />
                <span class="pulse-ring ms-n1"></span>

                <span class="form-check-label text-gray-600 fs-7">
                    {{ __('Dark Mode') }}
                </span>
            </label>
        </div>
    </div>
    <!--end::Menu item-->
    @endif
</div>
<!--end::Menu-->