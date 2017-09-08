@extends('layouts.app')

@section('content')
    <b>Item</b>
    <header class="primaryInfo">
    @isset($item->metaInfo->icon)
        <img src='data:image/png;base64,{{ $item->metaInfo->icon->icon }}'/>
    @endisset
        <div class='itemName title'>
            <span class="name">{{ $item->description->name }}</span>
            <span class="category">{{ $item->typeInfo->overallCategory }} - {{ $item->typeInfo->category }} {{ $item->typeInfo->subCategory }}</span>
@isset($item->description->description)
            <span>{{ ParseMapleString($item->description->description) }}</span>
@endisset
        </div>
    </header>

    <div class='itemData'>
        @isset($item->metaInfo->equip)
        <section class="equipImagesContainer">
            <div class='title'><b>Preview</b></div>

            <div class='preview'>
                <div class='previewControls'>
                    <img src="https://labs.maplestory.io/api/gms/latest/character/{{GetRandomSkin()}}/{{$item->id}}" appendFramebook="https://labs.maplestory.io/api/gms/latest/character/{{GetRandomSkin()}}/{{$item->id}}" />
                    {{-- Uglify the framebooks so they can presented to the user in a reasonable and consumeable manner --}}
                    <div class='previewController'>
                    <select class='framebookSelector'>
                    @foreach($item->frameBooks as $animation => $book)
                        <option value='{{$animation}}'>{{$animation}}</option>
                    @endforeach
                    </select>
                    </div>
                </div>

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
        </section>

        @component('equip-info', ['item' => $item])
        @endcomponent
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
                    <a href='/item/{{$requiredItemOption->id}}' class='requiredItemOptionForSet'>
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
    float: right;
}

.previewController {
    display: inline-flex;
    flex-direction: column;
    justify-content: space-around;
}

.equipInfo, .dropInfo, .setInfo {
    align-items: center;
    display: inline-flex;
    flex-direction: column;
    padding: 0 16px;
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

</style>