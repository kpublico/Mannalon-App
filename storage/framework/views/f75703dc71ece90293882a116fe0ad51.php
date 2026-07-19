

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div style="display: flex; min-height: 100vh; background-color: #f8f9fa;">
    <!-- SIDEBAR -->
    <aside style="width: 260px; background-color: #1b5e20; color: white; position: fixed; left: 0; top: 0; bottom: 0; padding: 20px 0; box-shadow: 2px 0 10px rgba(0,0,0,0.1);">
        <div style="padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px;">
            <h2 style="margin: 0; font-size: 22px;">🌾 ManalonApp</h2>
            <p style="margin: 5px 0 0 0; font-size: 12px; color: #c8e6c9;">Farmer Management</p>
        </div>

        <nav style="padding: 0 10px;">
            <a href="#" style="display: flex; align-items: center; padding: 15px; color: white; text-decoration: none; border-radius: 8px; margin-bottom: 10px; background-color: rgba(255,255,255,0.1); transition: all 0.3s;">
                <span style="font-size: 20px; margin-right: 12px;">📊</span>
                <span>Dashboard</span>
            </a>
            <a href="#" style="display: flex; align-items: center; padding: 15px; color: #c8e6c9; text-decoration: none; border-radius: 8px; margin-bottom: 10px; transition: all 0.3s;">
                <span style="font-size: 20px; margin-right: 12px;">🌱</span>
                <span>My Crops</span>
            </a>
            <a href="#" style="display: flex; align-items: center; padding: 15px; color: #c8e6c9; text-decoration: none; border-radius: 8px; margin-bottom: 10px; transition: all 0.3s;">
                <span style="font-size: 20px; margin-right: 12px;">🐄</span>
                <span>Livestock</span>
            </a>
            <a href="#" style="display: flex; align-items: center; padding: 15px; color: #c8e6c9; text-decoration: none; border-radius: 8px; margin-bottom: 10px; transition: all 0.3s;">
                <span style="font-size: 20px; margin-right: 12px;">🌤️</span>
                <span>Weather</span>
            </a>
            <a href="#" style="display: flex; align-items: center; padding: 15px; color: #c8e6c9; text-decoration: none; border-radius: 8px; margin-bottom: 10px; transition: all 0.3s;">
                <span style="font-size: 20px; margin-right: 12px;">📈</span>
                <span>Market Prices</span>
            </a>
            <a href="#" style="display: flex; align-items: center; padding: 15px; color: #c8e6c9; text-decoration: none; border-radius: 8px; margin-bottom: 10px; transition: all 0.3s;">
                <span style="font-size: 20px; margin-right: 12px;">👤</span>
                <span>Profile</span>
            </a>
        </nav>

        <div style="position: absolute; bottom: 20px; left: 10px; right: 10px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
            <form method="POST" action="/logout" style="width: 100%;">
                <?php echo csrf_field(); ?>
                <button type="submit" style="width: 100%; padding: 12px; background-color: #c8e6c9; color: #1b5e20; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; transition: all 0.3s;">
                    🚪 Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div style="margin-left: 260px; flex: 1; display: flex; flex-direction: column;">
        <!-- HEADER -->
        <header style="background-color: white; padding: 15px 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; background-color: #f0f0f0; padding: 10px 15px; border-radius: 8px; max-width: 400px;">
                    <span style="font-size: 18px; margin-right: 10px;">🔍</span>
                    <input type="text" placeholder="Search crops, livestock..." style="flex: 1; border: none; background: transparent; outline: none; font-size: 14px;">
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 20px; margin-left: 30px;">
                <div style="text-align: right;">
                    <p style="margin: 0; font-weight: bold; color: #333;"><?php echo e(session('user.name') ?? 'Farmer Demo'); ?></p>
                    <p style="margin: 0; font-size: 12px; color: #666;"><?php echo e(session('user')->role ?? 'farmer'); ?></p>
                </div>
                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #1b5e20, #4caf50); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 16px;">
                    <?php echo e(substr(session('user.name') ?? 'F', 0, 1)); ?>

                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main style="flex: 1; padding: 30px;">
            <!-- SUMMARY CARDS -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 30px;">
                <!-- Card 1 -->
                <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #1b5e20;">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div>
                            <p style="margin: 0; color: #666; font-size: 13px; text-transform: uppercase;">Active Crops</p>
                            <h3 style="margin: 10px 0 0 0; font-size: 32px; color: #1b5e20; font-weight: bold;"><?php echo e($totalCrops); ?></h3>
                        </div>
                        <span style="font-size: 40px;">🌱</span>
                    </div>
                    <p style="margin: 15px 0 0 0; font-size: 12px; color: #999;"><?php echo e($harvestReady); ?> ready for harvest</p>
                </div>

                <!-- Card 2 -->
                <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #4caf50;">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div>
                            <p style="margin: 0; color: #666; font-size: 13px; text-transform: uppercase;">Total Livestock</p>
                            <h3 style="margin: 10px 0 0 0; font-size: 32px; color: #4caf50; font-weight: bold;"><?php echo e($activeLivestock); ?></h3>
                        </div>
                        <span style="font-size: 40px;">🐄</span>
                    </div>
                    <p style="margin: 15px 0 0 0; font-size: 12px; color: #999;">All healthy status</p>
                </div>

                <!-- Card 3 -->
                <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #81c784;">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div>
                            <p style="margin: 0; color: #666; font-size: 13px; text-transform: uppercase;">Farm Area</p>
                            <h3 style="margin: 10px 0 0 0; font-size: 32px; color: #81c784; font-weight: bold;"><?php echo e($farmArea); ?></h3>
                        </div>
                        <span style="font-size: 40px;">📍</span>
                    </div>
                    <p style="margin: 15px 0 0 0; font-size: 12px; color: #999;">Total cultivated acres</p>
                </div>
            </div>

            <!-- DATA TABLE -->
            <div style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h3 style="margin: 0; color: #333; font-size: 18px;">Recent Crops Activity</h3>
                    <button style="padding: 10px 20px; background-color: #81c784; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; transition: all 0.3s;">
                        + Add Crop
                    </button>
                </div>

                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid #f0f0f0; background-color: #fafafa;">
                            <th style="padding: 12px; text-align: left; color: #666; font-weight: 600; font-size: 13px;">Crop Name</th>
                            <th style="padding: 12px; text-align: left; color: #666; font-weight: 600; font-size: 13px;">Type</th>
                            <th style="padding: 12px; text-align: left; color: #666; font-weight: 600; font-size: 13px;">Area (acres)</th>
                            <th style="padding: 12px; text-align: left; color: #666; font-weight: 600; font-size: 13px;">Status</th>
                            <th style="padding: 12px; text-align: left; color: #666; font-weight: 600; font-size: 13px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $crops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="border-bottom: 1px solid #f0f0f0; transition: all 0.2s;">
                            <td style="padding: 15px; color: #333; font-weight: 500;">🌾 <?php echo e($crop->name); ?></td>
                            <td style="padding: 15px; color: #666;"><?php echo e($crop->type); ?></td>
                            <td style="padding: 15px; color: #666;"><?php echo e($crop->area); ?></td>
                            <td style="padding: 15px;">
                                <span style="display: inline-block; padding: 6px 12px; background-color: <?php echo e($crop->status_color); ?>; color: <?php echo e($crop->status_text_color); ?>; border-radius: 20px; font-size: 12px; font-weight: bold;"><?php echo e($crop->status); ?></span>
                            </td>
                            <td style="padding: 15px;">
                                <button style="padding: 6px 12px; background-color: #f0f0f0; border: none; border-radius: 4px; cursor: pointer; font-size: 12px; color: #1b5e20;">Edit</button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<style>
    * {
        box-sizing: border-box;
    }
    
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    a:hover {
        background-color: rgba(255, 255, 255, 0.15) !important;
    }

    button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    tr:hover {
        background-color: #fafafa;
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\dashboard\dashboard.blade.php ENDPATH**/ ?>