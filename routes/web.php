<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\PodcastController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\customerController;
use App\Http\Controllers\admin\yogaController;
use App\Http\Controllers\setting\SettingController;
use App\Http\Controllers\CoupensController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\admin\VideoController;
use App\Http\Controllers\blogs\NewBlogHandleController;
use App\Http\Controllers\moodDisordersController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\MoonPhaseController;
use App\Http\Controllers\countryController;
use App\Http\Controllers\languageController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/', function () {
//     return view('/auth/signin');
// });
Route::get('/user', function () {
    return view('user/user');
});
Route::get('/', function () {
    return view('coming');
});

Route::get('/secure', function () {
    return view('/auth/signin');
})->name('login');

Route::get('/signup', function () {
    return view('/auth/signup');
})->name('signup');



// reset password
Route::get('/reset-password/{token}', [UserAdminController::class, 'resetPassword'])->name('reset.password.get');
Route::post('/reset-password', [UserAdminController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::get('/email-verify-msg/{token}/{id}', [UserAdminController::class, 'verifiedUserEmail']);


// start blog here 
Route::get('/admin/delete-blog/{id}',[NewBlogHandleController::class,'deleteBlog'])->name('blog');
Route::get('/admin/delete-blog-slide/{id}',[NewBlogHandleController::class,'deleteBlogSlide'])->name('blog');
Route::get('/undo-blog/{id}',[NewBlogHandleController::class,'UndoBlog'])->name('blog');
Route::get('/delete-slide/{slide_id}',[NewBlogHandleController::class,'DeleteSlideBlog'])->name('blog');
Route::get('/admin/create-blog',[NewBlogHandleController::class,'getBlog'])->name('blog');
Route::get('/admin/edit-blog/{id}',[NewBlogHandleController::class,'EditBlog'])->name('blog');
Route::post('/admin/edit-blog',[NewBlogHandleController::class,'saveEditBlogNEW'])->name('blog');
Route::get('/admin/edit-blog-slide/{id}',[NewBlogHandleController::class,'EditBlogSlide'])->name('blog');
Route::post('/admin/edit-blog-slide',[NewBlogHandleController::class,'saveEditBlogSlide'])->name('blog');
// Route::get('/admin/edit-blog/',[NewBlogHandleController::class,'saveEditBlog'])->name('blog');
Route::get('/admin/get-list-blog',[NewBlogHandleController::class,'getBlogList'])->name('blog');
Route::post('/admin/create-blog',[NewBlogHandleController::class,'saveBlog'])->name('blog');
Route::post('/admin/get-blogs-sub-categories',[NewBlogHandleController::class,'getBlogsSubCategory'])->name('blog');
Route::get('/admin/archived-blog',[NewBlogHandleController::class,'ArchivedBlog'])->name('blog');

// end blog here 


//here admin routes
// signin signup routes

Route::post('/user-signin',[SigninController::class,'signin']);
Route::post('/user-signup',[SigninController::class,'signup']);
Route::get('/signout',[SigninController::class,'logout']);


//

// Route::get('/forget-password', [SigninController::class, 'showForgetPasswordForm'])->name('forget.password.get');
// Route::post('/forget-password', [SigninController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
// Route::get('/reset-password/{token}', [SigninController::class, 'showResetPasswordForm'])->name('reset.password.get');
// Route::post('/reset-password', [SigninController::class, 'submitResetPasswordForm'])->name('reset.password.post');

///dashboard route
Route::get('/admin/dashboard',[AdminController::class,'adminDashboard']);
Route::get('/admin/package',[PackageController::class,'Package'])->name('package');
Route::get('/admin/package-details/{id}',[PackageController::class,'PackageDetails'])->name('package');
Route::post('/save-package',[PackageController::class,'savePackage'])->name('package');
Route::get('/admin/list-all-packages',[PackageController::class,'listPackage'])->name('package');
Route::get('/admin/delete-package/{package_id}',[PackageController::class,'deletePackage'])->name('package');
Route::get('/admin/edit-package/{package_id}',[PackageController::class,'editPackage'])->name('package');
Route::post('/update-package',[PackageController::class,'updatePackage'])->name('package');
Route::get('/admin/archived-package',[PackageController::class,'Archivedpackage'])->name('package');
Route::get('/package-undo/{package_id}',[PackageController::class,'undoPackage'])->name('package');

//here package setting routes
Route::get('/admin/tips-create',[PackageController::class,'settingPackage'])->name('tip');
Route::post('/admin/save-tips',[PackageController::class,'saveTips'])->name('tip');
Route::get('/admin/list-all-tips',[PackageController::class,'listTip'])->name('tip');
Route::get('/admin/delete-tips/{tip_id}',[PackageController::class,'deleteTip'])->name('tip');
Route::get('/admin/edit-tips/{tip_id}',[PackageController::class,'editTip'])->name('tip');
Route::post('/tips-update',[PackageController::class,'tipsUpdate'])->name('tip');
Route::post('/admin/get-tips-sub-categories',[PackageController::class,'getTipsSubCategory'])->name('tip');
Route::post('/admin/search-tip-categories',[PackageController::class,'SearchCategory'])->name('tip');
Route::get('/admin/archived-tips',[PackageController::class,'archivedTip'])->name('tip');
Route::get('/undo-tips/{tip_id}',[PackageController::class,'undoTip'])->name('tip');

//here podcast routes
Route::get('/admin/podcast-create',[PodcastController::class,'podcastCreate'])->name('podcast');
Route::post('/save-podcasts',[PodcastController::class,'podcastSave'])->name('podcast');
Route::get('/admin/list-all-podcast',[PodcastController::class,'podcastList'])->name('podcast');
Route::get('/admin/delete-podcast/{podcast_id}',[PodcastController::class,'podcastDelete'])->name('podcast');
Route::get('/admin/edit-podcast/{podcast_id}',[PodcastController::class,'podcastEdit'])->name('podcast');
Route::post('/update-podcasts',[PodcastController::class,'subpodcastUpdate'])->name('podcast');
Route::post('/admin/get-podcast-sub-categories',[PodcastController::class,'getPodcastSubCategory'])->name('podcast');
Route::post('/admin/search-podcast-categories',[PodcastController::class,'searchpodcast'])->name('podcast');
Route::get('/admin/archived-podcast',[PodcastController::class,'podcastArchived'])->name('podcast');
Route::get('/undo-podcast/{podcast_id}',[PodcastController::class,'podcastUndo'])->name('podcast');

//here yoga routes
Route::get('/admin/yoga-create',[YogaController::class,'yogaCreate']);
Route::post('/save-yogas',[YogaController::class,'yogaSave']);
Route::get('/admin/list-all-yogas',[YogaController::class,'yogaList']);
Route::get('/admin/delete-yogas/{id}',[YogaController::class,'yogaDelete']);

// here blogs routes
// Route::get('/admin/blogs-create',[BlogsController::class,'blogsCreate']);
// Route::post('/save-blogs',[BlogsController::class,'blogsSave']);
// Route::get('/admin/edit-blog/{blog_id}',[BlogsController::class,'editBlog']);
// Route::get('/admin/delete-blog/{blog_id}',[BlogsController::class,'deleteBlog']);
// Route::get('/admin/list-all-blogs',[BlogsController::class,'blogsList']);
// Route::get('/admin/delete-sub_blogs/{s_b_id}',[BlogsController::class,'subblogsDelete']);
// Route::post('/get-blogs-sub-categories',[BlogsController::class,'getBlogsSubCategory']);

// blogs route
// Route::get('/admin/create-blogs',[BlogController::class,'createBlog']);

// here videos routes
Route::get('/undo-videos/{video_id}',[VideoController::class,'videosUndo'])->name('video');
Route::get('/admin/videos-create',[VideoController::class,'videosCreate'])->name('video');
Route::post('/admin/videos-save',[VideoController::class,'videosSave'])->name('video');
Route::get('/admin/list-all-videos',[VideoController::class,'videosList'])->name('video');
Route::get('/admin/delete-videos/{video_id}',[VideoController::class,'videosDelete'])->name('video');
Route::get('/admin/edit-videos/{video_id}',[VideoController::class,'videosEdit'])->name('video');
Route::post('/videos-update',[VideoController::class,'videosUpdate'])->name('video');
Route::post('/admin/video-sub-categories',[VideoController::class,'getVideoSubCategory'])->name('video');
Route::post('/admin/search-categories',[VideoController::class,'SearchVideo'])->name('video');
Route::get('/admin/archived-video',[VideoController::class,'videosAchived'])->name('video');

//here user route
Route::get('/admin/user-list',[customerController::class,'userList'])->name('user');
Route::get('/admin/all-users-list',[customerController::class,'userDetails'])->name('user');
Route::get('/admin/user-details/{user_id}',[customerController::class,'userallDetails'])->name('user');
Route::get('/admin/edit-users/{user_id}',[customerController::class,'editUsers'])->name('user');
Route::post('/update-users',[customerController::class,'updateUsers'])->name('user');
Route::get('/admin/delete-users/{user_id}',[customerController::class,'deleteUsers'])->name('user');
Route::get('/admin/archived-user',[customerController::class,'userAchived'])->name('user');
Route::get('/undo-users/{user_id}',[customerController::class,'undoUsers'])->name('user');
Route::get('/admin/admin-user',[customerController::class,'userAdmin'])->name('user');
Route::get('/admin/add-admin-user',[UserAdminController::class,'addAdmin'])->name('user');
Route::post('/admin/create-admin-user',[UserAdminController::class,'createAdmin'])->name('user');


//here route upload setting
Route::get('/setting/upload-setting',[SettingController::class,'UploadSetting'])->name('setting');
Route::post('/admin/save-upload-setting',[SettingController::class,'saveSetting'])->name('setting');
Route::get('/editior/editior-create',[SettingController::class,'editior'])->name('editior');
Route::post('/save-editior',[SettingController::class,'saveEditior'])->name('editior');
Route::get('/editior/list-editior',[SettingController::class,'ListEditior'])->name('editior');
Route::get('/editior/view-editior/{id}',[SettingController::class,'ViewEditior'])->name('editior');
Route::get('/editior/delete-editior/{id}',[SettingController::class,'DeleteEditior'])->name('editior');
Route::get('/editior/edit-editior/{id}',[SettingController::class,'EditEditior'])->name('editior');
Route::post('/update-editior',[SettingController::class,'UpdateEditior'])->name('editior');


//here route coupens
Route::get('/coupens/coupens-create',[CoupensController::class,'coupensCreate'])->name('coupon');
Route::post('/save-coupens',[CoupensController::class,'coupensSave'])->name('coupon');
Route::get('/coupens/list-all-coupons',[CoupensController::class,'coupensList'])->name('coupon');
Route::get('/coupens/delete-coupons/{coupons_id}',[CoupensController::class,'couponsDelete'])->name('coupon');
Route::get('/coupens/edit-coupons/{coupons_id}',[CoupensController::class,'couponsEdit'])->name('coupon');
Route::post('/update-coupons',[CoupensController::class,'coupensUpdate'])->name('coupon');
Route::get('/coupens/archived-coupons',[CoupensController::class,'coupensArichved'])->name('coupon');
Route::get('/undo-coupons/{coupons_id}',[CoupensController::class,'coupensUndo'])->name('coupon');


//here group route
Route::get('/groups/group-create',[UserGroupController::class,'groupsCreate'])->name('user');
Route::post('/save-groups',[UserGroupController::class,'groupsSave'])->name('user');
Route::get('/groups/list-all-groups',[UserGroupController::class,'groupsList'])->name('user');
Route::get('/groups/delete-group/{g_id}',[UserGroupController::class,'groupsDelete'])->name('user');
Route::get('/groups/edit-group/{g_id}',[UserGroupController::class,'groupsEdit'])->name('user');
Route::post('/groups/update-groups',[UserGroupController::class,'groupsUpdate'])->name('user');
Route::get('/groups/archived-groups',[UserGroupController::class,'Archivedgroups'])->name('user');
Route::get('/undo-group/{g_id}',[UserGroupController::class,'Undogroups'])->name('user');

//category route
Route::get('/admin/category-create',[CategoryController::class,'categoryCreate']);
Route::post('/save-category',[CategoryController::class,'categorySave']);
Route::get('/admin/list-all-category',[CategoryController::class,'categoryList']);


// category (navjot)
Route::get('admin/n-create-category',[CategoryController::class,'nCreateCategory'])->name('category');
Route::post('admin/n-save-category',[CategoryController::class,'nSaveCategory'])->name('category');
Route::get('admin/n-list-category',[CategoryController::class,'nListCategory'])->name('category');
Route::get('admin/n-edit-category/{c_id}',[CategoryController::class,'nEditCategory'])->name('category');
Route::post('admin/n-update-category',[CategoryController::class,'nUpdateCategory'])->name('category');
Route::get('admin/n-delete-category/{c_id}/{parent}',[CategoryController::class,'nDeleteCategory'])->name('category');
Route::get('admin/n-sub-category',[CategoryController::class,'nSubCategory'])->name('category');
Route::post('admin/n-sub-save-category',[CategoryController::class,'nSubSaveCategory'])->name('category');
Route::get('admin/n-sub-list-category',[CategoryController::class,'nSubListCategory'])->name('category');
Route::get('admin/n-edit-sub-category/{sub_cat_id}',[CategoryController::class,'nEditSubCategory'])->name('category');
Route::post('admin/n-update-sub-category',[CategoryController::class,'nUpdateSubCategory'])->name('category');
Route::get('admin/n-delete-sub-category/{sub_cat_id}',[CategoryController::class,'nDeleteSubCategory'])->name('category');
Route::get('admin/n-assign-to-category',[CategoryController::class,'nAssignToCategory'])->name('category');
Route::post('/admin/get-sub-categories',[CategoryController::class,'getSubCategory'])->name('category');
Route::get('/admin/show-all-list',[CategoryController::class,'showAllList'])->name('category');
Route::get('admin/archived-category',[CategoryController::class,'ArchivedCategory'])->name('category');
Route::get('/undo-category/{category_id}/{parent}',[CategoryController::class,'UndoCategory'])->name('category');


//disorders route 

Route::get('/disorder/disorders-create',[moodDisordersController::class,'CreateDisorder']);
Route::post('/save-disorders',[moodDisordersController::class,'SaveDisorder']);
Route::get('/disorder/list-all-disorders',[moodDisordersController::class,'ListDisorder']);
Route::get('/disorder/edit-disorder/{disorders_id}',[moodDisordersController::class,'EditDisorder']);
Route::post('/update-disorders',[moodDisordersController::class,'UpdateDisorder']);
Route::get('/disorder/delete-emotions/{disorders_id}',[moodDisordersController::class,'DeleteEmotions'])->name('emotions');
Route::get('/disorder/undo-emotions/{disorders_id}',[moodDisordersController::class,'undo'])->name('emotions');

Route::get('/disorder/delete-energy/{disorders_id}',[moodDisordersController::class,'DeleteEnergy'])->name('energy');
Route::get('/disorder/delete-symtoms/{disorders_id}',[moodDisordersController::class,'DeleteSymtoms'])->name('symptoms');
Route::get('/disorder/delete-menstrual/{disorders_id}',[moodDisordersController::class,'DeleteMenstrual'])->name('menstrual');
Route::get('/disorder/menstrual-create/{menstrual}',[moodDisordersController::class,'CreateMenstrual'])->name('menstrual');
Route::get('/disorder/symptoms-create/{symptoms}',[moodDisordersController::class,'CreateSymptoms'])->name('symptoms');
Route::get('/disorder/emotions-create/{emotions}',[moodDisordersController::class,'CreateEmotions'])->name('emotions');
Route::get('/disorder/energy-create/{energy}',[moodDisordersController::class,'CreateEnergy'])->name('energy');
Route::get('/disorder/list-menstrual',[moodDisordersController::class,'ListMenstrual'])->name('menstrual');
Route::get('/disorder/list-symtoms',[moodDisordersController::class,'ListSymtoms'])->name('symptoms');
Route::get('/disorder/list-emotions',[moodDisordersController::class,'ListEmotions'])->name('emotions');
Route::get('/disorder/list-energy',[moodDisordersController::class,'ListEnergy'])->name('energy');
Route::get('/disorder/archived',[moodDisordersController::class,'achived'])->name('emotions');
Route::get('/disorder/archived-energy',[moodDisordersController::class,'achivedEnergy'])->name('energy');
Route::get('/undo-energy/{disorders_id}',[moodDisordersController::class,'UndoEnergy'])->name('energy');
Route::get('/disorder/archived-symtoms',[moodDisordersController::class,'ArchivedSymtoms'])->name('symptoms');
Route::get('/undo-symtoms/{disorders_id}',[moodDisordersController::class,'UndoSymtoms'])->name('symptoms');
Route::get('/disorder/archived-menstrual',[moodDisordersController::class,'ArchivedMenstrual'])->name('menstrual');
Route::get('/undo-menstrual/{disorders_id}',[moodDisordersController::class,'UndoMenstrual'])->name('menstrual');


//route  moon phase
Route::get('/disorder/moonphase-create',[MoonPhaseController::class,'CreateMoonphase'])->name('moon');
Route::post('/save-moonphase',[MoonPhaseController::class,'SaveMoonPhase'])->name('moon');
Route::get('/disorder/list-all-moonphase',[MoonPhaseController::class,'ListMoonphase'])->name('moon');
Route::get('/disorder/delete-moonphase/{moon_phase_id}',[MoonPhaseController::class,'DeleteMoonphase'])->name('moon');
Route::get('/disorder/edit-moonphase/{moon_phase_id}',[MoonPhaseController::class,'EditMoonphase'])->name('moon');
Route::post('/update-moonphase',[MoonPhaseController::class,'UpdateMoonPhase'])->name('moon');
Route::get('/disorder/archived-moonphase',[MoonPhaseController::class,'ArchivedMoonphase'])->name('moon');
Route::get('/undo-moonphase/{moon_phase_id}',[MoonPhaseController::class,'UndoMoonphase'])->name('moon');


// push notification
Route::get('/notifications/push-notifications',[PushNotificationController::class,'pushNotification'])->name('notification');
Route::post('/save-push-notifications',[PushNotificationController::class,'savePushNotification'])->name('notification');
Route::get('/notifications/list-all-notifications',[PushNotificationController::class,'listAllNotification'])->name('notification');
Route::get('/notifications/edit-notifications/{push_notification_id}',[PushNotificationController::class,'editNotification'])->name('notification');
Route::post('/update-notifications',[PushNotificationController::class,'updateNotification'])->name('notification');
Route::get('/notifications/delete-notifications/{push_notification_id}',[PushNotificationController::class,'deleteNotification'])->name('notification');
Route::get('/resend_notification/{push_notification_id}',[PushNotificationController::class,'Resend'])->name('notification');
Route::get('/notification/archived-notifi',[PushNotificationController::class,'ArchivedNoti'])->name('notification');
Route::get('/undo-notification/{push_notification_id}',[PushNotificationController::class,'Noticationundo'])->name('notification');

//route country
Route::get('/country/country-create',[countryController::class,'createCountry'])->name('country');
Route::post('/save-country',[countryController::class,'SaveCountry'])->name('country');
Route::get('/country/country-list',[countryController::class,'ListCountry'])->name('country');
Route::get('/country/delete-country/{country_id}',[countryController::class,'DeleteCountry'])->name('country');
Route::get('/country/edit-country/{country_id}',[countryController::class,'EditCountry'])->name('country');
Route::post('/update-country',[countryController::class,'UpdateCountry'])->name('country');
//route language

Route::get('/language/language-create',[languageController::class,'createLanguage'])->name('language');
Route::post('/save-language',[languageController::class,'SaveLanguage'])->name('language');
Route::get('/language/language-list',[languageController::class,'Listlanguage'])->name('language');
Route::get('/language/delete-language/{language_id}',[languageController::class,'DeleteLanguage'])->name('language');
Route::get('/language/edit-language/{language_id}',[languageController::class,'EditLanguage'])->name('language');
Route::post('/update-language',[languageController::class,'UpdateLanguage']);
// route orders
Route::get('/order/orders',[OrdersController::class,'ordersShow'])->name('order');
Route::post('/order/searchorder',[OrdersController::class,'Search'])->name('order');
Route::get('/order/views-orders/{order_id}',[OrdersController::class,'ordersView'])->name('order');
Route::get('/order/edit-order/{order_id}',[OrdersController::class,'ordersEdit'])->name('order');
Route::post('/update-order',[OrdersController::class,'UpdateOrder'])->name('order');


