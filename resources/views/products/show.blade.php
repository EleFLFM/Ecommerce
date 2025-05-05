@extends('layouts.app') <!-- o tu layout base -->

@section('content')
<div class="container">
 <div class="product-section">
    <!-- Imágenes del producto -->
    <div class="product-images">
        <div class="main-image">
            <img src="/api/placeholder/480/600" alt="Vestido Elegance" />
        </div>
        
    </div>
    
    <!-- Información del producto -->
    <div class="product-info">
        <h1 style="color: white" class="product-title">{{$producto->name}}</h1>
        <div class="product-price">{{$producto->price}}</div>
        
        <div class="product-description">
            <p>Vestido de fiesta con elegante diseño y corte que favorece la silueta. Confeccionado con telas de la más alta calidad que garantizan comodidad y durabilidad. Perfecto para eventos especiales y ocasiones que requieren un look sofisticado.</p>
        </div>
        
        <div class="product-options">
            <div class="option-title">Talla</div>
            <div class="size-options">
                <div class="size-option">XS</div>
                <div class="size-option active">S</div>
                <div class="size-option">M</div>
                <div class="size-option">L</div>
                <div class="size-option">XL</div>
            </div>
            
            <div class="option-title">Color</div>
            <div class="color-options">
                <div class="color-option active" style="background-color: #000;"></div>
                <div class="color-option" style="background-color: #d4af37;"></div>
                <div class="color-option" style="background-color: #800020;"></div>
                <div class="color-option" style="background-color: #1e3a8a;"></div>
            </div>
        </div>
        
        <div class="quantity-selector">
            <div class="quantity-btn">-</div>
            <input type="text" class="quantity-input" value="1">
            <div class="quantity-btn">+</div>
        </div>
        
        <div class="action-buttons">
            <button class="add-to-cart">AÑADIR AL CARRITO</button>
            <div class="wishlist-btn">
                <i class="far fa-heart"></i>
            </div>
        </div>
        
    </div>
</div>
<style>
    /* Variables globales */
    :root {
        --primary-color: #111;
        --accent-color: #d4af37;
        --hover-bg: #333;
        --dropdown-bg: #222;
        --text-color: #333;
        --border-color: #e0e0e0;
        --light-bg: #f9f9f9;
        --white: #ffffff;
    }
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }
    
    body {
        background-color: var(--light-bg);
        color: var(--text-color);
    }
    
    /* Navbar estilos */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: var(--primary-color);
        padding: 0 2rem;
        height: 80px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    
    .logo-container {
        display: flex;
        align-items: center;
    }
    
    .logo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary-color);
        border: 2px solid var(--accent-color);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }
    
    .logo-text {
        font-size: 24px;
        text-transform: uppercase;
        color: var(--accent-color);
        font-weight: bold;
        letter-spacing: 1px;
    }
    
    .nav-links {
        display: flex;
        list-style: none;
        gap: 2rem;
    }
    
    .nav-links a {
        text-decoration: none;
        color: white;
        font-size: 16px;
        font-weight: 400;
        transition: color 0.3s;
        position: relative;
        display: block;
        padding: 10px 0;
    }
    
    .dropdown {
        position: relative;
    }
    
    .dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: var(--dropdown-bg);
        min-width: 200px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        z-index: 1;
        border-top: 2px solid var(--accent-color);
    }
    
    .dropdown:hover .dropdown-content {
        display: block;
    }
    
    .dropdown-content a {
        color: #f9f9f9;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        border-bottom: 1px solid var(--hover-bg);
    }
    
    .dropdown-content a:hover {
        background-color: var(--hover-bg);
    }
    
    .dropdown::after {
        content: '▼';
        font-size: 10px;
        margin-left: 5px;
        position: absolute;
        right: -15px;
        top: 12px;
        color: var(--accent-color);
    }
    
    .nav-links a:hover {
        color: var(--accent-color);
    }
    
    .ofertas {
        color: var(--accent-color) !important;
    }
    
    .icons-container {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }
    
    .icon {
        color: white;
        font-size: 20px;
        cursor: pointer;
        transition: color 0.3s;
    }
    
    .icon:hover {
        color: var(--accent-color);
    }
    
    /* Estilos para la página de producto */
    .container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }
    
    .breadcrumb {
        display: flex;
        margin-bottom: 20px;
        font-size: 14px;
    }
    
    .breadcrumb a {
        color: var(--text-color);
        text-decoration: none;
        margin-right: 5px;
    }
    
    .breadcrumb a:hover {
        color: var(--accent-color);
    }
    
    .breadcrumb span {
        margin: 0 5px;
        color: #888;
    }
    
    .product-section {
        display: flex;
        gap: 40px;
    }
    
    .product-images {
        flex: 1;
    }
    
    .main-image {
        width: 100%;
        height: 500px;
        background-color: #f0f0f0;
        margin-bottom: 15px;
        border-radius: 5px;
        overflow: hidden;
        position: relative;
    }
    
    .main-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .thumbnail-container {
        display: flex;
        gap: 10px;
    }
    
    .thumbnail {
        width: 80px;
        height: 80px;
        border: 1px solid var(--border-color);
        border-radius: 5px;
        cursor: pointer;
        overflow: hidden;
    }
    
    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .thumbnail:hover {
        border-color: var(--accent-color);
    }
    
    .product-info {
        flex: 1;
    }
    
    .product-title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 10px;
        color: var(--primary-color);
    }
    
    .product-ref {
        font-size: 14px;
        color: #888;
        margin-bottom: 15px;
    }
    
    .product-price {
        font-size: 24px;
        font-weight: bold;
        color: var(--accent-color);
        margin-bottom: 20px;
    }
    
    .product-description {
        margin-bottom: 25px;
        line-height: 1.6;
    }
    
    .product-options {
        margin-bottom: 25px;
    }
    
    .option-title {
        font-weight: bold;
        margin-bottom: 10px;
    }
    
    .size-options, .color-options {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .size-option {
        width: 40px;
        height: 40px;
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border-radius: 5px;
        transition: all 0.2s;
    }
    
    .size-option:hover, .size-option.active {
        border-color: var(--accent-color);
        background-color: var(--accent-color);
        color: white;
    }
    
    .color-option {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        position: relative;
    }
    
    .color-option.active::after {
        content: '';
        position: absolute;
        width: 38px;
        height: 38px;
        border: 2px solid var(--accent-color);
        border-radius: 50%;
        top: -6px;
        left: -6px;
    }
    
    .quantity-selector {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
    }
    
    .quantity-btn {
        width: 40px;
        height: 40px;
        background-color: var(--light-bg);
        border: 1px solid var(--border-color);
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        user-select: none;
    }
    
    .quantity-btn:hover {
        background-color: #e0e0e0;
    }
    
    .quantity-input {
        width: 60px;
        height: 40px;
        border: 1px solid var(--border-color);
        text-align: center;
        font-size: 16px;
        margin: 0 5px;
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }
    
    .add-to-cart {
        padding: 15px 40px;
        background-color: var(--accent-color);
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    .add-to-cart:hover {
        background-color: #c09830;
    }
    
    .wishlist-btn {
        width: 50px;
        height: 50px;
        border: 1px solid var(--border-color);
        border-radius: 5px;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .wishlist-btn:hover {
        background-color: #f0f0f0;
    }
    
    .wishlist-btn i {
        font-size: 20px;
        color: #888;
    }
    
    .wishlist-btn:hover i {
        color: #ff6b6b;
    }
    
    .product-details {
        margin-top: 40px;
    }
    
    .details-tabs {
        display: flex;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 20px;
    }
    
    .tab {
        padding: 15px 25px;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        transition: all 0.3s;
    }
    
    .tab:hover, .tab.active {
        color: var(--accent-color);
        border-bottom-color: var(--accent-color);
    }
    
    .tab-content {
        line-height: 1.6;
    }
    
    .features-list {
        list-style: none;
        margin-top: 15px;
    }
    
    .features-list li {
        margin-bottom: 10px;
        position: relative;
        padding-left: 25px;
    }
    
    .features-list li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--accent-color);
        font-weight: bold;
    }
    
    .similar-products {
        margin-top: 60px;
    }
    
    .section-title {
        font-size: 24px;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        width: 60px;
        height: 3px;
        background-color: var(--accent-color);
        bottom: 0;
        left: 0;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }
    
    .product-card {
        border: 1px solid var(--border-color);
        border-radius: 5px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .card-image {
        height: 250px;
        overflow: hidden;
        position: relative;
    }
    
    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .card-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: var(--accent-color);
        color: white;
        padding: 5px 10px;
        font-size: 12px;
        border-radius: 3px;
    }
    
    .card-info {
        padding: 15px;
    }
    
    .card-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 8px;
    }
    
    .card-price {
        color: var(--accent-color);
        font-weight: bold;
    }
    
    /* Estilos responsivos */
    @media (max-width: 992px) {
        .navbar {
            padding: 0 1rem;
        }
        
        .nav-links {
            gap: 1rem;
        }
        
        .product-section {
            flex-direction: column;
        }
        
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .logo-text {
            font-size: 18px;
        }
        
        .nav-links {
            display: none;
        }
        
        .main-image {
            height: 350px;
        }
        
        .products-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection
