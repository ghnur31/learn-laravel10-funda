<x-app-web-layout>

  <x-slot:title>
    Gallery
  </x-slot>

  <div class="container mt-5 animate__animated animate__fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Gallery List
                      <a href="{{ url('gallery/upload') }}" class="btn btn-primary float-end">Upload Images</a>
                    </h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    @foreach ($gallerys as $gallery)
                      <div class="col-md-3">
                        <div class="card shadow p-2 border">
                          <img src="{{ asset($gallery->image) }}" style="width: 200px" alt="Img" />
                          <form action="{{ url('gallery/'.$gallery->id.'/delete') }}" method="POST" style="display: inline-block">
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
                        </div>
                        
                      </div>
                    @endforeach
                  </div>
                </div>
            </div>
        </div>
    </div>
  </div>


</x-app-web-layout>
