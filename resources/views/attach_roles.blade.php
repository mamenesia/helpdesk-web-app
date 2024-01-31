<form action="{{ route('attach.roles') }}" method="POST">
    @csrf
    <div>
        <label for="user">User</label>
        <select name="user_id" id="user">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->nama }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="roles">Roles</label>
        @foreach($roles as $role)
            <div>
                <input type="checkbox" id="role{{ $role->id }}" name="role_ids[]" value="{{ $role->id }}">
                <label for="role{{ $role->id }}">{{ $role->name }}</label>
            </div>
        @endforeach
    </div>
    <button type="submit">Attach Roles</button>
</form>