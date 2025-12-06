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
                        <form>
                            <div class="mb-3">
                                <label for="message" class="form-label">message</label>
                                <input type="text" class="form-control" id="message" placeholder="type something">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <h3 class="text-center ">Current users</h3>
                        <div class="border border-3 rounded rounded-2 mt-4 h-75 overflow-y-scroll">
                            <ul class="list-group ">
                                <li class="list-group-item">An item</li>
                                <li class="list-group-item">A second item</li>
                                <li class="list-group-item">A third item</li>
                                <li class="list-group-item">A fourth item</li>
                                <li class="list-group-item">And a fifth one</li>
                                <li class="list-group-item">An item</li>
                                <li class="list-group-item">A second item</li>
                                <li class="list-group-item">A third item</li>
                                <li class="list-group-item">A fourth item</li>
                                <li class="list-group-item">And a fifth one</li>
                                <li class="list-group-item">An item</li>
                                <li class="list-group-item">A second item</li>
                                <li class="list-group-item">A third item</li>
                                <li class="list-group-item">A fourth item</li>
                                <li class="list-group-item">And a fifth one</li>
                                <li class="list-group-item">An item</li>
                                <li class="list-group-item">A second item</li>
                                <li class="list-group-item">A third item</li>
                                <li class="list-group-item">A fourth item</li>
                                <li class="list-group-item">And a fifth one</li>
                            </ul>
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
