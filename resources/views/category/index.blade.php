<x-app-web-layout>

  <x-slot:title>
    Categories
  </x-slot>

  <div class="container mt-5 animate__animated animate__fadeIn ">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Categories
              <a href="{{ url('categories/create') }}" class="btn btn-primary float-end">
                Add Category
              </a>
            </h4>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead class="text-center">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Is Active</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="text-start align-middle">
                @foreach ($categories as $index => $item)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                      <img src="{{ asset($item->image)}}" style="height: 70px; width: 70px;" alt="img">
                    </td>
                    <td>{{ $item->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>
                      <a href="{{ url('categories/'.$item->id.'/edit') }}" class="btn btn-success">Edit</a>
                      <form action="{{ url('categories/'.$item->id.'/delete') }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button 
                          type="submit" 
                          class="btn btn-danger"
                          data-confirm-delete
                        >
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
