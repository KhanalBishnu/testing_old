@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3>Edit event
                        <a href="{{ url('/event') }}" class="btn btn-primary float-end btn-sm text-white">Back</a>
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{ url('/event/' . $event->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name">Title</label>
                                <input type="text" name="title"class="form-control" value="{{ $event->title }}">
                                @error('title')
                                    <small class=text-danger>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="description">Descroption</label>
                                <textarea name="description"class="form-control" rows="3">{{ $event->description }}</textarea>
                                @error('description')
                                    <small class=text-danger>{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Display existing images -->
                            <div class="existing-images">
                                @if ($event->images)
                                    @foreach (json_decode($event->images) as $image)
                                        <div class="image-container" data-file="{{ $image }}"
                                            data-event-id="{{ $event->id }}">
                                            <img src="{{ asset('storage/' . $image) }}?t={{ time() }}" alt="Image"
                                                width="50" name="images[]">
                                            <button type="button" class="delete-file">Delete</button>
                                        </div>
                                    @endforeach
                                    @else
                                    No Images
                                    @endif
                                    <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
                            </div>

                            <!-- Display existing videos -->
                            <div class="existing-videos">
                                @if ($event->videos)
                                    @foreach (json_decode($event->videos) as $video)
                                        <div class="video-container"  data-file="{{ $video }}"
                                            data-event-id="{{ $event->id }}">
                                            <video controls width="200" name="videos[]">
                                                <source src="{{ asset('storage/' . $video) }}?t={{ time() }}"
                                                    type="video/mp4" >
                                            </video>
                                            <button type="button" class="delete-file">Delete</button>
                                        </div>
                                    @endforeach
                                    {{-- <input type="file" name="videos[]" id="videos" class="form-control" multiple accept="image/*"> --}}
                                    @else
                                    No Videos
                                    @endif
                                    <input type="file" name="videos[]" id="videos" class="form-control" multiple >
                            </div>
                            <div class="form-group">
                                <label>Current Thumbnail</label>
                                <div>
                                    <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="Thumbnail" width="100">
                                    <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="price">status</label>
                                <input type="number" name="price"class="form-control" value="{{ $event->status }}">
                                @error('price')
                                    <small class=text-danger>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <button class="btn btn-primary ">Update Product</button>
                            </div>


                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle delete file button click
            $('.delete-file').on('click', function() {
                var container = $(this).closest('.image-container, .video-container');
                var file = container.data('file');
                var eventId = container.data('event-id');

                // Perform deletion using AJAX request
                $.ajax({
                    url: '{{ route('events.deleteFile') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        file: file,
                        event_id: eventId
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Remove the container from the HTML
                        container.remove();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

@endsection
