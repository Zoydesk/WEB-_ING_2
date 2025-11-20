<?php
use App\Http\Controllers\ReservationRatingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
  AuthController,
  CatalogController,
  ReservationController,
  PaymentController,
  ProfileController,
  AdminController,
  VehicleRatingController,
  WorkerController
};

Route::get('/', [CatalogController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/vehicles', [CatalogController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/{vehicle}', [CatalogController::class, 'show'])->name('vehicles.show');

Route::middleware('auth')->group(function () {

  // RESERVAS
  Route::get('/reservation/{vehicle}', [ReservationController::class, 'create'])->name('reservations.create');
  Route::post('/reservation', [ReservationController::class, 'store'])->name('reservations.store');
  Route::get('/reservations', [ReservationController::class, 'my'])->name('reservations.my');

  // PAGOS (solo una vez)
  Route::get('/payments/{reservation}/checkout', [PaymentController::class, 'checkout'])->name('payments.checkout');
  Route::post('/payments/{reservation}/process', [PaymentController::class, 'process'])->name('payments.process');

  // PERFIL
  Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
  Route::post('/profile/payment-method', [ProfileController::class, 'storePaymentMethod'])->name('profile.payment.store');
  Route::middleware('auth')->post(
    '/reservations/{reservation}/rating',
    [ReservationRatingController::class, 'store']
  )->name('reservations.rate');
});

Route::middleware(['auth', 'can:admin'])->group(function () {
  Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
  Route::get('/admin/vehicles', [AdminController::class, 'index'])->name('admin.vehicles.index');
  Route::get('/admin/vehicles/create', [AdminController::class, 'create'])->name('admin.vehicles.create');
  Route::post('/admin/vehicles', [AdminController::class, 'store'])->name('admin.vehicles.store');
  Route::get('/admin/vehicles/{vehicle}/edit', [AdminController::class, 'edit'])->name('admin.vehicles.edit');
  Route::post('/admin/vehicles/{vehicle}', [AdminController::class, 'update'])->name('admin.vehicles.update');
  Route::delete('/admin/vehicles/{vehicle}', [AdminController::class, 'destroy'])->name('admin.vehicles.destroy');
});

Route::middleware(['auth', 'can:worker'])->group(function () {
  Route::get('/worker', [WorkerController::class, 'dashboard'])->name('worker.dashboard');
  Route::get('/worker/deliver/{reservation}', [WorkerController::class, 'deliver'])->name('worker.deliver');
  Route::post('/worker/deliver/{reservation}', [WorkerController::class, 'confirmDeliver']);
  Route::get('/worker/receive/{reservation}', [WorkerController::class, 'receive'])->name('worker.receive');
  Route::post('/worker/receive/{reservation}', [WorkerController::class, 'confirmReceive']);


  Route::middleware('auth')->post(
    '/vehicles/{vehicle}/rate',
    [VehicleRatingController::class, 'store']
  )->name('vehicles.rate');
});
