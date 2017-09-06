@extends('layouts.app')

@section('content')
    <header class="primaryInfo card card-2">
    @isset($item->metaInfo->icon)
        <span class="icon"><img src='data:image/png;base64,{{ $item->metaInfo->icon->icon }}'/></span>
    @endisset
        <div class='itemName'>
        <span class="name">{{ $item->description->name }}</span>
        <span class="category">{{ $item->typeInfo->overallCategory }} - {{ $item->typeInfo->category }} {{ $item->typeInfo->subCategory }}</span>
        </div>
    </header>

    <div class='itemData'>
        <section class='dropInfo card card-2'>
            <b>Dropped By</b>
            <table>
            @foreach ($item->metaInfo->droppedBy as $mobInfo)
                <tr>
                    <td>{{$mobInfo->name}}</td>
                    <td><img src='https://labs.maplestory.io/api/gms/latest/mob/{{$mobInfo->id}}/icon'></td>
                </tr>
            @endforeach
            </table>
        </section>
        @isset($item->metaInfo->equip)
        <section class='equipInfo card card-2'>
            <b>Equipment Information</b>
            <table>
        @isset($item->metaInfo->equip->reqSTR)
                <tr>
                    <td>Requires this STR</td>
                    <td>{{ $item->metaInfo->equip->reqSTR }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->reqDEX)
                <tr>
                    <td>Requires this DEX</td>
                    <td>{{ $item->metaInfo->equip->reqDEX }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->reqINT)
                <tr>
                    <td>Requires this INT</td>
                    <td>{{ $item->metaInfo->equip->reqINT }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->reqLUK)
                <tr>
                    <td>Requires this LUK</td>
                    <td>{{ $item->metaInfo->equip->reqLUK }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->reqPOP)
                <tr>
                    <td>Requires this fame</td>
                    <td>{{ $item->metaInfo->equip->reqPOP }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->reqJob)
                <tr>
                    <td>Requires this job</td>
                    <td>{{ GetRequiredJobs($item->metaInfo->equip->reqJob) }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->reqJob2)
                <tr>
                    <td>Requires this secondary job</td>
                    <td>{{ $item->metaInfo->equip->reqJob2 }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->reqSpecJob)
                <tr>
                    <td>Requires this special job</td>
                    <td>{{ $item->metaInfo->equip->reqSpecJob }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->reqLevel)
                <tr>
                    <td>Requires this level</td>
                    <td>{{ $item->metaInfo->equip->reqLevel }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->tuc)
                <tr>
                    <td>Scrollable Count</td>
                    <td>{{ $item->metaInfo->equip->tuc }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incSTR)
                <tr>
                    <td>Increases the character's STR by</td>
                    <td>{{ $item->metaInfo->equip->incSTR }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incDEX)
                <tr>
                    <td>Increases the character's DEX by</td>
                    <td>{{ $item->metaInfo->equip->incDEX }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incINT)
                <tr>
                    <td>Increases the character's INT by</td>
                    <td>{{ $item->metaInfo->equip->incINT }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incLUK)
                <tr>
                    <td>Increases the character's LUK by</td>
                    <td>{{ $item->metaInfo->equip->incLUK }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incMHP)
                <tr>
                    <td>Increases the character's Max HP by</td>
                    <td>{{ $item->metaInfo->equip->incMHP }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incMMP)
                <tr>
                    <td>Increases the character's Max MP by</td>
                    <td>{{ $item->metaInfo->equip->incMMP }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incPAD)
                <tr>
                    <td>Increases the character's Weapon ATT by</td>
                    <td>{{ $item->metaInfo->equip->incPAD }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incMAD)
                <tr>
                    <td>Increases the character's Magic ATT by</td>
                    <td>{{ $item->metaInfo->equip->incMAD }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incPDD)
                <tr>
                    <td>Increases the character's Weapon DEF by</td>
                    <td>{{ $item->metaInfo->equip->incPDD }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incMDD)
                <tr>
                    <td>Increases the character's Magic DEF by</td>
                    <td>{{ $item->metaInfo->equip->incMDD }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incACC)
                <tr>
                    <td>Increases the character's ACC by</td>
                    <td>{{ $item->metaInfo->equip->incACC }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incEVA)
                <tr>
                    <td>Increases the character's EVA by</td>
                    <td>{{ $item->metaInfo->equip->incEVA }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incCraft)
                <tr>
                    <td>Increases the character's Craft by</td>
                    <td>{{ $item->metaInfo->equip->incCraft }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incSpeed)
                <tr>
                    <td>Increases the character's Speed by</td>
                    <td>{{ $item->metaInfo->equip->incSpeed }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->incJump)
                <tr>
                    <td>Increases the character's Jump by</td>
                    <td>{{ $item->metaInfo->equip->incJump }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->tradeBlock)
                <tr>
                    <td>Is trade blocked</td>
                    <td>{{ $item->metaInfo->equip->tradeBlock == 1 ? 'true' : 'false' }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->equipTradeBlock)
                <tr>
                    <td>Is tradeblocked after equipped</td>
                    <td>{{ $item->metaInfo->equip->equipTradeBlock == 1 ? 'true' : 'false' }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->exItem)
                <tr>
                    <td>Is an Exclusive/Unique item</td>
                    <td>{{ $item->metaInfo->equip->exItem == 1 ? 'true' : 'false' }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->charmEXP)
                <tr>
                    <td>Increases the character's charm by </td>
                    <td>{{ $item->metaInfo->equip->charmEXP }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->willEXP)
                <tr>
                    <td>Increases the character's willpower by </td>
                    <td>{{ $item->metaInfo->equip->willEXP }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->charismaEXP)
                <tr>
                    <td>Increases the character's charisma by </td>
                    <td>{{ $item->metaInfo->equip->charismaEXP }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->craftEXP)
                <tr>
                    <td>Increases the character's crafting by </td>
                    <td>{{ $item->metaInfo->equip->craftEXP }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->senseEXP)
                <tr>
                    <td>Increases the character's insight by </td>
                    <td>{{ $item->metaInfo->equip->senseEXP }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->tradeAvailable)
                <tr>
                    <td>The type of trading that's available</td>
                    <td>{{ GetTradeAvailable($item->metaInfo->equip->tradeAvailable) }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->superiorEqp)
                <tr>
                    <td>If the item is a superior equip</td>
                    <td>{{ $item->metaInfo->equip->superiorEqp == 1 ? 'true' : 'false' }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->noPotential)
                <tr>
                    <td>The character can not put a potential on this item</td>
                    <td>{{ $item->metaInfo->equip->noPotential == 1 ? 'true' : 'false' }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->unchangeable)
                <tr>
                    <td>The character can not change anything on this item</td>
                    <td>{{ $item->metaInfo->equip->unchangeable == 1 ? 'true' : 'false' }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->durability)
                <tr>
                    <td>This item has a durability</td>
                    <td>{{ $item->metaInfo->equip->durability == 1 ? 'true' : 'false' }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->accountSharable)
                <tr>
                    <td>Is possible to move in account</td>
                    <td>{{ $item->metaInfo->equip->accountSharable == 1 ? 'true' : 'false' }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->attackSpeed)
                <tr>
                    <td>Attack Speed</td>
                    <td>{{ $item->metaInfo->equip->attackSpeed }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->bdR)
                <tr>
                    <td>The boss damage this item gives</td>
                    <td>{{ $item->metaInfo->equip->bdR }}%</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->bossReward)
                <tr>
                    <td>Reward for fighting against bosses</td>
                    <td>{{ $item->metaInfo->equip->bossReward == 1 ? 'true' : 'false' }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->imdR)
                <tr>
                    <td>The ignore defense this item gives</td>
                    <td>{{ $item->metaInfo->equip->imdR }}%</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->islot)
                <tr>
                    <td>Exclusive slot of item</td>
                    <td>{{ $item->metaInfo->equip->islot }}</td>
                </tr>
        @endisset
        @isset($item->metaInfo->equip->vslot)
                <tr>
                    <td>Visual Slots of item</td>
                    <td>{{ $item->metaInfo->equip->vslot }}</td>
                </tr>
        @endisset
            </table>
        </section>

        <section class="equipImagesContainer card card-2">
            <b>Preview</b>
            <section class="characterPreview">
                <img src="http://labs.maplestory.io/api/gms/latest/character/{{GetRandomSkin()}}/{{$item->id}}" appendFramebook="http://labs.maplestory.io/api/gms/latest/character/{{GetRandomSkin()}}/{{$item->id}}" />
            </section>

            {{-- Uglify the framebooks so they can presented to the user in a reasonable and consumeable manner --}}
            <select class='framebookSelector'>
            @foreach($item->frameBooks as $animation => $book)
                <option value='{{$animation}}'>{{$animation}}</option>
            @endforeach
            </select>

            @foreach($item->frameBooks as $animation => $book)
                <div class='framebook' id='{{$animation}}' style='display: none;'>
                    <select class='frameSelector'>
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
                                            <tr><td>{{$mapFrom}}</td><td><span>{{$mapOffset->x}}, {{$mapOffset->y}}</span></td></tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endisset
                            @endforeach
                        </div>
                        @endforeach
                </div>
            @endforeach
        </section>
        @endisset
    </div>

    <script>
    $(function() {
        $('.framebookSelector').change(function(){
            $('.framebook').hide()
            $('#' + $(this).val() + ', ' + '#' + $(this).val() + ' .frame:first').show()

            var shouldAppendFramebook = $("img[appendFramebook]")
            if (shouldAppendFramebook)
                shouldAppendFramebook.attr('src', shouldAppendFramebook.attr('appendFramebook') + '/' + $(this).val())
        })
    })

    $(function() {
        $('.frameSelector').change(function(){
            $('.frame').hide()
            $('.frame-' + $(this).val()).show()
            var frameBook = $('.framebookSelector').val()

            var shouldAppendFramebook = $("img[appendFramebook]")
            if (shouldAppendFramebook)
                shouldAppendFramebook.attr('src', shouldAppendFramebook.attr('appendFramebook') + '/' + frameBook + '/' + $(this).val())
        })
    })

    $('.framebook:first, .frame:first').show()
    </script>
@endsection

<style>

.itemName {
    display: flex;
    flex-direction: column;
}

.primaryInfo.card {
    display: inline-flex;
    float: none;
}

.card.card-2 {
    padding: 5px;
    justify-content: center;
    align-items: center;
}

.equipImagesContainer.card.card-2, .equipInfo.card.card-2, .framebook, .dropInfo.card.card-2 {
    display: inline-flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.equipImagesContainer.card.card-2, .framebook {
    float: right;
}

.primaryInfo.card img {
    margin-right: 8px;
}

table tr td:first-child {
    text-align: right;
    padding-right: 5px;
}

.equipInfo table tr td:first-child:after {
    content: ': ';
}

</style>