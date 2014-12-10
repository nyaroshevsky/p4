@extends('_master')

@section('title')
	Welcome to Pult
@stop

@section('head')
 <!-- 2. jquery library -->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

    <!-- 3. flowplayer -->
    <script src="//releases.flowplayer.org/5.5.2/flowplayer.min.js"></script>

    <style type="text/css">
        .auto-style1 {
            text-decoration: underline;
        }
    </style>
@stop

@section('/body')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <script type="text/javascript">
        
        function playFunction(elmnt,id_of_element) {
            
            $.ajax({
                    type: 'POST',
                    url: '/play',
                    success: function (response) {
                        $('#playlist').html(response[0]);
                        $('#channelTitle').html(response[1]);
                        init();
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

        {{ Form::token() }}

            <table cellpadding="10">
                <tr>
                    <td valign="top">
                        <br />
                        <br />
                        <br />
                        
                        {{ $yourChannels}}

                        {{ $allChannels}}

                    </td>
                    <td valign="top">

                        <div>
                            <h3 id="channelTitle" >CNN Channel</h3>

                            <script language="JavaScript">
                                flowplayer("player", "http://releases.flowplayer.org/swf/flowplayer-3.2.18.swf");
                            </script>

                            <video id="vid" poster="splash-screen.jpg" controls>

                                <a id="flash-player"></a>
                                <script>
                                    flowplayer("flash-player", "flowplayer/flowplayer-3.2.16.swf", {
                                        clip: {
                                            url: 'http://ht.cdn.turner.com/cnn/big/bestoftv/2014/05/21/erin-pkg-brown-hash-brownies-life-sentence.cnn_21203752_1280x720_3500k.mp4',
                                            autoPlay: false,
                                            autoBuffering: true,
                                            scaling: 'half'
                                        },
                                        canvas: {
                                            backgroundColor: "#000000",
                                            backgroundGradient: "none"
                                        }

                                    });
                                </script>
                            </video>
                            <ul id="playlist">
                                <li class="active"><a href="http://ht.cdn.turner.com/cnn/big/world/2014/05/22/idesk-darlington-brazil-transit-strike.cnn_22114008_1280x720_3500k.mp4">Brazil Strike</a></li>
                                <li><a href="http://ht.cdn.turner.com/cnn/big/topvideos/2014/05/14/ac-intv-sterling-wife-relationship.cnn_14215109_1280x720_3500k.mp4">Sterling</a></li>
                                <li><a href="http://ht.cdn.turner.com/cnn/big/international/2014/05/06/anthony-bourdain-show-extension-russia-orig-ms.cnn_06173205_1280x720_3500k.mp4">Antony Burdain Russia</a></li>
                                <li><a href="http://ht.cdn.turner.com/cnn/big/bestoftv/2014/04/15/ab-anthony-bourdain-parts-unknown-vegas-3.cnn_15160303_1280x720_3500k.mp4">Antony Burdain Great Meal Mexico</a></li>
                            </ul>

                            

                            <!--This javascript runs the videos in playlist-->
                            <script type="text/javascript">
                                var video;
                                var playlist;
                                var tracks;
                                var current;

                                init();
                                function init() {
                                    current = 0;
                                    video = $('video');
                                    playlist = $('#playlist');
                                    tracks = playlist.find('li a');
                                    len = tracks.length - 1;
                                    //video[0].volume = .10;
                                    playlist.find('a').click(function (e) {
                                        e.preventDefault();
                                        link = $(this);
                                        current = link.parent().index();
                                        run(link, video[0]);
                                    });
                                    video[0].addEventListener('ended', function (e) {
                                        current++;
                                        if (current == len) {
                                            current = 0;
                                            link = playlist.find('a')[0];
                                        } else {
                                            link = playlist.find('a')[current];
                                        }
                                        run($(link), video[0]);
                                    });
                                    playlist.find('a')[0].click();
                                }
                                function run(link, player) {
                                    player.src = link.attr('href');
                                    par = link.parent();
                                    par.addClass('active').siblings().removeClass('active');
                                    video[0].load();
                                    video[0].play();
                                    video[0].width = 1000;
                                }
                            </script>
                        </div>
                    </td>
                </tr>
            </table>


        </div>

@stop