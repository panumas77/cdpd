<?PHP


use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function(){


    Route::group(['prefix' => 'register'], function () {

        Route::get("", [AuthController::class, "register"])->name("register");
    
        Route::post("", [AuthController::class, "store"]);
    });
    
    
    
    Route::group(['prefix' => 'login'], function () {
    
        Route::get("", [AuthController::class, "login"])->name("login");
    
        Route::post("", [AuthController::class, "authenticate"]);
    });
    
    
});

Route::get("/logout", [AuthController::class, "logout"])->name('logout');
