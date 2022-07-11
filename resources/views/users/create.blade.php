<x-layout title="Novo usuário">
    <form method="post">
        @csrf    

        <div class="form-group">
            <label for="name" class="form-label"> Nome </label>
            <input type="name" id="name" name="name" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="email" class="form-label"> E-mail </label>
            <input type="email" id="email" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="password" class="form-label"> Senha </label>
            <input type="password" id="password" name="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label"> Confirmação da senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>
        
        <button class="btn btn-primary">
            Registrar
        </button>
    </form>
</x-layout>