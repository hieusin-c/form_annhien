<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HealthConsultation;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HealthConsultationController extends Controller
{
    /**
     * Display the registration form.
     */
    public function index(): View
    {
        return view('welcome');
    }

    /**
     * Store a new health consultation request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'in:nam,nu,khac'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'phone' => ['required', 'string', 'regex:/^(03|05|07|08|09)\d{8}$/'],
            'reason' => ['required', 'string', 'max:2000'],
            'medical_history' => ['nullable', 'string', 'max:2000'],
        ], [
            'name.required' => 'Họ và tên là bắt buộc.',
            'name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'gender.required' => 'Vui lòng chọn giới tính để có tư vấn chuyên khoa phù hợp.',
            'gender.in' => 'Giới tính đã chọn không hợp lệ.',
            'age.required' => 'Vui lòng nhập tuổi.',
            'age.integer' => 'Tuổi phải là một số nguyên.',
            'age.min' => 'Tuổi phải lớn hơn hoặc bằng 1.',
            'age.max' => 'Tuổi không hợp lệ (tối đa 120).',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại không đúng định dạng Việt Nam (ví dụ: 0912345678).',
            'reason.required' => 'Vui lòng nhập lý do tư vấn hoặc các triệu chứng đang gặp phải.',
            'reason.max' => 'Lý do tư vấn không được vượt quá 2000 ký tự.',
            'medical_history.max' => 'Tiền sử bệnh lý không được vượt quá 2000 ký tự.',
        ]);

        $consultation = HealthConsultation::create($validated);

        $zaloPhone = env('ZALO_PHONE', '0912345678');
        $zaloLink = 'https://zalo.me/' . preg_replace('/\D/', '', $zaloPhone);

        return redirect()->back()->with([
            'success' => 'Gửi yêu cầu tư vấn thành công! Thông tin của bạn đã được tiếp nhận an toàn.',
            'zalo_link' => $zaloLink,
            'consultation_id' => $consultation->id,
        ]);
    }
}
