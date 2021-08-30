@extends('backend.layouts.master')

@section('title','E-SHOP || Banner Create')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Banner</h5>
    <div class="card-body">
      <form method="post" action="{{route('banner.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
        @error('title')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">

                    <div class="field" align="left"></div>

                    <div class="input-field">
                        <label class="active">Photos</label>
                        <input type="file" id="files" name="photo[]" multiple hidden />
                        <div class="input-images-2" style="padding-top: .5rem;"></div>
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link type="text/css" rel="stylesheet" href="{{ asset('css/image-uploader.css') }}">
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script type="text/javascript" src="{{ asset('js/image-uploader.js') }}"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    let preloaded = [];

   $('.input-images-2').imageUploader({
        preloaded: preloaded,
        imagesInputName: 'photo',
        preloadedInputName: 'old',
        maxSize: 2 * 1024 * 1024,
        maxFiles: 10
    });


    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush
