@extends('layouts.app')

@section('title')
    {{$npc->name}}
@endsection

@section('css')
<style>
table tr td:first-child {
    text-align: right;
    padding-right: 5px;
}

section, header {
    display: inline-flex;
    flex-direction: column;
}

section {
    align-items: center;
    padding: 0 16px;
}

.previewController {
    display: flex;
    justify-content: space-around;
}

.preview {
    float: right;
}
</style>
@endsection

@section('content')
<header>
    <div class='title'>
        <span class='name'>{{$npc->name}}</span>
    </div>
</header>

<div>
    <section>
        <b class='title'>Info</b>
        <ul>
            <li>@if($npc->isShop)Is @else Is not @endif a shop</li>
        </ul>
    </section>

    <section class='preview'>
        <div class='title'><b>Preview</b></div>

        <div>
            <div class='previewControls'>
            @if(isset($npc->isComponentNPC) && $npc->isComponentNPC)
                <img src="https://labs.maplestory.io/api/gms/latest/character/{{$npc->componentSkin}}/{{implode($npc->componentIds, ',')}}" />
            @else
                <img src="https://labs.maplestory.io/api/gms/latest/npc/{{$npc->id}}/render/{{array_keys(get_object_vars($npc->framebooks))[0]}}" appendFramebook="https://labs.maplestory.io/api/gms/latest/npc/{{$npc->id}}/render" />
                {{-- Uglify the framebooks so they can presented to the user in a reasonable and consumeable manner --}}
                <div class='previewController'>
                <select class='framebookSelector'>
                @foreach($npc->framebooks as $animation => $frames)
                    <option value='{{$animation}}'>{{$animation}}</option>
                @endforeach
                </select>
                </div>
            @endif
            </div>

            @foreach($npc->framebooks as $animation => $frames)
                <div class='framebook' id='{{$animation}}' style='display: none;'>
                    <select class='frameSelector' style='display: none;' for='{{$animation}}'>
                    @for($frameNumber = 0; $frameNumber < $frames; ++$frameNumber)
                        <option value='{{$frameNumber}}'>Frame {{$frameNumber}}</option>
                    @endfor
                    </select>
                </div>
            @endforeach
        </div>
    </section>

    @if(count($npc->foundAt) > 0)
    <section>
        <b class='title'>Found at</b>
        <ul>
        @foreach($npc->foundAt as $mapEntry)
            <li><a href='/{{$region}}/{{$version}}/map/{{$mapEntry->id}}'>{{$mapEntry->name}} ({{$mapEntry->streetName}})</a></li>
        @endforeach
        </ul>
    </section>
    @endif

    <section>
        <b class='title'>Things this NPC will say</b>
        <ul>
            @foreach($npc->dialogue as $dialogue)
                <li>{!! ParseMapleString($dialogue) !!}</li>
            @endforeach
        </ul>
    </section>
</div>
@endsection

@section('js')
<script>
    $(function() {
        if($('.framebookSelector').change(function(){
            $('.framebook, .frame').hide()
            $('#' + $(this).val() + ', ' + '#' + $(this).val() + ' .frame:first').show()

            var shouldAppendFramebook = $("img[appendFramebook]")
            if (shouldAppendFramebook)
                shouldAppendFramebook.attr('src', shouldAppendFramebook.attr('appendFramebook') + '/' + $(this).val())

            var frameSelector = $($('#' + $(this).val() + ' .frameSelector')[0].outerHTML)
            copyAndShowFrameSelector(frameSelector)
        }).length > 0) {
            $('.framebook:first, .frame:first').show()
            copyAndShowFrameSelector($('.framebook:first .frameSelector'))
        }
    })

    function copyAndShowFrameSelector($frameSelector) {
        $frameSelector.show().change(function(){
            $('.frame').hide()
            $('.frame-' + $(this).val()).show()
            var frameBook = $('.framebookSelector').val()

            var shouldAppendFramebook = $("img[appendFramebook]")
            if (shouldAppendFramebook)
                shouldAppendFramebook.attr('src', shouldAppendFramebook.attr('appendFramebook') + '/' + frameBook + '/' + $(this).val())
        });

        $('.previewController .frameSelector').remove()
        $('.previewController').append($frameSelector)
    }
</script>
@endsection