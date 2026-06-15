<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hệ Thống Quản Trị Tư Vấn Sức Khỏe</title>
    
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
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col justify-between">

    <!-- Header Navigation -->
    <header class="bg-slate-900 text-white shadow-md sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('consultation.index') }}" class="bg-teal-600 text-white p-2 rounded-xl hover:bg-teal-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="font-bold text-lg leading-tight tracking-tight">Trang Quản Trị Y Tế</h1>
                    <p class="text-[10px] text-teal-400 font-medium">HỆ THỐNG TƯ VẤN SỨC KHỎE CỘNG ĐỒNG</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="text-xs text-slate-400 font-medium">Xin chào, {{ Auth::user()->name }}</span>
                <a href="{{ route('consultation.index') }}" target="_blank" class="text-xs font-semibold text-slate-300 hover:text-white bg-slate-800 px-3.5 py-2 rounded-lg transition-colors border border-slate-700">
                    Xem Trang Chủ Form
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs font-semibold text-red-400 hover:text-red-300 bg-slate-800 hover:bg-red-950/20 px-3.5 py-2 rounded-lg transition-colors border border-slate-700 cursor-pointer">
                        Đăng Xuất
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Real-time Update Alert Banner (Hidden by default) -->
    <div id="realtimeAlertBanner" class="hidden bg-teal-600 text-white border-b border-teal-500 py-3.5 px-4 shadow-md sticky top-16 z-30 animate-pulse">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-2.5">
                <span class="flex h-2.5 w-2.5 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-100 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-teal-200"></span>
                </span>
                <p class="text-sm font-semibold">Có yêu cầu tư vấn mới từ khách hàng! Vui lòng tải lại trang để cập nhật danh sách.</p>
            </div>
            <button onclick="location.reload()" class="bg-white text-teal-800 hover:bg-teal-50 px-4 py-1.5 rounded-lg text-xs font-bold transition-all shadow-sm cursor-pointer whitespace-nowrap">
                Tải lại ngay
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow py-8 max-w-7xl w-full mx-auto px-4">
        
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-2 shadow-sm animate-fade-in">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-emerald-600">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Statistics Cards -->
        <section class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <!-- Total -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="block text-xs font-bold text-slate-400 uppercase">Tổng số yêu cầu</span>
                    <span class="block text-2xl md:text-3xl font-extrabold text-slate-800 mt-1">{{ $stats['total'] }}</span>
                </div>
                <div class="p-3.5 bg-slate-100 text-slate-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-.621-.504-1.125-1.125-1.125H9.75M8.25 21h8.25c.621 0 1.125-.504 1.125-1.125V11.25c0-.621-.504-1.125-1.125-1.125H8.25c-.621 0-1.125.504-1.125 1.125v8.625c0 .621.504 1.125 1.125 1.125ZM12 3v1.5M12 18.75V21m-6-6h1.5m10.5 0H18M7.05 7.05l1.06 1.06m7.78 7.78l1.06 1.06M7.05 16.95l1.06-1.06m7.78-7.78l1.06-1.06" />
                    </svg>
                </div>
            </div>
            <!-- Pending -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="block text-xs font-bold text-yellow-600 uppercase">Đang chờ xử lý</span>
                    <span class="block text-2xl md:text-3xl font-extrabold text-yellow-600 mt-1">{{ $stats['pending'] }}</span>
                </div>
                <div class="p-3.5 bg-yellow-50 text-yellow-600 rounded-xl border border-yellow-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
            <!-- Contacted -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="block text-xs font-bold text-blue-600 uppercase">Đang xử lý</span>
                    <span class="block text-2xl md:text-3xl font-extrabold text-blue-600 mt-1">{{ $stats['contacted'] }}</span>
                </div>
                <div class="p-3.5 bg-blue-50 text-blue-600 rounded-xl border border-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .802-.336 48.086 48.086 0 0 0 3.34-.367c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>
                </div>
            </div>
            <!-- Completed -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="block text-xs font-bold text-emerald-600 uppercase">Đã xử lý</span>
                    <span class="block text-2xl md:text-3xl font-extrabold text-emerald-600 mt-1">{{ $stats['completed'] }}</span>
                </div>
                <div class="p-3.5 bg-emerald-50 text-emerald-600 rounded-xl border border-emerald-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                    </svg>
                </div>
            </div>
        </section>

        <!-- Filters & Search Form -->
        <section class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-6">
            <form action="{{ route('admin.consultations.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <!-- Search Box -->
                <div class="md:col-span-2">
                    <label for="search" class="block text-xs font-semibold text-slate-500 mb-1.5">Tìm kiếm khách hàng</label>
                    <div class="relative">
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nhập tên hoặc số điện thoại..." class="w-full pl-10 pr-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-teal-50 focus:border-teal-500 text-sm">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.608 10.608Z" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-xs font-semibold text-slate-500 mb-1.5">Trạng thái</label>
                    <select name="status" id="status" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-teal-50 focus:border-teal-500 text-sm bg-white">
                        <option value="">-- Tất cả trạng thái --</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Đang chờ xử lý</option>
                        <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Đang xử lý</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Đã xử lý</option>
                    </select>
                </div>

                <!-- Gender Filter -->
                <div>
                    <label for="gender" class="block text-xs font-semibold text-slate-500 mb-1.5">Giới tính</label>
                    <select name="gender" id="gender" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-teal-50 focus:border-teal-500 text-sm bg-white">
                        <option value="">-- Tất cả giới tính --</option>
                        <option value="nam" {{ request('gender') === 'nam' ? 'selected' : '' }}>Nam</option>
                        <option value="nu" {{ request('gender') === 'nu' ? 'selected' : '' }}>Nữ</option>
                        <option value="khac" {{ request('gender') === 'khac' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>
                
                <!-- Form Buttons -->
                <div class="md:col-span-4 flex items-center justify-end gap-3 mt-2">
                    @if(request()->anyFilled(['search', 'status', 'gender']))
                        <a href="{{ route('admin.consultations.index') }}" class="px-4 py-2 border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold rounded-xl text-xs transition-colors">
                            Xóa bộ lọc
                        </a>
                    @endif
                    <button type="submit" class="px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl text-xs shadow-md shadow-teal-600/10 cursor-pointer">
                        Áp Dụng Bộ Lọc
                    </button>
                </div>
            </form>
        </section>

        <!-- Main Data Table Section -->
        <section class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-wider border-b border-slate-100">
                            <th class="px-6 py-4">Thời gian gửi</th>
                            <th class="px-6 py-4">Khách hàng</th>
                            <th class="px-6 py-4">SĐT</th>
                            <th class="px-6 py-4">Giới tính / Tuổi</th>
                            <th class="px-6 py-4">Triệu chứng / Lý do tư vấn</th>
                            <th class="px-6 py-4">Trạng thái</th>
                            <th class="px-6 py-4 text-right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600 text-sm">
                        @forelse($consultations as $item)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-400 whitespace-nowrap">
                                    {{ $item->created_at->format('H:i d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-800 whitespace-nowrap">
                                    {{ $item->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="tel:{{ $item->phone }}" class="text-teal-600 font-semibold hover:underline">{{ $item->phone }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="capitalize">
                                        @if($item->gender === 'nam') Nam @elseif($item->gender === 'nu') Nữ @else Khác @endif
                                    </span> 
                                    / <span class="font-medium text-slate-800">{{ $item->age }} tuổi</span>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <div class="line-clamp-2 text-xs" title="{{ $item->reason }}">
                                        {{ $item->reason }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($item->status === 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-50 text-yellow-700 border border-yellow-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-400"></span>
                                            Đang chờ xử lý
                                        </span>
                                    @elseif($item->status === 'contacted')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                                            Đang xử lý
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                            Đã xử lý
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap flex items-center justify-end gap-2">
                                    <button 
                                        type="button" 
                                        onclick="openDetailModal({{ json_encode($item) }})" 
                                        class="px-3 py-1.5 bg-slate-100 hover:bg-teal-50 hover:text-teal-600 text-slate-700 font-bold rounded-lg text-xs transition-colors cursor-pointer"
                                    >
                                        Xem & Xử lý
                                    </button>
                                    <form action="{{ route('admin.consultations.destroy', $item) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa yêu cầu tư vấn của khách hàng {{ $item->name }}?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 font-bold rounded-lg text-xs transition-colors cursor-pointer"
                                        >
                                            Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-slate-400 text-sm">
                                    Không tìm thấy dữ liệu đăng ký tư vấn sức khỏe nào.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Section -->
            @if($consultations->hasPages())
                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $consultations->links() }}
                </div>
            @endif
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 py-6 text-center text-slate-400 text-xs mt-12">
        <p>&copy; {{ date('Y') }} Hệ Thống Quản Trị Y Tế Cộng Đồng. Mọi thông tin tuân thủ quy chế bảo mật.</p>
    </footer>

    <!-- Consultation Detail Dialog (Modal) -->
    <dialog id="detailModal" class="rounded-2xl border border-slate-100 shadow-2xl p-0 w-full max-w-xl backdrop:bg-slate-900/40 focus:outline-none">
        <div class="bg-gradient-to-r from-teal-700 to-teal-800 px-6 py-4 text-white flex justify-between items-center">
            <h3 class="font-bold text-base">Chi Tiết Yêu Cầu Tư Vấn</h3>
            <button onclick="closeDetailModal()" class="text-white/80 hover:text-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="p-6 space-y-6">
            <!-- Patient Info Details grid -->
            <div class="grid grid-cols-2 gap-4 text-sm bg-slate-50 p-4 rounded-xl border border-slate-100">
                <div>
                    <span class="block text-[10px] font-bold text-slate-400 uppercase">Họ và tên</span>
                    <strong class="text-slate-800 text-base" id="modalName">N/A</strong>
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-slate-400 uppercase">Số điện thoại</span>
                    <strong class="text-teal-600 text-base" id="modalPhone">N/A</strong>
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-slate-400 uppercase">Giới tính</span>
                    <span class="font-semibold text-slate-800" id="modalGender">N/A</span>
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-slate-400 uppercase">Tuổi</span>
                    <span class="font-semibold text-slate-800"><span id="modalAge">0</span> tuổi</span>
                </div>
            </div>

            <!-- Health Question details -->
            <div class="space-y-4">
                <div>
                    <span class="block text-xs font-bold text-slate-400 uppercase mb-1">Lý do yêu cầu tư vấn / Triệu chứng</span>
                    <p class="text-sm text-slate-700 bg-slate-50 border border-slate-100 p-3.5 rounded-xl whitespace-pre-wrap leading-relaxed" id="modalReason">N/A</p>
                </div>
                <div>
                    <span class="block text-xs font-bold text-slate-400 uppercase mb-1">Tiền sử bệnh lý</span>
                    <p class="text-sm text-slate-700 bg-slate-50 border border-slate-100 p-3.5 rounded-xl whitespace-pre-wrap leading-relaxed" id="modalHistory">Không có</p>
                </div>
            </div>

            <!-- Treatment/Update Form -->
            <form id="updateForm" method="POST" action="" class="space-y-4 border-t border-slate-100 pt-4">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Status selector -->
                    <div>
                        <label for="modalStatus" class="block text-xs font-bold text-slate-400 uppercase mb-1.5">Trạng thái xử lý</label>
                        <select name="status" id="modalStatus" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-teal-50 focus:border-teal-500 text-sm bg-white">
                            <option value="pending">Đang chờ xử lý</option>
                            <option value="contacted">Đang xử lý</option>
                            <option value="completed">Đã xử lý</option>
                        </select>
                    </div>
                    
                    <!-- Call patient quick link -->
                    <div class="flex items-end">
                        <a id="modalCallBtn" href="tel:" class="w-full text-center py-2 px-4 bg-teal-50 text-teal-700 font-bold border border-teal-100 rounded-xl hover:bg-teal-100 text-xs transition-colors flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.1-1.353 1.353-.22-.22a8.72 8.72 0 0 1-5.05-5.05L10 11.23l1.1-1.353-1.1-4.423a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                            Gọi Hotline Khách Hàng
                        </a>
                    </div>
                </div>

                <!-- Doctor / Admin notes -->
                <div>
                    <label for="modalNotes" class="block text-xs font-bold text-slate-400 uppercase mb-1.5">Ghi chú y bác sĩ (Nội bộ)</label>
                    <textarea name="admin_notes" id="modalNotes" rows="3" placeholder="Nhập chuẩn đoán y khoa, trạng thái liên hệ hoặc ghi chú theo dõi..." class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-teal-50 focus:border-teal-500 text-sm"></textarea>
                </div>

                <!-- Submit update button -->
                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="closeDetailModal()" class="px-4 py-2 border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold rounded-xl text-xs transition-colors cursor-pointer">
                        Đóng lại
                    </button>
                    <button type="submit" id="modalSubmitBtn" class="px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl text-xs shadow-md shadow-teal-600/10 cursor-pointer">
                        Lưu Thay Đổi
                    </button>
                    <!-- Locked message -->
                    <div id="modalLockMessage" class="hidden p-3.5 bg-slate-100 rounded-xl border border-slate-200 text-slate-500 text-xs flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <span>Yêu cầu tư vấn này đã hoàn tất xử lý và được khóa. Không thể thay đổi trạng thái nữa.</span>
                    </div>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        const modal = document.getElementById('detailModal');
        
        function openDetailModal(item) {
            document.getElementById('modalName').innerText = item.name;
            document.getElementById('modalPhone').innerText = item.phone;
            document.getElementById('modalAge').innerText = item.age;
            
            let genderText = 'Khác';
            if (item.gender === 'nam') genderText = 'Nam';
            else if (item.gender === 'nu') genderText = 'Nữ';
            document.getElementById('modalGender').innerText = genderText;
            
            document.getElementById('modalReason').innerText = item.reason;
            document.getElementById('modalHistory').innerText = item.medical_history || 'Không có';
            
            // Set fields in form
            document.getElementById('modalStatus').value = item.status;
            document.getElementById('modalNotes').value = item.admin_notes || '';
            
            // Disable editing if status is completed
            if (item.status === 'completed') {
                document.getElementById('modalStatus').disabled = true;
                document.getElementById('modalNotes').disabled = true;
                document.getElementById('modalSubmitBtn').style.display = 'none';
                document.getElementById('modalLockMessage').classList.remove('hidden');
            } else {
                document.getElementById('modalStatus').disabled = false;
                document.getElementById('modalNotes').disabled = false;
                document.getElementById('modalSubmitBtn').style.display = 'inline-flex';
                document.getElementById('modalLockMessage').classList.add('hidden');
                
                // Disable transitioning back from contacted to pending
                const pendingOption = document.querySelector('#modalStatus option[value="pending"]');
                if (item.status === 'contacted') {
                    pendingOption.disabled = true;
                } else {
                    pendingOption.disabled = false;
                }
            }
            
            // Update action route dynamically
            document.getElementById('updateForm').action = `/admin/consultations/${item.id}`;
            document.getElementById('modalCallBtn').href = `tel:${item.phone}`;
            
            modal.showModal();
        }
        
        function closeDetailModal() {
            modal.close();
        }

        // Real-time notification sound using Web Audio API (synthesizes chime: D5 then A5)
        function playNotificationSound() {
            try {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                if (!AudioContext) return;
                const ctx = new AudioContext();
                
                const playTone = (freq, start, duration) => {
                    const osc = ctx.createOscillator();
                    const gain = ctx.createGain();
                    osc.connect(gain);
                    gain.connect(ctx.destination);
                    
                    osc.frequency.setValueAtTime(freq, start);
                    
                    // Smooth volume envelope to avoid clicking sounds
                    gain.gain.setValueAtTime(0, start);
                    gain.gain.linearRampToValueAtTime(0.15, start + 0.05);
                    gain.gain.exponentialRampToValueAtTime(0.001, start + duration);
                    
                    osc.start(start);
                    osc.stop(start + duration);
                };
                
                const now = ctx.currentTime;
                playTone(587.33, now, 0.2); // D5
                playTone(880.00, now + 0.15, 0.35); // A5
            } catch (e) {
                console.error('Audio play failed:', e);
            }
        }

        // Create and show a beautiful toast notification
        function showToast(message) {
            const container = document.getElementById('toastContainer');
            if (!container) return;
            
            const toast = document.createElement('div');
            toast.className = 'pointer-events-auto bg-slate-900/95 text-white border border-slate-800 p-4 rounded-2xl shadow-2xl flex items-start gap-3 transform translate-y-2 opacity-0 transition-all duration-300 ease-out';
            
            toast.innerHTML = `
                <div class="p-2 bg-teal-500/10 text-teal-400 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a9.04 9.04 0 0 0 5.697-4.44m-5.697 4.44a9.073 9.073 0 0 1-4.305-6.837m1.5 13.946c-.053.072-.1.143-.15.212m-.07.291c-.07.292-.162.58-.275.862m-.275-.862a9.07 9.07 0 0 1-4.305-6.837M12 3v1.5m0 17.25a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                    </svg>
                </div>
                <div class="flex-grow">
                    <h4 class="font-bold text-xs text-teal-400 uppercase tracking-wider">Thông báo Real-time</h4>
                    <p class="text-xs text-slate-200 mt-1 font-medium leading-relaxed">${message}</p>
                </div>
            `;
            
            container.appendChild(toast);
            
            // Trigger animation
            requestAnimationFrame(() => {
                toast.classList.remove('translate-y-2', 'opacity-0');
            });
            
            // Auto-dismiss after 6 seconds
            setTimeout(() => {
                toast.classList.add('translate-y-[-10px]', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 6000);
        }

        // Initialize state tracker with the absolute latest consultation ID on initial page load
        let latestConsultationId = {{ \App\Models\HealthConsultation::latest()->first() ? \App\Models\HealthConsultation::latest()->first()->id : 0 }};

        function checkRealtimeUpdates() {
            fetch("/admin/consultations/check-updates")
                .then(response => {
                    if (!response.ok) throw new Error('Yêu cầu AJAX thất bại');
                    return response.json();
                })
                .then(data => {
                    if (data.latest_id > latestConsultationId) {
                        const newName = data.latest_name || 'Khách hàng mới';
                        latestConsultationId = data.latest_id;
                        
                        const isModalOpen = modal && modal.hasAttribute('open');
                        
                        if (isModalOpen) {
                            // Show persistent warning banner at the top
                            const banner = document.getElementById('realtimeAlertBanner');
                            if (banner) {
                                banner.classList.remove('hidden');
                            }
                        } else {
                            // Play chime sound
                            playNotificationSound();
                            
                            // Show toast notification
                            showToast(`Có yêu cầu tư vấn mới từ: ${newName}. Trang sẽ tự động tải lại sau giây lát.`);
                            
                            // Reload after 2.5 seconds
                            setTimeout(() => {
                                location.reload();
                            }, 2500);
                        }
                    }
                })
                .catch(error => {
                    console.error('Lỗi kiểm tra real-time:', error);
                });
        }

        // Poll every 5 seconds
        setInterval(checkRealtimeUpdates, 5000);
    </script>

    <!-- Toast Notification Container -->
    <div id="toastContainer" class="fixed bottom-5 right-5 z-50 flex flex-col gap-3 max-w-sm w-full pointer-events-none"></div>

</body>
</html>
