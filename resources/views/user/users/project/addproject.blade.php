
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
    <h3 class="mb-3 display-4">Add Project</h3>
    <form action="{{ route('user.project.store') }}" onkeydown="e.preventDefault()" method="POST" id="projectForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <input id="product_id" name="title" placeholder="Title" class="form-control py-2 pl-2 input-md" required="" type="text">
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-3">
                <select class="w-100" name="category">
                    <option>All Category</option>
                    @foreach (Helper::getAllCategory() as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="delivery" class="w-100">
                    <option value="1">1 day</option>
                    @php for($i=2; $i <= 10; $i++): @endphp
                    <option value="{{ $i }}">{{ $i }} days</option>
                    @php endfor; @endphp
                    <option value="20">20 days</option>
                    <option value="30">30 days</option>
                </select>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="sr-only" for="exampleInputAmount">Amount (in PKR)</label>
                    <div class="input-group">
                      <div class="input-group-addon">R.s</div>
                      <input type="number" name="price" min="0.00" step="0.05" value="1.00" id="exampleInputAmount" class="form-control py-2 pl-2 input-md" placeholder="Price">
                    </div>
                  </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="sr-only" for="exampleInputAmount">Preferred Location</label>
                    
                    <input type="text" name="pref_location" class="form-control py-2 pl-2 input-md" placeholder="Preferred Location">
                    
                  </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <textarea class="ckeditor form-control" name="description"></textarea>
                </div>
            </div>
        </div>

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
                    <input type="text" class="form-control py-2 pl-2 input-md" value="" name="keywords" data-role="tagsinput" placeholder="Add Keywords" />                </div>
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
    
        $('.input-images-2').imageUploader({
            preloaded: preloaded,
            imagesInputName: 'photos',
            preloadedInputName: 'old',
            maxSize: 2 * 1024 * 1024,
            maxFiles: 10
        });
    
    </script>



@endsection

