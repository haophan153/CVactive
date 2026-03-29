<?php $__env->startSection('title', 'Tổng quan'); ?>
<?php $__env->startSection('page-title', 'Tổng quan hệ thống'); ?>

<?php $__env->startSection('content'); ?>


<div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
    <?php
    $cards = [
        ['label' => 'Tổng người dùng',  'value' => number_format($stats['users']),     'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'indigo',  'sub' => '+' . $stats['new_users'] . ' hôm nay'],
        ['label' => 'CV đã tạo',        'value' => number_format($stats['cvs']),       'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'blue',    'sub' => '+' . $stats['new_cvs'] . ' hôm nay'],
        ['label' => 'Templates',        'value' => number_format($stats['templates']), 'icon' => 'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z', 'color' => 'purple', 'sub' => 'đang hoạt động'],
        ['label' => 'Doanh thu',        'value' => number_format($stats['revenue'], 0, ',', '.') . '₫', 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z', 'color' => 'green',  'sub' => 'tổng thanh toán'],
    ];
    $colorMap = ['indigo' => 'bg-indigo-500', 'blue' => 'bg-blue-500', 'purple' => 'bg-purple-500', 'green' => 'bg-green-500'];
    $bgMap    = ['indigo' => 'bg-indigo-50', 'blue' => 'bg-blue-50', 'purple' => 'bg-purple-50', 'green' => 'bg-green-50'];
    $textMap  = ['indigo' => 'text-indigo-600', 'blue' => 'text-blue-600', 'purple' => 'text-purple-600', 'green' => 'text-green-600'];
    ?>

    <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm text-gray-500"><?php echo e($card['label']); ?></span>
            <div class="w-9 h-9 <?php echo e($bgMap[$card['color']]); ?> rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 <?php echo e($textMap[$card['color']]); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="<?php echo e($card['icon']); ?>"/>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-extrabold text-gray-900"><?php echo e($card['value']); ?></div>
        <p class="text-xs text-gray-400 mt-1"><?php echo e($card['sub']); ?></p>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="grid lg:grid-cols-3 gap-5 mb-6">

    
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-gray-900">CV tạo theo ngày (7 ngày gần nhất)</h3>
        </div>
        <div class="flex items-end space-x-2 h-32">
            <?php $__currentLoopData = $cvsByDay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $maxVal = $cvsByDay->max('count') ?: 1; $height = max(8, ($day->count / $maxVal) * 100); ?>
            <div class="flex-1 flex flex-col items-center space-y-1">
                <span class="text-xs text-gray-500 font-medium"><?php echo e($day->count); ?></span>
                <div class="w-full rounded-t-md bg-indigo-500 transition-all hover:bg-indigo-600"
                    style="height: <?php echo e($height); ?>%"></div>
                <span class="text-xs text-gray-400"><?php echo e(\Carbon\Carbon::parse($day->date)->format('d/m')); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
        <h3 class="font-semibold text-gray-900 mb-4">Phân bổ gói dịch vụ</h3>
        <div class="space-y-3">
            <?php $__currentLoopData = $planStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $pct = $stats['users'] > 0 ? round($stat->count / $stats['users'] * 100) : 0; ?>
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-gray-700 font-medium"><?php echo e($stat->name ?? 'Chưa có gói'); ?></span>
                    <span class="text-gray-500"><?php echo e($stat->count); ?> (<?php echo e($pct); ?>%)</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="h-2 rounded-full bg-indigo-500" style="width: <?php echo e($pct); ?>%"></div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>


<div class="grid lg:grid-cols-2 gap-5">

    
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-900">Người dùng mới nhất</h3>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="text-xs text-indigo-600 hover:underline">Xem tất cả →</a>
        </div>
        <div class="divide-y divide-gray-50">
            <?php $__empty_1 = true; $__currentLoopData = $recentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="flex items-center space-x-3 px-5 py-3">
                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xs font-bold flex-shrink-0">
                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate"><?php echo e($user->name); ?></p>
                    <p class="text-xs text-gray-400 truncate"><?php echo e($user->email); ?></p>
                </div>
                <div class="text-right flex-shrink-0">
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium <?php echo e($user->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600'); ?>">
                        <?php echo e($user->role); ?>

                    </span>
                    <p class="text-xs text-gray-400 mt-0.5"><?php echo e($user->created_at->diffForHumans()); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="px-5 py-4 text-sm text-gray-400">Chưa có người dùng.</p>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-900">Thanh toán gần đây</h3>
            <a href="<?php echo e(route('admin.payments.index')); ?>" class="text-xs text-indigo-600 hover:underline">Xem tất cả →</a>
        </div>
        <div class="divide-y divide-gray-50">
            <?php $__empty_1 = true; $__currentLoopData = $recentPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
            $statusColor = match($payment->status) {
                'completed' => 'bg-green-100 text-green-700',
                'pending'   => 'bg-yellow-100 text-yellow-700',
                'failed'    => 'bg-red-100 text-red-700',
                default     => 'bg-gray-100 text-gray-600',
            };
            $statusLabel = match($payment->status) {
                'completed' => 'Thành công',
                'pending'   => 'Chờ xử lý',
                'failed'    => 'Thất bại',
                'refunded'  => 'Hoàn tiền',
                default     => $payment->status,
            };
            ?>
            <div class="flex items-center space-x-3 px-5 py-3">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate"><?php echo e($payment->user->name); ?></p>
                    <p class="text-xs text-gray-400"><?php echo e($payment->plan->name); ?> – <?php echo e($payment->payment_method); ?></p>
                </div>
                <div class="text-right flex-shrink-0">
                    <p class="text-sm font-semibold text-gray-900"><?php echo e(number_format($payment->amount, 0, ',', '.')); ?>₫</p>
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium <?php echo e($statusColor); ?>"><?php echo e($statusLabel); ?></span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="px-5 py-4 text-sm text-gray-400">Chưa có thanh toán.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\CLone Git\CVactive_ST5\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>