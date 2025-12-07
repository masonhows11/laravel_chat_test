@extends('chat.master')
@section('title')
    chat room
@endsection

@section('main')
    <input type="hidden" id="room" value="{{ $roomId }}">
    <div class="container vh-100">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8 vh-75 d-flex flex-column ">
                        <h3>Message box</h3>
                        <div class="mt-4 border border-2 rounded rounded-2 mh-100 overflow-y-auto" style="height:480px">

                        </div>
                        <form>
                            <div class="mb-3">
                                <label for="message" class="mt-2 form-label fw-medium">Message</label>
                                <div class="d-flex flex-column">
                                    <input type="text" class="form-control"
                                           onclick="typingWhisper(event)"
                                           id="inputMessage"
                                           placeholder="type something">
                                    <button class="ms-1 btn  btn-secondary w-25  py-1 my-1" id="clearMessage">clear</button>
                                </div>


                                <span id="isTyping"></span>
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
