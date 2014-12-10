@extends('_master')

@section('title')
	Add or Remove Channels
@stop

@section('/body')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <script type="text/javascript">
        
        function updateFunction(elmnt,id_of_element) {
            
            $.ajax({
                    type: 'POST',
                    url: '/channel',
                    success: function (response) {
                        $('#results').html(response);
                    },
                    data: {
                        format: 'html',
                        query: id_of_element,
                        _token: $('input[name=_token]').val(),
                    },
                });
        }


    </script>

       
    


@stop

@section('content')

 <div id="body">


            <h1>Add Your Favorite Channels (with Ajax!)</h1>

            
            {{ Form::token() }}

            <!--<button id='search-html'>Search and get HTML back</button>-->

            <table cellpadding="10">
                <tr>
                    <td valign="top">
                        <br />
                        <br />
                        <br />
                        <span class="auto-style1"><strong>All Channels:</strong></span>
                        <br />
                        <br />

                        {{ $all_channels }}

                    </td>
                    <td valign="top">
                        <br />
                        <br />
                        <br />
                        <span class="auto-style1"><strong>Your Channels:</strong></span><br /><br />

                        <div id='results'>{{ $already_has_user_channels}}</div>
                        
                    </td>
                </tr>
            </table>
            



        </div>


@stop