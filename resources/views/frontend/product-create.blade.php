<x-app-web-layout>
  <x-slot:title>
    Product Create
  </x-slot>

  <div class="container mt-5">
    <form action="{{ url('/products/create') }}" method="POST">
      @csrf
      <div class="row justify-content-center">
        <div class="col-md-6">
          @if (Session::has('success'))
          <div class="alert alert-success">
            {{ Session::get('success') }}
          </div>
          @endif

          {{-- @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif --}}

          <div class="card">
            <div class="card-body">
              <div class="mb-3">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" >
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
              </div>                
              <div class="mb-3">
                <label for="description">Product Description</label>
                <textarea name="description" class="form-control" id="" rows="3"></textarea>
                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
              </div>                
              <div class="mb-3">
                <label for="price">Product Price</label>
                <input type="text" name="price" class="form-control">
                @error('price')<span class="text-danger">{{ $message }}</span>@enderror
              </div>                
              <div class="mb-3">
                <label for="stock">Product Stock</label>
                <input type="text" name="stock" class="form-control">
                @error('stock')<span class="text-danger">{{ $message }}</span>@enderror
              </div>                
              <div class="mb-3">
                <label for="is_active">Is Active</label>
                <br>
                <input type="checkbox" name="is_active" style="height: 30px; width: 30px">
                @error('is_active')<span class="text-danger">{{ $message }}</span>@enderror
              </div>        
              <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>

        </div>  
      </div>
    </form>                     
  </div>  

  <x-slot:scripts>
    <script>
      console.log('this is my script area');
    </script>
  </x-slot>
</x-app-web-layout>
