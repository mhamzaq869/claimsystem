
@extends('user.layouts.master')

@section('main-content')
<style>
    .list{
        width: 100%;
    }
    .nice-select{
        line-height: 40px;
    }
    input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
</style>
<!-- add to document <head> -->
    <link href="{{ asset('css/tagsinput.css') }}" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/image-uploader.css') }}">

    @include('user.layouts.notification')

    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
    <h3 class="mb-3 display-4">Edit Project</h3>
    <form action="{{ route('user.project.update',[$project->id]) }}" onkeydown="e.preventDefault()" method="POST" id="projectForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$project->id}}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <input id="product_id" name="title" placeholder="Title" value="{{$project->title}}" class="form-control py-2 pl-2 input-md" required type="text">
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-3">
                <select class="w-100" name="category">
                    <option>All Category</option>
                    @foreach (Helper::getAllCategory() as $cat)
                        <option value="{{ $cat->id }}" @if($project->category == $cat->id) selected @endif>{{ $cat->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="delivery" class="w-100">
                    <option value="1" @if($project->delivery == 1) selected @endif>1 day</option>
                    @php for($i=2; $i <= 10; $i++): @endphp
                    <option value="{{ $i }}" @if($project->delivery == $i) selected @endif>{{ $i }} days</option>
                    @php endfor; @endphp
                    <option value="20" @if($project->delivery == 20) selected @endif>20 days</option>
                    <option value="30" @if($project->delivery == 30) selected @endif>30 days</option>
                </select>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="sr-only" for="exampleInputAmount">Amount ($)</label>
                    <div class="input-group">
                      <div class="input-group-addon">$</div>
                      <input type="number" name="price" min="0.00" step="0.05" value="{{$project->price}}" id="exampleInputAmount" class="form-control py-2 pl-2 input-md" placeholder="Price">
                    </div>
                  </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="sr-only" for="exampleInputAmount">Preferred Location</label>

                    <input type="text" name="pref_location" class="form-control py-2 pl-2 input-md" value="{{$project->preff_location}}" placeholder="Preferred Location">

                  </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <textarea class="ckeditor form-control" name="description">
                        {!! $project->description !!}
                    </textarea>
                </div>
            </div>
        </div>
        @php
            $img = [];
            if($project->images):
                foreach (json_decode($project->images) as $photo):
                        array_push($img,asset($photo));
                endforeach;
            endif;
        @endphp

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="field" align="left"></div>

                    <div class="input-field">
                        <label class="active">Photos</label>
                        <input type="file" id="files" name="files[]" multiple hidden/>
                        <div class="input-images-2" style="padding-top: .5rem;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control py-2 pl-2 input-md" value="{{$project->keywords}}" name="keywords" data-role="tagsinput" placeholder="Add Keywords" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <input type="submit" class="btn btn-primary" value="Submit" />
            </div>
        </div>

    </form>
    <script type="text/javascript" src="{{ asset('js/image-uploader.js') }}"></script>
    <script>

    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
            event.preventDefault();
            return false;
            }
        });
    });

    let preloaded = [];
    var images = @json($img);

    for(var i=0; i<images.length; i++){
        preloaded.push({id: i, src: images[i]} );
    }

   $('.input-images-2').imageUploader({
        preloaded: preloaded,
        imagesInputName: 'photo',
        preloadedInputName: 'old',
        maxSize: 2 * 1024 * 1024,
        maxFiles: 10
    });

    for(var i=0; i<images.length; i++){
      document.querySelectorAll('input[name="old[]"]')[i].value = images[i]
    }

    </script>



@endsection

