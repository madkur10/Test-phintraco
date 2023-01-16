@extends('layout.template')

@section('container')
<div class="card mb-2">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h3 class="ms-2">List Projects</h3>
            </div>
            <div class="col-6 text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProject">+ Add Project</button>
            </div>
        </div>
    </div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Start Date</th>
            <th scope="col">Finish Date</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($list_project as $project)
        <tr>
            <td class="text-center" style="width: 3%;">{{ $loop->iteration }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->description }}</td>
            <td>{{ $project->start_at }}</td>
            <td>{{ $project->finish_at }}</td>
            <td>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateProject{{ $project->project_id }}">Update</button>
                <div class="modal fade" id="updateProject{{ $project->project_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateProjectLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form action="{{ route('project.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="updateProjectLabel">Update Project</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" placeholder="Input name" required>
                                        <input type="hidden" class="form-control" id="name" name="project_id" value="{{ $project->project_id }}" >
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Input description" required>{{ $project->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="start_at" name="start_at" placeholder="Input start_at" value="{{ date('Y-m-d', strtotime($project->start_at)) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Finish Date</label>
                                        <input type="date" class="form-control" id="finish_at" name="finish_at" placeholder="Input finish_at" value="{{ date('Y-m-d', strtotime($project->finish_at)) }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a class="btn btn-danger" href="{{ route('project.delete', ['project_id' => $project->project_id]) }}">Delete</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No data</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="modal fade" id="addProject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('project.add') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addProjectLabel">Add Project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Input name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea type="text" class="form-control" id="email" name="description" placeholder="Input description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_at" name="start_at" placeholder="Input Start Date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Finish Date</label>
                        <input type="date" class="form-control" id="finish_at" name="finish_at" placeholder="Input Finish Date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection