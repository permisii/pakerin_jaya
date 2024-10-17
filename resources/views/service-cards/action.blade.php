<tr>
    <th>
        <div class="btn-group">
            <a href="{{ route('users.show', $id) }}" class="btn btn-sm btn-default text-blue action-btn">
                <i class="fas fa-info-circle"></i>
                Detail
            </a>
            <form action="{{ route('users.destroy', $id) }}" method="post" id="delete-form-{{ $id }}">
                @csrf
                @method('DELETE')
                {{--                <button type="button" onclick="confirmDelete({{ $id }})" --}}
                {{--                        class="btn btn-sm btn-default text-danger action-btn"><i --}}
                {{--                        class="fas fa-trash"></i> Delete --}}
                {{--                </button> --}}
                <button onclick="confirm('Are you sure?')" class="btn btn-sm btn-default text-danger action-btn">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
            <button onclick="resetpass({{ $id }})" class="btn btn-sm btn-default text-info action-btn">
                <i class="fas fa-fw fa-lock-open"></i> Reset Pass
            </button>
            {{--                                <a href="{{ route('users.akses') }}" class="btn btn-sm btn-default text-blue"><i --}}
            {{--                                        class="fas fa-check"></i> Akses</a> --}}
            <a href="{{ route('users.edit', $id) }}" class="btn btn-sm btn-default text-blue action-btn">
                <i class="fas fa-check"></i>
                Akses
            </a>
        </div>
    </th>
</tr>

<script>
    function resetpass(userId) {
        if (confirm('Are you sure you want to reset the password?')) {
            fetch(`/users/${userId}/reset-password`, {
                    method: 'PUT', // Using POST method, with _method=PUT
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                })
                .then(res => {
                    if(res.ok) {
                        return res.json();
                    } else {
                        throw new Error('failed to reset password.');
                    }
                })
                .then(data => {
                    alert(data.message || 'Password has been reset to "Pakerin999".');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred: ' + error.message);
                });
        }
    }
</script>
