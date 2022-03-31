<style>
    /*Display Style*/
    #fullscreen {
        width: 100%;
        height: 100%;
    }
    .queue {
        /* font-family: 'Display'; */
        position: relative;
        height: 120px;
        z-index: 1;
        background: #e3e3e3;
    }
    .queue .token {
        padding: 0px;
        margin: 0px;
    }
    .queue.active {
        background: #222222!important;
        color: white!important;
    }
    .queue.active:after {
        display: none;
    }
    .queue-box {
        float: left;
        margin: 0 2px;
        /* font-family: 'Display'; */
    }
    .queue-box-status {
        width: 120px !important;
    }
    .queue-box-element {
        width: 11%;
        /*max-width: 20%;*/
        display: inline-block
    }
    .queue-box .deprt {
        color: white;
        padding: 0px;
        margin: 0px;
        text-align: center;
        background-color: #222222;
    }
    .queue-box-status .item {
        margin: 0px;
        height: 118px;
        font-size:16px;
        font-weight:bolder;
    }
    .queue2 {
        width: 100%;
        height: 118px;
        padding:5px 0;
        float: left;
        z-index: 1;
        position: relative;
        background: #3C8DBC;
        color: #fff;
        border: 1px solid #222222;
    }
    .queue2 .title {
        padding: 0px;
        margin: 0 0 0 5px;
        font-size: 28px;
        color: white;

    }
    .queue2.active {
        background: #222222!important;
        color: white!important;
    }
    .queue2.active:after {
        display: none;
    }
  </style>
<!--begin::Card-->
<div class="card">
    <div class="card-header border-0 py-10">
        <h1 class="card-title align-items-center flex-column">
            <h4>{{ $title }} </h3>
                <span class="text-danger">(enable full-screen mode and wait 10 seconds to adjust the screen)</span>
            {{-- <span class="card-label fw-bolder fs-3 mb-1">Active Tokens </span>
            <span class="text-muted mt-1 fw-bold fs-7">Clients waiting: {{ $waiting }}</span> --}}
           
        </h1>
        <div class="card-toolbar" >
            
            <a href="#" class="btn btn-sm btn-primary btn-active-primary " onclick="goFullscreen('fullscreen'); return false" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to maximize">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                {!! theme()->getSvgIcon("icons/duotune/arrows/arr035.svg", "svg-icon-3") !!}
                <!--end::Svg Icon--></a>
        </div>
    </div>
    <!--begin::Card body-->
    <div class="card-body p-0" id="fullscreen" style="color:{{ (!empty($setting->color)?$setting->color:'#FFF') }}">
     <div class="media">
        <div class="media-left hidden-xs">
          {{-- <img class="media-object" style="height:59px;" src="{{ asset('public/assets/img/icons/logo.jpg') }}" alt="Logo"> --}}
        </div>
        {{-- <div class="media-body" >
          <h2 class="media-heading">
            <marquee direction="{{ (!empty($setting->direction)?$setting->direction:null) }}">
              {{ (!empty($setting->message)?$setting->message:null) }}
            </marquee>
          </h2> 
        </div> --}}
      </div>
