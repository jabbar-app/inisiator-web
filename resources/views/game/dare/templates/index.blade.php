@extends('layouts.dashboard')

@section('content')
  <div class="container mt-4">
    <h1>Templates List</h1>
    <a href="{{ route('dare-templates.create') }}" class="btn btn-primary mb-3">Create New Template</a>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Question</th>
          <th>Options</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($templates as $template)
          <tr>
            <td>{{ $template->id }}</td>
            <td>{{ $template->question }}</td>
            <td>
              @php
                $options = json_decode($template->options, true);
              @endphp
              @foreach ($options as $option)
                <div class="mb-2">
                  <span>{{ $option['text'] }}</span>
                  @if (isset($option['is_image']) && $option['is_image'])
                  {{-- {{ dd($option) }} --}}
                    <div>
                      <img src="{{ asset($option['image_url'] ?? 'default-placeholder.jpg') }}" alt="Option Image"
                        style="max-width: 100px; max-height: 100px;">
                    </div>
                  @endif
                </div>
              @endforeach
            </td>
            <td>
              <a href="{{ route('dare-templates.edit', $template) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('dare-templates.destroy', $template) }}" method="POST"
                style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
