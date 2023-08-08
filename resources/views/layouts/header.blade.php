
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
      <div class="sidebar-brand-icon">
        @if(Auth::user()->profile_pic)
          <img class="img-profile rounded-circle" src="{{asset(Auth::user()->profile_pic) }}" style="max-width: 60px">
        @else
          <img class="img-profile rounded-circle" src="{{asset('admin/img/boy.png') }}" style="max-width: 60px">
        @endif
      </div>
      <div class="sidebar-brand-text mx-3">{{ Auth::user()->name }}</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
     @if(Gate::allows('roles.index') || Gate::allows('users.index')||Gate::allows('course.index') || Gate::allows('batch.index'))
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
        aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Administration</span>
      </a>
      <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Administration</h6>
          @if (Auth::user()->role_id==1 || Auth::user()->role_id==2)
          <a class="collapse-item" href="{{ route('modules.index') }}">Module</a>
          <a class="collapse-item" href="{{ route('permissions.index') }}">Permission</a>
          @endif
           @can('users.index')
            <a class="collapse-item" href="{{ route('users.index') }}">Set User</a>
          @endcan
          @can('user_assigned.index')
            <a class="collapse-item" href="{{ url('user/assigned') }}">Assigned User</a>
          @endcan
          @can('roles.index')
            <a class="collapse-item" href="{{ route('roles.index') }}">Role</a>
          @endcan
           @can('course.index')
            <a class="collapse-item" href="{{ route('course.index') }}">Set Course</a>
          @endcan
          @can('batch.index')
            <a class="collapse-item" href="{{ route('batch.index') }}">Set Batch</a>
          @endcan
        </div>
      </div>
    </li>
    @endif
    @if(Gate::allows('subject.index')||Gate::allows('chapter.index') || Gate::allows('question.index'))
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2"
        aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Question Bank</span>
      </a>
      <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Question Bank</h6>
           @can('subject.index')
            <a class="collapse-item" href="{{ route('subject.index') }}">Set Subject</a>
          @endcan
          @can('chapter.index')
            <a class="collapse-item" href="{{ route('chapter.index') }}">Set chapter</a>
          @endcan
           @can('question.index')
            <a class="collapse-item" href="{{ route('question.index') }}">Question</a>
          @endcan
        </div>
      </div>
    </li>
    @endif
    @if( Gate::allows('admin_review.index')||Gate::allows('review.index') || Gate::allows('questionbankquestion.index'))
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Review System</span>
      </a>
      <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Review System</h6>
           @can('review.index')
            <a class="collapse-item" href="{{route('review.index')}}">Question Review</a>
           @endcan
          @can('admin_review.index')
          @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
            <a class="collapse-item" href="{{route('admin_review.index')}}">Admin Question Review</a>
          @endif
          @endcan
           @can('questionbankquestion.index')
            <a class="collapse-item" href="{{route('questionbankquestion.index')}}">View Question Bank</a>
           @endcan
        </div>
      </div>
    </li>
    @endif
    @if(Gate::allows('exam.index'))
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExam" aria-expanded="true"
        aria-controls="collapseExam">
        <i class="fas fa-fw fa-table"></i>
        <span>Examination </span>
      </a>
      <div id="collapseExam" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Examination</h6>
           @can('exam.index')
            <a class="collapse-item" href="{{ route('exam.index') }}">Set Exam</a>
           @endcan
        </div>
      </div>
    </li>
    @endif
    @if( Gate::allows('exam.evaluation'))
     <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Evaluationse" aria-expanded="true"
        aria-controls="Evaluationse">
        <i class="fas fa-fw fa-table"></i>
        <span>Evaluation </span>
      </a>
      <div id="Evaluationse" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Evaluation</h6>
           @can('exam.evaluation')
            <a class="collapse-item" href="{{ route('exam.evaluation') }}">Evaluation</a>
           @endcan
        </div>
      </div>
    </li>
    @endif
  @if( Gate::allows('markinfo.index') ||  Gate::allows('teacher.markinfo'))
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Markinfo" aria-expanded="true"
        aria-controls="Markinfo">
        <i class="fas fa-fw fa-table"></i>
        <span>Mark Sheet</span>
      </a>
      <div id="Markinfo" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Mark</h6>
           @can('markinfo.index')
            <a class="collapse-item" href="{{ route('mark.index') }}">Your Exam  Mark</a>
           @endcan
          @can('teacher.markinfo')
              <a class="collapse-item" href="{{ route('mark.teacher_mark') }}">Mark Info</a>
          @endcan
        </div>
      </div>
    </li>
  @endif
  @if( Gate::allows('forum_category.index') ||  Gate::allows('forum.index'))
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
        aria-controls="collapseTable">
        <i class="fas fa-fw fa-table"></i>
        <span>Forum</span>
      </a>
      <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Forum</h6>
           @can('forum_category.index')
            <a class="collapse-item" href="{{ url('forum/category') }}">Forum Category</a>
           @endcan
          @can('forum.index')
            <a class="collapse-item" href="{{ route('forum.index') }}">Forum</a>
          @endcan
        </div>
      </div>
    </li>
    @endif
    <hr class="sidebar-divider">
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
