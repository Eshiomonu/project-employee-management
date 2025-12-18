<form method="GET" action="{{ route('projects.index') }}">
    <input type="text" name="search" placeholder="Search Projects" value="{{ request('search') }}">
    <select name="status">
        <option value="">All Statuses</option>
        <option value="planned" {{ request('status') == 'planned' ? 'selected' : '' }}>Planned</option>
        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="on-hold" {{ request('status') == 'on-hold' ? 'selected' : '' }}>On Hold</option>
        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>
    <button type="submit">Filter</button>  
</form>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
            <tr>
                <td>{{ $project->name }}</td>
                <td>{{ $project->description }}</td>
                <td>{{ ucfirst($project->status) }}</td>
                <td>
                    <a href="{{ route('projects.show', $project) }}">View</a>
                    <a href="{{ route('projects.edit', $project) }}">Edit</a>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $projects->links() }}
