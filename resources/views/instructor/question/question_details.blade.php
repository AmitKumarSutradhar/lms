@extends('instructor.instructor_dashboard')

@section('body')
    @php
        $id = Auth::user()->id;
        $profileData = \App\Models\User::find($id);
    @endphp

    <div class="page-content">
        <div class="chat-wrapper">
            <div class="chat-sidebar">
                <div class="chat-sidebar-header">
                    <div class="d-flex align-items-center">
                        <div class="chat-user-online">
                            <img src="{{ (!empty($profileData->photo)) ? url('upload/instructor_images/'.$profileData->photo) : url('upload/no_images.jpg') }}" width="45" height="45" class="rounded-circle" alt="" />
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <p class="mb-0">{{ $profileData->name }}</p>
                        </div>
                        <div class="dropdown">
                            <div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
                            </div>
                            <div class="dropdown-menu dropdown-menu-end"> <a class="dropdown-item" href="javascript:;">Settings</a>
                                <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Help & Feedback</a>
                                <a class="dropdown-item" href="javascript:;">Enable Split View Mode</a>
                                <a class="dropdown-item" href="javascript:;">Keyboard Shortcuts</a>
                                <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Sign Out</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3"></div>
                    <div class="input-group input-group-sm"> <span class="input-group-text bg-transparent"><i class='bx bx-search'></i></span>
                        <input type="text" class="form-control" placeholder="People, groups, & messages"> <span class="input-group-text bg-transparent"><i class='bx bx-dialpad'></i></span>
                    </div>
                </div>
                <div class="chat-sidebar-content">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-Chats">
                            <div class="chat-list">
                                <div class="list-group list-group-flush">
                                    <a href="javascript:;" class="list-group-item">
                                        <div class="d-flex">
                                            <div class="chat-user-online">
                                                <img src="{{ (!empty($question->user->photo)) ? url('upload/user_images/'.$question->user->photo) : url('upload/no_images.jpg') }}" width="42" height="42" class="rounded-circle" alt="" />
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <h6 class="mb-0 chat-title">{{ $question['user']['name'] }}</h6>
                                                <p class="mb-0 chat-msg">Student</p>
                                            </div>
                                            <div class="chat-time">{{ \Carbon\Carbon::parse($question->created_at)->diffForHumans() }}</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-header d-flex align-items-center">
                <div class="chat-toggle-btn"><i class='bx bx-menu-alt-left'></i>
                </div>
                <div>
                    <h4 class="mb-1 font-weight-bold">{{ $question['user']['name'] }}</h4>
                    <div class="list-inline d-sm-flex mb-0 d-none"> <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><small class='bx bxs-circle me-1 chart-online'></small>Active Now</a>
                        <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary">|</a>
                        <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><i class='bx bx-images me-1'></i>Gallery</a>
                        <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary">|</a>
                        <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><i class='bx bx-search me-1'></i>Find</a>
                    </div>
                </div>
                <div class="chat-top-header-menu ms-auto"> <a href="javascript:;"><i class='bx bx-video'></i></a>
                    <a href="javascript:;"><i class='bx bx-phone'></i></a>
                    <a href="javascript:;"><i class='bx bx-user-plus'></i></a>
                </div>
            </div>
            <div class="chat-content">
                <div class="chat-content-leftside">
                    <div class="d-flex">
                        <img src="{{ (!empty($question->user->photo)) ? url('upload/user_images/'.$question->user->photo) : url('upload/no_images.jpg') }}" width="48" height="48" class="rounded-circle" alt="" />
                        <div class="flex-grow-1 ms-2">
                            <p class="mb-0 chat-time">{{ $question['user']['name'] }}, {{ \Carbon\Carbon::parse($question->created_at)->diffForHumans() }}</p>
                            <p class="chat-left-msg">{{$question->question }}</p>
                        </div>
                    </div>
                </div>
                @foreach($reply as $rep)
                    <div class="chat-content-rightside">
                        <div class="d-flex ms-auto">
                            <div class="flex-grow-1 me-2">
                                <p class="mb-0 chat-time text-end">you, {{ \Carbon\Carbon::parse($rep->created_at)->diffForHumans() }}</p>
                                <p class="chat-right-msg">{{ $rep->question }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <form action="{{ route('instructor.reply') }}" method="POST">
                @csrf

                <input type="hidden" name="qid" value="{{ $question->id }}" id="">
                <input type="hidden" name="course_id" value="{{ $question->course->id }}" id="">
                <input type="hidden" name="user_id" value="{{ $question->user->id }}" id="">
                <input type="hidden" name="instructor_id" value="{{ $profileData->id }}" id="">

                <div class="chat-footer d-flex align-items-center">
                    <div class="flex-grow-1 pe-2">
                        <div class="input-group">	<span class="input-group-text"><i class='bx bx-smile'></i></span>
                            <input type="text" name="question" class="form-control" placeholder="Type a message">
                        </div>
                    </div>
                    <div class="chat-footer-menu">
                        <button type="submit" class="bx-border-circle bg-white p-3"><i class='lni lni-reply'></i></button>
                        <a href="javascript:;"><i class='bx bxs-contact'></i></a>
                        <a href="javascript:;"><i class='bx bx-microphone'></i></a>
                        <a href="javascript:;"><i class='bx bx-dots-horizontal-rounded'></i></a>
                    </div>
                </div>
            </form>
            <!--start chat overlay-->
            <div class="overlay chat-toggle-btn-mobile"></div>
            <!--end chat overlay-->
        </div>
    </div>
@endsection
