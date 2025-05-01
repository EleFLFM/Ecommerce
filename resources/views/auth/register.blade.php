
<div class="register-container">
    <div class="register-form-wrapper">
        <h2 class="register-title">REGISTRO</h2>
        <p class="register-subtitle">Crea tu cuenta</p>
        
        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf
            
            <!-- Nombre -->
            <div class="form-group">
                <label for="name">Nombre</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Correo electrónico -->
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div class="form-group">
                <label for="password_confirmation">Confirmar contraseña</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit">
                    Registrarme
                </button>
            </div>
            
            <div class="login-link">
                <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a></p>
            </div>
        </form>
    </div>
</div>



<style>
    body {
        background-color: #1c1c1c;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    
    .register-container {
        
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        margin-top: 30px
    }
    
    .register-form-wrapper {
        background-color: rgba(28, 28, 28, 0.8);
        border: 1px solid #d5b44c;
        border-radius: 5px;
        padding: 30px;
        width: 100%;
        max-width: 450px;
        color: white;
    }
    
    .register-title {
        color: #d5b44c;
        text-align: center;
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .register-subtitle {
        text-align: center;
        margin-bottom: 20px;
        color: #fff;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    label {
        display: block;
        margin-bottom: 5px;
        color: #fff;
    }
    
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #333;
        border-radius: 3px;
        background-color: white;
        box-sizing: border-box;
    }
    
    .btn-submit {
        width: 100%;
        padding: 12px;
        background-color: #d5b44c;
        color: #1c1c1c;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        font-weight: bold;
        margin-top: 10px;
    }
    
    .btn-submit:hover {
        background-color: #c1a343;
    }
    
    .login-link {
        text-align: center;
        margin-top: 15px;
    }
    
    .login-link a {
        color: #d5b44c;
        text-decoration: none;
    }
    
    .login-link a:hover {
        text-decoration: underline;
    }
    
    .is-invalid {
        border-color: red !important;
    }
    
    .invalid-feedback {
        color: red;
        font-size: 0.85rem;
        margin-top: 5px;
    }
</style>
