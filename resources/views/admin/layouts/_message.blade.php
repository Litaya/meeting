@if(Session::has('notice_msg'))
    <div class="col-lg-12">
        <div class="panel panel-{{Session::has('notice_status')?Session::get('notice_status'):'default'}}">
            <div class="panel-body" style="padding: 10px;">
                {{ Session::get('notice_msg') }}
            </div>
        </div>
    </div>
@endif