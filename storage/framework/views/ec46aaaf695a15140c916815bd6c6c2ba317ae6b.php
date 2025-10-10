<?php
$menuItems = [
[
'title' => 'Dashboard',
'url' => url('/admin'),
'route' => 'index',
'children' => null
],
[
'title' => 'Notice',
'url' => url('/admin/all/notice'),
'route' => 'all.books', // Note: Potential mismatch in original; adjust as needed
'children' => null
],
[
'title' => 'Student Info',
'url' => '#',
'route' => null,
'children' => [
['title' => 'Student List', 'url' => url('/admin/student_info')],
['title' => 'Mobile List', 'url' => url('/admin/mobile_info')],
['title' => 'WhatsApp List', 'url' => url('/admin/whatsapp_info')],
['title' => 'Student By Id', 'url' => url('/admin/student_info_by_id')],
['title' => 'Student By Mobile', 'url' => url('/admin/student_info_by_mobile')],
['title' => 'Student By Name', 'url' => url('/admin/student_info_by_name')],
]
],
[
'title' => 'Enrolled',
'url' => url('/admin/batch_student'),
'route' => 'admin.batch_student',
'children' => null
],
[
'title' => 'Payment History',
'url' => url('/admin/payment_history'),
'route' => 'admin.batch_student', // Note: Potential copy-paste error in original; adjust as needed
'children' => null
],
[
'title' => 'User',
'url' => '#',
'route' => null,
'children' => [
['title' => 'All User', 'url' => url('/admin/all/user')],
['title' => 'Register', 'url' => url('/admin/create/user')],
]
],
[
'title' => 'Batch Student',
'url' => '#',
'route' => null,
'children' => [
['title' => 'Enroll Student', 'url' => url('/admin/batch_student')],
['title' => 'Payment Info', 'url' => url('/admin/payment')],
]
],
[
'title' => 'Class Information',
'url' => url('/admin/lecture-sheet'),
'route' => 'all.sheet',
'children' => null
],
[
'title' => 'Subject',
'url' => url('/admin/all/subject'),
'route' => null, // No route check in original
'children' => null
],
[
'title' => 'Chapter',
'url' => url('/admin/chapter/create'),
'route' => null, // No route check in original
'children' => null
],
[
'title' => 'Live Exam List',
'url' => url('/admin/all/model'),
'route' => 'all.model',
'children' => null
],
[
'title' => 'Question Bank',
'url' => url('/admin/question_bank'),
'route' => 'all.questionBank',
'children' => null
],
[
'title' => 'Admission Batch',
'url' => url('/admin/addmition/batch'), // Note: Typo in original URL ('addmition' -> 'admission'?)
'route' => 'all.batch',
'children' => null
],
[
'title' => 'Batch Duration',
'url' => url('/admin/admission/showbatchduration'),
'route' => 'show.duration',
'children' => null
],
[
'title' => 'Batch Package',
'url' => url('/admin/batchPackage'),
'route' => null, // No route check in original
'children' => null
],
[
'title' => 'Add HELP',
'url' => url('/admin/help'),
'route' => 'show.help',
'children' => null
],
[
'title' => 'Download',
'url' => url('/admin/books'),
'route' => 'all.notic', // Note: Potential mismatch in original
'children' => null
],
[
'title' => 'Gallery',
'url' => url('/admin/all/photos'),
'route' => 'all.notic', // Note: Potential copy-paste error in original
'children' => null
],
[
'title' => 'Books',
'url' => url('/admin/all/books'),
'route' => 'book.index',
'children' => null
],
[
'title' => 'Mentors',
'url' => url('/admin/all/mentors'),
'route' => 'all.mentors',
'children' => null
],
[
'title' => 'Review',
'url' => url('/admin/all/review'),
'route' => 'all.review',
'children' => null
],
[
'title' => 'News',
'url' => url('/admin/all/news'),
'route' => 'all.news',
'children' => null
],
[
'title' => 'Student Summary',
'url' => url('/admin/report/summary'),
'route' => 'report.summary',
'children' => null
],
[
'title' => 'Banner',
'url' => url('/admin/banner'),
'route' => null, // No route check in original
'children' => null
],
[
'title' => 'Visit site',
'url' => url('/'),
'route' => null,
'children' => null,
'target' => '_blank'
],
[
'title' => 'CMS',
'url' => '#',
'route' => null,
'children' => [
['title' => 'Home Page', 'url' => url('/admin/home-page-edit')],
]
],
];
?>

<ul class="sidebar navbar-nav">
    <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php if($item['children']): ?>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown<?php echo e($key); ?>" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span><?php echo e($item['title']); ?></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown<?php echo e($key); ?>">
            <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="dropdown-item" href="<?php echo e($child['url']); ?>">
                <?php echo e($child['title']); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </li>
    <?php else: ?>
    <li class="nav-item <?php echo e($item['route'] ? (Request::routeIs($item['route']) ? 'active' : '') : ''); ?>">
        <a class="nav-link<?php echo e(isset($item['target']) ? ' target="' . $item['target'] . '"' : ''); ?><?php echo e(isset($item['onclick'])
            ? ' onclick="' . $item['onclick'] . '"' : ''); ?>" href="<?php echo e($item['url']); ?>">
            <span><?php echo e($item['title']); ?></span>
        </a>
    </li>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
</form>
