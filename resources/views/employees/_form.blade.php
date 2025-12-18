<form method="GET" action="{{ $action }}">
    @csrf

    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $employee->name ?? '') }}" required>
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $employee->email ?? '') }}" required>
    </div>

    <div>
        <label for="position">Role:</label>
        <input type="text" id="position" name="position" value="{{ old('position', $employee->position ?? '') }}" required>
    </div>

    <div>
        <button type="submit">{{ $buttonText }}</button>
    </div>
</form>
