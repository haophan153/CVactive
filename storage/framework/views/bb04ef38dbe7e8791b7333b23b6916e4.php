<?php $__env->startSection('title', 'Quản lý người dùng'); ?>
<?php $__env->startSection('page-title', 'Người dùng'); ?>

<?php $__env->startSection('content'); ?>


<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-5">
    <form method="GET" class="flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-48">
            <label class="block text-xs font-medium text-gray-600 mb-1">Tìm kiếm</label>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Tên hoặc email..."
                class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Vai trò</label>
            <select name="role" class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Tất cả</option>
                <option value="user" <?php echo e(request('role') === 'user' ? 'selected' : ''); ?>>User</option>
                <option value="hr" <?php echo e(request('role') === 'hr' ? 'selected' : ''); ?>>HR</option>
                <option value="admin" <?php echo e(request('role') === 'admin' ? 'selected' : ''); ?>>Admin</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Gói dịch vụ</label>
            <select name="plan" class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Tất cả</option>
                <option value="none" <?php echo e(request('plan') === 'none' ? 'selected' : ''); ?>>Chưa có gói</option>
                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($plan->id); ?>" <?php echo e(request('plan') == $plan->id ? 'selected' : ''); ?>><?php echo e($plan->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Lọc</button>
        <?php if(request()->hasAny(['search', 'role', 'plan'])): ?>
        <a href="<?php echo e(route('admin.users.index')); ?>" class="px-4 py-2 bg-gray-100 text-gray-600 text-sm font-medium rounded-lg hover:bg-gray-200 transition">Reset</a>
        <?php endif; ?>
    </form>
</div>


<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
        <h3 class="font-semibold text-gray-900"><?php echo e(number_format($users->total())); ?> người dùng</h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Người dùng</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Gói</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Vai trò</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Đăng ký</th>
                    <th class="text-right px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0 overflow-hidden
                                <?php echo e($user->role === 'admin' ? 'bg-red-500' : 'bg-indigo-500'); ?>">
                                <?php if($user->avatar && !str_starts_with($user->avatar, 'http')): ?>
                                    <img src="<?php echo e(asset('storage/'.$user->avatar)); ?>" class="w-full h-full object-cover">
                                <?php elseif($user->avatar): ?>
                                    <img src="<?php echo e($user->avatar); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                <?php endif; ?>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900"><?php echo e($user->name); ?></p>
                                <p class="text-xs text-gray-400"><?php echo e($user->email); ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <?php if($user->plan): ?>
                        <span class="px-2.5 py-1 text-xs font-medium rounded-full <?php echo e($user->plan->slug === 'free' ? 'bg-gray-100 text-gray-600' : ($user->plan->slug === 'pro' ? 'bg-indigo-100 text-indigo-700' : 'bg-amber-100 text-amber-700')); ?>">
                            <?php echo e($user->plan->name); ?>

                        </span>
                        <?php else: ?>
                        <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-400">Không có</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3">
                        <?php switch($user->role):
                            case ('admin'): ?>
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Admin</span>
                                <?php break; ?>
                            <?php case ('hr'): ?>
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-700">HR</span>
                                <?php break; ?>
                            <?php default: ?>
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">User</span>
                        <?php endswitch; ?>
                    </td>
                    <td class="px-4 py-3 text-gray-500 text-xs"><?php echo e($user->created_at->format('d/m/Y')); ?></td>
                    <td class="px-5 py-3 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="<?php echo e(route('admin.users.show', $user)); ?>"
                                class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded transition" title="Xem">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <a href="<?php echo e(route('admin.users.edit', $user)); ?>"
                                class="p-1.5 text-indigo-400 hover:text-indigo-600 hover:bg-indigo-50 rounded transition" title="Sửa">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <?php if($user->id !== auth()->id()): ?>
                            <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST"
                                onsubmit="return confirm('Xóa người dùng <?php echo e(addslashes($user->name)); ?>?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 hover:bg-red-50 rounded transition" title="Xóa">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="px-5 py-10 text-center text-gray-400">Không tìm thấy người dùng nào.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($users->hasPages()): ?>
    <div class="px-5 py-4 border-t border-gray-100">
        <?php echo e($users->links()); ?>

    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\CLone Git\CVactive_ST5\resources\views/admin/users/index.blade.php ENDPATH**/ ?>