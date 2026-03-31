

<?php $__env->startSection('title', 'About MannalonApp'); ?>
<?php $__env->startSection('page-title', 'About MannalonApp'); ?>
<?php $__env->startSection('page-subtitle', 'Learn more about our platform and mission'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 rounded-xl p-8 text-white">
        <div class="text-center">
            <div class="text-6xl mb-4">🌾</div>
            <h2 class="text-4xl font-bold mb-4">MannalonApp</h2>
            <p class="text-xl text-emerald-100 max-w-3xl mx-auto">
                Empowering farmers in Cagayan Province with modern tools for smarter farming and better livelihoods
            </p>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-md p-8">
            <div class="text-4xl mb-4">🎯</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h3>
            <p class="text-gray-600 leading-relaxed">
                To provide farmers with accessible technology that enables informed decision-making, 
                increases productivity, and improves quality of life through data-driven farming solutions.
            </p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-8">
            <div class="text-4xl mb-4">👁️</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Vision</h3>
            <p class="text-gray-600 leading-relaxed">
                A future where every farmer in Cagayan Province has the knowledge and resources 
                to achieve sustainable farming success and food security for their communities.
            </p>
        </div>
    </div>

    <!-- Features -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">What We Offer</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center p-6 bg-emerald-50 rounded-xl">
                <i class="fas fa-cloud-sun text-4xl text-emerald-600 mb-3"></i>
                <h4 class="font-bold text-gray-800 mb-2">Weather Monitoring</h4>
                <p class="text-sm text-gray-600">Real-time weather updates and 7-day forecasts tailored for agricultural planning</p>
            </div>
            <div class="text-center p-6 bg-blue-50 rounded-xl">
                <i class="fas fa-chart-line text-4xl text-blue-600 mb-3"></i>
                <h4 class="font-bold text-gray-800 mb-2">Market Prices</h4>
                <p class="text-sm text-gray-600">Daily updates on crop prices to help you sell at the right time</p>
            </div>
            <div class="text-center p-6 bg-amber-50 rounded-xl">
                <i class="fas fa-book text-4xl text-amber-600 mb-3"></i>
                <h4 class="font-bold text-gray-800 mb-2">Farming Guides</h4>
                <p class="text-sm text-gray-600">Educational resources and best practices for all types of crops</p>
            </div>
            <div class="text-center p-6 bg-purple-50 rounded-xl">
                <i class="fas fa-bullhorn text-4xl text-purple-600 mb-3"></i>
                <h4 class="font-bold text-gray-800 mb-2">Announcements</h4>
                <p class="text-sm text-gray-600">Stay informed about government programs, subsidies, and training</p>
            </div>
            <div class="text-center p-6 bg-green-50 rounded-xl">
                <i class="fas fa-users text-4xl text-green-600 mb-3"></i>
                <h4 class="font-bold text-gray-800 mb-2">Community Support</h4>
                <p class="text-sm text-gray-600">Connect with fellow farmers and agricultural experts</p>
            </div>
            <div class="text-center p-6 bg-teal-50 rounded-xl">
                <i class="fas fa-mobile-alt text-4xl text-teal-600 mb-3"></i>
                <h4 class="font-bold text-gray-800 mb-2">Easy Access</h4>
                <p class="text-sm text-gray-600">User-friendly platform accessible from any device</p>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Our Impact</h3>
        <div class="text-center py-6">
            <p class="text-gray-500">No impact data available.</p>
        </div>
    </div>

    <!-- Contact -->
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 rounded-xl p-8 text-white">
        <h3 class="text-2xl font-bold mb-4 text-center">Need Help?</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="text-center">
                <i class="fas fa-envelope text-3xl mb-3"></i>
                <h4 class="font-semibold mb-2">Email Us</h4>
                <p class="text-sm text-emerald-100">support@mannalonapp.gov.ph</p>
            </div>
            <div class="text-center">
                <i class="fas fa-phone text-3xl mb-3"></i>
                <h4 class="font-semibold mb-2">Call Us</h4>
                <p class="text-sm text-emerald-100">(078) 844-1234</p>
            </div>
            <div class="text-center">
                <i class="fas fa-map-marker-alt text-3xl mb-3"></i>
                <h4 class="font-semibold mb-2">Visit Us</h4>
                <p class="text-sm text-emerald-100">Provincial Agriculture Office, Tuguegarao City</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.farmer-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\jayso\Desktop\dev\web\Mannalon-App\resources\views/farmer/about.blade.php ENDPATH**/ ?>