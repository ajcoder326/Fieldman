@php
    use App\Models\Settings;
    $settings = Settings::first();
@endphp
<footer class="footer position-absolute mt-3">
    <div class="row g-0 justify-content-between align-items-center h-100">
        <div class="col-12 col-sm-auto text-center">
            <p class="mb-0 mt-2 mt-sm-0 text-900"> Code with <i class="bi bi-heart-fill text-danger"></i> by <a
                    class="mx-1" href="https://czappstudio.com" target="_blank">CZ App Studio</a><span
                    class="d-none d-sm-inline-block"></span><span class="d-none d-sm-inline-block mx-1">|</span><br
                    class="d-sm-none"/> &copy; 2024</p>
        </div>
        <div class="col-12 col-sm-auto text-center">
            <p class="mb-0 text-600">V {{$settings->app_version}}</p>
        </div>
    </div>
</footer>

