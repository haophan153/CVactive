<?php $__env->startSection('title', 'Tìm CV: ' . $keyword . ' - ' . $jobPost->title . ' - CVactive'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        
        <div class="mb-6">
            <a href="<?php echo e(route('hr.job-posts.index')); ?>" class="text-indigo-600 hover:text-indigo-900 flex items-center gap-2 text-sm mb-4">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Quay lại danh sách tin tuyển dụng
            </a>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <h1 class="text-xl font-bold text-gray-900"><?php echo e($jobPost->title); ?></h1>
                            <span class="px-2 py-0.5 text-xs bg-indigo-100 text-indigo-700 rounded-full font-medium">Tìm CV</span>
                        </div>
                        <p class="text-gray-600 text-sm"><?php echo e($jobPost->company_name); ?></p>
                    </div>
                    <a href="<?php echo e(route('hr.job-posts.applications', $jobPost)); ?>"
                        class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1.5 transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                        Xem tất cả đơn ứng tuyển
                    </a>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
            <form method="GET" action="<?php echo e(route('hr.job-posts.search-cv', $jobPost)); ?>" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text"
                        name="q"
                        value="<?php echo e($keyword ?? ''); ?>"
                        placeholder="VD: PHP, Laravel, React, Designer..."
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                </div>
                <button type="submit"
                    class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition shadow-sm">
                    Tìm kiếm
                </button>
                <?php if($keyword): ?>
                <a href="<?php echo e(route('hr.job-posts.search-cv', $jobPost)); ?>"
                    class="px-4 py-2.5 border border-gray-300 text-gray-600 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
                    Xóa
                </a>
                <?php endif; ?>
            </form>
            <p class="text-xs text-gray-400 mt-2">Tìm trong kỹ năng, kinh nghiệm, mô tả của ứng viên đã ứng tuyển vào tin này.</p>
        </div>

        
        <div class="mb-4">
            <?php if($keyword): ?>
                <p class="text-sm text-gray-600">
                    Tìm thấy <strong><?php echo e($applications->total()); ?></strong> ứng viên phù hợp với <strong>"<?php echo e($keyword); ?>"</strong>
                </p>
            <?php else: ?>
                <p class="text-sm text-gray-600">
                    Tất cả ứng viên có đính kèm CV: <strong><?php echo e($applications->total()); ?></strong>
                </p>
            <?php endif; ?>
        </div>

        
        <?php if($applications->isEmpty()): ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-700 mb-1">Không tìm thấy ứng viên nào</h3>
                <p class="text-sm text-gray-500">
                    <?php if($keyword): ?>
                        Thử từ khóa khác hoặc xem <a href="<?php echo e(route('hr.job-posts.applications', $jobPost)); ?>" class="text-indigo-600 hover:underline">tất cả đơn ứng tuyển</a>.
                    <?php else: ?>
                        Chưa có ứng viên nào đính kèm CV trong tin này.
                    <?php endif; ?>
                </p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                <?php
                    function highlightMatch($items, $keyword) {
                        if (!$keyword) return $items;
                        return array_map(function ($item) use ($keyword) {
                            return preg_replace('/(' . preg_quote($keyword, '/') . ')/i', '<mark class="bg-yellow-200 text-yellow-900 rounded px-0.5">$1</mark>', $item);
                        }, $items);
                    }
                ?>
                <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $cv = $application->cv;
                    $personal = $cv->personal_info ?? [];
                    $fullName = $personal['full_name'] ?? $application->full_name ?? 'Không có tên';
                    $jobTitle = $personal['job_title'] ?? '';
                    $email    = $personal['email'] ?? $application->email ?? '';
                    $phone    = $personal['phone'] ?? $application->phone ?? '';
                    $avatar   = $personal['avatar'] ?? '';

                    $allSkills = [];
                    $experiences = [];
                    if ($cv) {
                        foreach ($cv->sections as $section) {
                            if ($section->type === 'skills' && $section->is_visible) {
                                foreach ($section->items as $item) {
                                    $name = $item->content['name'] ?? '';
                                    if ($name) $allSkills[] = $name;
                                }
                            }
                            if ($section->type === 'experience' && $section->is_visible) {
                                foreach ($section->items as $item) {
                                    $pos = $item->content['position'] ?? '';
                                    $com = $item->content['company'] ?? '';
                                    $exp = trim("$pos @ $com");
                                    if ($exp !== '@ ') $experiences[] = $exp;
                                }
                            }
                        }
                    }

                    $highlightedSkills = highlightMatch($allSkills, $keyword);
                ?>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition flex flex-col">
                    
                    <div class="flex items-start gap-3 mb-3">
                        <?php if($avatar): ?>
                            <img src="<?php echo e(str_starts_with($avatar, 'http') ? $avatar : asset('storage/'.$avatar)); ?>"
                                alt="<?php echo e($fullName); ?>"
                                class="w-11 h-11 rounded-full object-cover border border-gray-200 shrink-0">
                        <?php else: ?>
                            <div class="w-11 h-11 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-base shrink-0">
                                <?php echo e(strtoupper(substr($fullName, 0, 1))); ?>

                            </div>
                        <?php endif; ?>
                        <div class="min-w-0 flex-1">
                            <h3 class="font-semibold text-gray-900 text-sm truncate"><?php echo e($fullName); ?></h3>
                            <?php if($jobTitle): ?>
                            <p class="text-xs text-indigo-600 font-medium truncate"><?php echo e($jobTitle); ?></p>
                            <?php endif; ?>
                            <?php if(!$cv): ?>
                            <span class="inline-block mt-0.5 px-1.5 py-0.5 bg-gray-100 text-gray-500 text-[10px] rounded font-medium">File CV</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="flex flex-wrap gap-3 text-xs text-gray-500 mb-3">
                        <?php if($email): ?>
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <?php echo e($email); ?>

                        </span>
                        <?php endif; ?>
                        <?php if($phone): ?>
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <?php echo e($phone); ?>

                        </span>
                        <?php endif; ?>
                    </div>

                    
                    <?php if(count($allSkills) > 0): ?>
                    <div class="mb-3 flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Kỹ năng</p>
                        <div class="flex flex-wrap gap-1.5">
                            <?php $__currentLoopData = array_slice($allSkills, 0, 6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="px-2 py-0.5 bg-indigo-50 text-indigo-700 text-xs rounded font-medium"><?php echo $highlightedSkills[$i]; ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(count($allSkills) > 6): ?>
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-xs rounded">+<?php echo e(count($allSkills) - 6); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    
                    <?php if(count($experiences) > 0): ?>
                    <div class="mb-4">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Kinh nghiệm</p>
                        <?php $__currentLoopData = array_slice($experiences, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="text-xs text-gray-700 truncate">• <?php echo e($exp); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>

                    
                    <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                        <?php if($cv): ?>
                        <a href="<?php echo e(route('hr.applications.show', $application)); ?>"
                            class="flex-1 text-center px-3 py-1.5 bg-indigo-600 text-white text-xs font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Xem chi tiết
                        </a>
                        <?php elseif($application->hasCvFile()): ?>
                        
                        <a href="<?php echo e(route('hr.applications.cv.download', $application)); ?>"
                            class="flex-1 text-center px-3 py-1.5 bg-indigo-600 text-white text-xs font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Tải file CV
                        </a>
                        <?php else: ?>
                        <a href="<?php echo e(route('hr.applications.show', $application)); ?>"
                            class="flex-1 text-center px-3 py-1.5 bg-indigo-600 text-white text-xs font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Xem chi tiết
                        </a>
                        <?php endif; ?>
                        <a href="mailto:<?php echo e($email); ?>"
                            class="px-3 py-1.5 border border-gray-300 text-gray-600 text-xs font-medium rounded-lg hover:bg-gray-50 transition">
                            Liên hệ
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($applications->hasPages()): ?>
            <div class="mt-6">
                <?php echo e($applications->withQueryString()->links()); ?>

            </div>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\CLone Git\CVactive_ST5\resources\views/hr/applications/cv-search.blade.php ENDPATH**/ ?>