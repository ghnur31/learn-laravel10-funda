<x-app-web-layout>

  <x-slot:title>
    Add Categories
  </x-slot>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">

        @if (Session::has('success'))
        <div class="alert alert-success">
          {{ Session::get('success') }}
        </div>
        @endif

        <div class="card">
          <div class="card-header">
            <h4>Add Categories
              <a href="{{ url('categories') }}" class="btn btn-primary float-end">
                Back
              </a>
            </h4>            
          </div> 

          <div class="card-body">
            <form action="{{ url('categories/create') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" id="description" value="{{ old('description') }}">
                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <div class="mb-3">
                <label for="is_active">Is Active</label>
                <br>
                <input type="checkbox" name="is_active" style="height: 30px; width: 30px">
                @error('is_active')<span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <div class="mb-3">
                <label>Upload File/Image</label>
                <input type="file" name="image" class="form-control" id="image" onchange="previewImage(event)">
                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                <div class="mt-2" id="image_preview_container" style="display: none;">
                  <img id="image_preview" src="#" alt="Image Preview" style="max-width: 200px;">
                </div>
              </div>  
              <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Function to preview image after selecting file
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function(){
        var output = document.getElementById('image_preview');
        output.src = reader.result;
        document.getElementById('image_preview_container').style.display = 'block'; // Menampilkan preview container setelah gambar diunggah
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

</x-app-web-layout>
