
<?php
    $personal  = $cv->personal_info ?? [];
    $themeColor = $cv->theme_color ?? '#4F46E5';
    $font      = $cv->font_family ?? 'Inter';
    $sections  = $cv->sections ?? collect();
    $fullName  = $personal['full_name'] ?? 'Họ và Tên';
    $email     = $personal['email'] ?? '';
    $phone     = $personal['phone'] ?? '';
    $address   = $personal['address'] ?? '';
    $website   = $personal['website'] ?? '';
    $linkedin  = $personal['linkedin'] ?? '';
    $github    = $personal['github'] ?? '';
    $avatar    = $personal['avatar'] ?? '';
?>

<div class="cv-document" style="font-family: '<?php echo e($font); ?>', sans-serif; color: #1f2937; min-height: 297mm;">

    
    <div style="background-color: <?php echo e($themeColor); ?>; padding: 32px 40px; color: white;">
        <div style="display: flex; align-items: center; gap: 24px;">
            <?php if($avatar): ?>
            <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; border: 3px solid rgba(255,255,255,0.3); flex-shrink: 0;">
                <img src="<?php echo e(str_starts_with($avatar, 'http') ? $avatar : asset('storage/'.$avatar)); ?>"
                    alt="<?php echo e($fullName); ?>" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <?php endif; ?>
            <div style="flex: 1;">
                <h1 style="font-size: 28px; font-weight: 700; margin: 0 0 4px 0; letter-spacing: -0.5px;"><?php echo e($fullName); ?></h1>
                <?php if($cv->objective): ?>
                <p style="font-size: 13px; opacity: 0.85; margin: 0; line-height: 1.5;"><?php echo e(Str::limit($cv->objective, 120)); ?></p>
                <?php endif; ?>
            </div>
        </div>

        
        <div style="display: flex; flex-wrap: wrap; gap: 16px; margin-top: 16px; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.2); font-size: 12px; opacity: 0.9;">
            <?php if($email): ?>
            <span>✉ <?php echo e($email); ?></span>
            <?php endif; ?>
            <?php if($phone): ?>
            <span>📱 <?php echo e($phone); ?></span>
            <?php endif; ?>
            <?php if($address): ?>
            <span>📍 <?php echo e($address); ?></span>
            <?php endif; ?>
            <?php if($website): ?>
            <span>🌐 <?php echo e($website); ?></span>
            <?php endif; ?>
            <?php if($linkedin): ?>
            <span>in <?php echo e($linkedin); ?></span>
            <?php endif; ?>
            <?php if($github): ?>
            <span>⚡ <?php echo e($github); ?></span>
            <?php endif; ?>
        </div>
    </div>

    
    <div style="padding: 28px 40px;">
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$section->is_visible): ?> <?php continue; ?> <?php endif; ?>
            <?php if(in_array($section->type, ['personal', 'objective'])): ?> <?php continue; ?> <?php endif; ?>

            <div style="margin-bottom: 24px;">
                
                <div style="display: flex; align-items: center; margin-bottom: 12px;">
                    <div style="width: 4px; height: 20px; background-color: <?php echo e($themeColor); ?>; margin-right: 10px; border-radius: 2px;"></div>
                    <h2 style="font-size: 15px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #111827; margin: 0;"><?php echo e($section->title); ?></h2>
                    <div style="flex: 1; height: 1px; background-color: #e5e7eb; margin-left: 12px;"></div>
                </div>

                
                <?php $__currentLoopData = $section->items->sortBy('sort_order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $c = $item->content; ?>

                    <?php if($section->type === 'experience'): ?>
                    <div style="margin-bottom: 14px; padding-left: 14px; border-left: 2px solid #f3f4f6;">
                        <div style="display: flex; justify-content: space-between; align-items: baseline;">
                            <strong style="font-size: 14px; color: #111827;"><?php echo e($c['position'] ?? ''); ?></strong>
                            <span style="font-size: 11px; color: #6b7280;"><?php echo e($c['start_date'] ?? ''); ?><?php echo e(($c['start_date'] ?? '') && ($c['end_date'] ?? '') ? ' – ' : ''); ?><?php echo e($c['end_date'] ?? ''); ?></span>
                        </div>
                        <div style="font-size: 12px; color: <?php echo e($themeColor); ?>; font-weight: 600; margin-top: 2px;">
                            <?php echo e($c['company'] ?? ''); ?><?php echo e(($c['company'] ?? '') && ($c['location'] ?? '') ? ' · ' : ''); ?><?php echo e($c['location'] ?? ''); ?>

                        </div>
                        <?php if(!empty($c['description'])): ?>
                        <p style="font-size: 12px; color: #4b5563; margin-top: 6px; line-height: 1.6;"><?php echo e($c['description']); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php elseif($section->type === 'education'): ?>
                    <div style="margin-bottom: 12px; padding-left: 14px; border-left: 2px solid #f3f4f6;">
                        <div style="display: flex; justify-content: space-between; align-items: baseline;">
                            <strong style="font-size: 14px; color: #111827;"><?php echo e($c['degree'] ?? ''); ?></strong>
                            <span style="font-size: 11px; color: #6b7280;"><?php echo e($c['start_date'] ?? ''); ?><?php echo e(($c['start_date'] ?? '') && ($c['end_date'] ?? '') ? ' – ' : ''); ?><?php echo e($c['end_date'] ?? ''); ?></span>
                        </div>
                        <div style="font-size: 12px; color: <?php echo e($themeColor); ?>; font-weight: 600; margin-top: 2px;"><?php echo e($c['school'] ?? ''); ?></div>
                        <?php if(!empty($c['gpa'])): ?>
                        <span style="font-size: 11px; color: #6b7280;">GPA: <?php echo e($c['gpa']); ?></span>
                        <?php endif; ?>
                    </div>

                    <?php elseif($section->type === 'skills'): ?>
                    <div style="display: inline-flex; align-items: center; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 6px; padding: 4px 12px; margin: 3px; font-size: 12px; gap: 6px;">
                        <span style="color: #111827; font-weight: 500;"><?php echo e($c['name'] ?? ''); ?></span>
                        <?php if(!empty($c['level'])): ?>
                        <span style="color: <?php echo e($themeColor); ?>; font-size: 10px;">
                            <?php switch($c['level']):
                                case ('beginner'): ?> ● ○ ○ ○ <?php break; ?>
                                <?php case ('intermediate'): ?> ● ● ○ ○ <?php break; ?>
                                <?php case ('advanced'): ?> ● ● ● ○ <?php break; ?>
                                <?php case ('expert'): ?> ● ● ● ● <?php break; ?>
                            <?php endswitch; ?>
                        </span>
                        <?php endif; ?>
                    </div>

                    <?php elseif($section->type === 'certifications'): ?>
                    <div style="margin-bottom: 8px; padding-left: 14px; border-left: 2px solid #f3f4f6; display: flex; justify-content: space-between;">
                        <div>
                            <strong style="font-size: 13px; color: #111827;"><?php echo e($c['name'] ?? ''); ?></strong>
                            <?php if(!empty($c['issuer'])): ?>
                            <span style="font-size: 12px; color: #6b7280;"> · <?php echo e($c['issuer']); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($c['date'])): ?>
                        <span style="font-size: 11px; color: #6b7280;"><?php echo e($c['date']); ?></span>
                        <?php endif; ?>
                    </div>

                    <?php elseif($section->type === 'projects'): ?>
                    <div style="margin-bottom: 14px; padding-left: 14px; border-left: 2px solid #f3f4f6;">
                        <div style="display: flex; justify-content: space-between; align-items: baseline;">
                            <strong style="font-size: 14px; color: #111827;"><?php echo e($c['name'] ?? ''); ?></strong>
                            <?php if(!empty($c['url'])): ?>
                            <a href="<?php echo e($c['url']); ?>" style="font-size: 11px; color: <?php echo e($themeColor); ?>;"><?php echo e($c['url']); ?></a>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($c['tech'])): ?>
                        <div style="font-size: 11px; color: #6b7280; margin-top: 2px;"><?php echo e($c['tech']); ?></div>
                        <?php endif; ?>
                        <?php if(!empty($c['description'])): ?>
                        <p style="font-size: 12px; color: #4b5563; margin-top: 6px; line-height: 1.6;"><?php echo e($c['description']); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php elseif($section->type === 'activities'): ?>
                    <div style="margin-bottom: 8px; padding-left: 14px; border-left: 2px solid #f3f4f6;">
                        <div style="display: flex; justify-content: space-between;">
                            <strong style="font-size: 13px; color: #111827;"><?php echo e($c['name'] ?? ''); ?></strong>
                            <?php if(!empty($c['period'])): ?>
                            <span style="font-size: 11px; color: #6b7280;"><?php echo e($c['period']); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($c['organization'])): ?>
                        <div style="font-size: 12px; color: <?php echo e($themeColor); ?>;"><?php echo e($c['organization']); ?></div>
                        <?php endif; ?>
                    </div>

                    <?php elseif($section->type === 'references'): ?>
                    <div style="margin-bottom: 10px; padding: 12px; background: #f9fafb; border-radius: 8px;">
                        <strong style="font-size: 13px; color: #111827;"><?php echo e($c['name'] ?? ''); ?></strong>
                        <?php if(!empty($c['title'])): ?>
                        <div style="font-size: 12px; color: <?php echo e($themeColor); ?>;"><?php echo e($c['title']); ?></div>
                        <?php endif; ?>
                        <div style="font-size: 11px; color: #6b7280; margin-top: 2px;">
                            <?php echo e($c['email'] ?? ''); ?><?php echo e(($c['email'] ?? '') && ($c['phone'] ?? '') ? ' · ' : ''); ?><?php echo e($c['phone'] ?? ''); ?>

                        </div>
                    </div>

                    <?php else: ?> 
                    <p style="font-size: 13px; color: #4b5563; line-height: 1.6; margin-bottom: 6px;"><?php echo e($c['text'] ?? ''); ?></p>
                    <?php endif; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\CLone Git\CVactive_ST5\resources\views/cv-templates/classic-blue.blade.php ENDPATH**/ ?>