<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя пользователя"
                   value="{{$user->name}}" required>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="name">Email</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Введите email пользователя"
                   value="{{$user->email}}" required>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="role">Роль</label>
            <select class="form-control" id="role" name="role">
                @foreach($roles as $role)
                    <option value="{{$role->id}}"
                            @foreach($user->roles as $item) @if ($item->slug == $role->slug) selected="" @endif @endforeach>{{$role->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="email_verified_at">Верификация email</label>
            <input type="text" class="form-control" id="email_verified_at" name="email_verified_at"
                   value="@if($user->email_verified_at)Подтвержден@elseНе подтвержден@endif" disabled>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="created_at">Дата регистрации</label>
            <input type="text" class="form-control" id="created_at" name="created_at"
                   value="{{$user->created_at}}" disabled>
        </div>
    </div>


    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="" class="w-100"> </label>
            <button class="btn btn-outline-warning w-100" type="button" data-bs-toggle="collapse" data-bs-target="#userRoles"
                    aria-expanded="false" aria-controls="userRoles">
                Выдать дополнительные права:
            </button>
            <div class="collapse" id="userRoles">
                <div class="card card-body">
                    @foreach($permissions as $permission)
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                   value="{{$permission->slug}}"
                                   id="{{$permission->slug}}" @foreach($user->permissions as $item)@if ($item->slug == $permission->slug)checked @endif @endforeach>
                            <label class="form-check-label" for="{{$permission->slug}}">
                                {{$permission->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
