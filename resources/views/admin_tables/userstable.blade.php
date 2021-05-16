<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>SN. No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Company ID</th>
            <th>Created at</th>
            <th>Change Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($getusers as $users) {
        ?>
        <tr id="dataid{{$users->id}}">
            <td>{{$users->id}}</td>
            <td>{{$users->name}}</td>
            <td>{{$users->email}}</td>
            <td>{{$users->Company_id}}</td>
            <td>{{$users->created_at}}</td>
            <td>
            @if($users->id != auth()->user()->role_id)
                @if($users->role_id == '2')
                    <a class="badge badge-info px-2" onclick="StatusUpdate('{{$users->id}}','1')" style="color: #fff;">User</a>
                @else
                    <a class="badge badge-primary px-2" onclick="StatusUpdate('{{$users->id}}','2')" style="color: #fff;">Admin</a>
                @endif
            @else
                @if($users->role_id == '2')
                    <a class="badge badge-info px-2" onclick="StatusUpdate('{{$users->id}}','1')" style="color: #fff;">User</a>
                @else
                    <span class="badge badge-success px-2" style="color: #fff;">Current Login Admin</span>
                @endif
            @endif
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>