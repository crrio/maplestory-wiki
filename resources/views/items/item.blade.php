@extends('layouts.app')

@section('title')
    {{ $item->description->name }}
@endsection

@section('content')
<style>

.itemName {
    display: flex;
    flex-direction: column;
}

.primaryInfo {
    display: flex;
    align-items: center;
}

.primaryInfo img, .equipImagesContainer .preview .previewControls img, .requiredItemOptionForSet img {
    margin-right: 8px;
    float: left;
    flex-shrink: 0;
}

table tr td:first-child {
    text-align: right;
    padding-right: 5px;
}

.equipInfo table tr td:first-child:after {
    content: ': ';
}

.previewControls {
    display: inline-flex;
    overflow: hidden;
    float: left;
}

.equipInfo, .dropInfo, .setInfo {
    display: inline-flex;
    flex-direction: column;
    padding: 0 16px;
}

.equipInfo {
    background: rgba(0,0,0,0.1);
    width: 100%;
    padding: 10px 20px;
    border-radius: 5px;
}

#framebookexpand {
    float: right;
}

.requiredItemForSet {
    margin: 4px 0;
}

.requiredItemOptionForSet {
    display: flex;
    align-items: center;
}

.dropInfo li {
    display: flex;
    margin: 6px 0;
}

.dropInfo li a {
    overflow: hidden;
    display: flex;
    align-items: center;
}

.dropInfo img {
    margin-right: 8px;
    float: left;
    flex-shrink: 0;
}

.preview {
    overflow: hidden;
    min-height: 100px;
}

</style>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="/{{$region}}/{{$version}}/items">Items</a></li>
        <li class="breadcrumb-item active">{{ $item->description->name }}</li>
    </ol>
    <header class="primaryInfo">
    @isset($item->metaInfo->icon)
        <img src='data:image/png;base64,{{ $item->metaInfo->icon->icon }}' style="width:200px;image-rendering: pixelated;margin:20px;"/>
    @endisset
        <div class='itemName title'>
            <span class="name display-4">{{ $item->description->name }}</span>
            <span class="category">{{ $item->typeInfo->overallCategory }} - {{ $item->typeInfo->category }} {{ $item->typeInfo->subCategory }}</span>
@isset($item->description->description)
            <span>{!! ParseMapleString($item->description->description) !!}</span>
@endisset
        </div>
    </header>

    <div class='itemData'>
        @isset($item->metaInfo->equip)
        @component('items.equip-info', ['item' => $item])
        @endcomponent
        @isset($item->frameBooks)
        <section class="equipImagesContainer">
            <b class='title mb-3'>
                Preview
                <a class="btn btn-soft btn-sm" data-toggle="collapse" href="#framebookexpand" aria-expanded="false" aria-controls="framebookexpand">
                    View Technical Details
                </a>
            </b>
            <div class='preview'>
                <div class='previewControls'>
                @php
                    $skinId = GetRandomSkin();
                @endphp
                    <img src="https://labs.maplestory.io/api/gms/latest/character/{{$skinId}}/{{$item->id}}" appendFramebook="https://labs.maplestory.io/api/gms/latest/character/{{$skinId}}/{{$item->id}}" />
                    {{-- Uglify the framebooks so they can presented to the user in a reasonable and consumeable manner --}}
                    <div class='previewController'>
                    <select class='framebookSelector'>
                    @foreach($item->frameBooks as $animation => $book)
                        <option value='{{$animation}}'>{{$animation}}</option>
                    @endforeach
                    </select>
                    </div>
                </div>
                <div id="framebookexpand" class="collapse">
                    @foreach($item->frameBooks as $animation => $book)
                        <div class='framebook' id='{{$animation}}' style='display: none;'>
                            <select class='frameSelector' style='display: none;'>
                                @foreach($book->frames as $frameNumber => $frame)
                                    <option value='{{$frameNumber}}'>Frame {{$frameNumber}}</option>
                                @endforeach
                            </select>
                                @foreach($book->frames as $frameNumber => $frame)
                                <div class='frame frame-{{$frameNumber}}' style='display: none;'>
                                    @foreach($frame->effects as $effectName => $effectSegment)
                                    @isset($effectSegment->image)
                                        <div>
                                            <span>{{$effectName}}</span>
                                            <img src='data:image/png;base64,{{$effectSegment->image}}' />
                                            <span>Origin</span>
                                            <span>{{$effectSegment->originOrZero->x}}, {{$effectSegment->originOrZero->y}}</span>
                                            <span>Map Offsets</span>
                                            <table>
                                                @foreach($effectSegment->mapOffset as $mapFrom => $mapOffset)
                                                    <tr><td>{{$mapFrom}}</td><td>{{$mapOffset->x}}, {{$mapOffset->y}}</td></tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    @endisset
                                    @endforeach
                                </div>
                                @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endisset
        @endisset

        @if(count($item->metaInfo->droppedBy) > 0)
        <section class='dropInfo'>
            <b>Dropped By</b>
            <ul>
            @foreach ($item->metaInfo->droppedBy as $mobInfo)
                <li><a href='/mob/{{$mobInfo->id}}'><img src='https://labs.maplestory.io/api/gms/latest/mob/{{$mobInfo->id}}/icon'> {{$mobInfo->name}}</a></li>
            @endforeach
            </ul>
        </section>
        @endif

        @isset($item->metaInfo->set)
        <section class='setInfo'>
            <b>Set Information</b>
            <b>{{$item->metaInfo->set->setName}}</b>
            <span>(Requires {{$item->metaInfo->set->completeCount}} of {{count($item->metaInfo->set->requiredItems)}})</span>
            <div class='requiredItemsForSet'>
            @foreach($item->metaInfo->set->requiredItems as $requiredItemEntry)
                <div class='requiredItemForSet'>
                    @foreach($requiredItemEntry as $requiredItemOption)
                    <a href='/{{$region}}/{{$version}}/item/{{$requiredItemOption->id}}' class='requiredItemOptionForSet'>
                        <img src='https://labs.maplestory.io/api/gms/latest/item/{{$requiredItemOption->id}}/icon' />
                        <span>{{$requiredItemOption->name}}</span>
                    </a>
                    @endforeach
                </div>
            @endforeach
            </div>
        </section>
        @endisset
    </div>

    <script>
    $(function() {
        $('.framebookSelector').change(function(){
            $('.framebook, .frame').hide()
            $('#' + $(this).val() + ', ' + '#' + $(this).val() + ' .frame:first').show()

            var shouldAppendFramebook = $("img[appendFramebook]")
            if (shouldAppendFramebook)
                shouldAppendFramebook.attr('src', shouldAppendFramebook.attr('appendFramebook') + '/' + $(this).val())

            var frameSelector = $($('#' + $(this).val() + ' .frameSelector')[0].outerHTML)
            copyAndShowFrameSelector(frameSelector)
        })

        $('.framebook:first, .frame:first').show()
        copyAndShowFrameSelector($('.framebook:first .frameSelector'))
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