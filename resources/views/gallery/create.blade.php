<x-app-web-layout>

<x-slot:title>
    Upload Single/ Multiple Images
</x-slot>

  <div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Upload Single/ Multiple Images
                      <a href="{{ url('gallery') }}" class="btn btn-warning float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                    <label>Drag and Drop Multiple Images (JPG, JPEG, PNG, .webp)</label>

                    <form action="{{ url('gallery/upload') }}" method="POST" enctype="multipart/form-data"
                        class="dropzone" id="myDragAndDropUploader">
                        @csrf
                    </form>

                    <h5 id="message"></h5>

                </div>
            </div>
        </div>
    </div>
  </div>


@section('scripts')
  <script type="text/javascript">

    var maxFilesizeVal = 12;
    var maxFilesVal = 2;

    // Note that the name "myDragAndDropUploader" is the camelized id of the form.
    Dropzone.options.myDragAndDropUploader = {

        paramName:"file",
        maxFilesize: maxFilesizeVal, // MB
        maxFiles: maxFilesVal,
        resizeQuality: 1.0,
        acceptedFiles: ".jpeg,.jpg,.png,.webp",
        addRemoveLinks: false,
        timeout: 60000,
        dictDefaultMessage: "Drop your files here or click to upload",
        dictFallbackMessage: "Your browser doesn't support drag and drop file uploads.",
        dictFileTooBig: "File is too big. Max filesize: "+maxFilesizeVal+"MB.",
        dictInvalidFileType: "Invalid file type. Only JPG, JPEG, PNG and GIF files are allowed.",
        dictMaxFilesExceeded: "You can only upload up to "+maxFilesVal+" files.",
        maxfilesexceeded: function(file) {
            this.removeFile(file);
            // this.removeAllFiles(); 
        },
        sending: function (file, xhr, formData) {
            $('#message').text('Image Uploading...');
        },
        success: function (file, response) {
            $('#message').text(response.success);
            console.log(response.success);
            console.log(response);
        },
        error: function (file, response) {
            $('#message').text('Something Went Wrong! '+response);
            console.log(response);
            return false;
        }
    };
  </script>
@endSection

</x-app-web-layout>