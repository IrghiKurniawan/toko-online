@extends('templates.customer')

@section('content-customer')
<div class="login-wrapper d-flex justify-content-center align-items-center" 
     style="min-height:85vh; background: linear-gradient(135deg, rgba(0,36,85,0.03) 0%, rgba(27,60,83,0.05) 100%); padding: 2rem 1rem;">
  
  <div class="login-container">
    {{-- Decorative Elements --}}
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    <div class="floating-shape shape-3"></div>

    <div class="card shadow-lg border-0" style="width:100%; max-width:450px; border-radius:20px; overflow: hidden;">
      {{-- Card Header --}}
      <div class="card-header text-white position-relative" 
           style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); border: none; padding: 2rem;">
        <div class="text-center">
          <div class="login-icon mx-auto mb-3" 
               style="width: 70px; height: 70px; background: linear-gradient(135deg, #FFC107 0%, #FFD54F 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 16px rgba(255,193,7,0.3);">
            <i class="fas fa-user-circle fa-2x" style="color:#002455;"></i>
          </div>
          <h4 class="mb-1 fw-bold">Selamat Datang!</h4>
          <p class="mb-0" style="opacity: 0.9; font-size: 0.95rem;">Masuk untuk belanja</p>
        </div>
        
        {{-- Decorative Wave --}}
        <div class="wave-bottom">
          <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
            <path d="M0.00,49.98 C150.00,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" 
                  style="stroke: none; fill: #fff;"></path>
          </svg>
        </div>
      </div>

      {{-- Card Body --}}
      <div class="card-body p-4" style="padding-top: 2.5rem !important;">
        @if(session('error'))
          <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center" 
               style="border-radius: 12px; background-color: #fee; border-left: 4px solid #dc3545 !important;">
            <i class="fas fa-exclamation-circle me-2" style="color: #dc3545;"></i>
            <span>{{ session('error') }}</span>
          </div>
        @endif

        @if(session('success'))
          <div class="alert alert-success border-0 shadow-sm d-flex align-items-center" 
               style="border-radius: 12px; background-color: #d4edda; border-left: 4px solid #28a745 !important;">
            <i class="fas fa-check-circle me-2" style="color: #28a745;"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        <form method="POST" action="{{ route('loginProcess') }}">
          @csrf

          {{-- Email Input --}}
          <div class="mb-3">
            <label for="email" class="form-label fw-semibold" style="color:#002455;">
              <i class="fas fa-envelope me-2" style="color:#FFC107;"></i>Email
            </label>
            <div class="input-group">
              <span class="input-group-text border-end-0" 
                    style="background-color: #f8f9fa; border: 2px solid #e9ecef; border-right: none; border-radius: 10px 0 0 10px;">
                <i class="fas fa-at" style="color:#002455;"></i>
              </span>
              <input id="email" 
                     type="email" 
                     class="form-control border-start-0 @error('email') is-invalid @enderror" 
                     name="email" 
                     value="{{ old('email') }}" 
                     required 
                     autofocus 
                     placeholder="contoh@domain.com"
                     style="border: 2px solid #e9ecef; border-left: none; border-radius: 0 10px 10px 0; padding: 0.75rem;">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          {{-- Password Input --}}
          <div class="mb-3">
            <label for="password" class="form-label fw-semibold" style="color:#002455;">
              <i class="fas fa-lock me-2" style="color:#FFC107;"></i>Kata Sandi
            </label>
            <div class="input-group">
              <span class="input-group-text border-end-0" 
                    style="background-color: #f8f9fa; border: 2px solid #e9ecef; border-right: none; border-radius: 10px 0 0 10px;">
                <i class="fas fa-key" style="color:#002455;"></i>
              </span>
              <input id="password" 
                     type="password" 
                     class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror" 
                     name="password" 
                     required 
                     placeholder="Masukkan kata sandi"
                     style="border: 2px solid #e9ecef; border-left: none; border-right: none; padding: 0.75rem;">
              <button type="button" 
                      class="btn border-start-0" 
                      id="togglePassword" 
                      title="Tampilkan/Sembunyikan"
                      style="background-color: #f8f9fa; border: 2px solid #e9ecef; border-left: none; border-radius: 0 10px 10px 0; color:#002455; transition: all 0.3s ease;">
                <i class="fas fa-eye" id="toggleIcon"></i>
              </button>
              @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          </div>

          {{-- Remember & Forgot --}}
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
              <input class="form-check-input" 
                     type="checkbox" 
                     name="remember" 
                     id="remember" 
                     style="border-color: #002455;"
                     {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember" style="color:#002455; font-weight: 500;">
                Ingat saya
              </label>
            </div>
            <a href="#" 
               class="small fw-semibold" 
               style="color:#002455; text-decoration: none; transition: all 0.3s ease;">
              Lupa kata sandi?
            </a>
          </div>

          {{-- Submit Button --}}
          <div class="d-grid mb-3">
            <button type="submit" 
                    class="btn btn-login" 
                    style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); 
                           color:#fff; 
                           border: none; 
                           border-radius: 12px; 
                           padding: 0.875rem; 
                           font-weight: 700; 
                           font-size: 1.05rem;
                           box-shadow: 0 4px 12px rgba(0,36,85,0.3);
                           transition: all 0.3s ease;">
              <i class="fas fa-sign-in-alt me-2"></i>Masuk Sekarang
            </button>
          </div>
        {{-- Register Link --}}
        <div class="register-prompt text-center p-3" 
             style="background: linear-gradient(135deg, rgba(0,36,85,0.05) 0%, rgba(27,60,83,0.05) 100%); border-radius: 12px; margin-top: 1.5rem;">
          <p class="mb-0" style="color:#002455;">
            Belum punya akun? 
            <a href="{{ route('register') }}" 
               class="fw-bold" 
               style="color:#FFC107; text-decoration: none; transition: all 0.3s ease;">
              Daftar sekarang <i class="fas fa-arrow-right ms-1"></i>
            </a>
          </p>
        </div>
      </div>
    </div>
</div>

<style>
  /* Input Focus States */
  .form-control:focus,
  .input-group-text:has(+ .form-control:focus) {
    border-color: #002455 !important;
    box-shadow: 0 0 0 0.25rem rgba(0, 36, 85, 0.15) !important;
  }

  /* Login Button Hover */
  .btn-login:hover {
    background: linear-gradient(135deg, #1B3C53 0%, #002455 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,36,85,0.4) !important;
  }

  .btn-login:active {
    transform: translateY(0);
  }

  /* Toggle Password Button */
  #togglePassword:hover {
    background-color: #002455 !important;
    color: #fff !important;
  }

  /* Social Login Buttons */
  .btn-social:hover {
    border-color: #002455 !important;
    background-color: #f8f9fa !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,36,85,0.1);
  }

  /* Links Hover */
  a:hover {
    color: #FFC107 !important;
  }

  /* Checkbox Checked State */
  .form-check-input:checked {
    background-color: #002455;
    border-color: #002455;
  }

  /* Divider Text */
  .divider-text {
    position: relative;
    text-align: center;
  }

  .divider-text::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: #e9ecef;
    z-index: -1;
  }

  /* Wave Animation */
  .wave-bottom {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 60px;
    overflow: hidden;
    line-height: 0;
  }

  /* Floating Shapes */
  .login-wrapper {
    position: relative;
    overflow: hidden;
  }

  .floating-shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.05;
    z-index: 0;
  }

  .shape-1 {
    width: 300px;
    height: 300px;
    background-color: #002455;
    top: -100px;
    right: -100px;
    animation: float 15s ease-in-out infinite;
  }

  .shape-2 {
    width: 200px;
    height: 200px;
    background-color: #FFC107;
    bottom: -50px;
    left: -50px;
    animation: float 20s ease-in-out infinite reverse;
  }

  .shape-3 {
    width: 150px;
    height: 150px;
    background-color: #1B3C53;
    top: 50%;
    left: -75px;
    animation: float 18s ease-in-out infinite;
  }

  @keyframes float {
    0%, 100% {
      transform: translateY(0) rotate(0deg);
    }
    50% {
      transform: translateY(-20px) rotate(5deg);
    }
  }

  .login-container {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 450px;
  }

  /* Card Animation */
  .card {
    animation: slideUp 0.5s ease-out;
  }

  @keyframes slideUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Login Icon Pulse */
  .login-icon {
    animation: pulse 2s ease-in-out infinite;
  }

  @keyframes pulse {
    0%, 100% {
      box-shadow: 0 8px 16px rgba(255,193,7,0.3);
    }
    50% {
      box-shadow: 0 8px 24px rgba(255,193,7,0.5);
    }
  }

  /* Trust Badges */
  .trust-badge {
    transition: all 0.3s ease;
  }

  .trust-badge:hover {
    transform: scale(1.2) rotate(10deg);
  }

  /* Alert Animations */
  .alert {
    animation: slideDown 0.3s ease-out;
  }

  @keyframes slideDown {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Responsive */
  @media (max-width: 576px) {
    .card {
      border-radius: 16px !important;
    }

    .login-icon {
      width: 60px !important;
      height: 60px !important;
    }

    .card-header h4 {
      font-size: 1.25rem;
    }

    .wave-bottom {
      height: 40px;
    }
  }
</style>

{{-- Toggle Password Script --}}
@push('script')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('togglePassword');
    const pwd = document.getElementById('password');
    const icon = document.getElementById('toggleIcon');
    
    if (!toggle || !pwd || !icon) return;
    
    toggle.addEventListener('click', function () {
      const type = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
      pwd.setAttribute('type', type);
      
      // Toggle icon
      if (type === 'text') {
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });
  });
</script>
@endpush

@endsection