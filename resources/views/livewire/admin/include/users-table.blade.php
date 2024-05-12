<table class="table ">
    <thead>
    <tr>
        <th>No</th>
        <th>Foto</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Telepon</th>
        <th>Peran</th>
        <th>Status</th>

        <th>Tindakan</th>

    </tr>
    </thead>
    <tbody>
    @foreach ($users as $key => $user)
        <tr>
            <td>{{ $users->firstItem() + $key }}</td>
            <td>
                <div class="user-img">
                    @if ($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                             alt="img" class="rounded-circle"
                             style="height: 2.5rem; width: 2.5rem; object-fit: cover"/>
                    @else
                        <img src="{{ $user->profile_photo_url }}" alt="img"
                             class="rounded-circle"
                             style="height: 2.5rem; width: 2.5rem; object-fit: cover"/>
                    @endif
                </div>
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}  @if ($user->status)
                    <span class="badge bg-success ms-3">Aktif</span>
                @else
                    <span class="badge bg-danger ms-3">Tidak Aktif</span>
                @endif</td>
            <td>{{ $user->phone }}</td>
                @foreach ($user->roles as $key => $role)
                    <td>{{ $role->name }}</td>
                    @if ($key > 0)
                        @break
                    @endif
                @endforeach

            <td>
                <div @if(Auth::user()->id == $user->id) onclick="yourLoggedin()"
                     @endif
                     class="status-toggle d-flex justify-content-between align-items-center "
                     style="margin-right: 20px;"
                >
                    <input wire:click="updateStatus({{ $user->id }})" type="checkbox"
                           id="user{{$user->id}}" class="check"
                           @if($user->status) checked @endif @if(Auth::user()->id == $user->id) disabled
                        @endif />
                    <label for="user{{$user->id}}"
                           class="checktoggle @if(Auth::user()->id == $user->id) bg-secondary @endif">checkbox</label>
                </div>
            </td>
            <td>
                <a class="me-3" href="{{ route('user.edit', $user->id) }}">
                    <img src="{{asset('assets/img/icons/edit.svg')}}" alt="img"/>
                </a>
                <a class="me-3 confirm-text" wire:click='delete({{ $user->id }})'>
                    <img src="{{asset('assets/img/icons/delete.svg')}}" alt="img"/>
                </a>

            </td>
        </tr>
    @endforeach


    </tbody>
</table>
