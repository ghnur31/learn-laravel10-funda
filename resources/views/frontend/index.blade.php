<x-app-web-layout>

  <x-slot:title>
    Products
  </x-slot>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Products
              <a href="{{ url('categories/create') }}" class="btn btn-primary float-end">
                Add Product
              </a>
            </h4>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Images</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Is Active</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                  <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td><a href="{{ url('products/'.$product->id.'/upload') }}" class="btn btn-info">Add / View Images</a></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>
                      <a href="{{ url('categories/'.$product->id.'/edit') }}" class="btn btn-success">Edit</a>
                      <form action="{{ url('categories/'.$product->id.'/delete') }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button 
                          type="submit" 
                          class="btn btn-danger"
                          onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</x-app-web-layout>
