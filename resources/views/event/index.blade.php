@extends('layouts.app')
@section('content')
    <div class="col-md-12 grid-margin">
        @if (session('message'))
            <div class="aler alert-success col-md-10">{{ session('message') }}</div>
        @endif
        <div class="card">

            <div class="card-header">
                <h3>Event
                    <a href="{{ url('event/create') }}" class="btn btn-primary float-end btn-sm text-white">Add
                        Product</a>
                </h3>

            </div>
            <div class="card-body">
                <table class="table table-bordered striped">

                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Event Date</th>
                            <th>Event Location</th>
                            <th>Status</th>
                            <th>Thumbnail</th>
                            <th>First Image</th>
                            <th>First Video</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->description }}</td>
                                <td>{{ $event->event_date }}</td>
                                <td>{{ $event->event_location }}</td>
                                <td>{{ $event->status ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    @if ($event->thumbnail)
                                        <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="Thumbnail" width="50">
                                    @else
                                        No Thumbnail
                                    @endif
                                </td>
                                <td>
                                    @if ($event->images)
                                        @foreach (json_decode($event->images) as $image)
                                            <img src="{{ asset('storage/' . $image) }}" alt="Image" width="50">
                                        @break
                                    @endforeach
                                @else
                                    No Images
                                @endif
                            </td>
                            <td>
                                @if ($event->videos)
                                    @foreach (json_decode($event->videos) as $video)
                                        <video src="{{ asset('storage/' . $video) }}" width="200" controls></video>
                                    @break
                                @endforeach
                            @else
                                No Videos
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('events.edit', $event->id) }}">Edit</a>
                            <!-- Delete Event Button -->
                            <form action="{{ route('event.destroy', $event->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        </table>
        <div>

        </div>
    </div>
</div>
</div>
@endsection
