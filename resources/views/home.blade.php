@extends('layouts.app')

@section('content')
<style>
    .welcome-section {
        padding: 3rem 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
        margin-top: 2rem;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        animation: fadeIn 1s ease-in-out;
    }

    .welcome-section h1 {
        font-size: 2.5rem;
        font-weight: bold;
    }

    .welcome-section p {
        font-size: 1.2rem;
        margin-top: 1rem;
    }

    .dashboard-stats {
        margin-top: 3rem;
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: space-around;
    }

    .stat-box {
        background-color: white;
        color: #4e73df;
        padding: 2rem;
        border-radius: 1rem;
        min-width: 250px;
        flex: 1;
        text-align: center;
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        transition: 0.3s ease;
    }

    .stat-box:hover {
        transform: translateY(-5px);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container">
    <div class="welcome-section text-center">
        <h1>Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
        <p>Anda telah berhasil login ke <strong>SPK Bansos Desa Sindangkempeng</strong>.</p>
        <p>Sistem ini membantu dalam pengambilan keputusan untuk penyaluran bantuan sosial secara adil dan efisien.</p>
    </div>
</div>
@endsection
