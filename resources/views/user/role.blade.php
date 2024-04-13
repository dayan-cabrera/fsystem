<x-layout>

<div class="login-container">
    <div class="mb-3 p-2 w-full">
        <h1>Adminsitre el rol de: 
            {{$user->name}}</h1>
            <hr>    
        </div>
    <form class="login-form" method="post" action="{{route('user.role', $user->id)}}">
        @csrf
        @method('put')
        <div class="input-group">
            <label for="role" class="">Roles</label>
            
            <select class="input-select mb-5" name="role">
                @foreach ($roles as $role)
                <option value="{{$role}}">{{$role}}</option>
                @endforeach
            </select>
            </div>

        <button type="submit">Asignar</button>
    </form>
</div>
</x-layout>