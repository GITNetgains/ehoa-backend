<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAdminController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create-user',[UserAdminController::class,'createUser']);
Route::post('/login',[UserAdminController::class,'logIn']);
Route::get('/logout',[UserAdminController::class,'logOut']);
Route::post('/existing-user-social-login',[UserAdminController::class,'existingUserSocialLogIn']);
Route::post('/new-user-social-login',[UserAdminController::class,'newUserSocialLogIn']);

Route::post('/delete-user',[UserAdminController::class,'deleteUser']);




Route::post('/user-term-conditions',[UserAdminController::class,'userTermConditions']);
Route::post('/save-countries',[UserAdminController::class,'saveCountries']);
Route::get('/show-countries',[UserAdminController::class,'showCountries']);
Route::post('/save-name',[UserAdminController::class,'saveName']);
Route::post('/save-dob',[UserAdminController::class,'saveDob']);
Route::post('/save-gender',[UserAdminController::class,'saveGender']);
Route::post('/save-profile-image',[UserAdminController::class,'saveProfileImage']);

// newly created route
Route::post('/save-details',[UserAdminController::class,'saveDetails']);
Route::post('/save-energy',[UserAdminController::class,'saveEnergy']);
Route::get('/get-energy',[UserAdminController::class,'getEnergy']);
Route::post('/show-is_pro',[UserAdminController::class,'showIs_pro']);
Route::post('/save-is_pro', [UserAdminController::class, 'saveIs_pro']);
Route::get('/get-tips/{energy_id}/{sub_energy_id}/{category_id}',[UserAdminController::class,'getTips']);
Route::get('/get-reminders/{scheduled}', [UserAdminController::class, 'getReminders']);
Route::get('/show-reminders/{user_id}', [UserAdminController::class, 'showReminders']);
Route::get('/save-reminders/{status}/{user_id}/{r_type}/{scheduled}/{fcm_token}', [UserAdminController::class, 'saveReminders']);
Route::get('/save-status/{status}/{user_id}/{r_type}', [UserAdminController::class, 'saveStatus']);
Route::post('/update-period_day', [UserAdminController::class, 'updatePeriod_day']);
Route::get('/get-cycles/{user_id}', [UserAdminController::class, 'getCycles']);



Route::post('/save-language',[UserAdminController::class,'saveLanguage']);
Route::get('/show-languages',[UserAdminController::class,'showlanguages']);
Route::post('/save-cycle-length',[UserAdminController::class,'saveCycleLength']);
Route::post('/save-cycle-days',[UserAdminController::class,'saveCycleDays']);
Route::post('/save-period-day',[UserAdminController::class,'savePeriodDay']);
Route::post('/save-focus',[UserAdminController::class,'saveFocus']);

Route::get('/show-categories',[UserAdminController::class,'showCategories']);
Route::get('/show-all-categories',[UserAdminController::class,'showAllCategories']);
Route::get('/show-sub-categories/{category_id}',[UserAdminController::class,'showSubCategories']);
Route::get('/show-tips-category/{tip_id}',[UserAdminController::class,'showTipsCategory']);
Route::get('/show-all-tips',[UserAdminController::class,'showAllTips']);
Route::get('/show-tips-energy/{energy_id}/{sub_energy_id}',[UserAdminController::class,'showTipsEnergy']);
Route::get('/show-tips/{tip_id}',[UserAdminController::class,'showTips']);
Route::get('/show-tips-subcategory/{tip_id}',[UserAdminController::class,'showTipsSubcategory']);
Route::get('/show-energy',[UserAdminController::class,'showEnergy']);
Route::get('/show-sub-energy',[UserAdminController::class,'showSubEnergy']);
Route::get('/show-settings',[UserAdminController::class,'showSettings']);
Route::get('/show-emotions',[UserAdminController::class,'showEmotions']);
Route::get('/show-disorders/{disorders_type}',[UserAdminController::class,'showDisorders']);
Route::get('/show-all-disorders',[UserAdminController::class,'showAllDisorders']);
Route::get('/show-rituals',[UserAdminController::class,'showRituals']);

Route::get('/show-groups',[UserAdminController::class,'showGroups']);
Route::get('/show-wisdom-blogs/{category_id}',[UserAdminController::class,'showWisdomBlogs']);
Route::get('/show-wisdom-podcasts/{category_id}',[UserAdminController::class,'showWisdomPodcasts']);
Route::get('/show-wisdom-videos/{category_id}',[UserAdminController::class,'showWisdomVideos']);

Route::post('/save-symptoms',[UserAdminController::class,'saveSymptoms']);

Route::get('/show-primary-emotions',[UserAdminController::class,'showPrimaryEmotions']);

Route::get('/show-current-cycle-emotion/{user_id}',[UserAdminController::class,'currentCycle']);



Route::post('/show-symptoms',[UserAdminController::class,'showSymptoms']);
Route::post('/show-symptoms-between-dates',[UserAdminController::class,'showSymptomsBetweenDates']);



Route::post('/push-notification',[UserAdminController::class,'pushNotification']);


Route::get('/show-podcast',[UserAdminController::class,'showPodcast']);
Route::get('/show-podcast-subcategory/{podcast_id}',[UserAdminController::class,'showPodcastSubcategory']);
Route::get('/show-video-subcategory/{video_id}',[UserAdminController::class,'showVideosSubcategory']);
Route::get('/show-wisdom-tips/{category_id}',[UserAdminController::class,'showWisdomTips']);
Route::get('/show-moon-phases',[UserAdminController::class,'showMoonPhases']);

Route::get('/show-cms',[UserAdminController::class,'showcms']);
Route::get('/show-about-us/{id}',[UserAdminController::class,'aboutUs']);
Route::get('/show-privacy-settings/{id}',[UserAdminController::class,'privacySettings']);



Route::get('/show-users/{user_id}',[UserAdminController::class,'showUsers']);
Route::post('/update-users',[UserAdminController::class,'updateUsers']);
Route::post('/update-users-profile',[UserAdminController::class,'updateUsersProfile']);


Route::post('/forget-password',[UserAdminController::class,'forgetPassword']);

Route::post('/change-password',[UserAdminController::class,'changePassword']);

Route::post('/verify-email',[UserAdminController::class,'verifyEmail']);



Route::get('/get-package/package_id',[UserAdminController::class,'getPackage']);
