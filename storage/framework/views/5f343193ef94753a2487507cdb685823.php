<?php $__env->startSection('title', 'Quản lý Thanh toán'); ?>
<?php $__env->startSection('page-title', 'Thanh toán & Doanh thu'); ?>

<?php $__env->startSection('content'); ?>


<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <?php
    $rCards = [
        ['label'=>'Tổng doanh thu',       'value'=> number_format($revenueStats['total'], 0, ',', '.') . '₫',   'color'=>'green'],
        ['label'=>'Doanh thu tháng này',  'value'=> number_format($revenueStats['this_month'], 0, ',', '.') . '₫','color'=>'indigo'],
        ['label'=>'Hôm nay',              'value'=> number_format($revenueStats['today'], 0, ',', '.') . '₫',    'color'=>'blue'],
        ['label'=>'Giao dịch thành công', 'value'=> number_format($revenueStats['count']),                        'color'=>'purple'],
    ];
    $bgs = ['green'=>'bg-green-50','indigo'=>'bg-indigo-50','blue'=>'bg-blue-50','purple'=>'bg-purple-50'];
    $txts = ['green'=>'text-green-600','indigo'=>'text-indigo-600','blue'=>'text-blue-600','purple'=>'text-purple-600'];
    ?>
    <?php $__currentLoopData = $rCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
        <p class="text-xs text-gray-500 mb-1"><?php echo e($c['label']); ?></p>
        <p class="text-xl font-extrabold <?php echo e($txts[$c['color']]); ?>"><?php echo e($c['value']); ?></p>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 mb-6">
    <h3 class="font-semibold text-gray-900 mb-4">Doanh thu theo tháng (6 tháng gần nhất)</h3>
    <?php if($monthlyRevenue->isEmpty()): ?>
    <p class="text-sm text-gray-400 text-center py-8">Chưa có dữ liệu doanh thu.</p>
    <?php else: ?>
    <?php $maxRev = $monthlyRevenue->max('total') ?: 1; ?>
    <div class="flex items-end space-x-3 h-36">
        <?php $__currentLoopData = $monthlyRevenue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $h = max(8, ($month->total / $maxRev) * 100); ?>
        <div class="flex-1 flex flex-col items-center space-y-1">
            <span class="text-xs text-gray-500 font-medium"><?php echo e(number_format($month->total / 1000)); ?>K</span>
            <div class="w-full rounded-t-md bg-green-400 hover:bg-green-500 transition"
                style="height: <?php echo e($h); ?>%"></div>
            <span class="text-xs text-gray-400"><?php echo e(\Carbon\Carbon::createFromFormat('Y-m', $month->month)->format('m/Y')); ?></span>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</div>


<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-5">
    <form method="GET" class="flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-48">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Tìm tên / email người dùng..."
                class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <select name="status" class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">Tất cả trạng thái</option>
            <option value="pending"   <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Chờ xử lý</option>
            <option value="completed" <?php echo e(request('status') === 'completed' ? 'selected' : ''); ?>>Thành công</option>
            <option value="failed"    <?php echo e(request('status') === 'failed' ? 'selected' : ''); ?>>Thất bại</option>
            <option value="refunded"  <?php echo e(request('status') === 'refunded' ? 'selected' : ''); ?>>Hoàn tiền</option>
        </select>
        <select name="plan" class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">Tất cả gói</option>
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($plan->id); ?>" <?php echo e(request('plan') == $plan->id ? 'selected' : ''); ?>><?php echo e($plan->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Lọc</button>
        <?php if(request()->hasAny(['search','status','plan'])): ?>
        <a href="<?php echo e(route('admin.payments.index')); ?>" class="px-4 py-2 bg-gray-100 text-gray-600 text-sm rounded-lg hover:bg-gray-200 transition">Reset</a>
        <?php endif; ?>
    </form>
</div>


<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
        <h3 class="font-semibold text-gray-900"><?php echo e(number_format($payments->total())); ?> giao dịch</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Người dùng</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Gói</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Phương thức</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Số tiền</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Trạng thái</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Ngày</th>
                    <th class="text-right px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                $statusColor = match($payment->status) {
                    'completed' => 'bg-green-100 text-green-700',
                    'pending'   => 'bg-yellow-100 text-yellow-700',
                    'failed'    => 'bg-red-100 text-red-700',
                    'refunded'  => 'bg-gray-100 text-gray-600',
                    default     => 'bg-gray-100 text-gray-600',
                };
                $statusLabel = match($payment->status) {
                    'completed' => 'Thành công', 'pending' => 'Chờ xử lý',
                    'failed' => 'Thất bại', 'refunded' => 'Hoàn tiền', default => $payment->status,
                };
                ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-3">
                        <p class="font-medium text-gray-900"><?php echo e($payment->user->name); ?></p>
                        <p class="text-xs text-gray-400"><?php echo e($payment->user->email); ?></p>
                    </td>
                    <td class="px-4 py-3 text-gray-700 font-medium"><?php echo e($payment->plan->name); ?></td>
                    <td class="px-4 py-3 text-gray-500 text-xs"><?php echo e($payment->payment_method); ?></td>
                    <td class="px-4 py-3 font-semibold text-gray-900"><?php echo e(number_format($payment->amount, 0, ',', '.')); ?>₫</td>
                    <td class="px-4 py-3">
                        <span class="px-2.5 py-1 text-xs font-medium rounded-full <?php echo e($statusColor); ?>"><?php echo e($statusLabel); ?></span>
                    </td>
                    <td class="px-4 py-3 text-gray-400 text-xs"><?php echo e($payment->created_at->format('d/m/Y H:i')); ?></td>
                    <td class="px-5 py-3 text-right">
                        <form action="<?php echo e(route('admin.payments.status', $payment)); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <select name="status" onchange="this.form.submit()"
                                class="text-xs border border-gray-300 rounded-md px-2 py-1 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="pending"   <?php echo e($payment->status === 'pending' ? 'selected' : ''); ?>>Chờ xử lý</option>
                                <option value="completed" <?php echo e($payment->status === 'completed' ? 'selected' : ''); ?>>Thành công</option>
                                <option value="failed"    <?php echo e($payment->status === 'failed' ? 'selected' : ''); ?>>Thất bại</option>
                                <option value="refunded"  <?php echo e($payment->status === 'refunded' ? 'selected' : ''); ?>>Hoàn tiền</option>
                            </select>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" class="px-5 py-10 text-center text-gray-400">Chưa có giao dịch nào.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($payments->hasPages()): ?>
    <div class="px-5 py-4 border-t border-gray-100"><?php echo e($payments->links()); ?></div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\CLone Git\CVactive_ST5\resources\views/admin/payments/index.blade.php ENDPATH**/ ?>