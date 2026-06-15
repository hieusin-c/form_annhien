<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nhận Tư Vấn Sức Khỏe Cộng Đồng Miễn Phí</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (loaded via Vite or fallback) -->
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
                        },
                        colors: {
                            brand: {
                                50: '#f0fdfa',
                                100: '#ccfbf1',
                                500: '#0d9488',
                                600: '#0f766e',
                                700: '#115e59',
                            }
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
        @media (max-width: 1279px) {
            .desktop-only-card {
                display: none !important;
            }
        }
        @media (min-width: 1280px) {
            .mobile-only-card {
                display: none !important;
            }
        }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex flex-col justify-between selection:bg-teal-500 selection:text-white bg-cover bg-no-repeat bg-center bg-fixed" style="background-image: url('https://i.pinimg.com/1200x/75/07/a5/7507a5c18267753fabde3f018dd3d3c0.jpg');">

    <!-- Navigation Header -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm transition-all duration-300">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="{{ route('consultation.index') }}" class="flex items-center gap-2 group">
                <img src="{{ asset('logo.png') }}" alt="Dược An Nhiên" class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
            </a>
            
            <nav class="flex items-center gap-6">
                <a href="#form-registration" class="text-sm font-semibold text-teal-600 hover:text-teal-700 transition-colors duration-200">Đăng Ký Tư Vấn</a>
                <a href="{{ route('admin.consultations.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors duration-200 bg-slate-100 px-3.5 py-1.5 rounded-lg hover:bg-slate-200">Đăng Nhập</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        
        <!-- Hero Section -->
        <section class="relative overflow-hidden py-16 text-white bg-gradient-to-br from-teal-950 via-teal-900 to-slate-950">
            <!-- Background grids/graphics -->
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#0f766e_1px,transparent_1px),linear-gradient(to_bottom,#0f766e_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-25 z-0"></div>
            
            <!-- Left Side Product Showcase (Absolute positioned on desktop, hidden on mobile) -->
            <div class="desktop-only-card hidden xl:flex absolute left-6 2xl:left-12 top-1/2 -translate-y-1/2 z-10">
                <div class="relative group w-[180px] 2xl:w-[220px]">
                    <!-- Ambient glow effect -->
                    <div class="absolute -inset-1.5 bg-gradient-to-r from-teal-500 to-emerald-500 rounded-3xl blur opacity-25 group-hover:opacity-35 transition duration-500"></div>
                    <!-- Product Card -->
                    <div class="relative bg-white p-3 rounded-3xl shadow-2xl border border-teal-500/10 transform hover:scale-[1.02] transition-all duration-300">
                        <img src="{{ asset('hero-bg.jpg') }}" alt="KTIRA Omega 3 Krill" class="rounded-2xl w-full h-auto object-contain bg-white">
                    </div>
                </div>
            </div>

            <!-- Right Side Product Showcase (Absolute positioned on desktop, hidden on mobile) -->
            <div class="desktop-only-card hidden xl:flex absolute right-6 2xl:right-12 top-1/2 -translate-y-1/2 z-10">
                <div class="relative group w-[180px] 2xl:w-[220px]">
                    <!-- Ambient glow effect -->
                    <div class="absolute -inset-1.5 bg-gradient-to-r from-teal-500 to-emerald-500 rounded-3xl blur opacity-25 group-hover:opacity-35 transition duration-500"></div>
                    <!-- Product Card -->
                    <div class="relative bg-white p-3 rounded-3xl shadow-2xl border border-teal-500/10 transform hover:scale-[1.02] transition-all duration-300">
                        <img src="{{ asset('hero-bg.jpg') }}" alt="KTIRA Omega 3 Krill" class="rounded-2xl w-full h-auto object-contain bg-white">
                    </div>
                </div>
            </div>

            <!-- Centered Text Content (Keeping original centered layout and styling) -->
            <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-teal-500/10 text-teal-300 border border-teal-500/20 mb-4 animate-pulse">
                    <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                    Chương Trình Ý Nghĩa Vì Sức Khỏe Cộng Đồng
                </span>
                
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight mb-6">
                    Nhận Tư Vấn Sức Khỏe <br> <span class="bg-gradient-to-r from-teal-300 to-emerald-300 bg-clip-text text-transparent">Cộng Đồng Miễn Phí</span>
                </h1>
                
                <p class="text-lg text-teal-100/90 max-w-2xl mx-auto mb-8 leading-relaxed font-light">
                    Đồng hành cùng sức khỏe gia đình bạn. Hãy điền các thông tin cá nhân và tình trạng sức khỏe dưới đây. Bác sĩ chuyên khoa y tế sẽ tư vấn trực tuyến và giải đáp chi tiết nhất qua Zalo của bạn.
                </p>
                
                <div class="flex items-center justify-center gap-4 flex-wrap">
                    <div class="flex items-center gap-2 bg-white/5 border border-white/10 px-4 py-2 rounded-xl">
                        <span class="text-teal-400 font-bold">100%</span>
                        <span class="text-slate-300">Hoàn Toàn Miễn Phí</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/5 border border-white/10 px-4 py-2 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-teal-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                        <span class="text-sm text-slate-300">Chọn Chuyên Khoa Phù Hợp</span>
                    </div>
                </div>

                <!-- Product Showcase on Mobile/Tablet (centered below text) -->
                <div class="mobile-only-card flex xl:hidden justify-center mt-8">
                    <div class="relative group w-full max-w-[200px]">
                        <!-- Ambient glow effect -->
                        <div class="absolute -inset-1 bg-gradient-to-r from-teal-500 to-emerald-500 rounded-3xl blur opacity-25 group-hover:opacity-35 transition duration-500"></div>
                        <!-- Product Image Container -->
                        <div class="relative bg-white p-3 rounded-3xl shadow-2xl border border-teal-500/10 transform hover:scale-[1.02] transition-all duration-300">
                            <img src="{{ asset('hero-bg.jpg') }}" alt="KTIRA Omega 3 Krill" class="rounded-2xl w-full h-auto object-contain shadow-sm bg-white">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Form Section -->
        <section id="form-registration" class="py-12 max-w-3xl mx-auto px-4 -mt-8 relative z-20">
            
            <!-- Success Alert Modal Style -->
            @if(session('success'))
                <div class="bg-white rounded-3xl border border-teal-100 shadow-2xl p-8 text-center mb-8 transform hover:scale-[1.01] transition-transform duration-300">
                    <div class="w-16 h-16 bg-teal-50 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-10 h-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-2">Đăng Ký Thành Công!</h2>
                    <p class="text-slate-600 max-w-md mx-auto mb-6">{{ session('success') }}</p>
                    
                    <div class="p-6 bg-teal-50/50 rounded-2xl border border-teal-100/50 max-w-lg mx-auto mb-6">
                        <span class="block text-xs font-semibold text-teal-800 uppercase tracking-widest mb-1">Phương thức hỗ trợ</span>
                        <span class="block text-lg font-bold text-teal-950 mb-2">Trực tuyến (Chat qua Zalo)</span>
                        <p class="text-sm text-slate-500">Để nhận tư vấn chuyên khoa nhanh nhất từ bác sĩ, vui lòng nhấn nút kết nối bên dưới để mở cuộc trò chuyện trên Zalo ngay lập tức.</p>
                    </div>
                    
                    <a href="{{ session('zalo_link') }}" target="_blank" class="inline-flex items-center gap-2.5 px-8 py-4 bg-[#0068ff] hover:bg-[#005ad9] text-white font-bold rounded-2xl shadow-lg shadow-[#0068ff]/30 hover:shadow-[#005ad9]/40 transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.003 21c-5.52 0-9.99-4.48-9.99-10S6.483 1 12.003 1s9.99 4.48 9.99 10-4.47 10-9.99 10zm-1.89-6.38c.35.35.79.52 1.34.52s1-.17 1.35-.52c.35-.35.52-.78.52-1.31s-.17-.96-.52-1.31c-.35-.35-.8-.52-1.35-.52s-.99.17-1.34.52c-.35.35-.52.79-.52 1.31s.17.96.52 1.31z"/>
                        </svg>
                        Kết nối Chat qua Zalo
                    </a>
                </div>
            @endif

            <!-- Main Form Card -->
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
                <div class="bg-gradient-to-r from-teal-600 to-emerald-600 px-6 py-5 text-white">
                    <h3 class="font-bold text-lg">Phiếu Thông Tin Đăng Ký Tư Vấn</h3>
                    <p class="text-teal-100 text-xs">Vui lòng điền thông tin chính xác để bác sĩ nắm bắt tình trạng sức khỏe tốt nhất.</p>
                </div>
                
                <form action="{{ route('consultation.store') }}" method="POST" class="p-6 md:p-8 space-y-6">
                    @csrf

                    <!-- Section 1: Thông tin cá nhân -->
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-2 mb-4 flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-teal-50 text-teal-600 text-xs flex items-center justify-center font-bold">1</span>
                            Thông Tin Cá Nhân
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Họ và tên -->
                            <div>
                                <label for="name" class="block text-xs font-semibold text-slate-600 mb-1.5">Họ và tên <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Ví dụ: Nguyễn Văn A" class="w-full px-4 py-2.5 rounded-xl border @error('name') border-red-300 bg-red-50/20 focus:ring-red-200 focus:border-red-400 @else border-slate-200 focus:ring-teal-100 focus:border-teal-500 @enderror focus:outline-none focus:ring-4 transition-all duration-200 text-sm">
                                @error('name')
                                    <span class="block text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Số điện thoại -->
                            <div>
                                <label for="phone" class="block text-xs font-semibold text-slate-600 mb-1.5">Số điện thoại <span class="text-red-500">*</span></label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Ví dụ: 0912345678" class="w-full px-4 py-2.5 rounded-xl border @error('phone') border-red-300 bg-red-50/20 focus:ring-red-200 focus:border-red-400 @else border-slate-200 focus:ring-teal-100 focus:border-teal-500 @enderror focus:outline-none focus:ring-4 transition-all duration-200 text-sm">
                                @error('phone')
                                    <span class="block text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tuổi -->
                            <div>
                                <label for="age" class="block text-xs font-semibold text-slate-600 mb-1.5">Tuổi <span class="text-red-500">*</span></label>
                                <input type="number" name="age" id="age" value="{{ old('age') }}" placeholder="Nhập tuổi của bạn" min="1" max="120" class="w-full px-4 py-2.5 rounded-xl border @error('age') border-red-300 bg-red-50/20 focus:ring-red-200 focus:border-red-400 @else border-slate-200 focus:ring-teal-100 focus:border-teal-500 @enderror focus:outline-none focus:ring-4 transition-all duration-200 text-sm">
                                @error('age')
                                    <span class="block text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Giới tính -->
                            <div>
                                <label for="gender" class="block text-xs font-semibold text-slate-600 mb-1.5">Giới tính <span class="text-red-500">*</span> <span class="text-slate-400 font-normal">(để chọn chuyên khoa phù hợp)</span></label>
                                <select name="gender" id="gender" class="w-full px-4 py-2.5 rounded-xl border @error('gender') border-red-300 bg-red-50/20 focus:ring-red-200 focus:border-red-400 @else border-slate-200 focus:ring-teal-100 focus:border-teal-500 @enderror focus:outline-none focus:ring-4 transition-all duration-200 text-sm bg-white">
                                    <option value="" disabled {{ old('gender') === null ? 'selected' : '' }}>-- Chọn giới tính --</option>
                                    <option value="nam" {{ old('gender') === 'nam' ? 'selected' : '' }}>Nam</option>
                                    <option value="nu" {{ old('gender') === 'nu' ? 'selected' : '' }}>Nữ</option>
                                    <option value="khac" {{ old('gender') === 'khac' ? 'selected' : '' }}>Khác</option>
                                </select>
                                @error('gender')
                                    <span class="block text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Khảo sát tình trạng sức khỏe -->
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-2 mb-4 flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-teal-50 text-teal-600 text-xs flex items-center justify-center font-bold">2</span>
                            Khảo Sát Tình Trạng Sức Khỏe
                        </h4>
                        
                        <div class="space-y-4">
                            <!-- Lý do tư vấn -->
                            <div>
                                <label for="reason" class="block text-xs font-semibold text-slate-600 mb-1.5">Lý do yêu cầu tư vấn <span class="text-red-500">*</span></label>
                                <textarea name="reason" id="reason" rows="3" placeholder="Mô tả các triệu chứng bạn đang gặp phải hoặc vấn đề sức khỏe cần bác sĩ giải đáp..." class="w-full px-4 py-3 rounded-xl border @error('reason') border-red-300 bg-red-50/20 focus:ring-red-200 focus:border-red-400 @else border-slate-200 focus:ring-teal-100 focus:border-teal-500 @enderror focus:outline-none focus:ring-4 transition-all duration-200 text-sm">{{ old('reason') }}</textarea>
                                @error('reason')
                                    <span class="block text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tiền sử bệnh lý -->
                            <div>
                                <label for="medical_history" class="block text-xs font-semibold text-slate-600 mb-1.5">Tiền sử bệnh lý <span class="text-slate-400 font-normal">(nếu có)</span></label>
                                <textarea name="medical_history" id="medical_history" rows="3" placeholder="Các bệnh mạn tính đang điều trị, tiền sử dị ứng thuốc/thức ăn, tiền sử bệnh gia đình..." class="w-full px-4 py-3 rounded-xl border @error('medical_history') border-red-300 bg-red-50/20 focus:ring-red-200 focus:border-red-400 @else border-slate-200 focus:ring-teal-100 focus:border-teal-500 @enderror focus:outline-none focus:ring-4 transition-all duration-200 text-sm">{{ old('medical_history') }}</textarea>
                                @error('medical_history')
                                    <span class="block text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Phương thức hỗ trợ -->
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-2 mb-3 flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-teal-50 text-teal-600 text-xs flex items-center justify-center font-bold">3</span>
                            Phương Thức Hỗ Trợ
                        </h4>
                        
                        <div class="p-4 bg-teal-50 rounded-2xl border border-teal-100 flex gap-3.5 items-start">
                            <div class="p-2 bg-teal-600 text-white rounded-lg shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                </svg>
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-teal-950">Hình thức tư vấn: Trực tuyến (Chat qua Zalo)</span>
                                <p class="text-xs text-teal-800/80 mt-0.5 leading-relaxed">Sau khi bạn bấm gửi thông tin y tế thành công, một nút liên kết trực tiếp đến Zalo của Bác sĩ tư vấn sẽ hiển thị. Bạn có thể trò chuyện 1-1 riêng tư và bảo mật.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" class="w-full py-3.5 px-6 bg-teal-600 hover:bg-teal-700 active:bg-teal-800 text-white font-bold rounded-2xl shadow-lg shadow-teal-600/20 hover:shadow-teal-700/30 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150 flex items-center justify-center gap-2 cursor-pointer">
                            <span>Gửi Đăng Ký Tư Vấn Miễn Phí</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-white/80 backdrop-blur-md border-t border-slate-100 py-8 text-center text-slate-400 text-xs">
        <div class="max-w-6xl mx-auto px-4 space-y-2">
            <p>&copy; {{ date('Y') }} Chương Trình Vì Sức Khỏe Cộng Đồng. All rights reserved.</p>
            <p>Bảo mật thông tin khách hàng tuyệt đối theo quy định của Bộ Y Tế.</p>
        </div>
    </footer>

</body>
</html>
