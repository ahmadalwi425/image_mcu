<tr>
    <td>{{ $index }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
        @if($user->id_level == 1)
            <span class="status-badge status-admin">Admin</span>
        @elseif($user->id_level == 2)
            <span class="status-badge status-dokter">Dokter</span>
        @else
            <span class="status-badge status-pasien">Pasien</span>
        @endif
    </td>
    <td>
        {{ $user->id_poli ?? '-' }}
    </td>
    <td class="text-center action-buttons">

        {{-- Edit --}}
        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">
            Edit
        </a>

        {{-- Delete --}}
        <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="button"
                class="btn btn-danger btn-sm delete-user"
                data-username="{{ $user->name }}">
                Hapus
            </button>
        </form>

    </td>
</tr>