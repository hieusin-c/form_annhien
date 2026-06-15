<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Nhập Hệ Thống Quản Trị Y Tế 1</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Outfit', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
    @endif
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex flex-col justify-center items-center px-4 relative overflow-hidden bg-cover bg-no-repeat bg-center bg-fixed" style="background-image: url('https://i.pinimg.com/1200x/75/07/a5/7507a5c18267753fabde3f018dd3d3c0.jpg');">

    <!-- Background graphic accents -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>

    <div class="w-full max-w-md relative z-10">
        
        <!-- Logo / Branding header -->
        <div class="text-center mb-8">
            <a href="{{ route('consultation.index') }}" class="inline-flex items-center gap-2 mb-3">
                <div class="bg-teal-600 text-white p-2.5 rounded-2xl shadow-lg shadow-teal-600/20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                    </svg>
                </div>
                <span class="font-bold text-xl text-slate-800 tracking-tight">Sức Khỏe <span class="text-teal-600">Cộng Đồng</span></span>
            </a>
            <h1 class="text-lg font-bold text-slate-700">Đăng nhập cổng quản trị</h1>
            <p class="text-xs text-slate-400">Vui lòng điền tài khoản để duyệt hồ sơ tư vấn</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl overflow-hidden p-6 md:p-8">
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-600 mb-1.5">Địa chỉ Email</label>
                    <div class="relative">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="ten@vidu.com" class="w-full pl-10 pr-4 py-2.5 rounded-xl border @error('email') border-red-300 bg-red-50/20 focus:ring-red-100 focus:border-red-400 @else border-slate-200 focus:ring-teal-50 focus:border-teal-500 @enderror focus:outline-none focus:ring-4 transition-all text-sm">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.38 1.13 2.5 2.5 2.5s2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5-2.5 1.12-2.5 2.5Zm-13.5 0h.008v.008H3V12Z" />
                            </svg>
                        </div>
                    </div>
                    @error('email')
                        <span class="block text-red-500 text-xs mt-1.5">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-600 mb-1.5">Mật khẩu</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required placeholder="••••••••" class="w-full pl-10 pr-4 py-2.5 rounded-xl border @error('password') border-red-300 bg-red-50/20 focus:ring-red-100 focus:border-red-400 @else border-slate-200 focus:ring-teal-50 focus:border-teal-500 @enderror focus:outline-none focus:ring-4 transition-all text-sm">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                    </div>
                    @error('password')
                        <span class="block text-red-500 text-xs mt-1.5">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me and forgot pwd placeholders -->
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 text-slate-500 select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-teal-600 focus:ring-teal-500 cursor-pointer">
                        Ghi nhớ đăng nhập
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full py-3 px-5 bg-teal-600 hover:bg-teal-700 active:bg-teal-800 text-white font-bold rounded-2xl shadow-lg shadow-teal-600/20 hover:shadow-teal-700/30 transform hover:-translate-y-0.5 active:translate-y-0 transition-all cursor-pointer text-sm">
                        Đăng Nhập
                    </button>
                </div>
            </form>
        </div>

        <!-- Back Link -->
        <div class="text-center mt-6">
            <a href="{{ route('consultation.index') }}" class="text-xs font-semibold text-slate-400 hover:text-teal-600 transition-colors inline-flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Quay lại trang chủ đăng ký
            </a>
        </div>

    </div>

</body>
</html>
