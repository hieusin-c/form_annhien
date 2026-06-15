<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HealthConsultation;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ConsultationDashboardController extends Controller
{
    /**
     * Display a listing of the consultations.
     */
    public function index(Request $request): View
    {
        $query = HealthConsultation::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Gender filter
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        // Order by latest submission
        $consultations = $query->latest()->paginate(10)->withQueryString();

        // Statistics
        $stats = [
            'total' => HealthConsultation::count(),
            'pending' => HealthConsultation::where('status', 'pending')->count(),
            'contacted' => HealthConsultation::where('status', 'contacted')->count(),
            'completed' => HealthConsultation::where('status', 'completed')->count(),
        ];

        return view('admin.dashboard', compact('consultations', 'stats'));
    }

    /**
     * Update the specified consultation.
     */
    public function update(Request $request, HealthConsultation $consultation): RedirectResponse
    {
        if ($consultation->status === 'completed') {
            return redirect()->back()->withErrors([
                'status' => 'Yêu cầu tư vấn này đã hoàn tất xử lý và được khóa, không thể cập nhật nữa.',
            ]);
        }

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,contacted,completed'],
            'admin_notes' => ['nullable', 'string', 'max:5000'],
        ], [
            'status.in' => 'Trạng thái đã chọn không hợp lệ.',
            'admin_notes.max' => 'Ghi chú không được vượt quá 5000 ký tự.',
        ]);

        // Guard against contacted -> pending transition
        if ($consultation->status === 'contacted' && $validated['status'] === 'pending') {
            return redirect()->back()->withErrors([
                'status' => 'Không thể chuyển trạng thái từ Đang xử lý về Đang chờ xử lý.',
            ]);
        }

        $consultation->update($validated);

        return redirect()->back()->with('success', 'Cập nhật trạng thái và ghi chú tư vấn thành công.');
    }

    /**
     * Remove the specified consultation.
     */
    public function destroy(HealthConsultation $consultation): RedirectResponse
    {
        $consultation->delete();

        return redirect()->back()->with('success', 'Xóa yêu cầu tư vấn thành công.');
    }

    /**
     * Check for new consultations (AJAX Polling).
     */
    public function checkUpdates(Request $request): \Illuminate\Http\JsonResponse
    {
        $latest = HealthConsultation::latest()->first();

        return response()->json([
            'latest_id' => $latest ? $latest->id : 0,
            'latest_name' => $latest ? $latest->name : '',
            'total_pending' => HealthConsultation::where('status', 'pending')->count(),
        ]);
    }
}
