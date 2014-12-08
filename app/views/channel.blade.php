@extends('_master')

@section('title')
	Add or Remove Channels
@stop

@section('/body')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){

            $( {{ $add_id_list }} ).click(function (event) {
                $.ajax({
                    type: 'POST',
                    url: '/postChannel',
                    success: function (response) {
                        $('#results').html(response);
                    },
                    data: {
                        format: 'html',
                        query: event.target.id,
                        _token: $('input[name=_token]').val(),
                    },
                });
            });

        });

        $(document).ready(function(){

            $( {{ $erase_id_list }} ).click(function (event) {
                $.ajax({
                    type: 'POST',
                    url: '/test',
                    success: function (response) {
                        $('#results').html(response);
                    },
                    data: {
                        format: 'html',
                        query: event.target.id,
                        _token: $('input[name=_token]').val(),
                    },
                });
            });

        });
    </script>
@stop

@section('content')

 <div id="body">


            <h1>Search (with Ajax!)</h1>

            
            {{ Form::token() }}

            <!--<button id='search-html'>Search and get HTML back</button>-->


            <div id='results'></div>

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
                        <!--
                        CNN <input id='cnn' type="image" src="plus_add_blue.png" width="10" alt="Submit"><br /><br />
                        MSNBC <input id='MSNBC' type="image" src="plus_add_blue.png" width="10" alt="Submit"><br /><br />
                        Comedy <input id='Comedy' type="image" src="plus_add_blue.png" width="10" alt="Submit"><br /><br />
                        Sports <input id='Sports' type="image" src="plus_add_blue.png" width="10" alt="Submit"><br /><br />
                        Movies <input id='Movies' type="image" src="plus_add_blue.png" width="10" alt="Submit"><br /><br />
                        Youtube <input id='Youtube' type="image" src="plus_add_blue.png" width="10" alt="Submit"><br /><br />
                        Dailymotion <input id='Dailymotions' type="image" src="plus_add_blue.png" width="10" alt="Submit"><br /><br />
                        World News <input id='World News' type="image" src="plus_add_blue.png" width="10" alt="Submit"><br /><br />
                        NYTimes <input id='NYTimes' type="image" src="plus_add_blue.png" width="10" alt="Submit"><br /><br />
                        -->

                    </td>
                    <td valign="top">
                        <br />
                        <br />
                        <br />
                        <span class="auto-style1"><strong>Your Channels:</strong></span><br /><br />

                        {{ $already_has_user_channels}}
                        <!-- 
                        CNN <img src="erase.png" width="10" /><br /><br />
                        
                        MSNBC <img src="erase.png" width="10" /><br /><br />
                        
                        Comedy <img src="erase.png" width="10" /><br /><br />
                        -->

                        
                    </td>
                </tr>
            </table>
            



        </div>


@stop