<?php
use App\Models\User;
$username = Auth::User()->name;
?>
@extends('templates.admin')

@section('page-title', 'Dashboard')

@section('content-admin')
<div class="container-fluid">
    {{-- Welcome Banner --}}
    <div class="welcome-banner mb-4"
         style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%);
                border-radius: 16px;
                padding: 2rem;
                color: #fff;
                box-shadow: 0 4px 12px rgba(0,36,85,0.15);
                position: relative;
                overflow: hidden;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-2">
                    <i class="fas fa-hand-wave me-2" style="color:#FFC107;"></i>
                    Selamat Datang Kembali, Admin {{ $username }}!
                </h3>
            </div>
            <div class="col-lg-4 text-end d-none d-lg-block">
                <div class="welcome-illustration" style="font-size: 5rem; opacity: 0.2;">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>

        {{-- Decorative Elements --}}
        <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background-color: rgba(255,193,7,0.1); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background-color: rgba(255,193,7,0.05); border-radius: 50%;"></div>
    </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="card-header bg-white border-0" style="padding: 1.5rem; border-radius: 16px 16px 0 0;">
                    <h5 class="mb-0 fw-bold" style="color:#002455;">
                        <i class="fas fa-bolt me-2" style="color:#FFC107;"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.product') }}"
                           class="btn quick-action-btn text-start"
                           style="background-color: #f8f9fa; border: 2px solid #e9ecef; color:#002455; border-radius: 10px; padding: 1rem; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-plus-circle me-2" style="color:#FFC107;"></i>
                            Tambah Produk Baru
                        </a>
                        <a href="{{ route('admin.category') }}"
                           class="btn quick-action-btn text-start"
                           style="background-color: #f8f9fa; border: 2px solid #e9ecef; color:#002455; border-radius: 10px; padding: 1rem; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-layer-group me-2" style="color:#FFC107;"></i>
                            Kelola Kategori
                        </a>
                        <a href="{{ route('admin.orders') }}"
                           class="btn quick-action-btn text-start"
                           style="background-color: #f8f9fa; border: 2px solid #e9ecef; color:#002455; border-radius: 10px; padding: 1rem; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-clipboard-list me-2" style="color:#FFC107;"></i>
                            Lihat Semua Pesanan
                        </a>
                        <a href="{{ route('admin.account.data') }}"
                           class="btn quick-action-btn text-start"
                           style="background-color: #f8f9fa; border: 2px solid #e9ecef; color:#002455; border-radius: 10px; padding: 1rem; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-user-cog me-2" style="color:#FFC107;"></i>
                            Pengaturan Akun
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Stat Card Hover */
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,36,85,0.15) !important;
    }

    /* Table Row Hover */
    .table tbody tr:hover {
        background-color: rgba(0,36,85,0.02);
        cursor: pointer;
    }

    /* Quick Action Button Hover */
    .quick-action-btn:hover {
        border-color: #002455 !important;
        background-color: #002455 !important;
        color: #fff !important;
        transform: translateX(5px);
    }

    .quick-action-btn:hover i {
        color: #FFC107 !important;
    }

    /* Button Hover */
    .btn:hover {
        transform: translateY(-2px);
    }

    /* Smooth Animations */
    * {
        transition: all 0.3s ease;
    }
</style>
@endsection
