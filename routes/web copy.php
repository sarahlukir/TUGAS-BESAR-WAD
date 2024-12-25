use App\Http\Controllers\CompanyController;

Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');