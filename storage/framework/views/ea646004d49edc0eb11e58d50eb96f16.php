

<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('page-title', 'Farmer Dashboard'); ?>
<?php $__env->startSection('page-subtitle', 'View-only access to farm information and learning resources'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <section class="rounded-2xl bg-gradient-to-r from-emerald-700 via-emerald-600 to-teal-600 p-6 md:p-8 text-white shadow-lg">
        <div>
            <h2 class="text-3xl md:text-4xl font-extrabold">Welcome <?php echo e(auth()->user()->name ?? 'Farmer'); ?></h2>
            <p class="text-emerald-50 mt-2 text-sm md:text-base">Here is your latest farm information and resource access overview.</p>
            <div class="mt-4 flex flex-wrap gap-2 text-xs md:text-sm">
                <span class="px-3 py-1 rounded-full bg-white/20 border border-white/30">Role: Farmer</span>
                <span class="px-3 py-1 rounded-full bg-white/20 border border-white/30">Location: <?php echo e(auth()->user()->barangay ?? 'Barangay not set'); ?></span>
                <span class="px-3 py-1 rounded-full bg-white/20 border border-white/30"><?php echo e(now()->format('F d, Y')); ?></span>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 md:p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-800">Dashboard Navigation</h3>
            <span class="text-xs font-semibold bg-gray-100 text-gray-700 px-3 py-1 rounded-full">View Only</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4">
            <a href="<?php echo e(route('farmer.announcements')); ?>" class="group rounded-xl border border-emerald-200 bg-emerald-50 p-4 hover:shadow-md transition">
                <div class="w-10 h-10 rounded-lg bg-emerald-600 text-white flex items-center justify-center mb-3">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h4 class="font-bold text-gray-900">View Announcements</h4>
                <p class="text-sm text-gray-600 mt-1">Latest agricultural news and notices.</p>
                <span class="inline-block text-xs font-semibold text-emerald-700 mt-3">Open section</span>
            </a>

            <a href="<?php echo e(route('farmer.guides')); ?>" class="group rounded-xl border border-blue-200 bg-blue-50 p-4 hover:shadow-md transition">
                <div class="w-10 h-10 rounded-lg bg-blue-600 text-white flex items-center justify-center mb-3">
                    <i class="fas fa-book-open"></i>
                </div>
                <h4 class="font-bold text-gray-900">View Crop Guides</h4>
                <p class="text-sm text-gray-600 mt-1">Planting and harvesting instruction library.</p>
                <span class="inline-block text-xs font-semibold text-blue-700 mt-3">Open section</span>
            </a>

            <a href="<?php echo e(route('farmer.weather')); ?>" class="group rounded-xl border border-cyan-200 bg-cyan-50 p-4 hover:shadow-md transition">
                <div class="w-10 h-10 rounded-lg bg-cyan-600 text-white flex items-center justify-center mb-3">
                    <i class="fas fa-cloud-sun-rain"></i>
                </div>
                <h4 class="font-bold text-gray-900">Check Weather Updates</h4>
                <p class="text-sm text-gray-600 mt-1">Current local forecast and advisories.</p>
                <span class="inline-block text-xs font-semibold text-cyan-700 mt-3">Open section</span>
            </a>

            <a href="<?php echo e(route('farmer.market-prices')); ?>" class="group rounded-xl border border-amber-200 bg-amber-50 p-4 hover:shadow-md transition">
                <div class="w-10 h-10 rounded-lg bg-amber-600 text-white flex items-center justify-center mb-3">
                    <i class="fas fa-coins"></i>
                </div>
                <h4 class="font-bold text-gray-900">View Market Prices</h4>
                <p class="text-sm text-gray-600 mt-1">Real-time commodity rate monitoring.</p>
                <span class="inline-block text-xs font-semibold text-amber-700 mt-3">Open section</span>
            </a>

            <a href="<?php echo e(route('farmer.information')); ?>" class="group rounded-xl border border-teal-200 bg-teal-50 p-4 hover:shadow-md transition">
                <div class="w-10 h-10 rounded-lg bg-teal-600 text-white flex items-center justify-center mb-3">
                    <i class="fas fa-folder-open"></i>
                </div>
                <h4 class="font-bold text-gray-900">My Farm Information</h4>
                <p class="text-sm text-gray-600 mt-1">View your complete farmer profile data.</p>
                <span class="inline-block text-xs font-semibold text-teal-700 mt-3">Open section</span>
            </a>

            <a href="<?php echo e(route('farmer.guides')); ?>" class="group rounded-xl border border-fuchsia-200 bg-fuchsia-50 p-4 hover:shadow-md transition">
                <div class="w-10 h-10 rounded-lg bg-fuchsia-600 text-white flex items-center justify-center mb-3">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h4 class="font-bold text-gray-900">Read Farming Tips</h4>
                <p class="text-sm text-gray-600 mt-1">Educational, blog-style practical advice.</p>
                <span class="inline-block text-xs font-semibold text-fuchsia-700 mt-3">Open section</span>
            </a>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <article class="bg-white rounded-xl border border-gray-200 p-5 lg:col-span-2">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Information Snapshot</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div class="rounded-lg bg-gray-50 border border-gray-200 p-4">
                    <p class="text-sm text-gray-500">Weather</p>
                    <p class="text-2xl font-extrabold text-gray-900">28&deg;C</p>
                    <p class="text-xs text-cyan-700">Partly cloudy</p>
                </div>
                <div class="rounded-lg bg-gray-50 border border-gray-200 p-4">
                    <p class="text-sm text-gray-500">New Notices</p>
                    <p class="text-2xl font-extrabold text-gray-900"><?php echo e($newNotices ?? 0); ?></p>
                    <p class="text-xs text-emerald-700">Check announcements</p>
                </div>
                <div class="rounded-lg bg-gray-50 border border-gray-200 p-4">
                    <p class="text-sm text-gray-500">Price Updates</p>
                    <p class="text-2xl font-extrabold text-gray-900"><?php echo e($latestPriceDate ? \Carbon\Carbon::parse($latestPriceDate)->format('M d') : 'N/A'); ?></p>
                    <p class="text-xs text-amber-700">Latest commodity rates</p>
                </div>
            </div>
        </article>

        <aside class="bg-slate-900 text-slate-100 rounded-xl p-5">
            <h3 class="text-lg font-bold">Access Policy</h3>
            <ul class="mt-4 space-y-2 text-sm text-slate-200">
                <li><i class="fas fa-check-circle text-emerald-400 mr-2"></i>View announcements</li>
                <li><i class="fas fa-check-circle text-emerald-400 mr-2"></i>Read guides and tips</li>
                <li><i class="fas fa-check-circle text-emerald-400 mr-2"></i>Monitor weather and prices</li>
                <li><i class="fas fa-ban text-red-400 mr-2"></i>No create, edit, or delete actions</li>
                <li><i class="fas fa-ban text-red-400 mr-2"></i>No posting content</li>
            </ul>
        </aside>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.farmer-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\jayso\Desktop\dev\web\Mannalon-App\resources\views/farmer/home.blade.php ENDPATH**/ ?>