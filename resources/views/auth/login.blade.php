<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIMADA - Sistem Informasi Pengadaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #F4F6F8;
            --brand-dark: #0B3C35;
            --brand-green: #10B981;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
            --error-red: #EF4444;
            --error-bg: #FEF2F2;
            --error-border: #FCA5A5;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-main);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-wrapper {
            display: flex;
            background: #FFFFFF;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 960px;
            min-height: 600px;
            overflow: hidden;
        }

        /* --- LEFT PANEL --- */
        .login-left {
            background-color: var(--brand-dark);
            color: #FFFFFF;
            width: 45%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background-color: #FFFFFF;
            color: var(--brand-dark);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 22px;
        }

        .brand-text h2 { font-size: 20px; font-weight: 700; }
        .brand-text p { font-size: 11px; color: #A7F3D0; margin-top: 2px;}

        .left-content { margin-top: 60px; }
        .left-content hr {
            width: 40px;
            border: 2px solid var(--brand-green);
            margin-bottom: 24px;
        }
        .left-content h1 {
            font-size: 32px;
            line-height: 1.3;
            margin-bottom: 16px;
            font-weight: 700;
        }
        .left-content p {
            font-size: 14px;
            color: #D1E2DF;
            line-height: 1.6;
        }

        .left-footer {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
        }
        .left-footer p { font-size: 11px; color: #83A9A3; margin-bottom: 8px; }
        .left-footer h4 { display: flex; justify-content: space-between; font-size: 14px; font-weight: 600; }

        /* --- RIGHT PANEL (FORM) --- */
        .login-right {
            width: 55%;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-header h2 { font-size: 24px; font-weight: 700; color: var(--text-main); }
        .right-header p { font-size: 13px; color: var(--text-muted); margin-top: 6px; margin-bottom: 30px; }

        /* Alert Kredensial Salah */
        .alert-danger {
            background-color: var(--error-bg);
            border: 1px solid var(--error-border);
            border-radius: 8px;
            padding: 12px 16px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 24px;
        }
        .alert-danger svg { color: var(--error-red); flex-shrink: 0; margin-top: 2px; }
        .alert-danger div p.alert-title { color: var(--error-red); font-size: 13px; font-weight: 700; }
        .alert-danger div p.alert-desc { color: var(--error-red); font-size: 12px; margin-top: 2px; }

        .form-group { margin-bottom: 20px; position: relative; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: var(--text-main); margin-bottom: 8px; }
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            color: var(--text-main);
            outline: none;
            transition: border-color 0.2s;
        }
        .form-control:focus { border-color: var(--brand-dark); }
        
        .form-control.is-invalid {
            border-color: var(--error-red);
            background-color: #FFFAFA;
        }
        .error-message {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--error-red);
            font-size: 11px;
            margin-top: 6px;
            font-weight: 500;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 36px;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-muted);
        }

        .btn-submit {
            width: 100%;
            background-color: #059669;
            color: #FFFFFF;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 8px;
        }
        .btn-submit:hover { background-color: #047857; }

        .demo-box {
            background-color: #F8FAFC;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 16px;
            margin-top: 40px;
        }
        .demo-header { display: flex; justify-content: space-between; margin-bottom: 12px; }
        .demo-header h4 { font-size: 12px; font-weight: 700; color: var(--text-main); }
        .demo-header span { font-size: 10px; font-weight: 600; color: #059669; }
        .demo-row { display: flex; font-size: 12px; margin-bottom: 6px; }
        .demo-row:last-child { margin-bottom: 0; }
        .demo-label { width: 100px; color: var(--text-muted); }
        .demo-value { font-weight: 600; color: var(--text-main); }

        @media (max-width: 768px) {
            .login-wrapper { flex-direction: column; }
            .login-left { display: none; }
            .login-right { width: 100%; padding: 30px; }
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <!-- LEFT PANEL -->
        <div class="login-left">
            <div class="brand-header">
                <div class="brand-icon">S</div>
                <div class="brand-text">
                    <h2>SIMADA</h2>
                    <p>Sistem Informasi Pengadaan</p>
                </div>
            </div>

            <div class="left-content">
                <hr>
                <h1>Pengadaan terkelola. Pelaporan terarah.</h1>
                <p>Akses informasi pengadaan barang dan jasa Pemerintah Daerah melalui SIMADA.</p>
            </div>

            <div class="left-footer">
                <h4>Dashboard Pelaporan & Tracking <span>→</span></h4>
            </div>
        </div>

        <!-- RIGHT PANEL (FORM) -->
        <div class="login-right">
            <div class="right-header">
                <h2>Login SIMADA</h2>
                <p>Sistem Informasi Pengadaan Barang/Jasa</p>
            </div>

            <!-- Global Error Alert (Kredensial Salah) -->
            @if($errors->any() && !str_contains($errors->first(), 'wajib diisi'))
            <div class="alert-danger">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="alert-title">ID Pengguna atau password salah.</p>
                    <p class="alert-desc">Periksa kembali data Anda, lalu coba lagi.</p>
                </div>
            </div>
            @endif

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Input ID Pengguna -->
                <div class="form-group">
                    <label for="username">ID Pengguna</label>
                    <input type="text" id="username" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Masukkan ID pengguna">
                    
                    @error('email')
                        <div class="error-message">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Input Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password">
                    
                    <button type="button" class="password-toggle" id="togglePassword">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>

                    @error('password')
                        <div class="error-message">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Masuk</button>
            </form>
            </div>

        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.style.color = (type === 'text') ? '#0B3C35' : '#64748B';
        });
    </script>
</body>
</html>