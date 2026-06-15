<?php

use App\Models\HealthConsultation;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

test('public form is accessible and loads the title', function () {
    $response = $this->get(route('consultation.index'));

    $response->assertStatus(200)
             ->assertSee('Nhận Tư Vấn Sức Khỏe');
});

test('users can submit a consultation request successfully', function () {
    $data = [
        'name' => 'Nguyễn Văn Test',
        'gender' => 'nam',
        'age' => 30,
        'phone' => '0987654321',
        'reason' => 'Đau đầu, chóng mặt nhẹ',
        'medical_history' => 'Không có tiền sử dị ứng thuốc',
    ];

    $response = $this->post(route('consultation.store'), $data);

    $response->assertRedirect()
             ->assertSessionHas('success')
             ->assertSessionHas('zalo_link');

    $this->assertDatabaseHas('health_consultations', [
        'name' => 'Nguyễn Văn Test',
        'phone' => '0987654321',
        'status' => 'pending',
    ]);
});

test('submit fails validation when required parameters are missing', function () {
    $response = $this->post(route('consultation.store'), [
        'name' => '',
        'gender' => 'invalid_gender',
        'age' => -5,
        'phone' => '12345',
        'reason' => '',
    ]);

    $response->assertSessionHasErrors(['name', 'gender', 'age', 'phone', 'reason']);
    $this->assertDatabaseMissing('health_consultations', ['phone' => '12345']);
});

test('admin dashboard lists consultations', function () {
    $admin = \App\Models\User::factory()->create();

    $consultation = HealthConsultation::factory()->create([
        'name' => 'Bệnh Nhân A',
        'phone' => '0911223344',
    ]);

    $response = $this->actingAs($admin)
                     ->get(route('admin.consultations.index'));

    $response->assertStatus(200)
             ->assertSee('Bệnh Nhân A')
             ->assertSee('0911223344');
});

test('admin can update a consultation status and notes', function () {
    $admin = \App\Models\User::factory()->create();

    $consultation = HealthConsultation::factory()->create([
        'status' => 'pending',
        'admin_notes' => null,
    ]);

    $response = $this->actingAs($admin)
                     ->patch(route('admin.consultations.update', $consultation), [
                         'status' => 'completed',
                         'admin_notes' => 'Đã liên hệ tư vấn và kê đơn bổ sung.',
                     ]);

    $response->assertRedirect();
    
    $this->assertDatabaseHas('health_consultations', [
        'id' => $consultation->id,
        'status' => 'completed',
        'admin_notes' => 'Đã liên hệ tư vấn và kê đơn bổ sung.',
    ]);
});

test('guest is redirected to login when accessing admin dashboard', function () {
    $response = $this->get(route('admin.consultations.index'));

    $response->assertRedirect(route('login'));
});

test('login page is accessible to guest', function () {
    $response = $this->get(route('login'));

    $response->assertStatus(200)
             ->assertSee('Đăng nhập cổng quản trị');
});

test('admin can log in with valid credentials', function () {
    $admin = \App\Models\User::factory()->create([
        'email' => 'admin_test@gmail.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'admin_test@gmail.com',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('admin.consultations.index'));
    $this->assertAuthenticatedAs($admin);
});

test('admin cannot log in with invalid credentials', function () {
    \App\Models\User::factory()->create([
        'email' => 'admin_test@gmail.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'admin_test@gmail.com',
        'password' => 'wrong_password',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('admin can log out', function () {
    $admin = \App\Models\User::factory()->create();

    $response = $this->actingAs($admin)
                     ->post(route('logout'));

    $response->assertRedirect(route('consultation.index'));
    $this->assertGuest();
});

test('admin can delete a consultation', function () {
    $admin = \App\Models\User::factory()->create();
    $consultation = HealthConsultation::factory()->create();

    $response = $this->actingAs($admin)
                     ->delete(route('admin.consultations.destroy', $consultation));

    $response->assertRedirect();
    $this->assertDatabaseMissing('health_consultations', ['id' => $consultation->id]);
});

test('guest cannot delete a consultation', function () {
    $consultation = HealthConsultation::factory()->create();

    $response = $this->delete(route('admin.consultations.destroy', $consultation));

    $response->assertRedirect(route('login'));
    $this->assertDatabaseHas('health_consultations', ['id' => $consultation->id]);
});

test('admin cannot update a completed consultation', function () {
    $admin = \App\Models\User::factory()->create();
    $consultation = HealthConsultation::factory()->create([
        'status' => 'completed',
        'admin_notes' => 'Ghi chú cũ.',
    ]);

    $response = $this->actingAs($admin)
                     ->patch(route('admin.consultations.update', $consultation), [
                         'status' => 'pending',
                         'admin_notes' => 'Ghi chú mới.',
                     ]);

    $response->assertRedirect()
             ->assertSessionHasErrors('status');

    $this->assertDatabaseHas('health_consultations', [
        'id' => $consultation->id,
        'status' => 'completed',
        'admin_notes' => 'Ghi chú cũ.',
    ]);
});

test('admin cannot update a contacted consultation back to pending', function () {
    $admin = \App\Models\User::factory()->create();
    $consultation = HealthConsultation::factory()->create([
        'status' => 'contacted',
    ]);

    $response = $this->actingAs($admin)
                     ->patch(route('admin.consultations.update', $consultation), [
                         'status' => 'pending',
                     ]);

    $response->assertRedirect()
             ->assertSessionHasErrors('status');

    $this->assertDatabaseHas('health_consultations', [
        'id' => $consultation->id,
        'status' => 'contacted',
    ]);
});
