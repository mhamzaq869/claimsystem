@extends('user.layouts.master')

@section('title', 'Profile Setting')

@section('main-content')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/image-uploader.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h4 class=" font-weight-bold">Profile</h4>
            <ul class="breadcrumbs">
                <li><a href="{{ route('admin') }}" style="color:#999">Dashboard</a></li>
                <li><a href="" class="active text-primary">Profile Page</a></li>
            </ul>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="image">
                            @if ($profile->photo)
                                <img class="card-img-top img-fluid roundend-circle mt-4"
                                    style="border-radius:50%;height:80px;width:80px;margin:auto;"
                                    src="{{ asset($profile->photo) }}" alt="profile picture">
                            @else
                                <img class="card-img-top img-fluid roundend-circle mt-4"
                                    style="border-radius:50%;height:80px;width:80px;margin:auto;"
                                    src="{{ asset('backend/img/avatar.png') }}" alt="profile picture">
                            @endif
                        </div>
                        <div class="card-body mt-4 ml-2">
                            <h5 class="card-title text-left"><small><i class="fas fa-user"></i>
                                    {{ $profile->name }}</small>
                            </h5>
                            <p class="card-text text-left"><small><i class="fas fa-envelope"></i>
                                    {{ $profile->email }}</small></p>
                            <p class="card-text text-left"><small class="text-muted"><i class="fas fa-hammer"></i>
                                    {{ $profile->role }}</small></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form class="border px-4 pt-2 pb-3" method="POST"
                        action="{{ route('user-profile-update', $profile->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Name</label>
                            <input id="inputTitle" type="text" name="name" placeholder="Enter name"
                                value="{{ $profile->name }}" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputEmail" class="col-form-label">Email</label>
                            <input id="inputEmail" disabled type="email" name="email" placeholder="Enter email"
                                value="{{ $profile->email }}" class="form-control">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <div class="field" align="left"></div>

                                    <div class="input-field">
                                        <label class="active">Photos</label>
                                        <input type="file" id="files" name="photo[]" hidden />
                                        <div class="input-images-2" style="padding-top: .5rem;"></div>

                                        @php
                                            $img = [];
                                            foreach (explode(',', $profile->photo) as $photo):
                                                array_push($img, asset($photo));
                                            endforeach;
                                        @endphp

                                    </div>
                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        @if (Auth::user()->role == 'vendor' || Auth::user()->role == 'dboy')
                            <div class="form-group">
                                <label for="inputPhoto" class="col-form-label">Bio</label>
                                <div class="input-group">
                                    <textarea name="bio" id="" cols="30"
                                        rows="6">{{ auth()->user()->userdetail->bio ?? '' }}</textarea>
                                </div>
                            </div>

                            @if (Auth::user()->role == 'dboy')
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="active">CNIC Frontside</label>
                                    <input type="file" name="cnic_front" class="dropify"
                                    data-default-file="{{asset(Auth::user()->userdetail->cnic_front)}}"/>

                                </div>
                                <div class="col-md-6">
                                    <label class="active">CNIC Backside</label>
                                    <input type="file" name="cnic_back" class="dropify"
                                    data-default-file="{{asset(Auth::user()->userdetail->cnic_back)}}"/>
                                </div>
                            </div>
                            @endif


                            <div class="form-group">
                                <label for="inputPhoto" class="col-form-label">city</label>
                                <div class="input-group">
                                    <input id="thumbnail" class="form-control" type="text" name="city"
                                        value="{{ auth()->user()->userdetail->city ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPhoto" class="col-form-label">Country</label>
                                <div class="input-group">
                                    <input id="thumbnail" class="form-control" type="text" name="country"
                                        value="{{ auth()->user()->userdetail->country ?? '' }}">
                                </div>
                            </div>
                            {{-- {{ dd(Request::ip()) }} --}}
                            <div class="form-group">
                                <label for="address_address">Address</label>
                                <input type="text" id="address-input" name="address" class="form-control map-input mb-2"
                                    value="{{ auth()->user()->userdetail->address ?? '' }}">
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="address_address">Latitude</label>
                                    <input type="text" name="lat" class="form-control " id="address-latitude"
                                        value="{{ auth()->user()->userdetail->lat ?? '' }}" />
                                </div>
                                <div class="col-md-6">
                                    <label for="address_address">Longitude</label>
                                    <input type="text" name="long" class="form-control" id="address-longitude"
                                        value="{{ auth()->user()->userdetail->long ?? '' }}" />
                                </div>
                            </div>
                            <div id='printoutPanel'></div>
                            <div id='searchBoxContainer' class="form-group">
                                <label for="address_address">Search Location</label>
                                <input type='text' id='searchBox' class="form-control" />
                            </div>

                            <div id='myMap' style='height: 70vh;'></div>

                        @endif

                        <button type="submit" class="btn btn-success mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

<style>
    .breadcrumbs {
        list-style: none;
    }

    .breadcrumbs li {
        float: left;
        margin-right: 10px;
    }

    .breadcrumbs li a:hover {
        text-decoration: none;
    }

    .breadcrumbs li .active {
        color: red;
    }

    .breadcrumbs li+li:before {
        content: "/\00a0";
    }

    .image {
        background: url('{{ asset('backend/img/background.jpg') }}');
        height: 150px;
        background-position: center;
        background-attachment: cover;
        position: relative;
    }

    .image img {
        position: absolute;
        top: 55%;
        left: 35%;
        margin-top: 30%;
    }

    i {
        font-size: 14px;
        padding-right: 8px;
    }

</style>
<link type="text/css" rel="stylesheet" href="{{ asset('css/image-uploader.css') }}">
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('js/image-uploader.js') }}"></script>

    <script>


                let preloaded = [];
                var images = @json($img);

                for (var i = 0; i < images.length; i++) {
                    preloaded.push({
                        id: i,
                        src: images[i]
                    });
                }

                $('.input-images-2').imageUploader({
                    preloaded: preloaded,
                    imagesInputName: 'photo',
                    preloadedInputName: 'old',
                    maxSize: 2 * 1024 * 1024,
                    maxFiles: 10
                });

                for (var i = 0; i < images.length; i++) {
                    document.querySelectorAll('input[name="old[]"]')[i].value = images[i]
                }


        function loadMapScenario() {
            var map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
                /* No need to set credentials if already passed in URL */
                center: new Microsoft.Maps.Location(47.606209, -122.332071),
                zoom: 12
            });
            Microsoft.Maps.loadModule('Microsoft.Maps.AutoSuggest', function() {
                var options = {
                    maxResults: 4,
                    map: map
                };
                var manager = new Microsoft.Maps.AutosuggestManager(options);
                manager.attachAutosuggest('#searchBox', '#searchBoxContainer', selectedSuggestion);
            });

            function selectedSuggestion(suggestionResult) {
                map.entities.clear();
                map.setView({
                    bounds: suggestionResult.bestView
                });
                var pushpin = new Microsoft.Maps.Pushpin(suggestionResult.location);
                map.entities.push(pushpin);

                document.getElementById('address-input').setAttribute('value', suggestionResult.formattedSuggestion)
                document.getElementById('address-latitude').setAttribute('value', suggestionResult.location.latitude)
                document.getElementById('address-longitude').setAttribute('value', suggestionResult.location.longitude)
            }

        }


    </script>
    <script type='text/javascript'
        src='https://www.bing.com/api/maps/mapcontrol?key={{ env('BING_MAP_KEY') }}&callback=loadMapScenario' async
        defer>
    </script>

    @parent
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
        async defer></script>
    <script src="{{ asset('js/mapInput.js') }}"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endpush
