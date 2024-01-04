@if(View::hasSection('contentHeader') || View::hasSection('contentHeaderTitle'))
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="px-4 col-md-12 d-flex justify-content-between">
                    @if(trim($__env->yieldContent('contentHeaderTitle')))
                        <h1 class="m-0">@yield('contentHeaderTitle')</h1>
                    @else
                        <h1>&nbsp;</h1>
                    @endif
                    @yield('contentHeader')
                </div>
            </div>
        </div>
    </div>
@endif