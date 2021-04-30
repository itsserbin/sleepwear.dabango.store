<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя пользователя"
                   value="{{$role->name}}" required>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug"
                   value="{{$role->slug}}" required>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="" class="w-100"> </label>
            <button class="btn btn-outline-warning w-100" type="button" data-bs-toggle="collapse"
                    data-bs-target="#RolesPermissions"
                    aria-expanded="false" aria-controls="RolesPermissions">
                Управление правами:
            </button>
            <div class="collapse" id="RolesPermissions">
                <div class="card card-body">
                    @foreach($permissions as $permission)
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                   value="{{$permission->slug}}"
                                   id="{{$permission->slug}}"
                                   @foreach($role->permissions as $item) @if ($permission->name == $item->name) checked @endif @endforeach>
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


