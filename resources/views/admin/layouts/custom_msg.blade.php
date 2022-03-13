@if ( count($errors->messages()) > 0 )
    <section class="content server-side-validation">
        <div class="row">
            <div class="col-md-12">
                <p>The following action have occurred:</p>
                @foreach( $errors->messages() as $row )
                    <ul class="error-list">
                        @if($row['status'] == 'error')
                            <li>{!! $row['msg'] !!}</li>
                        @endif
                    </ul>
                    <ul class="success-list">
                        @if($row['status'] == 'success')
                            <li>{!! $row['msg'] !!}</li>
                        @endif
                    </ul>
                    @endforeach
                    </ul>
            </div>
        </div>
    </section>
@endif
