<x-app-web-layout>

  <x-slot:title>
    Edit Category
  </x-slot>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">

       @if(Session('status'))
       <div class="alert alert-success">
         {{ Session('status') }}
       </div>
       @endif

        <div class="card">
          <div class="card-header">
            <h4>Edit Category
              <a href="{{ url('categories') }}" class="btn btn-primary float-end">
                Back
              </a>
            </h4>            
          </div> 

          <div class="card-body">
            <form action="{{ url('categories/'.$category->id.'/edit') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}">
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" id="description" value="{{ $category->description }}">
                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <div class="mb-3">
                <label for="is_active">Is Active</label>
                <input type="checkbox" name="is_active" style="height: 30px; width: 30px" {{ $category->is_active ? 'checked' : '' }}>
                @error('is_active')<span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <div class="mb-3">
                <label>Upload File/Image</label>
                <input type="file" name="image" class="form-control" id="image" onchange="previewImage(event)">
                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                <div class="mt-2">
                  <img id="image_preview" src="{{ asset($category->image) }}" alt="Image Preview" style="max-width: 200px;">
                  <div id="image_name"></div>
                </div>
              </div>
              <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
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
        var nameOutput = document.getElementById('image_name');
        output.src = reader.result;
        nameOutput.textContent = event.target.files[0].name; // Menampilkan nama file di bawah gambar
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

</x-app-web-layout>
