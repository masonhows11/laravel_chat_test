@extends('chat.master')
@section('title')
    chat room
@endsection

@section('main')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="col-md-8">
                    <h3>Message box</h3>
                    <form>
                        <div class="mb-3">
                            <label for="message" class="form-label">message</label>
                            <input type="text" class="form-control" id="message" placeholder="type something">
                        </div>
                    </form>
                </div>
                <div class="col-md-3 border-2 rounded rounded-2 h-75 ">
                    <h3>Current users</h3>
                    <div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/chat.js')
@endsection
