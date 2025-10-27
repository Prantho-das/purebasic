@php
$menuItems = [
[
'title' => 'Dashboard',
'url' => url('/admin'),
'route' => 'index',
'children' => null
],
[
'title' => 'CMS',
'url' => '#',
'route' => null,
'children' => [
['title' => 'Section', 'url' => url('/admin/sections')],
['title' => 'Location', 'url' => url('/admin/locations')],
['title' => 'Mentor', 'url' => url('/admin/all/mentors')],
['title' => 'Review', 'url' => url('/admin/all/review')],
['title' => 'Menu', 'url' => url('/admin/menus')],
['title' => 'social-media', 'url' => url('/admin/social-media')],
['title' => 'site-settings', 'url' => url('/admin/site-settings')],
['title' => 'subscribers', 'url' => route('admin.subscribers.index')],
]
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
'title' => 'Batch',
'url' => '#',
'route' => null,
'children' => [
['title' => 'Admission Batch', 'url' => url('admin/addmition/batch')],
['title' => 'Batch Category', 'url' => url('admin/batch-categories')],
['title' => 'Batch Duration', 'url' => url('/admin/admission/showbatchduration'),],
['title' => 'Batch Package', 'url' => url('/admin/batchPackage')],
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

];
@endphp

<ul class="sidebar navbar-nav">
    @foreach($menuItems as $key => $item)
    @if($item['children'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown{{ $key }}" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span>{{ $item['title'] }}</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown{{ $key }}">
            @foreach($item['children'] as $child)
            <a class="dropdown-item" href="{{ $child['url'] }}">
                {{ $child['title'] }}
            </a>
            @endforeach
        </div>
    </li>
    @else
    <li class="nav-item {{ $item['route'] ? (Request::routeIs($item['route']) ? 'active' : '') : '' }}">
        <a class="nav-link{{ isset($item['target']) ? ' target="' . $item['target'] . '"' : '' }}{{ isset($item['onclick'])
            ? ' onclick="' . $item['onclick'] . '"' : '' }}" href="{{ $item['url'] }}">
            <span>{{ $item['title'] }}</span>
        </a>
    </li>
    @endif
    @endforeach
</ul>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>