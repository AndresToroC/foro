<x-app-layout>
    <x-slot name="header">
        <div class="page-title">Usuarios</div>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-status bg-blue"></div>
                        <b>Editar usuario</b>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <x-input-text label="Nombre *" name="name" value="{{ $user->name }}" required autofocus></x-input-text>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Correo electronico</label>
                                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                        <small class="text-muted">Si no va a cambiar la contraseña dejar en blanco</small>
                                        @error('password')
                                            <br>
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirmar contraseña</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                        @error('password_confirmation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <x-select label="Seleccione un rol" name="role_id" value="{{ $role->id }}" :options=$roles></x-select>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-dark btn-sm">Regresar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="scripts">

    </x-slot>
</x-app-layout>