@extends('glog::layout.master')
@section('content')
    <div class="row">
        <div class="col-xs-6 col-lg-offset-3">
            <form class="form-horizontal" action="{{ route('glog_clear_logs') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <div class="form-group">
                 <label for="level">Level:</label>
                 <select name="level" id="level" class="form-control">
                 <option value=""> - - - - </option>
                     @foreach($levels as $l)
                        @if($l == $level)
                        <option selected value="{{ $l }}">{{ $l }}</option>
                        @else
                        <option value="{{ $l }}">{{ $l }}</option>
                        @endif
                     @endforeach
                 </select>
             </div>

             <div class="form-group">
                 <label for="channels">Channels:</label>
                 <select name="channels" id="channels"  class="form-control">
                    <option value=""> - - - - </option>
                     @foreach($channels as $m)
                        @if($m == $channel)
                        <option selected value="{{ $m }}">{{ isset($translations[$m]) ? $translations[$m] : $m }}</option>
                        @else
                        <option value="{{ $m }}">{{ isset($translations[$m]) ? $translations[$m] : $m }}</option>
                        @endif
                     @endforeach
                 </select>
             </div>

             <div class="form-group">
                 <label for="datepicker_start">Start Date:</label>
                 <input type="text" id="datepicker_start" name="start_date" class="form-control" >
             </div>

             <div class="form-group">
                 <label for="datepicker_end">End Date:</label>
                 <input type="text" id="datepicker_end" name="end_date" class="form-control" >
             </div>
             <div class="form-group">
               <button type="submit" class="btn btn-sm btn-info">Purge Logs</button>
             </div>
            </form>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        $("#datepicker_start" ).datepicker({ format: 'yyyy-dd-mm' });
        $("#datepicker_end" ).datepicker({ format: 'yyyy-dd-mm' });
        $('select').select2({
            theme: "bootstrap"
        });
    </script>
 @stop
