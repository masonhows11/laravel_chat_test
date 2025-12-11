@extends('chat.master')
@section('title')
    chat room
@endsection
@section('main')
    <input type="hidden" id="roomId" value="{{ $roomId }}">
    <div class="container vh-100">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8 vh-75 d-flex flex-column ">
                        <h3>Message box</h3>
                        <div id="boxMessage"
                             class="flex  flex-column mt-3 py-2 px-2 border border-2 rounded rounded-2 mh-100 overflow-y-auto"
                             style="height:480px">
                            @if(!empty($messages))
                                @foreach($messages as $message)
                                    <div class="card my-2">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <span
                                                        class="card-subtitle text-muted">{{ $message->user->name }}</span>
                                                </div>
                                                @if( auth()->id() == $message->user->id )
                                                    <div><a id="removeMessage-{{$message->id}}"
                                                            data-messageId="{{ $message->id }}"
                                                            href="javascript:void(0)"
                                                            class="mb-4 removeMessage">
                                                            <i class="fa-solid fa-trash-alt text-danger"></i></a>
                                                    </div>
                                                @endif

                                            </div>
                                            {{ $message->message  }}
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <form>
                            <div class="mb-3">
                                <label for="inputMessage" class="mt-2 form-label fw-medium">Message</label>
                                <div class="d-flex flex-column">
                                    <input type="text" class="form-control" onclick="typingWhisper(event)"
                                           id="inputMessage" placeholder="type something">
                                </div>
                                <span id="isTyping" style="height: 50px"></span>
                                <div id="messageError" class="mt-2" style="display:none">
                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                        <div class="ms-2">
                                            Please enter your message
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div>
                                <button class="ms-1 btn  btn-success w-25  py-1 my-1" id="sendMessage">Send</button>
                                <button class="ms-1 btn  btn-secondary w-25  py-1 my-1" id="clearMessage">Clear</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-center ">Online users</h3>
                        <div class="border border-3 rounded rounded-2 mt-4 h-75 overflow-y-auto">
                            <ul class="list-group list-group-flush" id="onlineUsers"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/chat.js')
@endsection
