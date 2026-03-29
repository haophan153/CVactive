<?php $__env->startSection('title', 'Quản lý Templates'); ?>
<?php $__env->startSection('page-title', 'Templates CV'); ?>

<?php $__env->startSection('content'); ?>

<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500"><?php echo e($templates->total()); ?> templates</p>
    <a href="<?php echo e(route('admin.templates.create')); ?>"
        class="flex items-center space-x-2 px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        <span>Thêm template</span>
    </a>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
    <?php $__empty_1 = true; $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden group">
        
        <div class="aspect-[3/4] bg-gray-100 relative overflow-hidden">
            <?php if($template->thumbnail): ?>
                <img src="<?php echo e($template->thumbnail); ?>" alt="<?php echo e($template->name); ?>" class="w-full h-full object-cover">
            <?php else: ?>
                <div class="w-full h-full flex items-center justify-center text-gray-300">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            <?php endif; ?>

            
            <div class="absolute top-2 left-2 flex flex-col gap-1">
                <?php if($template->is_premium): ?>
                <span class="bg-amber-400 text-white text-xs font-bold px-2 py-0.5 rounded-full">PRO</span>
                <?php endif; ?>
                <?php if(!$template->is_active): ?>
                <span class="bg-gray-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">Ẩn</span>
                <?php endif; ?>
            </div>

            
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center space-x-2">
                <a href="<?php echo e(route('admin.templates.edit', $template)); ?>"
                    class="px-3 py-1.5 bg-white text-gray-800 text-xs font-semibold rounded-lg hover:bg-gray-100 transition">Sửa</a>
                <form action="<?php echo e(route('admin.templates.destroy', $template)); ?>" method="POST"
                    onsubmit="return confirm('Xóa template <?php echo e(addslashes($template->name)); ?>?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="px-3 py-1.5 bg-red-500 text-white text-xs font-semibold rounded-lg hover:bg-red-600 transition">Xóa</button>
                </form>
            </div>
        </div>

        <div class="p-3">
            <p class="font-semibold text-sm text-gray-800 truncate"><?php echo e($template->name); ?></p>
            <p class="text-xs text-gray-400 truncate"><?php echo e($template->category?->name ?? 'Chưa phân loại'); ?></p>
            <p class="text-xs text-gray-400 mt-1"><?php echo e(number_format($template->usage_count)); ?> lượt dùng</p>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-span-full py-12 text-center text-gray-400">Chưa có template nào.</div>
    <?php endif; ?>
</div>

<?php if($templates->hasPages()): ?>
<div class="mt-5"><?php echo e($templates->links()); ?></div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\CLone Git\CVactive_ST5\resources\views/admin/templates/index.blade.php ENDPATH**/ ?>