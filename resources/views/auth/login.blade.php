
<style>
    body {
        background-color: #1c1c1c;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }
    
    .login-form-wrapper {
        background-color: rgba(28, 28, 28, 0.8);
        border: 1px solid #d5b44c;
        border-radius: 5px;
        padding: 30px;
        width: 100%;
        max-width: 450px;
        color: white;
    }
    
    .login-title {
        color: #d5b44c;
        text-align: center;
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .login-subtitle {
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
    
    .register-link {
        text-align: center;
        margin-top: 15px;
    }
    
    .register-link a {
        color: #d5b44c;
        text-decoration: none;
    }
    
    .register-link a:hover {
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

<div class="login-container">
    <div class="login-form-wrapper">
        <h2 class="login-title">INICIO DE SESIÓN</h2>
        <p class="login-subtitle">Ingresa tus credenciales</p>
        
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
            
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit">
                    Iniciar Sesión
                </button>
            </div>
            
            <div class="register-link">
                <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
            </div>
        </form>
    </div>
</div>